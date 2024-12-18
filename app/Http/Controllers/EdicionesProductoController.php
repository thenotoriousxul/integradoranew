<?php

namespace App\Http\Controllers;

use App\Models\Edicion;
use App\Models\EdicionesProductos;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Svg\Tag\Rect;

class EdicionesProductoController extends Controller
{
    public function getProductos()
    {
        $producto = EdicionesProductos::where('rebaja', 0)
            ->where('estado', 'activo')
            ->where('personalizada', 0)
            ->get();

        $productos = $producto->groupBy(function ($item) {
            return strtolower(trim($item->nombre));
        })->map(function ($grupo) {
            return $grupo->sortByDesc(function ($item) {
                return [
                    $item->imagen_producto_trasera !== null ? 1 : 0,
                    $item->costo_precio_venta
                ];
            })->first();
        });

        return view('admin.edicionesP.productos', compact('productos'));
    }





    public function detalle($id)
    {
        $producto = EdicionesProductos::findOrFail($id);

        $tallas = EdicionesProductos::whereRaw('LOWER(nombre) = ?', [strtolower(trim($producto->nombre))])
            ->get()
            ->map(function ($item) {
                return [
                    'talla' => $item->talla,
                    'cantidad' => $item->cantidad,
                ];
            })
            ->unique('talla'); 

        return view('admin.edicionesP.producto_detalle', compact('producto', 'tallas'));
    }




    public function create()
    {
        $ediciones = Edicion::all();
        $productos = Producto::all();

        return view('admin.edicionesP.formularioProducto', compact('ediciones', 'productos'));
    }


    


    public function store(Request $request)
    {
        $request->validate([
            'edicion_id' => ['required', 'exists:edicion,id'],
            'productos_id' => ['required', 'exists:productos,id'],
            'nombre' => ['required', 'string', 'max:55'],
            'imagen_producto_final' => ['nullable', 'image', 'max:2048'],
            'imagen_producto_trasera' => ['nullable', 'image', 'max:2048'],
            'cantidad' => 'required|integer|min:1',
        ]);

        $imageUrl = null;

        if ($request->hasFile('imagen_producto_final')) {
            $imagePath = $request->file('imagen_producto_final')->store('ediciones_productos', 's3');
            Storage::disk('s3')->setVisibility($imagePath, 'public');
            $imageUrl = Storage::disk('s3')->url($imagePath);
        }

        $imageUrlTrasera = null;

        if ($request->hasFile('imagen_producto_trasera')) {
            $imagePathTrasera = $request->file('imagen_producto_trasera')->store('ediciones_productos', 's3');
            Storage::disk('s3')->setVisibility($imagePathTrasera, 'public');
            $imageUrlTrasera = Storage::disk('s3')->url($imagePathTrasera);
        }

        EdicionesProductos::create([
            'nombre' => $request->nombre,
            'imagen_producto_final' => $imageUrl,
            'imagen_producto_trasera' => $imageUrlTrasera,
            'cantidad' => $request->cantidad,
            'edicion_id' => $request->edicion_id,
            'productos_id' => $request->productos_id,
        ]);

        return redirect()->route('listar.productos');
    }







    public function rebajas()
    {
        $productos = EdicionesProductos::where('rebaja', 1)->get();

        return view('rebajas', compact('productos'));
    }




    public function filtro(Request $request)
    {
        $request->validate([
            'costo_min' => ['nullable', 'numeric', 'min:0'],
            'costo_max' => ['nullable', 'numeric', 'min:0'],
            'talla' => ['nullable', 'in:CH,M,XL,XXL'],
            'nombre' => ['nullable', 'string', 'max:20'],
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

        
        $productos = collect($productos);

        $productos = $productos->groupBy(function ($item) {
            return strtolower(trim($item->nombre)); 
        })->map(function ($grupo) {
            return $grupo->sortByDesc(function ($item) {
                return [
                    $item->imagen_producto_trasera !== null ? 1 : 0, 
                    $item->costo_precio_venta, 
                ];
            })->first(); 
        });

        return view('admin.edicionesP.productos', compact('productos'));
    }






    public function getProducts()
    {
        $productos = EdicionesProductos::paginate(15);

        return view('admin.edicionesP.listar', compact('productos'));
    }


    public function activar(Request $request, $id){
        $producto = EdicionesProductos::findOrFail($id);

        $producto->estado = 'activo';

        $producto->save();
        return redirect()->route('listar.productos')
        ->with('success', 'el producto se ah activado correctamente');

    }



    public function inactivar(Request $request ,$id){
        $producto = EdicionesProductos::findOrFail($id);
        
        $producto->estado = 'inactivo';
        $producto->save();
        return redirect()->route('listar.productos')
        ->with('success', 'el producto se ah inactivado correcamente.');
    }


    public function filtroRebaja(Request $request){
        $request->validate([
            'costo_min' => ['nullable', 'numeric', 'min:0'],
            'costo_max' => ['nullable', 'numeric', 'min:0'],
            'talla' => ['nullable', 'in:CH,M,XL,XXL'],
            'nombre' => ['nullable', 'string', 'max:20'],
            'orden' => ['nullable', 'in:precio_asc,precio_desc,nombre']
        ]);

        $costo_min = $request->input('costo_min') === '' ? null : $request->input('costo_min');
        $costo_max = $request->input('costo_max') === '' ? null : $request->input('costo_max');
        $talla = $request->input('talla') === '' ? null : $request->input('talla');
        $nombre = $request->input('nombre') === '' ? null : $request->input('nombre');
        $orden = $request->input('orden') === '' ? null : $request->input('orden');

        $productos = DB::select('call filtrarRebajas(?,?,?,?,?)', [
            $costo_min,
            $costo_max,
            $nombre,
            $talla,
            $orden,
        ]);


        return view('rebajas', compact('productos'));


    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id); 
        return view('admin.edicionesP.editarProducto', compact('producto')); 
    }
    

public function update(Request $request, $id)
{
    $request->validate([
        'nombre' => ['required', 'string', 'max:55'],
        'talla' => ['required', 'in:CH,M,XL,XXL'],
        'imagen_producto_final' => ['nullable', 'image', 'max:2048'],
        'imagen_producto_trasera' => ['nullable', 'image', 'max:2048'],
        'costo_precio_venta' => ['required', 'numeric', 'min:0'],
        'cantidad' => ['required', 'integer', 'min:1'],
    ]);

    $producto = EdicionesProductos::findOrFail($id);

    if ($request->hasFile('imagen_producto_final')) {
        $imagePath = $request->file('imagen_producto_final')->store('ediciones_productos', 's3');
        Storage::disk('s3')->setVisibility($imagePath, 'public');
        $producto->imagen_producto_final = Storage::disk('s3')->url($imagePath);
    }

    if ($request->hasFile('imagen_producto_trasera')) {
        $imagePathTrasera = $request->file('imagen_producto_trasera')->store('ediciones_productos', 's3');
        Storage::disk('s3')->setVisibility($imagePathTrasera, 'public');
        $producto->imagen_producto_trasera = Storage::disk('s3')->url($imagePathTrasera);
    }

    $producto->nombre = $request->nombre;
    $producto->talla = $request->talla;
    $producto->costo_precio_venta = $request->costo_precio_venta;
    $producto->cantidad = $request->cantidad;

    $producto->save();

    return redirect()->route('listar.productos')
        ->with('success', 'Producto actualizado correctamente.');
}

}
