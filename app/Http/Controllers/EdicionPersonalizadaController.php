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
    
    // Controlador EdicionPersonalizadaController

// Método en el controlador EdicionPersonalizadaController para agregar al carrito
public function agregarAlCarrito(Request $request, $productoId)
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

    // Obtener stock disponible
    $stockDisponible = EdicionesProductos::where('id', $productoId)
                            ->where('talla', $talla)
                            ->value('cantidad');

    if ($cantidad > $stockDisponible) {
        return back()->withErrors(['error' => 'Lo sentimos, stock insuficiente, intenta con otra cantidad menor.']);
    }

    // Carrito
    $carrito = collect(session()->get('carrito', []));
    
    $productoTallaKey = "{$productoId}_{$talla}";

    // Si el producto ya existe en el carrito, aumentamos la cantidad
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

    session()->put('carrito', $carrito);
    session()->flash('success', 'Producto agregado al carrito.');

    return redirect()->route('carrito.mostrar'); // Redirige al carrito para que el usuario vea el producto agregado
}

    

    
}
