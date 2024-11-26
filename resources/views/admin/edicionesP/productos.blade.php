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

        /* Contenedor para la imagen */
        .image-container {
        position: relative;
        display: inline-block;
    }

    /* Capa superpuesta */
    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    /* Líneas de las tachas */
    .line {
        position: absolute;
        width: 150%; /* Más ancho que la imagen */
        height: 4px;
        background-color: red;
        opacity: 0.8;
    }

    /* Primera línea: diagonal de izquierda a derecha */
    .line1 {
        transform: rotate(-45deg);
        transform-origin: center;
    }

    /* Segunda línea: diagonal de derecha a izquierda */
    .line2 {
        transform: rotate(45deg);
        transform-origin: center;
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

    .filter-icon {
        display: inline-block;
        width: 20px;
        height: 20px;
        margin-right: 10px;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolygon points='22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3'%3E%3C/polygon%3E%3C/svg%3E");
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
    }

    .filter-text {
        font-size: 14px;
    }

    @media (max-width: 768px) {
        .btn-filter {
            padding: 8px 15px;
            font-size: 14px;
        }

        .filter-icon {
            width: 16px;
            height: 16px;
            margin-right: 8px;
        }

        .filter-text {
            font-size: 12px;
        }
    }

    .offcanvas {
        background-color: #f8f9fa;
    }

    .offcanvas-header {
        background-color: #000;
        color: #fff;
        padding: 1rem;
    }

    .offcanvas-title {
        font-size: 1.5rem;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .btn-close {
        filter: invert(1);
    }

    .offcanvas-body {
        padding: 1.5rem;
    }

    .filter-section {
        margin-bottom: 1.5rem;
        border-bottom: 1px solid #e0e0e0;
        padding-bottom: 1rem;
    }

    .filter-section:last-child {
        border-bottom: none;
    }

    .filter-title {
        font-size: 1.1rem;
        font-weight: bold;
        margin-bottom: 1rem;
        color: #333;
    }

    .form-label {
        font-weight: 500;
        color: #555;
    }

    .form-control, .form-select {
        border: 1px solid #ddd;
        border-radius: 0;
        padding: 0.5rem;
    }

    .form-control:focus, .form-select:focus {
        box-shadow: none;
        border-color: #000;
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
            <span class="filter-icon"></span>
            <span class="filter-text">Filtrar</span>
        </button>
    </div>

    <!-- Productos base -->

    <div class="row">
        @foreach ($productos as $producto)
            <div class="col-md-3 mb-4">
                <div class="card h-100 position-relative">
                    @if ($producto->cantidad > 1)
                        @if ($producto->imagen_producto_final)
                            <a href="{{ route('vista_producto_detalle', ['id' => $producto->id]) }}">
                                <img src="{{ $producto->imagen_producto_final }}" alt="Imagen de {{ $producto->nombre }}" class="card-img-top">
                            </a>
                        @else
                            <a href="{{ route('vista_producto_detalle', ['id' => $producto->id]) }}">
                                <p>Imagen no disponible</p>
                            </a>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $producto->nombre }}</h5>
                            <p class="card-text">Precio: ${{ number_format($producto->costo_precio_venta, 2) }}</p>
                        </div>
                    @else
                        @if ($producto->imagen_producto_final)
                            <div class="image-container">
                                <img src="{{ $producto->imagen_producto_final }}" alt="Imagen de {{ $producto->nombre }}" class="card-img-top">
                                <div class="overlay">
                                    <div class="line line1"></div>
                                    <div class="line line2"></div>
                                </div>
                            </div>
                        @else
                            <p>Imagen no disponible</p>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $producto->nombre }}</h5>
                            <p class="text-danger">Agotado</p>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>





    <div class="offcanvas offcanvas-start" tabindex="-1" id="filtroOffcanvas" aria-labelledby="filtroOffcanvasLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="filtroOffcanvasLabel">Filtros</h5>
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
                    <h6 class="filter-title">Filtrar por Tipo</h6>
                    <div class="mb-3">
                        <label for="tipo" class="form-label">Nombre producto</label>
                        <input type="text" name="tipo" id="tipo" class="form-control" value="{{ request('tipo') }}">
                    </div>
                </div>
    
                <div class="filter-section">
                    <h6 class="filter-title">Filtrar por Talla</h6>
                    <div class="mb-3">
                        <label for="talla" class="form-label">Talla</label>
                        <select name="talla" id="talla" class="form-select">
                            <option value="">-- Seleccionar la talla --</option>
                            <option value="CH" {{ request('talla') == 'CH' ? 'selected' : '' }}>CH</option>
                            <option value="M" {{ request('talla') == 'M' ? 'selected' : '' }}>M</option>
                            <option value="XL" {{ request('talla') == 'XL' ? 'selected' : '' }}>XL</option>
                            <option value="XXL" {{ request('talla') == 'XXL' ? 'selected' : '' }}>XXL</option>
                        </select>
                    </div>
                </div>
    
                <button type="submit" class="btn btn-filter">Aplicar Filtros</button>
            </form>
    
            <form method="GET" action="{{ route('mostrar.productos') }}">
                <button type="submit" class="btn btn-clear">Limpiar Filtros</button>
            </form>
        </div>
    </div>
</div>
@endsection
