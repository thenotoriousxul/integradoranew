<?php

namespace App\Http\Controllers;

use App\Models\DetalleOrden;
use App\Models\Orden;
use App\Models\Pago;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Models\User;

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

            return response()->json([
                'clientSecret' => $paymentIntent->client_secret,
            ]);
        } catch (\Exception $e) {
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

        try {
            $paymentIntent = $this->obtenerPaymentIntentDesdeStripe($paymentIntentId);

            if (!$paymentIntent || $paymentIntent->status !== 'succeeded') {
                return response()->json(['success' => false, 'message' => 'El pago no se procesó correctamente.'], 500);
            }

            $orden = $this->guardarOrden($carrito, $paymentIntent);

            $this->guardarPago($orden, $paymentIntent);


            return response()->json([
                'success' => true,
                'message' => 'Pago procesado exitosamente.',
                'orden_id' => $orden->id,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Hubo un error al procesar el pago: ' . $e->getMessage(),
            ], 500);
        }
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

        $orden->update([ 'estado' => 'Pagada', ]);
    }

    private function obtenerPaymentIntentDesdeStripe($paymentIntentId)
    {
        return PaymentIntent::retrieve($paymentIntentId);
    }

}