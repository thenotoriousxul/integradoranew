<?php

namespace App\Http\Controllers\formularios;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class formulariosController extends Controller
{
    public function agregarProveedor(){
        return view('formularios.agregarProveedor');
    }


    public function formularioProducto(){
        return view('admin.agregarProducto');
    }

    public function formularioEdicion(){
        return view('formularioEdicion');
    }
}
