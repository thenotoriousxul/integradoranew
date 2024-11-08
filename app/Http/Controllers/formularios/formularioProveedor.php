<?php
namespace App\Http\Controllers\formularios;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class formularioProveedor extends Controller
{
    public function agregarProveedor(){
        return view('formularios.agregarProveedor');
    }
}
