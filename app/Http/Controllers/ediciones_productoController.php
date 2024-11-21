<?php

namespace App\Http\Controllers;

use App\Models\ediciones_productos;
use Illuminate\Http\Request;

class ediciones_productoController extends Controller
{
    public function getProductos() {
        $productos = ediciones_productos::all();
        return view('productos' , compact('productos'));
    }

    public function detalle($id)
    {
    $producto = ediciones_productos::findOrFail($id);
    return view('producto_detalle', compact('producto'));
    }
}
