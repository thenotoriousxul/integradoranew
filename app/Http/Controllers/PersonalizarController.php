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
        // Obtener solo los productos que se pueden personalizar
        $productos = Producto::where('producto_personalizar', 1)->get();
        return view('personalizacion', compact('productos'));
    }

    /**
     * Mostrar la vista para personalizar un producto específico.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function personalizarProducto($id)
    {
        $producto = Producto::findOrFail($id);

        // Obtener todos los estampados disponibles y ajustar el path relativo
        $estampados = Estampado::all()->map(function ($estampado) {
            // Asegurarse de que la URL esté correctamente formateada
            $estampado->imagen_estampado = ltrim(parse_url($estampado->imagen_estampado, PHP_URL_PATH), '/');
            return $estampado;
        });

        return view('personalizar', compact('producto', 'estampados'));
    }

    /**
     * Guardar el diseño personalizado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
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
        $imageData = preg_replace('/^data:image\/\w+;base64,/', '', $imageData);
        $imageData = str_replace(' ', '+', $imageData);

        try {
            // Generar un nombre único para la imagen
            $imageName = 'personalizaciones/' . uniqid() . '.png';

            // Decodificar la imagen
            $decodedImage = base64_decode($imageData);

            // Verificar que la decodificación fue exitosa
            if ($decodedImage === false) {
                throw new \Exception('Error al decodificar la imagen.');
            }

            // Guardar en S3 con visibilidad pública
            Storage::disk('s3')->put($imageName, $decodedImage, 'public');

            // Obtener la URL completa de la imagen
            $imageUrl = Storage::disk('s3')->url($imageName);

            // Obtener el producto base
            $productoBase = Producto::findOrFail($request->input('producto_id'));

            // Crear una nueva edición personalizada
            $edicion = new \App\Models\Edicion();
            $edicion->nombre_edicion = 'Personalizada';
            $edicion->descripcion = 'Edición personalizada';
            $edicion->fecha_de_salida = now();
            $edicion->lote = 1;
            $edicion->existencias = 1;
            $edicion->extra = 0;
            $edicion->tipo = 'Personalizada';
            $edicion->save();

            // Crear una nueva relación EdicionesProductos
            $edicionProducto = new EdicionesProductos();
            $edicionProducto->nombre = 'Producto Personalizado';
            $edicionProducto->cantidad = 1;
            $edicionProducto->rebaja = 0;
            $edicionProducto->porcentaje_rebaja = 0;
            $edicionProducto->precio_rebajado = $productoBase->costo ?? 0;
            $edicionProducto->productos_id = $request->input('producto_id');
            $edicionProducto->edicion_id = $edicion->id;
            $edicionProducto->imagen_producto_final = $imageUrl; // Guarda la URL completa
            $edicionProducto->imagen_producto_trasera = $imageUrl; // Guarda la URL completa
            $edicionProducto->costo_fabrica = $productoBase->costo_fabrica ?? 0;
            $edicionProducto->costo_precio_venta = $productoBase->costo_precio_venta ?? 0;
            $edicionProducto->talla = $productoBase->talla ?? 'M';
            $edicionProducto->estado = 'activo';
            $edicionProducto->save();

            // Agregar al carrito
            $carrito = collect(session()->get('carrito', []));
            $productoKey = "personalizado_{$edicionProducto->id}";
            $carrito->put($productoKey, [
                'id' => $edicionProducto->id,
                'name' => $edicionProducto->nombre,
                'price' => $edicionProducto->precio_rebajado,
                'quantity' => 1,
                'attributes' => [
                    'imagen' => $edicionProducto->imagen_producto_final, // Guarda la URL completa
                    'talla' => $edicionProducto->talla,
                ],
            ]);
            session()->put('carrito', $carrito);

            // Mensaje de éxito
            return redirect()->route('detalleOrden')->with('success', 'Producto personalizado agregado al carrito.');
        } catch (\Exception $e) {
            Log::error('Error al guardar el diseño personalizado:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Ocurrió un error al guardar el producto personalizado. Inténtalo nuevamente.');
        }
    }
}
