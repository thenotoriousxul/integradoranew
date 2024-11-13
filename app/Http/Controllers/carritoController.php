<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class carritoController extends Controller
{
    // Agregar un producto al carrito
    public function agregarProducto(Request $request, $productoId)
{
    $producto = Producto::find($productoId);
    
    if (!$producto) {
        return response()->json(['message' => 'Producto no encontrado'], 404);
    }

    // Obtener la cantidad desde la solicitud, con un valor predeterminado de 1
    $cantidad = $request->input('cantidad', 1);

    if ($cantidad <= 0) {
        return response()->json(['message' => 'Cantidad inválida'], 400);
    }

    // Recuperamos el carrito de la sesión
    $carrito = collect(session()->get('carrito', [])); // Usamos colección en vez de array

    // Verificar si el producto ya existe en el carrito
    if ($carrito->has($productoId)) {
        // Si existe, incrementamos la cantidad
        $carrito->put($productoId, [
            'id' => $producto->id,
            'tipo' => $producto->tipo,
            'price' => $producto->costo,
            'quantity' => $carrito[$productoId]['quantity'] + $cantidad, // Incrementamos la cantidad
            'attributes' => [
                'imagen' => $producto->imagen_producto,
            ]
        ]);
    } else {
        // Si no existe, lo agregamos con la cantidad especificada
        $carrito->put($productoId, [
            'id' => $producto->id,
            'tipo' => $producto->tipo,
            'price' => $producto->costo,
            'quantity' => $cantidad,
            'attributes' => [
                'imagen' => $producto->imagen_producto,
            ]
        ]);
    }

    // Guardamos el carrito actualizado en la sesión
    session()->put('carrito', $carrito);

    // Respondemos con el carrito actualizado
    return view('producto_detalle', compact('producto'));

}



    // Mostrar contenido del carrito
    public function mostrarCarrito()
    {
        $contenidoCarrito = collect(session()->get('carrito', []));
        return view('carrito', data:  compact('contenidoCarrito'));
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







