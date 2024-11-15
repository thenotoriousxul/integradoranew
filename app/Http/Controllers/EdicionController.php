<?php

namespace App\Http\Controllers;

use App\Models\Edicion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EdicionController extends Controller
{
    // Mostrar formulario para crear una edición
    public function crearFormularioEdicion()
    {
        return view('admin.ediciones.crear'); // Asegúrate de que esta vista existe
    }

    // Guardar una nueva edición
    public function guardarEdicion(Request $request)
    {
        // Validación
        $request->validate([
            'nombre_edicion' => 'required|string|max:50',
            'fecha_de_salida' => 'required|date',
            'lote' => 'required|integer|min:1',
            'existencias' => 'required|integer|min:1',
            'extra' => 'nullable|numeric|min:0',
            'precio_de_venta' => 'required|numeric|min:0',
            'imagen_producto' => 'nullable|image|max:2048',
        ]);

        // Manejo de imagen
        $imagenProducto = null;
        if ($request->hasFile('imagen_producto')) {
            $path = $request->file('imagen_producto')->store('ediciones', 's3');
            Storage::disk('s3')->setVisibility($path, 'public');
            $imagenProducto = Storage::disk('s3')->url($path);
        }

        // Crear la edición
        Edicion::create([
            'nombre_edicion' => $request->nombre_edicion,
            'fecha_de_salida' => $request->fecha_de_salida,
            'lote' => $request->lote,
            'existencias' => $request->existencias,
            'extra' => $request->extra ?? 0,
            'costo_fabricacion' => 0, // Puedes calcular esto más adelante si es necesario
            'precio_de_venta' => $request->precio_de_venta,
            'tipo' => 'Edicion',
            'imagen_producto' => $imagenProducto,
        ]);

        // Redirigir al listado con un mensaje de éxito
        return redirect()->route('ediciones.listar')->with('success', 'Edición creada exitosamente.');
    }

    // Listar todas las ediciones
    public function listarEdiciones()
    {
        $ediciones = Edicion::all();
        return view('admin.ediciones.listar', compact('ediciones'));
    }

    // Mostrar los detalles de una edición
    public function detalleEdicion($id)
    {
        $edicion = Edicion::findOrFail($id);
        return view('admin.ediciones.detalle', compact('edicion'));
    }

    // Editar una edición (formulario)
    public function editarFormularioEdicion($id)
    {
        $edicion = Edicion::findOrFail($id);
        return view('admin.ediciones.editar', compact('edicion'));
    }

    // Actualizar una edición
    public function actualizarEdicion(Request $request, $id)
    {
        // Validación
        $request->validate([
            'nombre_edicion' => 'required|string|max:50',
            'fecha_de_salida' => 'required|date',
            'lote' => 'required|integer|min:1',
            'existencias' => 'required|integer|min:1',
            'extra' => 'nullable|numeric|min:0',
            'precio_de_venta' => 'required|numeric|min:0',
            'imagen_producto' => 'nullable|image|max:2048',
        ]);

        // Buscar la edición
        $edicion = Edicion::findOrFail($id);

        // Manejo de imagen
        if ($request->hasFile('imagen_producto')) {
            // Eliminar imagen anterior si existe
            if ($edicion->imagen_producto) {
                Storage::disk('s3')->delete($edicion->imagen_producto);
            }
            // Subir nueva imagen
            $path = $request->file('imagen_producto')->store('ediciones', 's3');
            Storage::disk('s3')->setVisibility($path, 'public');
            $edicion->imagen_producto = Storage::disk('s3')->url($path);
        }

        // Actualizar los datos de la edición
        $edicion->update([
            'nombre_edicion' => $request->nombre_edicion,
            'fecha_de_salida' => $request->fecha_de_salida,
            'lote' => $request->lote,
            'existencias' => $request->existencias,
            'extra' => $request->extra ?? 0,
            'precio_de_venta' => $request->precio_de_venta,
        ]);

        // Redirigir al listado con un mensaje de éxito
        return redirect()->route('ediciones.listar')->with('success', 'Edición actualizada exitosamente.');
    }

    // Eliminar una edición
    public function eliminarEdicion($id)
    {
        $edicion = Edicion::findOrFail($id);

        // Eliminar imagen asociada si existe
        if ($edicion->imagen_producto) {
            Storage::disk('s3')->delete($edicion->imagen_producto);
        }

        // Eliminar la edición
        $edicion->delete();

        return redirect()->route('ediciones.listar')->with('success', 'Edición eliminada exitosamente.');
    }
}
