<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB; 
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class dashController extends Controller
{
    public function menuPrincipal(){

        $ingresosMes = DB::table('ordenes')
        ->where('estado', 'Pagada')
        ->whereMonth('fecha_orden', now()->month)
        ->whereYear('fecha_orden', now()->year)
        ->sum('total');


        $ventasTotales = DB::table('ordenes')
        ->where('estado', 'Pagada')
        ->whereMonth('fecha_orden', now()->month)
        ->whereYear('fecha_orden', now()->year)
        ->count();

        $nuevosClientes = DB::table('tipo_personas')
        ->where('tipo_persona', 'cliente')
        ->whereMonth('created_at', now()->month)
        ->whereYear('created_at', now()->year)
        ->count();


        return view('admin.dashmenu', [
            'ingresosMes'=>$ingresosMes,
            'ventasTotales'=>$ventasTotales,
            'nuevosClientes'=>$nuevosClientes,
        ]);
    }

    public function manual(){

        $pdf = pdf::loadView('admin.manual');

        return $pdf->stream('manual_usuario.pdf');
    }
}
