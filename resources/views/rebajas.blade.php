@extends('layouts.app')

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
    </div>
@endif

<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold text-uppercase" style="font-size: 2.5rem; letter-spacing: 2px;">Rebajas</h1>
        <p class="text-muted">Explora nuestras increíbles rebajas.</p>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        @foreach ($productos as $producto)
            <div class="col">
                <div class="card h-100 border-0 shadow-sm">
                    <!-- Contenedor de imagen con comportamiento igual al de personalización -->
                    <div class="image-container position-relative">
                        @if($producto->imagen_producto_final)
                            <img src="{{ asset($producto->imagen_producto_final) }}" alt="Imagen de {{ $producto->nombre }}" class="card-img-top img-fluid" style="height: 300px; object-fit: cover;">
                        @else
                            <div class="d-flex justify-content-center align-items-center bg-light" style="height: 300px;">
                                <p class="text-muted">Imagen no disponible</p>
                            </div>
                        @endif

                       
                        @if ($producto->cantidad <= 0)
                            <div class="overlay">
                                <p class="text-danger">Agotado</p>
                            </div>
                        @endif
                    </div>

                    @if($producto->rebaja)
                        <div class="position-absolute top-0 end-0 bg-danger text-white px-2 py-1" style="border-radius: 0 0 0 5px; z-index: 3;">
                            -{{ $producto->porcentaje_rebaja }}%
                        </div>
                    @endif
                    
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold">{{ $producto->nombre }}</h5>
                        
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
                        
                        @if ($producto->cantidad > 0)
                            <a href="{{ route('vista_producto_detalle', ['id' => $producto->id]) }}" class="btn btn-dark w-100 mt-3">Ver Detalle</a>
                        @else
                            <button class="btn btn-secondary w-100" disabled>No disponible</button>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection

@section('styles')
    <style>
        .image-container {
            position: relative;
            width: 100%;
            height: 300px; /* Ajusta el tamaño de la imagen según tu necesidad */
            overflow: hidden;
        }

        .image-main,
        .image-hover {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: opacity 0.3s ease;
        }

        .image-hover {
            opacity: 0; /* Ocultamos la imagen trasera por defecto */
        }

        .image-container:hover .image-hover {
            opacity: 1; /* Mostramos la imagen trasera cuando se hace hover */
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
@endsection
