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
        // Consulta los productos personalizables
        $productos = Producto::where('producto_personalizar', 1)->get();
    
        // Devuelve la vista con la variable $productos
        return view('admin.personalizar.personalizarAdmin', compact('productos'));
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

public function personalizarProducto($id)
{
    $producto = Producto::findOrFail($id);

    // Obtener estampados disponibles
    $estampados = Estampado::all()->map(function ($estampado) {
        $estampado->imagen_estampado = ltrim(parse_url($estampado->imagen_estampado, PHP_URL_PATH), '/');
        return $estampado;
    });
   

    // Retorna la vista correcta en la ruta `admin.personalizador.detalle`
    return view('personalizar', compact('producto', 'estampados'));
}

public function mostrarCatalogoPersonalizableFinal()
{
    $productos = EdicionesProductos::where('personalizada', 1)
        ->where('estado', 'activo')
        ->paginate(10);

    return view('personalizacion', compact('productos'));
}



    

}
