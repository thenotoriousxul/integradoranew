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
        border: 1px solid #e3e5e8;
        border-radius: 8px;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.15);
    }

    .btn-details {
        background-color: #5865F2;
        color: #ffffff;
        border: none;
        padding: 10px 20px;
        font-size: 14px;
        font-weight: 600;
        border-radius: 5px;
        text-transform: uppercase;
        transition: all 0.3s ease;
    }

    .btn-details:hover {
        background-color: #4752c4;
        color: #ffffff;
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.15);
    }

    .whatsapp-info {
        margin-top: 30px;
        font-size: 16px;
        color: #333;
        text-align: center;
    }

    .whatsapp-info a {
        color: #25D366;
        text-decoration: none;
        font-weight: bold;
    }

    .whatsapp-info a:hover {
        color: #128C7E;
    }

    .whatsapp-icon {
        font-size: 24px;
        margin-left: 8px;
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
                        <div class="d-flex justify-content-center align-items-center" style="height: 300px; background-color: #f6f6f6;">
                            <p>Imagen no disponible</p>
                        </div>
                    @endif
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $producto->nombre }}</h5>
                        <p class="card-text">Cantidad: {{ $producto->cantidad }}</p>
                        <p class="card-text">Estado: {{ ucfirst($producto->estado) }}</p>
                        <a href="{{ route('personalizacion.detalle', $producto->id) }}" class="btn btn-details">Ver Detalle</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-center">No hay ediciones personalizadas disponibles en este momento.</p>
            </div>
        @endforelse
    </div>

    <!-- Mensaje informativo después de todos los productos -->
    <div class="whatsapp-info">
        <p>¿Te gustaría un diseño personalizado? Si tienes alguna idea en mente, no dudes en <a href="https://wa.me/528718974991?text=Hola,%20quiero%20saber%20más%20sobre%20el%20diseño%20personalizado" target="_blank">contactarnos por WhatsApp</a>. ¡Estaremos encantados de ayudarte!</p>
        <a href="https://wa.me/528718974991?text=Hola,%20quiero%20saber%20más%20sobre%20el%20diseño%20personalizado" 
           class="whatsapp-icon" 
           target="_blank">
            <i class="bi bi-whatsapp"></i>
        </a>
    </div>
</div>
@endsection
