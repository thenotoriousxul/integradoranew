<?php
namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Estampado;
use App\Models\Diseno;
use Illuminate\Http\Request;

class PersonalizarController extends Controller
{
    public function mostrarCatalogoPersonalizable() {
        // Obtener solo los productos que se pueden personalizar
        $productos = Producto::where('producto_personalizar', 1)->get();
        return view('personalizacion', compact('productos'));
    }

    public function personalizarProducto($id) {
        $producto = Producto::findOrFail($id);
    
        // Obtener todos los estampados disponibles
        $estampados = Estampado::all();
    
        return view('personalizar', compact('producto', 'estampados'));
    }
    
}
