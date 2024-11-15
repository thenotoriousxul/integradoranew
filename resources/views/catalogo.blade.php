@extends('layouts.app')
<style>
    img{
        height: 300px;
        width: 200px;
    }
</style>
@section('content')
<div class="container py-4">
    <div class="text-center mb-5">
        <p class="lead">Explora nuestra amplia gama de playeras para todos los gustos.</p>
    </div>

    <h1>productos base </h1>
    <div class="row">
        @foreach ($productos as $producto)
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm">
                    @if($producto->imagen_producto)
                        <img src="{{$producto->imagen_producto}}" alt="" class="card-img-top">
                    @else
                        <p>imagen no disponible</p>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{$producto->tipo}}</h5>
                        <p class="card-text">Precio: ${{ number_format($producto->costo, 2) }}</p>
                        <p class="card-text">Lote: {{$producto->lote}}</p>
                        <p class="card-text">Tamaño: {{$producto->tamaño}}</p>
                        <a href="{{ route('vista_producto_detalle', ['id' => $producto->id]) }}" class="btn btn-primary w-100">Ver detalles</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    </div> 
</div>
@endsection
