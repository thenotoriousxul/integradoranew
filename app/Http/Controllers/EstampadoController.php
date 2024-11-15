<?php

namespace App\Http\Controllers;

use App\Models\Estampado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EstampadoController extends Controller
{
    // Listar todos los estampados
    public function listarEstampados()
    {
        $estampados = Estampado::all();
        return view('admin.estampados.listar', compact('estampados'));
    }

    // Mostrar formulario para crear un estampado
    public function crearFormularioEstampado()
    {
        return view('admin.estampados.crear');
    }

    // Guardar un nuevo estampado
    public function guardarEstampado(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:45',
            'imagen_diseño' => 'nullable|image|max:2048',
        ]);

        $imagenDiseño = null;
        if ($request->hasFile('imagen_diseño')) {
            $path = $request->file('imagen_diseño')->store('estampados', 's3');
            Storage::disk('s3')->setVisibility($path, 'public');
            $imagenDiseño = Storage::disk('s3')->url($path);
        }

        Estampado::create([
            'nombre' => $request->nombre,
            'imagen_diseño' => $imagenDiseño,
        ]);

        return redirect()->route('estampados.listar')->with('success', 'Estampado creado exitosamente.');
    }

    // Mostrar formulario para editar un estampado
    public function editarFormularioEstampado($id)
    {
        $estampado = Estampado::findOrFail($id);
        return view('admin.estampados.editar', compact('estampado'));
    }

    // Actualizar un estampado
    public function actualizarEstampado(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:45',
            'imagen_diseño' => 'nullable|image|max:2048',
        ]);

        $estampado = Estampado::findOrFail($id);

        if ($request->hasFile('imagen_diseño')) {
            if ($estampado->imagen_diseño) {
                Storage::disk('s3')->delete($estampado->imagen_diseño);
            }
            $path = $request->file('imagen_diseño')->store('estampados', 's3');
            Storage::disk('s3')->setVisibility($path, 'public');
            $estampado->imagen_diseño = Storage::disk('s3')->url($path);
        }

        $estampado->update([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('estampados.listar')->with('success', 'Estampado actualizado exitosamente.');
    }

    // Eliminar un estampado
    public function eliminarEstampado($id)
    {
        $estampado = Estampado::findOrFail($id);

        if ($estampado->imagen_diseño) {
            Storage::disk('s3')->delete($estampado->imagen_diseño);
        }

        $estampado->delete();

        return redirect()->route('estampados.listar')->with('success', 'Estampado eliminado exitosamente.');
    }
}
