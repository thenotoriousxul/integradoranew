@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold text-uppercase" style="font-size: 2.5rem; letter-spacing: 2px;">Ediciones Personalizadas</h1>
        <p class="text-muted">Explora nuestras ediciones personalizadas.</p>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        @forelse ($productos as $producto)
            <div class="col">
                <div class="card h-100 border-0 shadow-sm">
                    @if($producto->imagen_producto_final)
                        <img src="{{ $producto->imagen_producto_final }}" alt="Imagen de {{ $producto->nombre }}" class="card-img-top img-fluid" style="height: 300px; object-fit: cover;">
                    @else
                        <div class="d-flex justify-content-center align-items-center bg-light" style="height: 300px;">
                            <p class="text-muted">Imagen no disponible</p>
                        </div>
                    @endif
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold">{{ $producto->nombre }}</h5>
                        <p class="card-text text-muted">Cantidad: {{ $producto->cantidad }}</p>
                        <a href="{{ route('personalizacion.detalle', $producto->id) }}" class="btn btn-dark w-100 mt-3">Ver Detalle</a>
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
    <div class="whatsapp-info text-center mt-5">
        <p class="text-muted">¿Te gustaría un diseño personalizado? Si tienes alguna idea en mente, no dudes en <a href="https://wa.me/528718974991?text=Hola,%20quiero%20saber%20más%20sobre%20el%20diseño%20personalizado" class="text-success fw-bold" target="_blank">contactarnos por WhatsApp</a>. ¡Estaremos encantados de ayudarte!</p>
        <a href="https://wa.me/528718974991?text=Hola,%20quiero%20saber%20más%20sobre%20el%20diseño%20personalizado" target="_blank" class="d-inline-block mt-2">
            <i class="bi bi-whatsapp" style="font-size: 1.5rem; color: #25D366;"></i>
        </a>
    </div>
</div>
@endsection
