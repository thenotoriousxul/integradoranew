@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Imagen del Producto -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <img src="https://png.pngtree.com/png-vector/20220120/ourmid/pngtree-black-t-shirt-template-png-image_4293336.png" class="card-img-top" alt="Playera Detalle">
            </div>
        </div>

        <!-- Detalles del Producto -->
        <div class="col-md-6">
            <h1 class="mb-3">Playera</h1>
            <p class="text-muted">Código: PRD001</p>
            <p class="lead">$20.00</p>
            <p>Descripción: Esta es una playera de alta calidad, perfecta para el uso diario. Hecha de algodón suave y disponible en varios colores.</p>
            

            <div class="mb-3">
                <label class="form-label">Cantidad</label>
                <input type="number" class="form-control" value="1" min="1">
            </div>

            <div class="d-grid gap-2 mt-4">
                <button class="btn btn-primary btn-lg">Agregar al Carrito</button>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <h3>Productos Relacionados</h3>
        <div class="row">
            @for ($j = 1; $j <= 4; $j++)
                <div class="col-md-3 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="https://png.pngtree.com/png-vector/20220120/ourmid/pngtree-black-t-shirt-template-png-image_4293336.png" class="card-img-top" alt="Playera Relacionada {{ $j }}">
                        <div class="card-body">
                            <h5 class="card-title">Playera Modelo {{ $j }}</h5>
                            <p class="card-text">$ {{ number_format(15 + ($j * 10), 2) }}</p>
                            <a href="{{ route('producto.detalle', $j) }}" class="btn btn-primary w-100">Ver detalles</a>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
</div>
@endsection
