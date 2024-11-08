<?php

namespace App\Http\Controllers;

use App\Http\Requests\productoRequest;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class productoController extends Controller
{
    public function saveProducto(productoRequest $request){
        $imageUrl = null;

        // Subida de la imagen a S3 y generación de la URL
        if ($request->hasFile('imagen_producto')) {
            $imagePath = $request->file('imagen_producto')->store('productos', 's3');
            Storage::disk('s3')->setVisibility($imagePath, 'public');
            $imageUrl = Storage::disk('s3')->url($imagePath); // Esto es un string con la URL
        }
    
        // Creación y guardado del producto
        $producto = new Producto();
        $producto->tipo = $request->input('tipo');
        $producto->tamaño = $request->input('tamaño');
        $producto->color = $request->input('color');
        $producto->lote = $request->input('lote');
        $producto->costo = $request->input('costo');
        $producto->imagen_producto = $imageUrl; // La URL se guarda como string en la BD
        $producto->save();
    
        return redirect()->route('agregar.producto')->with('success', 'Producto creado exitosamente.');
    
    }
}
