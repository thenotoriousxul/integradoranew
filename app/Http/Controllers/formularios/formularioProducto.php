<?php

namespace App\Http\Controllers\formularios;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class formularioProducto extends Controller
{
    public function formularioProducto(){
        return view('formularios.agregarProducto');
    }
}
