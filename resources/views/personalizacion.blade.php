@extends('layouts.app')

@section('content')
<style>
    img {
        height: 300px;
        width: 200px;
        object-fit: cover;
    }

    .card {
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.15);
    }
</style>

<div class="container py-4">
    <div class="text-center mb-5">
        <p class="lead">Explora nuestras ediciones personalizadas.</p>
    </div>

    <h1 class="mb-4 text-center">Ediciones Personalizadas</h1>
    <div class="row">
        @forelse ($productos as $producto)
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm">
                    @if($producto->imagen_producto_final)
                        <img src="{{ $producto->imagen_producto_final }}" alt="Imagen de {{ $producto->nombre }}" class="card-img-top">
                    @else
                        <p>Imagen no disponible</p>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $producto->nombre }}</h5>
                        <p class="card-text">Cantidad: {{ $producto->cantidad }}</p>
                        <p class="card-text">Estado: {{ ucfirst($producto->estado) }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-center">No hay ediciones personalizadas disponibles en este momento.</p>
            </div>
        @endforelse
    </div>

</div>
@endsection
