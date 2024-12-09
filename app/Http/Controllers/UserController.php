<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function listar(){

        $usuarios = User::with(['persona', 'roles'])->paginate(10);
        return view('admin.usuarios.listar', compact('usuarios'));
    }   


    public function desactivar($id){
        $usuarios = User::FindOrFail($id);

        $usuarios->status = 'Inactivo';
        $usuarios->save();


        return redirect()->back()->with('success', 'usuario desactivado correctamente');
    }
}
