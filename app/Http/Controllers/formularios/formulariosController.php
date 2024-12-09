<?php

namespace App\Http\Controllers\formularios;
use App\Http\Controllers\Controller;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class formulariosController extends Controller
{
    public function agregarProveedor(){
        return view('formularios.agregarProveedor');
    }


    public function formularioProducto(){

        $proveedores = Proveedor::all();
        return view('admin.productos.dashProducto', compact('proveedores'));
    }

    public function formularioEdicion(){
        return view('formularioEdicion');
    }

    public function crearDiseño(){
        return view('admin.disenos.crearDiseño');
    }

    public function crearEdicionProducto(){
        return view('admin.edicionesP.formularioProducto');
    }
}
