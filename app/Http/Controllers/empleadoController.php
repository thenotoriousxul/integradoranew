<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\CreateNewUser;
use Illuminate\Http\Request;

class empleadoController extends Controller
{
    public function registrarEmpleado(Request $request, CreateNewUser $action)
{
    $action->createEmpleado($request->all()); 
    return redirect()->route('dash.menu')->with('success', 'Empleado registrado correctamente');
}
}
