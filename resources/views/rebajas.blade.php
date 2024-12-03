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
    <div class="catalogo-header">
        <h1>Rebajas</h1>
        <p>EXplora nuestras rebajas</p>
    </div>

    <div class="filter-button-container mb-4">
        <button class="btn-filter" type="button" data-bs-toggle="offcanvas" data-bs-target="#filtroOffcanvas" aria-controls="filtroOffcanvas">
            <span class="filter-text">Filtrar</span>
        </button>
    </div>

    <div class="row">
        @foreach ($productos as $producto)
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm position-relative">
                    <div class="image-container">
                        <!-- Imagen principal -->
                        <img src="{{ $producto->imagen_producto_final ? asset($producto->imagen_producto_final) : 'https://png.pngtree.com/png-vector/20220120/ourmid/pngtree-black-t-shirt-template-png-image_4293336.png' }}" 
                             class="card-img-top image-main" 
                             alt="Imagen de {{ $producto->nombre }}">
                        <!-- Imagen trasera -->
                        <img src="{{ $producto->imagen_producto_trasera ? asset($producto->imagen_producto_trasera) : 'https://png.pngtree.com/png-vector/20220120/ourmid/pngtree-black-t-shirt-template-png-image_4293336.png' }}" 
                             class="card-img-top image-hover" 
                             alt="Imagen trasera de {{ $producto->nombre }}">
                        
                        <!-- Overlay para productos agotados -->
                        @if ($producto->cantidad <= 0)
                            <div class="overlay">
                                <p class="text-danger">Agotado</p>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Etiqueta de rebaja -->
                    @if($producto->rebaja)
                        <div class="position-absolute top-0 end-0 bg-danger text-white px-2 py-1" style="border-radius: 0 0 0 5px; z-index: 3;">
                            -{{ $producto->porcentaje_rebaja }}%
                        </div>
                    @endif
                    
                    <div class="card-body">
                        <h5 class="card-title">{{ $producto->nombre }}</h5>
                        
                        <!-- Mostrar precios con o sin rebaja -->
                        <p class="text-muted mb-0">
                            @if($producto->rebaja)
                                <del>${{ number_format($producto->costo_precio_venta, 2) }}</del>
                            @endif
                        </p>
                        <p class="{{ $producto->rebaja ? 'text-danger fw-bold' : 'fw-bold' }}">
                            ${{ number_format($producto->rebaja ? $producto->precio_rebajado : $producto->costo_precio_venta, 2) }}
                            @if($producto->rebaja)
                                <small class="text-success">({{ $producto->porcentaje_rebaja }}% Off)</small>
                            @endif
                        </p>
                        
                        <!-- Botón para productos disponibles -->
                        @if ($producto->cantidad > 0)
                            <a href="{{ route('vista_producto_detalle', ['id' => $producto->id]) }}" 
                               class="btn btn-primary w-100">Ver detalles</a>
                        @else
                            <button class="btn btn-secondary w-100" disabled>No disponible</button>
                        @endif
                    </div>
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
        <form method="GET" action="{{route('filtros.rebajas')}}">
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
        <form method="GET" action="#">
            <button type="submit" class="btn btn-filter">Limpiar Filtros</button>
        </form>
    </div>
</div>
@endsection
