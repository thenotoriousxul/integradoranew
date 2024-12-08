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
        $productos = Producto::where('producto_personalizar', 1)->get(); // Filtrar productos personalizables
        return view('admin.ediciones_personalizadas.create', compact('ediciones', 'productos'));
    }
    
    public function store(Request $request)
{
    // Validación de los datos
    $request->validate([
        'nombre' => 'required|string|max:255',
        'edicion_id' => 'required|exists:ediciones,id',
        'productos_id' => 'required|exists:productos,id',
        'cantidad' => 'required|integer|min:1',
        'imagen_producto_final' => 'nullable|image',
    ]);

    // Creación de la edición personalizada
    $edicionPersonalizada = new EdicionPersonalizada();
    $edicionPersonalizada->nombre = $request->input('nombre');
    $edicionPersonalizada->edicion_id = $request->input('edicion_id');
    $edicionPersonalizada->productos_id = $request->input('productos_id');
    $edicionPersonalizada->cantidad = $request->input('cantidad');

    // Subir imagen si existe
    if ($request->hasFile('imagen_producto_final')) {
        $path = $request->file('imagen_producto_final')->store('public/imagenes');
        $edicionPersonalizada->imagen_producto_final = $path;
    }

    $edicionPersonalizada->save();

    return redirect()->route('admin.ediciones_personalizadas.index')->with('success', 'Edición personalizada creada exitosamente.');
}

}

