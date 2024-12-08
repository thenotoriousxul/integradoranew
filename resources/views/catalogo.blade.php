@extends('layouts.app')

<style>
    /* General Styles */
    body {
        font-family: 'Bebas Neue', sans-serif;
    }

    img {
        border-radius: 8px;
    }

    .catalogo-header {
        background-color: #f4f4f4;
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 8px;
        text-align: center;
    }

    .catalogo-header h1 {
        font-size: 2.5rem;
        color: #333;
        margin: 0;
        font-weight: 600;
        letter-spacing: 2px;
    }

    .catalogo-header p {
        font-size: 1.2rem;
        color: #777;
    }

    /* Card Styles */
    .card {
        border: none;
        border-radius: 10px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    .image-container {
        position: relative;
        height: 260px;
        overflow: hidden;
    }

    .image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: opacity 0.5s ease-in-out;
    }

    .image-container .image-hover {
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
        z-index: 0;
    }

    .image-container:hover .image-main {
        opacity: 0;
    }

    .image-container:hover .image-hover {
        opacity: 1;
        z-index: 1;
    }

    .card-body {
        padding: 15px;
        text-align: center;
    }

    .card-title {
        font-size: 1.5rem;
        color: #333;
        margin-bottom: 10px;
        letter-spacing: 1px;
    }

    .card-text {
        color: #666;
        font-size: 1rem;
    }

    /* Button Styles */
    .btn-primary {
        background-color: #000;
        color: #fff;
        border: none;
        font-size: 1rem;
        padding: 10px;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btn-primary:hover {
        background-color: #333;
        transform: translateY(-2px);
    }

    /* Filter Button */
    .filter-button-container {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 20px;
    }

    .btn-filter {
        background-color: #000;
        color: #fff;
        border: none;
        font-size: 16px;
        font-weight: bold;
        text-transform: uppercase;
        padding: 10px 20px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-filter:hover {
        background-color: #333;
    }

    /* Offcanvas Styles */
    .offcanvas-header {
        background-color: #000;
        color: #fff;
    }

    .offcanvas-body {
        padding: 20px;
    }

    .btn-clear {
        background-color: transparent;
        color: #000;
        border: 1px solid #000;
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
        font-weight: bold;
        text-transform: uppercase;
        width: 100%;
        transition: all 0.3s ease;
    }

    .btn-clear:hover {
        background-color: #000;
        color: #fff;
    }
</style>

@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="catalogo-header">
        <h1>Catálogo de Productos</h1>
        <p>Explora nuestra amplia gama de playeras para todos los gustos.</p>
    </div>

    <!-- Filter Button -->
    <div class="filter-button-container">
        <button class="btn-filter" type="button" data-bs-toggle="offcanvas" data-bs-target="#filtroOffcanvas" aria-controls="filtroOffcanvas">
            Filtrar
        </button>
    </div>

    <!-- Product Cards -->
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        @foreach ($productos as $producto)
            <div class="col">
                <div class="card">
                    <div class="image-container">
                        <img src="{{ $producto->imagen_producto_final }}" alt="{{ $producto->nombre }}" class="image-main">
                        <img src="{{ $producto->imagen_producto_trasera }}" alt="Imagen trasera de {{ $producto->nombre }}" class="image-hover">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $producto->nombre }}</h5>
                        <p class="card-text">Precio: ${{ number_format($producto->costo_precio_venta, 2) }}</p>
                        @if (!Auth::check() || (Auth::check() && !Auth::user()->hasRole('admin')))
                            <a href="{{ route('vista_producto_detalle', ['id' => $producto->id]) }}" class="btn btn-primary w-100">Ver detalles</a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Filter Offcanvas -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="filtroOffcanvas" aria-labelledby="filtroOffcanvasLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="filtroOffcanvasLabel">Selecciona el filtro</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form method="GET" action="{{ route('filtros.productos') }}">
                <div class="mb-3">
                    <label for="costo_min" class="form-label">Costo Mínimo</label>
                    <input type="number" name="costo_min" id="costo_min" class="form-control" value="{{ request('costo_min') }}">
                </div>
                <div class="mb-3">
                    <label for="costo_max" class="form-label">Costo Máximo</label>
                    <input type="number" name="costo_max" id="costo_max" class="form-control" value="{{ request('costo_max') }}">
                </div>
                <button type="submit" class="btn btn-dark w-100">Aplicar Filtros</button>
            </form>
            <form method="GET" action="{{ route('mostrar.productos') }}">
                <button type="submit" class="btn btn-clear">Limpiar Filtros</button>
            </form>
        </div>
    </div>
</div>
@endsection
