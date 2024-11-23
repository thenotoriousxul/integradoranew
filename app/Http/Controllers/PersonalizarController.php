<?php

namespace App\Http\Controllers;
use App\Models\Producto;
use Illuminate\Http\Request;
use App\Models\Estampado;

class PersonalizarController extends Controller
{

public function mostrarCatalogoPersonalizable() {
    // Obtener solo los productos que se pueden personalizar
    $productos = Producto::where('producto_personalizar', 1)->get();

    // Pasar los productos a la vista
    return view('personalizacion', ['productos' => $productos]);
}


public function personalizarProducto($id) {
    $producto = Producto::findOrFail($id);

    $estampados = Estampado::all();

    return view('personalizar', compact('producto', 'estampados'));
}

}
