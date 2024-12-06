@extends('admin.layouts.dashboard')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">Seleccione un producto a personalizar</h1>

    @if($productos->isEmpty())
        <p class="text-center text-muted">No hay productos disponibles para personalizar.</p>
    @else
        <div class="row">
            @foreach($productos as $producto)
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ asset($producto->imagen_producto) }}" class="card-img-top" alt="Imagen de {{ $producto->tipo }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $producto->tipo }}</h5>
                            <p class="card-text">Color: {{ $producto->color }}</p>
                            <a href="{{ route('admin.guardar', $producto->id) }}" class="btn btn-primary">Personalizar</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
