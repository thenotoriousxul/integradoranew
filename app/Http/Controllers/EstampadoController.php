<?php

namespace App\Http\Controllers;

use App\Models\Estampado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EstampadoController extends Controller
{
    public function listarEstampados()
    {
        $estampados = Estampado::paginate(10);
        
        return view('admin.estampados.listar', compact('estampados'));
    }


    public function crearFormularioEstampado()
    {
        return view('admin.estampados.crear');
    }

    public function guardarEstampado(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:45',
            'costo' => 'required|numeric|min:0',
            'imagen_diseño' => 'nullable|image|max:2048',
        ]);
    
        $imagenEstampado = null;
        if ($request->hasFile('imagen_diseño')) {
            $path = $request->file('imagen_diseño')->store('estampados', 's3');
            Storage::disk('s3')->setVisibility($path, 'public');
            $imagenEstampado = Storage::disk('s3')->url($path);
        }
    
        Estampado::create([
            'nombre' => $request->nombre,
            'costo' => $request->costo,
            'imagen_estampado' => $imagenEstampado,
        ]);
    
        return redirect()->route('estampados.listar')->with('success', 'Estampado creado exitosamente.');
    }
    


    public function editarFormularioEstampado($id)
    {
        $estampado = Estampado::findOrFail($id);
        return view('admin.estampados.editar', compact('estampado'));
    }

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
