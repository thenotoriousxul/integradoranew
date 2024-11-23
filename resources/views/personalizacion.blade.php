@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">Seleccione un producto a personalizar</h1>
    <div class="row">
        @foreach($productos as $producto)
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <img src="{{ $producto->imagen_producto }}" alt="Imagen de {{ $producto->tipo }}" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">{{ $producto->tipo }}</h5>
                        <p class="card-text">Talla: {{ $producto->talla }}</p>
                        <p class="card-text">Color: {{ $producto->color }}</p>
                        <p class="card-text">Costo: ${{ number_format($producto->costo, 2) }}</p>
                        <a href="#" class="btn btn-primary">Personalizar</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
