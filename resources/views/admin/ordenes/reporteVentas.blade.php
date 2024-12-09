@extends('admin.layouts.dashboard')

@section('title', 'Reporte de Ventas')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.bootstrap5.css">
@endsection

@section('content')
<div class="dash-info">
    <h2 class="text-center">Reporte de Ventas</h2>
    <div class="card">
        <h2>Total de ventas en línea:</h2>
        <div class="table-info">{{ number_format($TotalVentasLinea, 2) }}</div>
    </div>
    <div class="card">
        <h2>Total de ventas locales:</h2>
        <div class="table-info">{{ number_format($TotalVentasFisica, 2) }}</div>
    </div>
</div>
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
            
            <div class="container">
                <a href="{{ route('pdf.reporte') }}">
                    <button class="btn btn-success">Guardar PDF</button>
                    </a>
            </div>
            
        </div>
    </div>
</div>
<style>
.dash-info {
    display: grid;
    gap: 20px;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    margin-bottom: 40px;
}

.card {
    padding: 25px;
    border-radius: 12px;
    color: #ffffff;
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    position: relative;
    overflow: hidden;
}

.card::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: rgba(255, 255, 255, 0.1);
    transform: rotate(45deg);
    pointer-events: none;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.1);
}

.card h2 {
    font-size: 1.75rem;
    margin-bottom: 1.25rem;
    font-weight: 600;
}

.card:nth-child(1) { background: linear-gradient(135deg, #3498db, #2980b9); }
.card:nth-child(2) { background: linear-gradient(135deg, #453ce7, #c0392b); }
.card:nth-child(3) { background: linear-gradient(135deg, #2a0069, #000000); }

.table-info
{
    color: white;
}
</style>

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
            info: 'Mostrando pagina _PAGE_ of _PAGES_',
            infoEmpty: 'No hay registros para mostrar',
            emptyTable: "No hay datos para mostrar",
            search:"Buscar:",
            zeroRecords: "No se encontraron resultados",
            lengthMenu: "Mostrando _MENU_ Registros",
            infoFiltered: "(filtrando from _MAX_ total de registros)",
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


