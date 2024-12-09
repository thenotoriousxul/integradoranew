<?php

namespace App\Http\Controllers;

use App\Http\Requests\direccionRequest;
use App\Mail\EnvioEntregado;
use App\Models\Direccion;
use App\Models\Envios;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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
        $ultimaActualizacion = Carbon::parse($direccion->updated_at);  
        
        $ultimaActualizacion->setTimezone('America/Mexico_City');
        
        $diasPasados = now('America/Mexico_City')->diffInDays($ultimaActualizacion, false);
        
        $diasFaltantes = intval($diasRestriccion - abs($diasPasados));
        
        if ($diasFaltantes > 0) {
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
    


    /**
     * Handle the event.
     *
     * @param  \App\Models\Envios  $envio
     * @return void
     */
    // public function handle(Envios $envio)
    // {
    //     // Verifica si el estado ha cambiado a 'entregado'
    //     if ($envio->isDirty('estado_envio') && $envio->estado_envio === 'entregado') {
    //         // Obtén el correo del usuario a través de las relaciones
    //         $correo = $envio->orden->persona->usuario->email;

    //         // Envía el correo
    //         Mail::to($correo)->send(new EnvioEntregado($envio));
    //     }
    // }



}
