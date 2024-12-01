<?php

namespace App\Http\Controllers;

use App\Http\Requests\direccionRequest;
use App\Models\Direccion;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class informacionClienteController extends Controller
{
    public function mostrarInformacionEnvio()
    {
        $user = auth()->user()->load('persona.direccion');

        return view('detallaeOrden', compact('user'));
    }

    public function dashinfo()
    {
        $usuario = auth()->user()->load('persona.direccion');

        return view('cliente.miInformacion', compact('usuario'));
    }

    public function actualizarDireccion(direccionRequest $request, $id)
    {
        $direccion = Direccion::findOrFail($id);


        $diasRestriccion = 30; 
        $ultimaActualizacion = $direccion->updated_at;

    if ($ultimaActualizacion && now()->diffInDays($ultimaActualizacion) < $diasRestriccion) {
        $diasFaltantes = $diasRestriccion - now()->diffInDays($ultimaActualizacion);

        return redirect()->back()->withErrors([
            'message' => "No puedes actualizar tu dirección. Debes esperar $diasFaltantes días más."
        ]);
    }

        $direccion->update([
            'calle' => $request->calle,
            'colonia' => $request->colonia,
            'numero_ext' => $request->numero_ext,
            'numero_int' => $request->numero_int,
            'estado' => $request->estado,
            'codgo_postal' => $request->codigo_postal,
            'pais' => $request->pais
        ]);

        return redirect()->route('perfil')->with('success', 'Direccion actualizada exitosamente.');
    }

    public function mostrarenvios()
    {
        $userId = auth()->id();
    
        $enviosPendientes = DB::table('vista_envios_pendientes')
            ->where('usuario_id', $userId)
            ->get();

        return view('cliente.estadoenvios', ['envios' => $enviosPendientes]);
    }
    public function obtenerDetallesProducto($ordenId)
    {
        $productosComprados = DB::table('vista_detalle_productos_comprados')
            ->where('orden_id', $ordenId)
            ->get();
    
        return response()->json($productosComprados);
    }
    
    
}
