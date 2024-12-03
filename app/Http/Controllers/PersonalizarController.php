<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Estampado;
use Illuminate\Http\Request;
use App\Models\EdicionesProductos;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PersonalizarController extends Controller
{
    /**
     * Mostrar el catálogo de productos personalizables.
     *
     * @return \Illuminate\View\View
     */
    public function mostrarCatalogoPersonalizable()
    {
        // Filtrar los productos personalizados
        $productos = EdicionesProductos::where('personalizada', 1)
            ->where('estado', 'activo')
            ->paginate(10);

        return view('personalizacion', compact('productos'));
    }
}
