@extends('admin.layouts.dashboard')

@section('content')

<style>
    body {
        background-color: #f0f4f8;
        color: #2d3748;
        font-family: 'Arial', sans-serif;
    }

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
    .card:nth-child(2) { background: linear-gradient(135deg, #e74c3c, #c0392b); }
    .card:nth-child(3) { background: linear-gradient(135deg, #2ecc71, #27ae60); }

    .dashboard-sections, .section-columns {
        display: grid;
        gap: 25px;
    }

    .section-columns {
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    }

    .dashboard-section {
        background-color: #ffffff;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border: 1px solid #e2e8f0;
        transition: box-shadow 0.3s ease;
    }

    .dashboard-section:hover {
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.1);
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #e2e8f0;
    }

    .section-title {
        font-size: 1.25rem;
        color: #2d3748;
        font-weight: 600;
        position: relative;
        padding-left: 15px;
    }

    .section-title::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 5px;
        height: 20px;
        background-color: #3498db;
        border-radius: 2px;
    }

    .section-content {
        height: 300px;
        background-color: #f8fafc;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        padding: 20px;
        position: relative;
        overflow: auto;
    }

    .section-content::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 4px;
    }

    .table-info {
        font-size: 2rem;
        font-weight: bold;
    }
</style>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="dash-info">
    <div class="card">
        <h2>Ingresos Del Mes</h2>
        <div class="table-info">{{ number_format($ingresosMes, 2) }}</div>
    </div>
    <div class="card">
        <h2>Número de Ventas este Mes</h2>
        <div class="table-info">{{ $ventasTotales }}</div>
    </div>
    <div class="card">
        <h2>Nuevos Clientes este Mes</h2>
        <div class="table-info">{{ $nuevosClientes }}</div>
    </div>
</div>

<div class="container">
    <div class="dashboard-section">
        <div class="section-header">
            <h2 class="section-title">Productos Más Vendidos</h2>
        </div>
        <div class="section-content">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Talla</th>
                            <th>Costo de Venta</th>
                            <th>Costo de Producción</th>
                            <th>Total Vendidos</th>
                            <th>Total Ventas</th>
                            <th>Ganancia Neta</th>
                            <th>Promedio Ventas por Orden</th>
                            <th>Fecha Primera Venta</th>
                            <th>Fecha Última Venta</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reporteVentas as $venta)
                            <tr>
                                <td>{{ $venta->Producto }}</td>
                                <td>{{ $venta->Talla }}</td>
                                <td>{{ number_format($venta->CostoVenta, 2) }}</td>
                                <td>{{ number_format($venta->CostoProduccion, 2) }}</td>
                                <td>{{ $venta->TotalVendidos }}</td>
                                <td>{{ number_format($venta->TotalVentas, 2) }}</td>
                                <td>{{ number_format($venta->GananciaNeta, 2) }}</td>
                                <td>{{ number_format($venta->PromedioVentasPorOrden, 2) }}</td>
                                <td>{{ $venta->FechaPrimeraVenta ? \Carbon\Carbon::parse($venta->FechaPrimeraVenta)->format('d/m/Y') : 'Sin datos' }}</td>
                                <td>{{ $venta->FechaUltimaVenta ? \Carbon\Carbon::parse($venta->FechaUltimaVenta)->format('d/m/Y') : 'Sin datos' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="dashboard-section">
        <div class="section-header">
            <h2 class="section-title">Alertas</h2>
        </div>
        <div class="section-content">
            @if ($productosBajoStock->count() > 0)
                <div class="alert alert-warning">
                    <strong>¡Alerta!</strong> Algunos productos tienen stock bajo (menos de 5 unidades):
                    <ul>
                        @foreach ($productosBajoStock as $producto)
                            <li>{{ $producto->nombre }} - {{ $producto->cantidad }} unidades</li>
                        @endforeach
                    </ul>
                </div>
            @else
                <p>No hay productos con bajo stock.</p>
            @endif

            @if ($productosAgotados->count() > 0)
                <div class="alert alert-danger">
                    <strong>¡Atención!</strong> Algunos productos están agotados:
                    <ul>
                        @foreach ($productosAgotados as $producto)
                            <li>{{ $producto->nombre }} - Agotado</li>
                        @endforeach
                    </ul>
                </div>
            @else
                <p>No hay productos agotados.</p>
            @endif
        </div>
    </div>

    <div class="section-columns">
        <div class="dashboard-section">
            <div class="section-header">
                <h2 class="section-title">Ventas por Mes</h2>
            </div>
            <div class="section-content">
                <canvas id="ventasChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    const ventasData = @json($ventas);
    const ctx = document.getElementById('ventasChart').getContext('2d');

    // Verifica que los datos sean correctos en consola
    console.log(ventasData);

    if (ventasData.length > 0) {
        const ventasChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ventasData.map(d => d.mes), // Uso correcto del campo 'mes'
                datasets: [{
                    label: 'Ventas por Mes',
                    data: ventasData.map(d => d.total_ventas), // Cambio de 'total' a 'total_ventas'
                    borderColor: 'rgba(255, 165, 0, 1)',
                    backgroundColor: 'rgba(255, 165, 0, 0.2)',
                    borderWidth: 2,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true, // Asegúrate de que las escalas empiecen desde cero
                    },
                },
            },
        });
    } else {
        document.getElementById('ventasChart').innerHTML = 'No hay datos para mostrar';
    }
</script>


@endsection
