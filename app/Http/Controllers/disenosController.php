<?php

namespace App\Http\Controllers;

use App\Models\Diseno;
use App\Models\Estampado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class disenosController extends Controller
{
    public function getDiseños(){
        $disenos = Diseno::with('estampados')->get();
        return view('admin.disenos.dieños', compact('disenos'));
    }

    public function storeDiseños(Request $request)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:55'],
            'estampados.*.nombre' => ['required', 'string', 'max:255'],
            'estampados.*.imagen_estampado' => ['nullable', 'image', 'max:2048'],
            'estampados.*.costo' => ['required', 'numeric'],
        ]);
    

        $diseño = new Diseno();
        $diseño->nombre = $request->input('nombre');
        $diseño->save();
    
        // Procesar estampados si existen
        if (isset($validated['estampados'])) {
            foreach ($validated['estampados'] as $estampadoData) {
                $estampado = new Estampado();
                $estampado->nombre = $estampadoData['nombre'];
                $estampado->costo = $estampadoData['costo'];
    
                 // Subir la imagen si está presente
                 if (isset($estampadoData['imagen_estampado']) && $estampadoData['imagen_estampado'] instanceof \Illuminate\Http\UploadedFile) {
                // Guardar en S3
                $path = $estampadoData['imagen_estampado']->store('estampados', 's3');
                $estampado->imagen_estampado = $path; // Guardar la ruta en la base de datos

                // Hacer pública la imagen (opcional)
                Storage::disk('s3')->setVisibility($path, 'public');
                 }
                $estampado->save();
    
                // Relacionar estampado con diseño
                $diseño->estampados()->attach($estampado->id);
            }
        }
    
        return redirect()->route('mostrar.diseños')->with('success', 'Diseño y estampados creados con éxito.');
    }
    
}