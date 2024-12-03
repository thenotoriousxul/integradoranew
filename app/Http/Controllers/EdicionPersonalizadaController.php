<?php

namespace App\Http\Controllers;

use App\Models\Edicion;
use App\Models\EdicionesProductos;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EdicionPersonalizadaController extends Controller
{
    public function create()
    {
        $ediciones = Edicion::all();
        $productos = Producto::where('estado', 'activo')->get();

        return view('admin.ediciones_personalizadas.crear', compact('ediciones', 'productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:55',
            'edicion_id' => 'required|exists:edicion,id',
            'productos_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
            'imagen_producto_final' => 'nullable|image|max:2048',
        ]);
    
        $imageUrl = null;
    
        // Subir imagen frontal a S3
        if ($request->hasFile('imagen_producto_final')) {
            $imagePath = $request->file('imagen_producto_final')->store('ediciones_productos', 's3');
            $imageUrl = Storage::disk('s3')->url($imagePath);
        }
    
        $imageUrlTrasera = $imageUrl; // Imagen trasera toma el valor de la frontal
    
        // Asignar todos los valores de forma explícita
        $data = [
            'nombre' => $request->nombre,
            'edicion_id' => $request->edicion_id,
            'productos_id' => $request->productos_id,
            'cantidad' => $request->cantidad,
            'imagen_producto_final' => $imageUrl,
            'imagen_producto_trasera' => $imageUrlTrasera,
            'personalizada' => 1, // Aquí siempre será 1
            'estado' => 'activo',
        ];
    
        EdicionesProductos::create($data);
    
        return redirect()->route('personalizacion')
            ->with('success', 'Edición personalizada creada correctamente.');
    }
    
    public function agregarAlCarrito(Request $request, $productoId)
    {
        // Buscar el producto
        $producto = EdicionesProductos::find($productoId);
    
        // Si el producto no existe, responder con error
        if (!$producto) {
            return back()->withErrors(['error' => 'Producto no encontrado.']);
        }
    
        // Obtener talla y cantidad
        $talla = $request->input('talla');
        $cantidad = $request->input('cantidad', 1);
    
        // Validar si la talla fue seleccionada
        if (!$talla) {
            return back()->withErrors(['error' => 'Por favor selecciona una talla.']);
        }
    
        // Validar la cantidad
        if ($cantidad <= 0) {
            return back()->withErrors(['error' => 'Cantidad inválida.']);
        }
    
        // Obtener stock disponible
        $stockDisponible = EdicionesProductos::where('id', $productoId)
                                ->where('talla', $talla)
                                ->value('cantidad');
    
        // Validar si hay suficiente stock
        if ($cantidad > $stockDisponible) {
            return back()->withErrors(['error' => 'Lo sentimos, stock insuficiente.']);
        }
    
        // Obtener el carrito actual de la sesión
        $carrito = collect(session()->get('carrito', []));
        
        $productoTallaKey = "{$productoId}_{$talla}";
    
        // Si el producto ya está en el carrito, aumentamos la cantidad
        if ($carrito->has($productoTallaKey)) {
            $carrito->put($productoTallaKey, [
                'id' => $producto->id,
                'name' => $producto->nombre,
                'price' => $producto->rebaja ? $producto->precio_rebajado : $producto->costo_precio_venta,
                'quantity' => $carrito[$productoTallaKey]['quantity'] + $cantidad,
                'attributes' => [
                    'imagen' => $producto->imagen_producto_final,
                    'talla' => $talla,
                ]
            ]);
        } else {
            // Si el producto no está en el carrito, lo agregamos
            $carrito->put($productoTallaKey, [
                'id' => $producto->id,
                'name' => $producto->nombre,
                'price' => $producto->rebaja ? $producto->precio_rebajado : $producto->costo_precio_venta,
                'quantity' => $cantidad,
                'attributes' => [
                    'imagen' => $producto->imagen_producto_final,
                    'talla' => $talla,
                ]
            ]);
        }
    
        // Actualizamos la sesión con el carrito
        session()->put('carrito', $carrito);
    
        // Redirigir automáticamente al carrito
        return redirect()->route('carrito.mostrar')->with('success', 'Producto agregado al carrito.');
    }
}
