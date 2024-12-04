<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Estampado;
use Illuminate\Http\Request;
use App\Models\EdicionesProductos;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class PersonalizarController extends Controller
{
    /**
     * Mostrar el catálogo de productos personalizables.
     *
     * @return \Illuminate\View\View
     */
    public function mostrarCatalogoPersonalizable()
    {
        $productos = EdicionesProductos::where('personalizada', 1)
            ->where('estado', 'activo')
            ->paginate(10);

        return view('personalizacion', compact('productos'));
    }

    public function mostrarDetalle($id)
{
    $producto = EdicionesProductos::findOrFail($id);

    $tallas = EdicionesProductos::where('nombre', $producto->nombre)
        ->select('talla', DB::raw('SUM(cantidad) as cantidad'))
        ->groupBy('talla')
        ->get()
        ->toArray(); 

    return view('detallepersonalizada', compact('producto', 'tallas'));
}

public function personalizarProducto()
{
    $estampados = Estampado::all()->map(function ($estampado) {
        $estampado->imagen_estampado = Storage::disk('s3')->url($estampado->imagen_estampado);
        return $estampado;
    });

    return view('admin.personalizar.personalizarAdmin', compact('estampados'));
}

    

}
