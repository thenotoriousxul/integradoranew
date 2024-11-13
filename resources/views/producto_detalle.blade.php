@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Imagen del Producto -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                @if(!empty($producto->imagen_producto))
                    <img src="{{ $producto->imagen_producto }}" alt="Imagen del producto" class="card-img-top">
                @else
                    <p>Imagen no disponible</p>
                @endif
            </div>
        </div>

        <!-- Detalles del Producto -->
        <div class="col-md-6">
            <h1 class="mb-3">{{ $producto->tipo }}</h1>
            <p class="text-muted">Código: {{ $producto->id }}</p>
            <p class="lead">${{ number_format($producto->costo, 2) }}</p>
            <p>Descripción: {{ $producto->descripcion }}</p>
            
            <!-- Dentro del formulario de producto -->
<form action="{{ route('carrito.agregar', $producto->id) }}" method="POST">
    @csrf
    <div class="mb-3">
        <label class="form-label">Cantidad</label>
        <input type="number" class="form-control" id="cantidad" name="cantidad" value="1" min="1">
    </div>
    <button type="submit" class="btn btn-primary">Agregar al carrito</button>
</form>

        </div>
    </div>
</div>
@endsection
