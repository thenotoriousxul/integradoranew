<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Auditoria;

class AccionesController extends Controller
{
    public function index()
    {
        $auditorias = Auditoria::all();
        return view('admin.acciones.acciones', compact('auditorias'));
    }
}
