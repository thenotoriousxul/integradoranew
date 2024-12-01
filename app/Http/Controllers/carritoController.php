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
    // Agregar un producto al carrito
    public function agregarProducto(Request $request, $productoId)
    {
        $producto = EdicionesProductos::find($productoId);
        
        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }
    
        $talla = $request->input('talla');
        $cantidad = $request->input('cantidad', 1);
    
        if (!$talla) {
            return back()->withErrors(['error' => 'Por favor selecciona una talla.']);
        }
    
        if ($cantidad <= 0) {
            return back()->withErrors(['error' => 'Cantidad inválida.']);
        }
    
        $stockDisponible = EdicionesProductos::where('nombre', $producto->nombre)
                            ->where('talla', $talla)
                            ->value('cantidad');
    
        if ($cantidad > $stockDisponible) {
            return back()->withErrors(['error' => 'Lo sentimos, stock insuficiente, intenta con otra cantidad menor.']);
        }
    
        $carrito = collect(session()->get('carrito', []));
    
        $productoTallaKey = "{$productoId}_{$talla}";
    
        if ($carrito->has($productoTallaKey)) {
            $precio = $producto->rebaja ? $producto->precio_rebajado : $producto->costo_precio_venta; // Usa el precio rebajado si hay rebaja
            $carrito->put($productoTallaKey, [
                'id' => $producto->id,
                'name' => $producto->nombre,
                'price' => $precio,
                'quantity' => $carrito[$productoTallaKey]['quantity'] + $cantidad,
                'attributes' => [
                    'imagen' => $producto->imagen_producto_final,
                    'talla' => $talla,
                ]
            ]);
        } else {
            $precio = $producto->rebaja ? $producto->precio_rebajado : $producto->costo_precio_venta; // Usa el precio rebajado si hay rebaja
            $carrito->put($productoTallaKey, [
                'id' => $producto->id,
                'name' => $producto->nombre,
                'price' => $precio,
                'quantity' => $cantidad,
                'attributes' => [
                    'imagen' => $producto->imagen_producto_final,
                    'talla' => $talla,
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
    
            // Guardamos el carrito actualizado en la sesión
            session()->put('carrito', $carrito->toArray());
    
            // Calcular total después de eliminar
            $total = $carrito->sum(function($item) {
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
        session()->forget('carrito');  // Limpiamos el carrito de la sesión
        return response()->json(['success' => true]);
        
    }

}







