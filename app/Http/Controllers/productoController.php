<?php

namespace App\Http\Controllers;

use App\Http\Requests\productoRequest;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

use function Laravel\Prompts\select;

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
        $producto->talla = $request->input('talla');
        $producto->color = $request->input('color');
        $producto->lote = $request->input('lote');
        $producto->costo = $request->input('costo');
        $producto->imagen_producto = $imageUrl; // La URL se guarda como string en la BD
        $producto->save();
    
        return redirect()->route('agregar.producto')->with('success', 'Producto creado exitosamente.');
    
    }

   

    public function dashProductos() {
        $productos = Producto::all();
 
        return view('admin.productos.productosBase' , compact('productos'));
    }


    public function activar($id){
        $producto = Producto::findOrFail($id);
        $producto->estado = 'Activo';
        $producto->save();
        return redirect()->route('dash.productosBase')->with('success', 'producto activado correctamente');
    }

    public function inactivar($id){
        $producto = Producto::findOrFail($id);
        $producto->estado = 'Inactivo';
        $producto->save();
        return redirect()->route('dash.productosBase')->with('success', 'producto desactivado correctamente');
    }

    public function editar($id){
        $producto = Producto::findOrFail($id);
        return view('admin.productos.dashEditProducto', compact('producto'));
    }

    public function update(productoRequest $request, $id){
        $producto = Producto::findOrFail($id);
        
        $imageUrl = null;

            // Manejar la imagen si hay una nueva subida
        if ($request->hasFile('imagen_producto')) {
        // Eliminar la imagen anterior de S3, si existe
        if ($producto->imagen_producto) {
            Storage::disk('s3')->delete($producto->imagen_producto);
        }

        // Subir la nueva imagen a S3
        $imagePath = $request->file('imagen_producto')->store('productos', 's3');
        Storage::disk('s3')->setVisibility($imagePath, 'public');

        // Actualizar la URL de la imagen
        $producto->imagen_producto = Storage::disk('s3')->url($imagePath);
        }

        $producto->tipo = $request->input('tipo');
        $producto->talla = $request->input('talla');
        $producto->color = $request->input('color');
        $producto->lote = $request->input('lote');
        $producto->costo = $request->input('costo');

        
        $producto->save();

        
        return redirect()->route('dash.productosBase')->with('success', 'Producto actualizado exitosamente.');
    }


    public function filtrarPorPrecio(Request $request){
        $request->validate([
            'costo_min' => ['required','numeric','min:0'],
            'costo_max' => ['required','numeric','min:0'],
        ]);

        $productos = DB::select('call filtrarPorPrecio(?,?)',[
            $request->input('costo_max'),
            $request->input('costo_min')
        ]);

        return view('admin.productosBase' , compact('productos'));
    }

    public function filtros(Request $request)
    {
        $request->validate([
            'costo_min' => ['nullable','numeric','min:0'],
            'costo_max' => ['nullable','numeric','min:0'],
            'talla' => ['nullable','in:CH,M,XL,XXL'],
            'tipo' => ['nullable','string','max:100'],
        ]);
    

        $costo_min = $request->input('costo_min') === '' ? null : $request->input('costo_min');
        $costo_max = $request->input('costo_max') === '' ? null : $request->input('costo_max');
        $talla = $request->input('talla') === '' ? null : $request->input('talla');
        $tipo = $request->input('tipo') === '' ? null : $request->input('tipo');
    
        $productos = DB::select('call filtrarProductos(?,?,?,?)', [
            $costo_min,
            $costo_max,
            $tipo,
            $talla,
        ]);

    
        return view('admin.productosBase', compact('productos'));
    }
    
}
