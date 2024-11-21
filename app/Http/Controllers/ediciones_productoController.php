<?php

namespace App\Http\Controllers;

use App\Models\Edicion;
use App\Models\ediciones_productos;
use App\Models\Producto;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ediciones_productoController extends Controller
{
    public function getProductos() {
        $productos = ediciones_productos::all();
        return view('admin.edicionesP.productos' , compact('productos'));
    }

    public function detalle($id)
    {
    $producto = ediciones_productos::findOrFail($id);
    return view('admin.edicionesP.producto_detalle', compact('producto'));
    }

    public function create()
    {
    $ediciones = Edicion::all();
    $productos = Producto::all();

    return view('admin.edicionesP.formularioProducto', compact('ediciones', 'productos'));
    }


    public function store(Request $request){
        $request->validate([
            'edicion_id' => ['required','exists:edicion,id'],
            'productos_id' => ['required','exists:productos,id'],
            'nombre' => ['required', 'string', 'max:55'],
            'imagen_producto_final'=>['nullable','image','max:2048'],
            'cantidad' => 'required|integer|min:1',
        ]);

        $imageUrl = null;

        // Subida de la imagen a S3 y generación de la URL
        if ($request->hasFile('imagen_producto_final')) {
            $imagePath = $request->file('imagen_producto_final')->store('ediciones_productos', 's3');
            Storage::disk('s3')->setVisibility($imagePath, 'public');
            $imageUrl = Storage::disk('s3')->url($imagePath); // Esto es un string con la URL
        }

        $edicionProducto = ediciones_productos::create([
            'nombre' => $request->nombre,
            'imagen_producto_final' => $imageUrl,
            'cantidad'=>$request->cantidad,
            'edicion_id'=>$request->edicion_id,
            'productos_id'=>$request->productos_id,
        ]);
        return redirect()->route('mostrar.productos');
    }

    public function rebajas() {
        $productos = ediciones_productos::where('rebaja', 1)->get();

        return view('rebajas' , compact('productos'));
    }
}