<?php

namespace App\Http\Controllers;

use App\Models\ediciones_productos;
use App\Models\EdicionesProductos;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\View\View;

class carritoController extends Controller
{
    // Agregar un producto al carrito
    public function agregarProducto(Request $request, $productoId)
    {
        // Buscar el producto
        $producto = EdicionesProductos::find($productoId);
        
        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }
    
        // Obtener la talla y la cantidad desde la solicitud
        $talla = $request->input('talla');
        $cantidad = $request->input('cantidad', 1);
    
        if (!$talla) {
            return back()->withErrors(['error' => 'Por favor selecciona una talla.']);
        }
    
        if ($cantidad <= 0) {
            return back()->withErrors(['error' => 'Cantidad inválida.']);
        }
    
        // Verificar si hay suficiente stock para la talla seleccionada
        $stockDisponible = ediciones_productos::where('nombre', $producto->nombre)
                            ->where('talla', $talla)
                            ->value('cantidad');
    
        if ($cantidad > $stockDisponible) {
            return back()->withErrors(['error' => 'Lo sentimos, stock insuficiente, intenta con otra cantidad menor.']);
        }
    
        // Recuperar el carrito de la sesión
        $carrito = collect(session()->get('carrito', []));
    
        // Identificador único para producto+talla
        $productoTallaKey = "{$productoId}_{$talla}";
    
        // Verificar si el producto+talla ya existe en el carrito
        if ($carrito->has($productoTallaKey)) {
            // Incrementar la cantidad
            $carrito->put($productoTallaKey, [
                'id' => $producto->id,
                'name' => $producto->nombre,
                'price' => $producto->costo_precio_venta,
                'quantity' => $carrito[$productoTallaKey]['quantity'] + $cantidad,
                'attributes' => [
                    'imagen' => $producto->imagen_producto_final,
                    'talla' => $talla,
                ]
            ]);
        } else {
            // Agregar como nuevo producto+talla
            $carrito->put($productoTallaKey, [
                'id' => $producto->id,
                'name' => $producto->nombre,
                'price' => $producto->costo_precio_venta,
                'quantity' => $cantidad,
                'attributes' => [
                    'imagen' => $producto->imagen_producto_final,
                    'talla' => $talla,
                ]
            ]);
        }

        
    
        // Guardar el carrito actualizado en la sesión
        session()->put('carrito', $carrito);
    
        // Mensaje de éxito
        session()->flash('success', 'Producto agregado al carrito.');
        
    
        // Redirigir a la vista del carrito o al detalle del producto
        return redirect()->back();
    }
    
    // Mostrar contenido del carrito
    public function mostrarCarrito()
    {
        return view('carrito');
    }

    
    // Actualizar cantidad de un producto en el carrito
    public function actualizarCantidad(Request $request, $productoId)
    {
        $carrito = collect(session()->get('carrito', []));
        
        if ($carrito->has($productoId)) {
            $cantidad = $request->input('cantidad', 1);
            if ($cantidad <= 0) {
                return response()->json(['message' => 'Cantidad inválida'], 400);
            }

            // Actualizamos la cantidad
            $carrito[$productoId]['quantity'] = $cantidad;

            // Guardamos el carrito actualizado en la sesión
            session()->put('carrito', $carrito->toArray());

            // Calcular subtotal y total
            $subtotal = $carrito[$productoId]['price'] * $carrito[$productoId]['quantity'];
            $total = $carrito->sum(function($item) {
                return $item['price'] * $item['quantity'];
            });

            return response()->json([
                'success' => true,
                'subtotal' => $subtotal,
                'total' => $total
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Producto no encontrado'], 404);
    }

    // Eliminar un producto del carrito
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

    // Vaciar el carrito
    public function vaciarCarrito()
    {
        session()->forget('carrito');  // Limpiamos el carrito de la sesión
        return response()->json(['success' => true]);
    }

}







