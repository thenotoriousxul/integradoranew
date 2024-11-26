<?php

namespace App\Http\Controllers;

use App\Models\Edicion;
use App\Models\ediciones_productos;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ediciones_productoController extends Controller
{
    public function getProductos()
    {
    $producto = ediciones_productos::where('rebaja', 0)->get();

    $productos = $producto->groupBy(function ($item) {
        // Convertimos a minúsculas para normalizar los nombres
        return strtolower(trim($item->nombre));
    })->map(function ($grupo) {
        // Ordenamos por precio y seleccionamos el más caro
        return $grupo->sortByDesc('costo_precio_venta')->first();
    });

    // Pasamos los productos agrupados a la vista
    return view('admin.edicionesP.productos', compact('productos'));
    }


    public function detalle($id)
    {
    $producto = ediciones_productos::findOrFail($id);
    
   
        // Obtener todas las tallas asociadas al producto normalizando el nombre
         // Obtener todas las tallas asociadas al producto por nombre
        $tallas = ediciones_productos::whereRaw('LOWER(nombre) = ?', [strtolower(trim($producto->nombre))])
        ->get()
        ->map(function ($item) {
            return [
                'talla' => $item->talla,
                'cantidad' => $item->cantidad,
            ];
        })
        ->unique('talla'); // Evita duplicados de tallas
    return view('admin.edicionesP.producto_detalle', compact('producto', 'tallas'));

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

     public function filtro(Request $request){
        $request->validate([
            'costo_min' => ['nullable','numeric','min:0'],
            'costo_max' => ['nullable','numeric','min:0'],
            'talla' => ['nullable','in:CH,M,XL,XXL'],
            'nombre' => ['nullable','string','max:100'],
        ]);
    

        $costo_min = $request->input('costo_min') === '' ? null : $request->input('costo_min');
        $costo_max = $request->input('costo_max') === '' ? null : $request->input('costo_max');
        $talla = $request->input('talla') === '' ? null : $request->input('talla');
        $nombre = $request->input('nombre') === '' ? null : $request->input('nombre');
    
        $productos = DB::select('call filtrarEdicionProductos(?,?,?,?)', [
            $costo_min,
            $costo_max,
            $nombre,
            $talla,
        ]);

    
        return view('admin.edicionesP.productos', compact('productos'));
    }
}
