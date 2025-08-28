<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class AuditoriaController extends Controller
{
    public function audUsuarios(Request $request)
    {
        $query = DB::table('auditoria_usuarios')
            ->leftJoin('users', 'auditoria_usuarios.usuario_id', '=', 'users.id')
            ->select(
                'auditoria_usuarios.id as auditoria_id',
                'auditoria_usuarios.accion as operacion',
                'users.name as usuario_nombre',
                'auditoria_usuarios.estado_anterior as datos_anterior',
                'auditoria_usuarios.estado_actual as datos_nuevo',
                'auditoria_usuarios.fecha'
            );

        if ($request->filled('operacion')) {
            $query->where('auditoria_usuarios.accion', $request->input('operacion'));
        }

        if ($request->filled('usuario')) {
            $query->where('users.name', 'like', '%' . $request->input('usuario') . '%');
        }

        $orden = $request->input('orden', 'desc');
        $query->orderBy('auditoria_usuarios.fecha', $orden);

        $auditorias = $query->paginate(7);

        return view('admin.acciones.AudUsuarios', compact('auditorias'));
    }

    public function audPagos(Request $request)
    {
        $query = DB::table('auditoria_pagos')
            ->leftJoin('users', 'auditoria_pagos.usuario_id', '=', 'users.id')
            ->select(
                'auditoria_pagos.id as auditoria_id',
                'auditoria_pagos.accion as operacion',
                'users.name as usuario_nombre',
                'auditoria_pagos.estado_anterior as datos_anterior',
                'auditoria_pagos.estado_actual as datos_nuevo',
                'auditoria_pagos.fecha'
            );

        if ($request->filled('operacion')) {
            $query->where('auditoria_pagos.accion', $request->input('operacion'));
        }

        if ($request->filled('usuario')) {
            $query->where('users.name', 'like', '%' . $request->input('usuario') . '%');
        }

        $orden = $request->input('orden', 'desc');
        $query->orderBy('auditoria_pagos.fecha', $orden);

        $auditorias = $query->paginate(7);

        return view('admin.acciones.AudPagos', compact('auditorias'));
    }
}