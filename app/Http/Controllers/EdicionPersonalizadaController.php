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
        $productos = Producto::where('estado', 'activo')->where('producto_personalizar', 1)->get();  // Usar la columna correcta
    
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
    
        $producto = Producto::find($request->productos_id); // Obtener el producto seleccionado
    
        // Verificar si el producto es personalizable
        if ($producto->personalizada != 1) {
            return redirect()->back()->withErrors(['producto' => 'El producto seleccionado no es personalizable.']);
        }

        // Verificar si la cantidad es mayor que el stock disponible
        if ($request->cantidad > $producto->stock) {
            return redirect()->back()->withErrors(['cantidad' => 'La cantidad no puede ser mayor al stock disponible.']);
        }
    
        $imageUrl = null;
    
        if ($request->hasFile('imagen_producto_final')) {
            $imagePath = $request->file('imagen_producto_final')->store('ediciones_productos', 's3');
            $imageUrl = Storage::disk('s3')->url($imagePath);
        }
    
        // Igualar la imagen trasera al producto
        $imageUrlTrasera = $imageUrl ?? $producto->imagen_producto_final; // Si no se sube una imagen trasera, usar la del producto
    
        $data = [
            'nombre' => $request->nombre,
            'edicion_id' => $request->edicion_id,
            'productos_id' => $request->productos_id,
            'cantidad' => $request->cantidad,
            'imagen_producto_final' => $imageUrl,
            'imagen_producto_trasera' => $imageUrlTrasera,
            'personalizada' => 1, 
            'estado' => 'activo',
        ];
    
        EdicionesProductos::create($data);
    
        return redirect()->route('personalizacion')
            ->with('success', 'Edición personalizada creada correctamente.');
    }
}

