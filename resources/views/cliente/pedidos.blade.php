@extends('cliente.layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-11 mx-auto">
            <section class="mb-5">
                <h2 class="h5 mb-4">Mis Órdenes</h2>
                @if ($ordenes->isEmpty())
                    <p>No tienes pedidos registrados.</p>
                @else
                    @foreach ($ordenes as $orden)
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-3">
                                    <span class="fw-bold">Orden:  {{$orden->fecha_orden}}-{{ $orden->id }}</span>
                                    <span class="text-muted">{{ $orden->fecha_orden }}</span>
                                </div>
                                @foreach ($orden->detalles as $detalle)
                                    <div class="row mb-3">
                                        <div class="col-md-2">
                                            <img src="{{ $detalle->edicionProducto->imagen_producto_final }}" 
                                                 alt="{{ $detalle->edicionProducto->nombre }}" 
                                                 class="img-fluid rounded">
                                        </div>
                                        <div class="col-md-10">
                                            <h3 class="h6 mb-2">{{ $detalle->edicionProducto->nombre }}</h3>
                                            <p class="mb-1">Talla: {{ $detalle->edicionProducto->talla }}</p>
                                            <p class="mb-1">Cantidad: {{ $detalle->cantidad }}</p>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="text-end">
                                    <p class="fw-bold mb-0">Total: ${{ number_format($orden->total, 2) }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="mt-4 d-flex justify-content-center">
                        {{ $ordenes->links('pagination::bootstrap-4')->withClass('pagination-sm') }}
                    </div>
                    
                @endif
            </section>
        </div>
    </div>
</div>

<style>
    .container {
        max-width: 900px;
    }
    .card {
        background-color: #f6f6f6;
        border: 1px solid #e2e2e2;
        border-radius: 4px;
    }
    .card-body {
        padding: 1.5rem;
    }
    img {
        object-fit: cover;
        width: 80px;
        height: 80px;
    }
</style>
@endsection
