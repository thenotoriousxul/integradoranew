<?php

namespace App\Http\Controllers;

use App\Models\ediciones_productos;
use App\Models\EdicionesProductos;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class carritoController extends Controller
{
    public function agregarProducto(Request $request, $productoId)
    {
        $producto = EdicionesProductos::find($productoId);

        $nombreProducto = $producto->nombre;

        $tallaEspecifica = $request->input('talla');
        $cantidad = $request->input('cantidad', 1);

        $productoConTallaEspecifica = EdicionesProductos::where('nombre', $nombreProducto)
            ->where('talla', $tallaEspecifica)
            ->first();

        $productoId = $productoConTallaEspecifica->id;

        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        if (!$tallaEspecifica) {
            return back()->withErrors(['error' => 'Por favor selecciona una talla.']);
        }

        if ($cantidad <= 0) {
            return back()->withErrors(['error' => 'Cantidad inválida.']);
        }

        $stockDisponible = EdicionesProductos::where('nombre', $producto->nombre)
            ->where('talla', $tallaEspecifica)
            ->value('cantidad');

        $carrito = collect(session()->get('carrito', []));
        $productoTallaKey = "{$productoId}_{$tallaEspecifica}";
        $cantidadEnCarrito = $carrito[$productoTallaKey]['quantity'] ?? 0;

        //checa la cantidad de producto que ya esta en el carrito y la compara con el stock disponible
        if (($cantidadEnCarrito + $cantidad) > $stockDisponible) {
            return back()->withErrors(['error' => 'Lo sentimos, stock insuficiente. Intenta con otra cantidad menor.']);
        }

        if ($carrito->has($productoTallaKey)) {
            $precio = $productoConTallaEspecifica->rebaja ? $productoConTallaEspecifica->precio_rebajado : $productoConTallaEspecificacosto_precio_venta;
            $carrito->put($productoTallaKey, [
                'id' => $productoConTallaEspecifica->id,
                'name' => $productoConTallaEspecifica->nombre,
                'price' => $precio,
                'quantity' => $carrito[$productoTallaKey]['quantity'] + $cantidad,
                'attributes' => [
                    'imagen' => $productoConTallaEspecifica->imagen_producto_final,
                    'talla' => $tallaEspecifica,
                ]
            ]);
        } else {
            $precio = $productoConTallaEspecifica->rebaja ? $productoConTallaEspecifica->precio_rebajado : $productoConTallaEspecifica->costo_precio_venta; // Usa el precio rebajado si hay rebaja
            $carrito->put($productoTallaKey, [
                'id' => $productoConTallaEspecifica->id,
                'name' => $productoConTallaEspecifica->nombre,
                'price' => $precio,
                'quantity' => $cantidad,
                'attributes' => [
                    'imagen' => $productoConTallaEspecifica->imagen_producto_final,
                    'talla' => $tallaEspecifica,
                ]
            ]);
        }
        session()->put('carrito', $carrito);

        session()->flash('success', 'Producto agregado al carrito.');
        return redirect()->back();
    }

    public function mostrarCarrito()
    {
        return view('carrito');
    }

    public function eliminarProducto($productoId)
    {
        $carrito = collect(session()->get('carrito', []));

        if ($carrito->has($productoId)) {
            $carrito->forget($productoId);

            session()->put('carrito', $carrito->toArray());

            $total = $carrito->sum(function ($item) {
                return $item['price'] * $item['quantity'];
            });

            return response()->json([
                'success' => true,
                'total' => $total
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Producto no encontrado'], 404);
    }

    public function vaciarCarrito()
    {
        session()->forget('carrito');
        return response()->json(['success' => true]);
    }
}
