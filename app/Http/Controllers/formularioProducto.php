<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class formularioProducto extends Controller
{
    public function formularioProducto(){
        return view('formularios.agregarProducto');
    }
}
