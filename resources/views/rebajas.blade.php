@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="text-center mb-5">
        <h1>Ofertas de Rebajas</h1>
        <p class="lead">Aprovecha los grandes descuentos en nuestros productos seleccionados.</p>
    </div>

    <div class="row">
        @for ($i = 1; $i <= 8; $i++)
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="https://png.pngtree.com/png-vector/20220120/ourmid/pngtree-black-t-shirt-template-png-image_4293336.png" class="card-img-top" alt="Playera en Rebaja {{ $i }}">
                    
                    <div class="card-body">
                        <h5 class="card-title">Playera en Oferta {{ $i }}</h5>
                        
                        <p class="text-muted mb-0">
                            <del>$ {{ number_format(30 + ($i * 5), 2) }}</del>
                        </p>
                        <p class="text-danger fw-bold">
                            ${{ number_format((30 + ($i * 5)) * 0.8, 2) }} <small class="text-success">(20% Off)</small>
                        </p>
                        
                        <a href="{{ route('producto.detalle') }}" class="btn btn-primary w-100">Ver detalles</a>
                    </div>
                    
                    <div class="position-absolute top-0 end-0 bg-danger text-white px-2 py-1" style="border-radius: 0 0 0 5px;">
                        -20%
                    </div>
                </div>
            </div>
        @endfor
    </div>
</div>
@endsection
