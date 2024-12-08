@extends('admin.layouts.dashboard')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Detalles de la Orden #{{ $orden->id }}</h1>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title">Información de la Orden</h5>
            <p><strong>Cliente:</strong> {{ $orden->tipoPersona->persona->nombre }}</p>
            <p><strong>Fecha:</strong> {{ $orden->fecha_orden }}</p>
            <p><strong>Total:</strong> ${{ number_format($orden->total, 2) }}</p>
            <p><strong>Envío a domicilio:</strong> {{ $orden->envios_domicilio ? 'Sí' : 'No' }}</p>
            @if($orden->estado !== 'Pagada' && $orden->estado !=='Devuelta')
            <form action="{{ route('admin.orden.entregada', ['id' => $orden->id]) }}" method="POST" class="d-inline">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-success btn-sm">Marcar como Entregada</button>
            </form>
            @elseif($orden->estado === 'Pendiente')
            <form action="{{ route('admin.orden.cancelada', ['id' => $orden->id]) }}" method="POST" class="d-inline">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-danger btn-sm">Cancelar Orden</button>
            </form>

            @endif
        </div>
    </div>
    

    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Detalles de los Productos</h5>
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orden->detalles as $detalle)
                        <tr>
                            <td>{{ $detalle->EdicionProducto->nombre }}</td>
                            <td>{{ $detalle->cantidad }}</td>
                            <td>${{ number_format($detalle->EdicionProducto->costo_precio_venta, 2) }}</td>
                            <td>${{ number_format($detalle->total, 2) }}</td>
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
