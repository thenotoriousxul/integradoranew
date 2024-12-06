@extends('admin.layouts.dashboard')

@section('title', 'Reporte de Ventas')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.bootstrap5.css">
@endsection

@section('content')
<h2 class="text-center">Reporte de Ventas</h2>
<div class="card">
    <div class="card-body">
{{--    
        <style>
            label:has(input[type="search"]) {
                display: inline-block;
                margin-left: 350px; 
            }
            label:has(input[type="search"]) input {
                margin-left: 2px; 
            } --}}
        </style>

            <div class="container mt-4">
                <table id="ReporteVentas" class="table table-striped" style="width:100%">
                    <thead>
                    <tr>
                        <th>N.º Orden</th>
                        <th>Fecha Orden</th>
                        <th>Cliente/Empleado</th>
                        <th>Nombre</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Total Orden</th>
                        <th>Pago Final</th>
                        <th>Descuento</th>
                        <th>Método de Pago</th>
                        <th>Estado de Envío</th>
                        <th>Direccion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reporteVentas as $reporteVenta)
                    <tr>
                        <td>{{ $reporteVenta->numero_orden }}</td>
                        <td>{{ \Carbon\Carbon::parse($reporteVenta->fecha_orden)->format('d/m/Y') }}</td>
                        <td>{{ $reporteVenta->tipo_cliente }}</td>
                        <td>{{ $reporteVenta->Nombre }}</td>
                        <td>{{ $reporteVenta->nombre_producto }}</td>
                        <td>{{ $reporteVenta->cantidad }}</td>
                        <td>{{ number_format($reporteVenta->total_producto, 2) }}</td>
                        <td>{{ number_format($reporteVenta->total_pedido, 2) }}</td>
                        <td>{{ $reporteVenta->descuento }}</td>
                        <td>{{ $reporteVenta->metodo_pago }}</td>
                        <td>{{ $reporteVenta->estado_envio }}</td>
                        <td>{{ $reporteVenta->direccion_envio}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-3">
                <strong>Total de ventas en línea:</strong> {{ number_format($TotalVentasLinea, 2) }}<br>
                <strong>Total de ventas locales:</strong> {{ number_format($TotalVentasFisica, 2) }}
            </div>
            <div class="container">
                <a href="{{ route('pdf.reporte') }}">
                    <button class="btn btn-success">Guardar PDF</button>
                    </a>
            </div>
            
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    console.log("jQuery está definido:", typeof jQuery);  
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    console.log("Select2 cargado correctamente");
</script>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    console.log("DataTables cargado correctamente"); 
</script>

<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
    console.log("DataTables Bootstrap 5 cargado correctamente");
</script>
<script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.bootstrap5.js"></script>

<script>
    $('#ReporteVentas').DataTable({
        responsive: true,
        autowidth: false,
        language: {
            info: 'Showing page _PAGE_ of _PAGES_',
            infoEmpty: 'No hay registros para mostrar',
            emptyTable: "No hay datos para mostrar",
            search:"Buscar:",
            lengthMenu:     "Mostrando _MENU_ Registros",
            paginate: {
            first:      "Primero",
            last:       "Ultimo",
            next:       "Siguiente",
            previous:   "Anterior"
            },
        },
        scrollX: true
    });

    console.log("DataTable inicializado en #ReporteVentas");
</script>

{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log("El DOM está completamente cargado.");
        const sidebar = document.getElementById('sidebar');
        if (sidebar) {
            console.log("Elemento #sidebar encontrado:", sidebar);
            sidebar.addEventListener('click', function() {
                console.log('Sidebar clickeado');
            });
        } else {
            console.warn("El elemento #sidebar no existe en el DOM.");
        }
    }); --}}
</script>
@endsection
