@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold text-uppercase" style="font-size: 2.5rem; letter-spacing: 2px;">Catálogo de Productos</h1>
        <p class="text-muted">Explora nuestra amplia gama de playeras para todos los gustos.</p>
    </div>

    <!-- Filtro -->
    <div class="filter-button-container mb-4 text-end">
        <button class="btn btn-dark px-4 py-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#filtroOffcanvas" aria-controls="filtroOffcanvas">
            Filtrar
        </button>
    </div>

    <!-- Productos -->
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        @foreach ($productos as $producto)
            <div class="col">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="image-container">
                        <img src="{{ $producto->imagen_producto_final }}" alt="Imagen de {{ $producto->nombre }}" class="card-img-top image-main">
                        <img src="{{ $producto->imagen_producto_trasera }}" alt="Imagen trasera de {{ $producto->nombre }}" class="card-img-top image-hover">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center fw-bold">{{ $producto->nombre }}</h5>
                        <p class="card-text text-center text-muted mb-1">Precio: ${{ number_format($producto->costo_precio_venta, 2) }}</p>
                        @if (!Auth::check() || (Auth::check() && !Auth::user()->hasRole('admin')))
                            <a href="{{ route('vista_producto_detalle', ['id' => $producto->id]) }}" class="btn btn-dark w-100 mt-3">Ver detalles</a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Offcanvas para Filtros -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="filtroOffcanvas" aria-labelledby="filtroOffcanvasLabel">
        <div class="offcanvas-header bg-dark text-white">
            <h5 class="offcanvas-title" id="filtroOffcanvasLabel">Selecciona el filtro</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form method="GET" action="{{ route('filtros.productos') }}">
                <div class="mb-4">
                    <h6 class="fw-bold">Filtrar por Precio</h6>
                    <label for="costo_min" class="form-label">Costo Mínimo</label>
                    <input type="number" name="costo_min" id="costo_min" class="form-control" value="{{ request('costo_min') }}">
                </div>
                <div class="mb-4">
                    <label for="costo_max" class="form-label">Costo Máximo</label>
                    <input type="number" name="costo_max" id="costo_max" class="form-control" value="{{ request('costo_max') }}">
                </div>
                <div class="mb-4">
                    <h6 class="fw-bold">Filtrar por Nombre</h6>
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" value="{{ request('nombre') }}">
                </div>
                <button type="submit" class="btn btn-dark w-100">Aplicar Filtros</button>
            </form>
            <form method="GET" action="{{ route('mostrar.productos') }}">
                <button type="submit" class="btn btn-light w-100 mt-3">Limpiar Filtros</button>
            </form>
        </div>
    </div>
</div>

<style>
    /* Imagenes estilo hover */
    .image-container {
        position: relative;
        height: 300px;
        overflow: hidden;
    }
    .image-main {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: opacity 0.3s ease-in-out;
        z-index: 1;
    }
    .image-hover {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0;
        transition: opacity 0.5s ease-in-out;
        z-index: 0;
    }
    .image-container:hover .image-main {
        opacity: 0;
    }
    .image-container:hover .image-hover {
        opacity: 1;
    }

    /* Tarjetas */
    .card {
        border-radius: 8px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
</style>
@endsection
