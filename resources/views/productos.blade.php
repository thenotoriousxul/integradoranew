@extends('layouts.app')

<style>
    img {
        height: 200px;
        width: 100%;
        object-fit: cover; /* Para asegurarnos de que la imagen cubra el área correctamente */
        border-radius: 8px; /* Bordes redondeados para las imágenes */
    }

    .catalogo-header {
        background-color: #f4f4f4; /* Fondo claro */
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 8px;
        text-align: center;
        font-family: 'Bebas Neue', sans-serif;
    }

    .catalogo-header h1 {
        font-size: 2.5rem;
        color: #333;
        margin: 0;
        font-weight: 600;
    }

    .catalogo-header p {
        font-size: 1.2rem;
        color: #777;
    }

    .card {
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    .card-body {
        padding: 20px;
        text-align: center;
    }

    .card-title {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 1.5rem;
        color: #333;
        margin-bottom: 15px;
    }

    .card-text {
        color: #666;
        font-size: 1rem;
    }

    /* Diseño responsivo para pantallas más pequeñas */
    @media (max-width: 768px) {
        .catalogo-header h1 {
            font-size: 2rem;
        }

        .catalogo-header p {
            font-size: 1rem;
        }

        .card-body {
            padding: 15px;
        }
    }
</style>

@section('content')
<div class="container py-4">

    <!-- Encabezado del catálogo -->
    <div class="catalogo-header">
        <h1>Catálogo de Productos</h1>
        <p>Explora nuestra amplia gama de playeras para todos los gustos.</p>
    </div>

    <!-- Productos base -->
    <div class="row">
        @foreach ($productos as $producto)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    @if($producto->imagen_producto)
                        <a href="{{ route('vista_producto_detalle', ['id' => $producto->id]) }}">
                            <img src="{{ $producto->imagen_producto }}" alt="Imagen de {{ $producto->tipo }}" class="card-img-top">
                        </a>
                    @else
                    <a href="{{ route('vista_producto_detalle', ['id' => $producto->id]) }}">
                        <p>Imagen no disponible</p>
                    </a>

                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $producto->tipo }}</h5>
                        <p class="card-text">Precio: ${{ number_format($producto->costo, 2) }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
