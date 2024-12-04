<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Ventas</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- DataTables Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <style>
        /* Para evitar que se distorsione la tabla al usar scrollX */
        .dataTables_wrapper .dataTables_scroll {
            overflow: auto !important;
        }
    </style>
</head>
<body>

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

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- DataTables Core JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- DataTables Bootstrap 5 JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <!-- DataTables Initialization Script -->
    <script>
        $(document).ready(function() {
            // Inicializar DataTable
            $('#ReporteVentas').DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
                },
                scrollX: true,
                responsive: true
            });
            console.log("DataTable inicializado en #ReporteVentas");
        });
    </script>

</body>
</html>
