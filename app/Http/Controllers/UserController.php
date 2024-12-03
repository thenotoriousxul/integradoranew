<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function listar(){

        $usuarios = User::with('persona')->get();

        return view('admin.usuarios.listar', compact('usuarios'));
    }   
}
