<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Estampado;
use Illuminate\Http\Request;
use App\Models\Edicion;
use App\Models\ediciones_productos;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PersonalizarController extends Controller
{
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

            if ($decodedImage === false) {
                throw new \Exception('Error al decodificar la imagen.');
            }

            // Guardar en S3 con visibilidad pública
            Storage::disk('s3')->put($imageName, $decodedImage, [
                'visibility' => 'public',
                'ACL' => 'public-read',
            ]);

            // Obtener la URL de la imagen
            $imageUrl = Storage::disk('s3')->url($imageName);

            // Verificar que la URL es accesible
            if (!$imageUrl) {
                throw new \Exception('Error al obtener la URL de la imagen guardada.');
            }

            Log::info('Imagen guardada en S3 correctamente:', ['url' => $imageUrl]);

            // Obtener datos del producto base
            $productoBase = Producto::findOrFail($request->input('producto_id'));

            // Calcular costos
            $costoProductoBase = $productoBase->costo_fabrica ?? 0;
            $costoEstampado = 0;

            if ($request->input('estampado_id')) {
                $estampado = Estampado::findOrFail($request->input('estampado_id'));
                $costoEstampado = $estampado->costo;
            }

            $costoTotal = $costoProductoBase + ($costoEstampado * 1.7);

            // Reducir el stock del producto base
            if ($productoBase->existencia < 1) {
                return redirect()->back()->with('error', 'No hay suficiente stock del producto base.');
            }

            $productoBase->existencia -= 1;
            $productoBase->save();

            // Crear la edición personalizada
            $edicion = new Edicion();
            $edicion->nombre_edicion = 'Personalizada';
            $edicion->descripcion = 'Edición personalizada';
            $edicion->fecha_de_salida = now();
            $edicion->lote = 1;
            $edicion->existencias = 1;
            $edicion->extra = 0;
            $edicion->tipo = 'Personalizada';
            $edicion->save();

            // Crear la relación ediciones_productos
            $edicionProducto = new ediciones_productos();
            $edicionProducto->nombre = 'Producto Personalizado';
            $edicionProducto->cantidad = 1;
            $edicionProducto->rebaja = 0; // Nunca tiene rebaja
            $edicionProducto->porcentaje_rebaja = 0;
            $edicionProducto->precio_rebajado = $costoTotal; // Costo total calculado
            $edicionProducto->productos_id = $request->input('producto_id');
            $edicionProducto->edicion_id = $edicion->id;
            $edicionProducto->imagen_producto_final = $imageUrl;
            $edicionProducto->imagen_producto_trasera = $imageUrl; // Imagen trasera igual a la del producto final
            $edicionProducto->costo_fabrica = $costoProductoBase;
            $edicionProducto->costo_precio_venta = $costoTotal;
            $edicionProducto->talla = $productoBase->talla; // Talla tomada del producto base
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
                    'imagen' => $edicionProducto->imagen_producto_final,
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
