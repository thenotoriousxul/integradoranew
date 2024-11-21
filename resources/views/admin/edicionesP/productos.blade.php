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

    <div class="d-flex justify-content-end dropdown mb-3">
        <button class="btn btn-primary btn-animated mb-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#filtroOffcanvas" aria-controls="filtroOffcanvas">
            <i class="bi bi-funnel-fill"></i> Filtrar
        </button>
    </div>

    <!-- Productos base -->
    <div class="row">
        @foreach ($productos as $producto)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    @if($producto->imagen_producto_final)
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
                <!-- Filtro por Precio -->
                <h6>Filtrar por Precio</h6>
                <div class="mb-3">
                    <label for="costo_min" class="form-label">Costo Mínimo</label>
                    <input type="number" name="costo_min" id="costo_min" class="form-control mb-2" value="{{ request('costo_min') }}">
                </div>
                <div class="mb-3">
                    <label for="costo_max" class="form-label">Costo Máximo</label>
                    <input type="number" name="costo_max" id="costo_max" class="form-control mb-2" value="{{ request('costo_max') }}">
                </div>

                <h6>filtrar por tipo</h6>
                <div class="mb-3">
                    <label for="tipo" class="form-label">Nombre producto</label>
                    <input type="text" name="tipo" id="tipo" class="form-control mb-2" value="{{ request('tipo') }}">
                </div>
    
                <!-- Filtro por Tipo -->
                <h6>Filtrar por Talla</h6>
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
    
                <button type="submit" class="btn btn-primary">Aplicar Filtros</button>
            </form>
    
            <br>
            <form method="GET" action="{{ route('mostrar.productos') }}">
                <button type="submit" class="btn btn-dark">Limpiar Filtros</button>
            </form>
        </div>
    </div>
</div>
@endsection
