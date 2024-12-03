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
    
    

    
}
