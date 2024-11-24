<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class informacionClienteController extends Controller
{
    public function mostrarInformacionEnvio($userId)
    {
        // Aquí se utiliza el modelo User correctamente
        $user = User::with(['persona.direccion'])->findOrFail($userId);

        return view('detallaeOrden', compact('user'));
    }

}
