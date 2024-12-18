<?php

namespace App\Http\Controllers;

use App\Models\Direccion;
use Illuminate\Http\Request;
use App\Models\Proveedor;


class proveedorController extends Controller
{
    public function nuevoproveedor(Request $request)
    {
        $request->validate([
            'calle' => 'required|string|max:50',
            'numero_ext' => 'required|string|max:50',
            'numero_int' => 'nullable|string|max:50',
            'colonia' => 'required|string|max:50',
            'estado' => 'required|string|max:50',
            'codigo_postal' => 'required|string|max:10',
            'pais' => 'required|string|max:50',
            'nombre' => 'required|string|max:50',
            'numero_telefonico' => 'required|string|max:50',
        ]);

        $direccion = Direccion::create([
            'calle' => $request->input('calle'),
            'numero_ext' => $request->input('numero_ext'),
            'numero_int' => $request->input('numero_int'),
            'colonia' => $request->input('colonia'),
            'estado' => $request->input('estado'),
            'codigo_postal' => $request->input('codigo_postal'),
            'pais' => $request->input('pais'),
        ]);

        $proveedor = Proveedor::create([
            'nombre' => $request->input('nombre'),
            'numero_telefonico' => $request->input('numero_telefonico'),
            'direcciones_id' => $direccion->id,
            'tipo'=>$request->input('tipo'),
        ]);

        return redirect()->route('admin.agregarProveedor')->with('success', 'Proveedor registrado correctamente.');
   
    }
    public function index()
    {
        $proveedores = Proveedor::with('direccion')->get(); 
        return view('admin.proveedores.listarProveedor', compact('proveedores'));
    }

    public function editarProveedor($id)
{
    $proveedor = Proveedor::with('direccion')->findOrFail($id);
    return view('admin.proveedores.editarProveedor', compact('proveedor'));
}

public function actualizarProveedor(Request $request, $id)
{
    $request->validate([
        'calle' => 'required|string|max:50',
        'numero_ext' => 'required|string|max:50',
        'numero_int' => 'nullable|string|max:50',
        'colonia' => 'required|string|max:50',
        'estado' => 'required|string|max:50',
        'codigo_postal' => 'required|string|max:10',
        'pais' => 'required|string|max:50',
        'nombre' => 'required|string|max:50',
        'numero_telefonico' => 'required|string|max:50',
    ]);

    $proveedor = Proveedor::findOrFail($id);
    $direccion = $proveedor->direccion;

    // Actualiza los datos de la dirección
    $direccion->update([
        'calle' => $request->input('calle'),
        'numero_ext' => $request->input('numero_ext'),
        'numero_int' => $request->input('numero_int'),
        'colonia' => $request->input('colonia'),
        'estado' => $request->input('estado'),
        'codigo_postal' => $request->input('codigo_postal'),
        'pais' => $request->input('pais'),
    ]);

    // Actualiza los datos del proveedor
    $proveedor->update([
        'nombre' => $request->input('nombre'),
        'numero_telefonico' => $request->input('numero_telefonico'),
    ]);

    return redirect()->route('proveedores.index')->with('success', 'Proveedor actualizado correctamente.');
}

}
  