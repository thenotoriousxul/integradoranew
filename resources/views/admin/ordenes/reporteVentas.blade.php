@extends('admin.layouts.dashboard')

@section('title', 'Reporte de Ventas')

@section ('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
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
            <th>Metodo de Pago</th>
            <th>Estado de Envio</th>
            <th>Direccion de Envio</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reporteVentas as $reporteVenta)
        <tr>
            <td>{{ $reporteVenta->numero_orden }}</td>
            <td>{{ $reporteVenta->fecha_orden }}</td>
            <td>{{ $reporteVenta->tipo_cliente }}</td>
            <td>{{ $reporteVenta->Nombre }}</td>
            <td>{{ $reporteVenta->nombre_producto }}</td>
            <td>{{ $reporteVenta->cantidad }}</td>
            <td>{{ $reporteVenta->total_producto }}</td>
            <td>{{ $reporteVenta->total_pedido }}</td>
            <td>{{ $reporteVenta->descuento }}</td>
            <td>{{ $reporteVenta->metodo_pago }}</td>
            <td>{{ $reporteVenta->estado_envio }}</td>
            <td>{{ $reporteVenta->direccion_envio }}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
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
            <th>Metodo de Pago</th>
            <th>Estado de Envio</th>
            <th>Direccion de Envio</th>
        </tr>
    </tfoot>
</table>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#ReporteVentas').DataTable(); // Inicializa DataTable
    });
</script>
@endsection
