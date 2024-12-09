<?php

namespace App\Http\Controllers;

use App\Models\EdicionesProductos;
use App\Models\ReporteVenta;
use Illuminate\Support\Facades\DB; 
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;


class dashController extends Controller
{
    public function menuPrincipal(){


         $productos = EdicionesProductos::all();
        
        
         $productosBajoStock = DB::table('ediciones_productos')
         ->whereBetween('cantidad', [1, 5]) // Verifica si la cantidad está entre 1 y 5
         ->where('estado', 'activo') // Filtra por productos con estado activo
         ->get();
 
         $productosAgotados = DB::table('ediciones_productos')
         ->where('cantidad', 0) // Filtra productos con cantidad igual a 0
         ->where('estado', 'activo') // Filtra por productos con estado activo
         ->get();

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
        ->groupBy(DB::raw('YEAR(fecha_orden), MONTH(fecha_orden), MONTHNAME(fecha_orden)')) 
        ->orderBy(DB::raw('YEAR(fecha_orden)')) 
        ->orderBy(DB::raw('MONTH(fecha_orden)')) 
        ->get();

        $reporteVentas = DB::table('ediciones_productos as ep')
        ->select(
            'ep.nombre AS Producto',
            'ep.talla AS Talla',
            'ep.costo_precio_venta AS CostoVenta',
            'ep.costo_fabrica AS CostoProduccion',
            DB::raw('SUM(detalle.cantidad) AS TotalVendidos'),
            DB::raw('SUM(detalle.cantidad * ep.costo_precio_venta) AS TotalVentas'),
            DB::raw('SUM(detalle.cantidad * (ep.costo_precio_venta - ep.costo_fabrica)) AS GananciaNeta'),
            DB::raw('AVG(detalle.cantidad) AS PromedioVentasPorOrden'),
            DB::raw('MIN(ordenes.fecha_orden) AS FechaPrimeraVenta'),
            DB::raw('MAX(ordenes.fecha_orden) AS FechaUltimaVenta')
        )
        ->join('detalle_ordenes as detalle', 'ep.id', '=', 'detalle.ediciones_productos_id')
        ->join('ordenes', 'ordenes.id', '=', 'detalle.ordenes_id')
        ->groupBy('ep.nombre', 'ep.talla', 'ep.costo_precio_venta', 'ep.costo_fabrica')
        ->orderByDesc(DB::raw('SUM(detalle.cantidad)')) 
        ->limit(10) 
        ->get();
    

        return view('admin.dashboardMenu', [
            'ingresosMes'=>$ingresosMes,
            'ventasTotales'=>$ventasTotales,
            'nuevosClientes'=>$nuevosClientes,
            'ventas'=>$ventas,
            'reporteVentas'=>$reporteVentas,
            'productosBajoStock' => $productosBajoStock,
            'productosAgotados' => $productosAgotados
        ]);
    }

    public function manual(){

        $pdf = pdf::loadView('admin.manual');

        return $pdf->stream('manual_usuario.pdf');
    }
    

    public function reporteVentas(){
        // $reporteVentas = ReporteVenta::all();
        $reporteVentas = DB::table('reporteVentas')->get();

        $TotalVentasLinea = DB::table('ordenes')
            ->join('tipo_personas', 'ordenes.tipo_personas_id', '=', 'tipo_personas.id')
            ->where('tipo_personas.tipo_persona', 'Cliente')
            ->sum('ordenes.total');

        $TotalVentasFisica = DB::table('ordenes')
            ->join('tipo_personas', 'ordenes.tipo_personas_id', '=', 'tipo_personas.id')
            ->where('tipo_personas.tipo_persona', 'Empleado')
            ->sum('ordenes.total');

        return view('admin.ordenes.reporteVentas', compact('reporteVentas', 'TotalVentasLinea', 'TotalVentasFisica'));
    }

    public function pdfReporteVentas(){
        $inicioMes = Carbon::now()->startOfMonth(); 
        $finMes = Carbon::now()->endOfMonth(); 
        $currentMonth = Carbon::now()->month;

        $TotalVentasLinea = DB::table('ordenes')
        ->join('tipo_personas', 'ordenes.tipo_personas_id', '=', 'tipo_personas.id')
        ->where('tipo_personas.tipo_persona', 'Cliente')
        ->whereMonth('ordenes.fecha_orden', $currentMonth)
        ->where('estado', 'Pagada')
        ->sum('ordenes.total');

        $TotalVentasFisica = DB::table('ordenes')
        ->join('tipo_personas', 'ordenes.tipo_personas_id', '=', 'tipo_personas.id')
        ->where('tipo_personas.tipo_persona', 'Empleado')
        ->whereMonth('ordenes.fecha_orden', $currentMonth)
        ->where('estado', 'Pagada')
        ->sum('ordenes.total');
    
        $reporteVentas = ReporteVenta::whereBetween('fecha_orden', [$inicioMes, $finMes])->get(); 
    
        $pdf = PDF::loadView('admin.ordenes.reportepdf', compact('reporteVentas', 'TotalVentasLinea', 'TotalVentasFisica'));
    
        // Retornar el PDF
        return $pdf->stream('reporte_ventas_mes.pdf');
    }

    public function ventasPorProducto()
    {
        
        $reporteVentas = DB::table('ediciones_productos as ep')
            ->select(
                'ep.nombre AS Producto',
                'ep.talla AS Talla',
                'ep.costo_precio_venta AS CostoVenta',
                'ep.costo_fabrica AS CostoProduccion',
                DB::raw('SUM(detalle.cantidad) AS TotalVendidos'),
                DB::raw('SUM(detalle.cantidad * ep.costo_precio_venta) AS TotalVentas'),
                DB::raw('SUM(detalle.cantidad * (ep.costo_precio_venta - ep.costo_fabrica)) AS GananciaNeta'),
                DB::raw('AVG(detalle.cantidad) AS "Promedio ventas por orden"'),
                DB::raw('MIN(ordenes.fecha_orden) AS FechaPrimeraVenta'),
                DB::raw('MAX(ordenes.fecha_orden) AS FechaUltimaVenta')
            )
            ->join('detalle_ordenes as detalle', 'ep.id', '=', 'detalle.ediciones_productos_id')
            ->join('ordenes', 'ordenes.id', '=', 'detalle.ordenes_id')
            ->whereBetween('ordenes.fecha_orden', ['2024-01-01', '2024-12-31'])
            ->groupBy('ep.nombre', 'ep.talla', 'ep.costo_precio_venta', 'ep.costo_fabrica')
            ->orderByDesc(DB::raw('SUM(detalle.cantidad)'))
            ->get(); 

        
        return view('admin.dashboardMenu', compact('reporteVentas'));
    }


}
