@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">Seleccione un producto a personalizar</h1>
    <div class="row">
    @foreach($productos as $producto)
<div class="col-md-4">
    <div class="card">
        <img src="{{ $producto->imagen_producto }}" class="card-img-top" alt="Imagen de {{ $producto->tipo }}">
        <div class="card-body">
            <h5 class="card-title">{{ $producto->tipo }}</h5>
            <p class="card-text">Color: {{ $producto->color }}</p>
            <a href="{{ route('personalizar.producto', $producto->id) }}" class="btn btn-primary">Personalizar</a>
        </div>
    </div>
</div>
    @endforeach
    </div>
</div>
@endsection
