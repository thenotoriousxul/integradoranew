<?php

namespace App\Http\Controllers;

use App\Models\ReporteVenta;
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

        $ventas = DB::table('ordenes')
        ->select(DB::raw('YEAR(fecha_orden) as año'), DB::raw('MONTHNAME(fecha_orden) as mes'), DB::raw('COUNT(*) as total_ventas'))
        ->groupBy(DB::raw('YEAR(fecha_orden), MONTH(fecha_orden), MONTHNAME(fecha_orden)')) // Agrupar por mes y año
        ->orderBy(DB::raw('YEAR(fecha_orden)')) // Ordenar por año primero
        ->orderBy(DB::raw('MONTH(fecha_orden)')) // Luego ordenar por el número del mes (1-12)
        ->get();

    


        return view('admin.dashboardMenu', [
            'ingresosMes'=>$ingresosMes,
            'ventasTotales'=>$ventasTotales,
            'nuevosClientes'=>$nuevosClientes,
            'ventas'=>$ventas,
        ]);
    }

    public function manual(){

        $pdf = pdf::loadView('admin.manual');

        return $pdf->stream('manual_usuario.pdf');
    }
    
    public function reporteVentas(){
        $reporteVenta = ReporteVenta::all();
        dd($reporteVenta);

        return view('admin.ordenes.reporteVentas');
    }

}
