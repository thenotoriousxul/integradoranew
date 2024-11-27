<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Estampado;
use Illuminate\Http\Request;
use App\Models\ediciones_productos;
use Illuminate\Support\Facades\Storage;
use Cart;
use Illuminate\Support\Facades\Log;

class PersonalizarController extends Controller
{
    public function mostrarCatalogoPersonalizable()
    {
        // Obtener solo los productos que se pueden personalizar
        $productos = Producto::where('producto_personalizar', 1)->get();
        return view('personalizacion', compact('productos'));
    }

    public function personalizarProducto($id)
    {
        $producto = Producto::findOrFail($id);

        // Obtener todos los estampados disponibles
        $estampados = Estampado::all();

        return view('personalizar', compact('producto', 'estampados'));
    }

    public function guardar(Request $request)
{
    // Validar los datos recibidos
    $request->validate([
        'producto_id' => 'required|exists:productos,id',
        'estampado_id' => 'nullable|exists:estampados,id',
        'imagen_personalizada' => 'required',
    ]);

    // Procesar la imagen personalizada
    $imageData = $request->input('imagen_personalizada');
    // Quitar el prefijo 'data:image/png;base64,' o similar
    $imageData = preg_replace('/^data:image\/\w+;base64,/', '', $imageData);
    $imageData = str_replace(' ', '+', $imageData);
    $imageName = 'personalizaciones/' . uniqid() . '.png';

    // Decodificar la imagen
    $decodedImage = base64_decode($imageData);

    // Verificar que la decodificación fue exitosa
    if ($decodedImage === false) {
        return redirect()->back()->with('error', 'Error al decodificar la imagen.');
    }

    // Guardar en S3 con visibilidad pública y ACL público
    try {
        Storage::disk('s3')->put($imageName, $decodedImage, [
            'visibility' => 'public',
            'ACL' => 'public-read',
        ]);
    } catch (\Exception $e) {
        Log::error('Error al subir la imagen a S3: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Error al subir la imagen.');
    }

    // Obtener la URL de la imagen
    $imageUrl = Storage::disk('s3')->url($imageName);

    // Registrar la URL para depuración
    Log::info('URL de la imagen: ' . $imageUrl);

    // Verificar que la URL es accesible
    if (!$imageUrl) {
        return redirect()->back()->with('error', 'Error al obtener la URL de la imagen.');
    }

    // Obtener el producto base y los valores necesarios
    $productoBase = Producto::findOrFail($request->input('producto_id'));

    // Asignar valores desde el producto base o valores predeterminados
    $precio = $productoBase->costo ?? 0; // Precio del producto personalizado
    $costoFabrica = $productoBase->costo_fabrica ?? 0; // Costo de fábrica del producto base
    $costoPrecioVenta = $productoBase->costo_precio_venta ?? 0; // Costo precio venta
    $talla = $productoBase->talla ?? 'M'; // Talla del producto base o 'M' por defecto
    $estado = 'activo'; // Estado por defecto

    // Crear un nuevo registro en 'edicion' para la edición personalizada
    $edicion = new \App\Models\Edicion();
    $edicion->nombre_edicion = 'Personalizada';
    $edicion->descripcion = 'Edición personalizada';
    $edicion->fecha_de_salida = now(); // Fecha actual
    $edicion->lote = 1;
    $edicion->existencias = 1;
    $edicion->extra = 0; // Puedes ajustar este valor según tu lógica
    $edicion->tipo = 'Personalizada';
    $edicion->save();

    // Crear el nuevo registro en 'ediciones_productos'
    $edicionProducto = new ediciones_productos();
    $edicionProducto->nombre = 'Producto Personalizado';
    $edicionProducto->cantidad = 1;
    $edicionProducto->rebaja = 0;
    $edicionProducto->porcentaje_rebaja = 0;
    $edicionProducto->precio_rebajado = $precio;
    $edicionProducto->productos_id = $request->input('producto_id');
    $edicionProducto->edicion_id = $edicion->id; // Asignar el ID de la nueva edición
    $edicionProducto->imagen_producto_final = $imageUrl;
    $edicionProducto->imagen_producto_trasera = $imageUrl; // Asignar el mismo valor que 'imagen_producto_final'
    $edicionProducto->costo_fabrica = $costoFabrica; // Asignar valor definido
    $edicionProducto->costo_precio_venta = $costoPrecioVenta; // Asignar valor definido
    $edicionProducto->talla = $talla;
    $edicionProducto->estado = $estado;
    $edicionProducto->save();

    // Agregar al carrito
    Cart::add([
        'id' => $edicionProducto->id,
        'name' => $edicionProducto->nombre,
        'price' => $edicionProducto->precio_rebajado,
        'quantity' => 1,
        'attributes' => [
            'imagen' => $edicionProducto->imagen_producto_final,
            // Puedes agregar más atributos si es necesario
        ],
    ]);

    // Redirigir al carrito con mensaje de éxito
    return redirect()->route('carrito.mostrar')->with('success', 'Producto personalizado agregado al carrito.');
}




}
