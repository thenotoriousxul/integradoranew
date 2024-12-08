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


}
