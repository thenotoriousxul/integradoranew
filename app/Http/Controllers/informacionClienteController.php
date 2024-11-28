<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class informacionClienteController extends Controller
{
    public function mostrarInformacionEnvio()
    {
        // Aquí se utiliza el modelo User correctamente
        $user = auth()->user()->load('persona.direccion');

        return view('detallaeOrden', compact('user'));
    }

    public function mostrarInformacionEnviodash()
    {
        // Aquí se utiliza el modelo User correctamente
        $usuario = auth()->user()->load('persona.direccion');

        return view('cliente.miInformacion', compact('usuario'));
    }
}
