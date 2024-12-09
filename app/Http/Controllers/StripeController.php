<?php

namespace App\Http\Controllers;

use App\Mail\ordenMail;
use App\Models\DetalleOrden;
use App\Models\EdicionesProductos;
use App\Models\Orden;
use App\Models\Pago;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StripeController extends Controller
{
    public function __construct()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }

    public function createPaymentIntent(Request $request)
    {
        $contenidoCarrito = collect(session()->get('carrito', []));
        $total = $contenidoCarrito->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => $total * 100,
                'currency' => 'mxn',
                'payment_method_types' => ['card'],
            ]);

            Log::info('PaymentIntent creado:', ['clientSecret' => $paymentIntent->client_secret]);

            return response()->json([
                'clientSecret' => $paymentIntent->client_secret,
            ]);
        } catch (\Exception $e) {
            Log::error('Error creando PaymentIntent:', ['error' => $e->getMessage()]);
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function procesarPago(Request $request)
    {
        $carrito = session()->get('carrito', []);

        if (empty($carrito)) {
            return response()->json(['success' => false, 'message' => 'El carrito está vacío.'], 400);
        }

        $paymentIntentId = $request->input('payment_intent_id');

        foreach ($carrito as $key => $item) {
            $producto = EdicionesProductos::find($item['id']);

            if (!$producto) {
                return back()->withErrors(['error' => "El producto '{$item['name']}' no existe."]);
            }

            $stockDisponible = EdicionesProductos::where('nombre', $producto->nombre)
                                ->where('talla', $item['attributes']['talla'])
                                ->value('cantidad');

            if ($item['quantity'] > $stockDisponible) {
                return back()->withErrors([
                    'error' => "El producto '{$item['name']}' no tiene suficiente stock para la talla '{$item['attributes']['talla']}'."
                ]);
            }
        }
        foreach ($carrito as $productoId => $detalle) {
            $producto = EdicionesProductos::find($productoId);

            if (!$producto) {
                return redirect()->back()->with('error', "El producto con ID {$productoId} no existe.");
            }

            if ($producto->estado !== 'activo') {
                session()->forget('carrito');
                return redirect()->back()->with('error', "El producto '{$producto->nombre}' no está disponible.");
            }
        }


        try {
            $paymentIntent = $this->obtenerPaymentIntentDesdeStripe($paymentIntentId);
        
            if (!$paymentIntent || $paymentIntent->status !== 'succeeded') {
                return response()->json(['success' => false, 'message' => 'El pago no se procesó correctamente.'], 500);
            }
        
            DB::beginTransaction();
        
            foreach ($carrito as $productoId => $detalle) {
                $producto = EdicionesProductos::lockForUpdate()->find($productoId);
        
                if (!$producto) {
                    DB::rollBack();
                    return response()->json(['success' => false, 'message' => 'Producto no encontrado.'], 404);
                }
        
                if ($producto->cantidad < $detalle['quantity']) {
                    DB::rollBack();
                    session()->forget('carrito');
                    return response()->json([
                        'success' => false,
                        'message' => "El producto '{$producto->nombre}' no tiene suficiente stock.",
                    ], 400);
                }
            }
        
            // Guardar la orden y el pago
            $orden = $this->guardarOrden($carrito, $paymentIntent);
            $this->guardarPago($orden, $paymentIntent);
        
            // Recuperar productos y total
            $productos = DetalleOrden::where('ordenes_id', $orden->id)
                ->with('edicionProducto') // Asegúrate de que la relación esté definida en DetalleOrden
                ->get();
        
            $total = $orden->total;
        
            // Confirmar la transacción
            DB::commit();
        
            // Enviar el correo
            $usuario = auth()->user();
            // Crear el objeto del correo
            $correo = new ordenMail($orden->id, $productos, $total);

            // Ver el contenido del correo antes de enviarlo
            dd($correo->render());  // Muestra el contenido HTML del correo

            // Enviar el correo
            Mail::to($usuario->email)->send($correo);
        
            Log::info('Orden creada con éxito', ['orden_id' => $orden->id]);
        
            return response()->json([
                'success' => true,
                'message' => 'Pago procesado exitosamente.',
                'orden_id' => $orden->id,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al procesar el pago:', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Hubo un error al procesar el pago: ' . $e->getMessage(),
            ], 500);
        }
        

    private function guardarOrden($carrito, $paymentIntent)
    {
        $total = $paymentIntent->amount_received / 100;

        $usuario = auth()->user();

        $tipoPersona = $usuario->persona->tipoPersona()->first();

        $orden = Orden::create([
            'tipo_personas_id' => $tipoPersona->id,
            'fecha_orden' => now(),
            'total' => $total,
            'envios_domicilio' => 1,
            'estado' => 'Pendiente',
        ]);

        foreach ($carrito as $producto) {
            DetalleOrden::create([
                'ediciones_productos_id' => $producto['id'],
                'ordenes_id' => $orden->id,
                'cantidad' => $producto['quantity'],
                'total' => $producto['price'] * $producto['quantity'],
            ]);
        }

        session()->forget('carrito');

        Log::info('Orden guardada correctamente', ['orden_id' => $orden->id]);

        return $orden;
    }

    private function guardarPago($orden, $paymentIntent)
    {
        Pago::create([
            'ordenes_id' => $orden->id,
            'descuento' => 0,
            'pago_total' => $paymentIntent->amount_received / 100,
            'metodo_pago' => 'Tarjeta',
            'fecha_pago' => now(),
            'estado' => 'pagado',
            'num_referencia' => $paymentIntent->id,
        ]);

        $orden->update(['estado' => 'Pagada']);

        Log::info('Pago guardado correctamente', ['orden_id' => $orden->id, 'pago_total' => $paymentIntent->amount_received / 100]);
    }

    private function obtenerPaymentIntentDesdeStripe($paymentIntentId)
    {
        return PaymentIntent::retrieve($paymentIntentId);
    }

    public function verificarProductos(Request $request)
    {
        $carrito = session()->get('carrito', []);

        if (empty($carrito)) {
            return redirect()->back()->with('error', 'El carrito está vacío.');
        }

        foreach ($carrito as $productoId => $detalle) {
            $producto = EdicionesProductos::find($productoId);

            if (!$producto) {
                return redirect()->back()->with('error', "El producto con ID {$productoId} no existe.");
            }

            if ($producto->estado !== 'activo') {
                session()->forget('carrito');

                return redirect()->back()->with('error', "El producto '{$producto->nombre}' no está disponible.");
            }
        }
        foreach ($carrito as $productoId => $detalle) {
            $producto = EdicionesProductos::lockForUpdate()->find($productoId);

            if (!$producto) {
                DB::rollBack();
                return response()->json(['success' => false, 'message' => 'Producto no encontrado.'], 404);
            }

            if ($producto->cantidad < $detalle['quantity']) {
                DB::rollBack();
                session()->forget('carrito');
                return response()->json([
                    'success' => false,
                    'message' => "El producto '{$producto->nombre}' no tiene suficiente stock.",
                ], 400);
            }
        }

        return redirect()->route('detalleOrden');
    }
}
