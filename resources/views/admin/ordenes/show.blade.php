@extends('admin.layouts.dashboard')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Detalles de la Orden #{{ $orden->id }}</h1>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title">Información de la Orden</h5>
            <p><strong>Cliente (ID):</strong> {{ $orden->tipo_personas_id }}</p>
            <p><strong>Fecha:</strong> {{ $orden->fecha }}</p>
            <p><strong>Total:</strong> ${{ number_format($orden->total, 2) }}</p>
            <p><strong>Envío a domicilio:</strong> {{ $orden->envios_domicilio ? 'Sí' : 'No' }}</p>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Detalles de los Productos</h5>
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID Edición</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orden->detalles as $detalle)
                        <tr>
                            <td>{{ $detalle->edicion_id }}</td>
                            <td>{{ $detalle->cantidad }}</td>
                            <td>${{ number_format($detalle->precio, 2) }}</td>
                            <td>${{ number_format($detalle->cantidad * $detalle->precio, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('admins.ordenes.index') }}" class="btn btn-primary">Volver</a>
    </div>
</div>
@endsection
