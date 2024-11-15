<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estampado;

class PersonalizacionController extends Controller
{
    public function index()
    {
        $estampados = Estampado::all();
        return view('personalizacion', compact('estampados'));
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'color' => 'required|string',
            'tamaño' => 'required|string',
            'estampado' => 'required|exists:estampados,id',
            'logo' => 'nullable|image|max:2048',
        ]);

        // Procesar la personalización y guardarla (Lógica pendiente)

        return redirect()->route('personalizacion')->with('success', 'Tu playera personalizada se ha registrado.');
    }
}
