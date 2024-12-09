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
    public function crearFormularioEdicion()
    {
        return view('admin.ediciones.crear');
    }

    public function guardarEdicion(Request $request)
    {
        $request->validate([
            'nombre_edicion' => 'required|string|max:50',
            'descripcion' => 'required|string|max:255',
            'fecha_de_salida' => 'required|date',
            'lote' => 'required|integer',
            'existencias' => 'required|integer',
            'extra' => 'nullable|numeric|min:0',
            'tipo' => 'required|in:Edicion,Personalizada',
        ]);

        Edicion::create([
            'nombre_edicion' => $request->nombre_edicion,
            'descripcion' => $request->descripcion,
            'fecha_de_salida' => $request->fecha_de_salida,
            'lote' => $request->lote,
            'existencias' => $request->existencias,
            'extra' => $request->extra ?? 0,
            'tipo' => $request->tipo,
        ]);

        return redirect()->route('ediciones.listar')->with('success', 'Edición creada exitosamente.');
    }

    public function listarEdiciones()
    {
        $ediciones = Edicion::paginate(10);
        return view('admin.ediciones.listar', compact('ediciones'));
    }

    public function detalleEdicion($id)
    {
        $edicion = Edicion::findOrFail($id);
        return view('admin.ediciones.detalle', compact('edicion'));
    }

    public function editarFormularioEdicion($id)
    {
        $edicion = Edicion::findOrFail($id);
        return view('admin.ediciones.editar', compact('edicion'));
    }

    public function actualizarEdicion(Request $request, $id)
    {
        $request->validate([
            'nombre_edicion' => 'required|string|max:50',
            'descripcion' => 'required|string|max:255',
            'fecha_de_salida' => 'required|date',
            'lote' => 'required|integer|min:0',
            'existencias' => 'required|integer|min:0',
            'extra' => 'nullable|numeric|min:0',
            'tipo' => 'required|in:Edicion,Personalizada',
        ]);

        $edicion = Edicion::findOrFail($id);

        $edicion->update([
            'nombre_edicion' => $request->nombre_edicion,
            'descripcion' => $request->descripcion,
            'fecha_de_salida' => $request->fecha_de_salida,
            'lote' => $request->lote,
            'existencias' => $request->existencias,
            'extra' => $request->extra ?? 0,
            'tipo' => $request->tipo,
        ]);

        return redirect()->route('ediciones.listar')->with('success', 'Edición actualizada exitosamente.');
    }

    public function eliminarEdicion($id)
    {
        $edicion = Edicion::findOrFail($id);

        $edicion->delete();

        return redirect()->route('ediciones.listar')->with('success', 'Edición eliminada exitosamente.');
    }
}
