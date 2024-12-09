<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Ventas</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <!-- DataTables Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">

    <style>
        /* Estilos para la tabla en vista de pantalla */
        .dataTables_wrapper .dataTables_scroll {
            overflow: auto !important;
        }

        /* Ajustar el tamaño de la fuente */
        body {
            font-size: 12px; /* Reducción del tamaño de la fuente */
        }

        /* Ajustar el ancho de las columnas */
        table {
            width: 100%;
            margin: 0 auto;
            border-collapse: collapse;
            table-layout: fixed; /* Fija el ancho de las columnas */
        }

        th, td {
            text-align: left;
            padding: 6px; /* Espaciado reducido */
            border: 1px solid #ddd;
            word-wrap: break-word; /* Permite el ajuste del texto */
            white-space: normal; /* Ajuste del texto largo */
            font-size: 12px; /* Tamaño de fuente ajustado */
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        /* Especificar un ancho mínimo para algunas columnas */
        th:nth-child(10), td:nth-child(10) {
            width: 120px; /* Ancho ajustado para la columna "Método de Pago" */
        }

        th:nth-child(11), td:nth-child(11) {
            width: 120px; /* Ancho ajustado para la columna "Estado de Envío" */
        }

        th:nth-child(12), td:nth-child(12) {
            width: 200px; /* Ancho ajustado para la columna "Dirección" */
        }

        /* Estilos específicos para la impresión */
        @media print {
            body {
                font-family: Arial, sans-serif;
                font-size: 10px; /* Tamaño de fuente reducido para impresión */
            }

            .container {
                width: 100%;
                margin: 0;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            th, td {
                text-align: left;
                padding: 6px;
                border: 1px solid #ddd;
                word-wrap: break-word;
                white-space: normal;
            }

            th {
                background-color: #f2f2f2;
                font-weight: bold;
            }

            /* Ocultar elementos no necesarios en la impresión */
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>

    <div class="container mt-4">
        <h2 class="text-center">Reporte de Ventas de el mes actual</h2>
        <table id="ReporteVentas" class="table table-striped table-bordered" style="width:100%">
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
                    <th>Dirección</th>
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
                    <td>{{ $reporteVenta->direccion_envio }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Botón para imprimir -->
        <div class="text-center mt-4">
            <button class="btn btn-primary no-print" onclick="window.print()">Imprimir Reporte</button>
        </div>
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
        });
    </script>

</body>
</html>
