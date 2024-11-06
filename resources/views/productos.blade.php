@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="text-center mb-5">
        <h1>Nuestro Catálogo de Playeras</h1>
        <p class="lead">Explora nuestra amplia gama de playeras para todos los gustos.</p>
    </div>

    <div class="row">
        @for ($i = 1; $i <= 8; $i++)
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="https://png.pngtree.com/png-vector/20220120/ourmid/pngtree-black-t-shirt-template-png-image_4293336.png" class="card-img-top" alt="Playera {{ $i }}">
                    <div class="card-body">
                        <h5 class="card-title">Playera Modelo {{ $i }}</h5>
                        <p class="card-text">Precio: ${{ number_format(20 + ($i * 5), 2) }}</p>
                        <a href="{{ route('producto.detalle', $i) }}" class="btn btn-primary w-100">Ver detalles</a>
                    </div>
                </div>
            </div>
        @endfor
    </div>
</div>
@endsection
