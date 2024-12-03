@extends('layouts.app')

<style>
    img {
        height: 200px;
        width: 100%;
        object-fit: cover;
        border-radius: 8px;
    }

    .catalogo-header {
        background-color: #f4f4f4;
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

    .image-container {
        position: relative;
        height: 260px;
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
        transition: opacity 0.5s ease-in-out;
        opacity: 0;
        z-index: 0;
    }

    .image-container:hover .image-main {
        opacity: 0;
    }

    .image-container:hover .image-hover {
        opacity: 1;
    }

    .filter-button-container {
        display: flex;
        justify-content: flex-end;
    }

    .btn-filter {
        display: flex;
        align-items: center;
        background-color: #000;
        color: #fff;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 1px;
        cursor: pointer;
        transition: all 0.3s ease;
        border-radius: 0;
    }

    .btn-filter:hover {
        background-color: #333;
    }

    .btn-clear {
        background-color: transparent;
        color: #000;
        border: 1px solid #000;
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 1px;
        width: 100%;
        transition: all 0.3s ease;
    }

    .btn-clear:hover {
        background-color: #000;
        color: #fff;
    }

    .offcanvas-header {
        background-color: #000;
        color: #fff;
    }

    .offcanvas-body {
        padding: 1.5rem;
    }
</style>

@section('content')
<div class="container py-4">

    <!-- Encabezado del catálogo -->
    <div class="catalogo-header">
        <h1>Catálogo de Productos</h1>
        <p>Explora nuestra amplia gama de playeras para todos los gustos.</p>
    </div>

    <div class="filter-button-container mb-4">
        <button class="btn-filter" type="button" data-bs-toggle="offcanvas" data-bs-target="#filtroOffcanvas" aria-controls="filtroOffcanvas">
            <span class="filter-text">Filtrar</span>
        </button>
    </div>

    <!-- Productos -->
    <div class="row">
        @foreach ($productos as $producto)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    @if ($producto->cantidad > 0)
                        <div class="image-container">
                            <img src="{{ $producto->imagen_producto_final }}" alt="Imagen de {{ $producto->nombre }}" class="image-main">
                            <img src="{{ $producto->imagen_producto_trasera }}" alt="Imagen trasera de {{ $producto->nombre }}" class="image-hover">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $producto->nombre }}</h5>
                            <p class="card-text">Precio: ${{ number_format($producto->costo_precio_venta, 2) }}</p>
                            @if(!Auth::check() || (Auth::check() && !Auth::user()->hasRole('admin')))
                            <a href="{{ route('vista_producto_detalle', ['id' => $producto->id]) }}" class="btn btn-primary w-100">Ver detalles</a>
                            @endif
                        </div>
                    @else
                        <div class="image-container">
                            <img src="{{ $producto->imagen_producto_final }}" alt="Imagen de {{ $producto->nombre }}" class="image-main">
                            <div class="overlay">
                                <p class="text-danger">Agotado</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $producto->nombre }}</h5>
                            <p class="text-danger">Agotado</p>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <!-- Filtros -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="filtroOffcanvas" aria-labelledby="filtroOffcanvasLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="filtroOffcanvasLabel">Selecciona el filtro</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form method="GET" action="{{ route('filtros.productos') }}">
                <div class="filter-section">
                    <h6 class="filter-title">Filtrar por Precio</h6>
                    <div class="mb-3">
                        <label for="costo_min" class="form-label">Costo Mínimo</label>
                        <input type="number" name="costo_min" id="costo_min" class="form-control" value="{{ request('costo_min') }}">
                    </div>
                    <div class="mb-3">
                        <label for="costo_max" class="form-label">Costo Máximo</label>
                        <input type="number" name="costo_max" id="costo_max" class="form-control" value="{{ request('costo_max') }}">
                    </div>
                </div>

                <div class="filter-section">
                    <h6 class="filter-title">Filtrar por Nombre</h6>

                    <div class="mb-3">
                        <label for="nombre" class="form-label">nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ request('nombre') }}">
                    </div>
                </div>
                <button type="submit" class="btn btn-dark">Aplicar Filtros</button>
            </form>
            <form method="GET" action="{{ route('mostrar.productos') }}">
                <button type="submit" class="btn btn-filter">Limpiar Filtros</button>
            </form>
        </div>
    </div>
</div>
@endsection
