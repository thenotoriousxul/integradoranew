<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuditoriaController extends Controller
{
    public function audEdiciones(Request $request)
    {
        $query = DB::table('vista_auditoria_ediciones');

        if ($request->filled('operacion')) {
            $query->where('operacion', $request->input('operacion'));
        }

        if ($request->filled('usuario')) {
            $query->where('usuario_nombre', 'like', '%' . $request->input('usuario') . '%');
        }

        $orden = $request->input('orden', 'desc');
        $query->orderBy('fecha', $orden);

        $auditorias = $query->paginate(7);

        return view('admin.acciones.AudEdiciones', compact('auditorias'));
    }

    public function audPagos(Request $request)
    {
        $query = DB::table('vista_auditoria_pagos');

        if ($request->filled('operacion')) {
            $query->where('operacion', $request->input('operacion'));
        }

        if ($request->filled('usuario')) {
            $query->where('usuario_nombre', 'like', '%' . $request->input('usuario') . '%');
        }

        $orden = $request->input('orden', 'desc');
        $query->orderBy('fecha', $orden);

        $auditorias = $query->paginate(7);

        return view('admin.acciones.AudPagos', compact('auditorias'));
    }

    public function audUsuarios(Request $request)
    {
        $query = DB::table('vista_auditoria_usuarios');

        if ($request->filled('operacion')) {
            $query->where('operacion', $request->input('operacion'));
        }

        if ($request->filled('usuario')) {
            $query->where('usuario_nombre', 'like', '%' . $request->input('usuario') . '%');
        }

        $orden = $request->input('orden', 'desc');
        $query->orderBy('fecha', $orden);

        $auditorias = $query->paginate(7);

        return view('admin.acciones.AudUsuarios', compact('auditorias'));
    }
}
