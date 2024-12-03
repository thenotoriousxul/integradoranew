@extends('admin.layouts.dashboard')

@section('title', 'Reporte de Ventas')

@section('css')
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<!-- DataTables Bootstrap 5 CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<!-- Select2 CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
@endsection

@section('content')
<div class="container mt-4">
    <h2 class="text-center">Reporte de Ventas</h2>
    <table id="ReporteVentas" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>N.º Orden</th>
                <th>Fecha Orden</th>
                <th>Cliente/Empleado</th>
                <th>Nombre</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Total Pedido</th>
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
</div>

@endsection

@section('js')
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    // Verifica si jQuery está cargado correctamente
    console.log("jQuery está definido:", typeof jQuery);  // Esto debería mostrar "function"
</script>

<!-- Select2 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    console.log("Select2 cargado correctamente");  // Verifica si Select2 está cargado correctamente
</script>

<!-- DataTables Core -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    console.log("DataTables cargado correctamente");  // Verifica si DataTables está cargado correctamente
</script>

<!-- DataTables Bootstrap 5 -->
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
    console.log("DataTables Bootstrap 5 cargado correctamente");  // Verifica si DataTables Bootstrap 5 está cargado correctamente
</script>

<!-- Cargar idioma español localmente (evitar CORS) -->
<script>
    $('#ReporteVentas').DataTable({
        language: {
            url: "/js/i18n/es-ES.json"  // Ruta local al archivo JSON
        },
        scrollX: true
    });

    console.log("DataTable inicializado en #ReporteVentas");
</script>

<!-- Sidebar Script -->
<script>
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
    });
</script>
@endsection
