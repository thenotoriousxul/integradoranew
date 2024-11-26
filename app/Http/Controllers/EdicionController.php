<?php

namespace App\Http\Controllers;

use App\Models\Edicion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

namespace App\Http\Controllers;

use App\Models\Edicion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EdicionController extends Controller
{
    // Mostrar formulario para crear una edición
    public function crearFormularioEdicion()
    {
        return view('admin.ediciones.crear');
    }

    // Guardar una nueva edición
    public function guardarEdicion(Request $request)
    {
        // Validación
        $request->validate([
            'nombre_edicion' => 'required|string|max:50',
            'descripcion' => 'required|string|max:255',
            'fecha_de_salida' => 'required|date',
            'lote' => 'required|integer',
            'existencias' => 'required|integer',
            'extra' => 'nullable|numeric|min:0',
            'tipo' => 'required|in:Edicion,Personalizada',
        ]);

        // Crear la edición
        Edicion::create([
            'nombre_edicion' => $request->nombre_edicion,
            'descripcion' => $request->descripcion,
            'fecha_de_salida' => $request->fecha_de_salida,
            'lote' => $request->lote,
            'existencias' => $request->existencias,
            'extra' => $request->extra ?? 0,
            'tipo' => $request->tipo,
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
            'descripcion' => 'required|string|max:255',
            'fecha_de_salida' => 'required|date',
            'lote' => 'required|integer|min:0',
            'existencias' => 'required|integer|min:0',
            'extra' => 'nullable|numeric|min:0',
            'tipo' => 'required|in:Edicion,Personalizada',
        ]);

        // Buscar la edición
        $edicion = Edicion::findOrFail($id);

        // Actualizar los datos de la edición
        $edicion->update([
            'nombre_edicion' => $request->nombre_edicion,
            'descripcion' => $request->descripcion,
            'fecha_de_salida' => $request->fecha_de_salida,
            'lote' => $request->lote,
            'existencias' => $request->existencias,
            'extra' => $request->extra ?? 0,
            'tipo' => $request->tipo,
        ]);

        // Redirigir al listado con un mensaje de éxito
        return redirect()->route('ediciones.listar')->with('success', 'Edición actualizada exitosamente.');
    }

    // Eliminar una edición
    public function eliminarEdicion($id)
    {
        $edicion = Edicion::findOrFail($id);

        // Eliminar la edición
        $edicion->delete();

        return redirect()->route('ediciones.listar')->with('success', 'Edición eliminada exitosamente.');
    }
}
