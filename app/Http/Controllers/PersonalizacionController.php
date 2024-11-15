<?php

namespace App\Http\Controllers\formularios;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PersonalizacionController extends Controller
{
    public function personalizacion(){
        return view('personalizacion');
    }

}
