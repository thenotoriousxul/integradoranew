<?php

namespace App\Http\Controllers\formularios;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class formularioEdicion extends Controller
{
    public function formularioEdicion(){
        return view('formularioEdicion');
    }
}
