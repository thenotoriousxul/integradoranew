@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="text-center mb-5">
        <h1>Ofertas de Rebajas</h1>
        <p class="lead">Aprovecha los grandes descuentos en nuestros productos seleccionados.</p>
    </div>

    <div class="row">
        @foreach ($productos as $producto)
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm">
                    @if($producto->imagen_producto_final)
                        <img src="{{ $producto->imagen_producto_final }}" class="card-img-top" alt="Imagen de {{ $producto->nombre }}">
                    @else
                        <img src="https://png.pngtree.com/png-vector/20220120/ourmid/pngtree-black-t-shirt-template-png-image_4293336.png" class="card-img-top" alt="Imagen no disponible">
                    @endif
                    
                    <div class="card-body">
                        <h5 class="card-title">{{ $producto->nombre }}</h5>
                        
                        <p class="text-muted mb-0">
                            @if($producto->rebaja)
                                <del>${{ number_format($producto->costo_precio_venta, 2) }}</del>
                            @endif
                        </p>
                        
                        <p class="{{ $producto->rebaja ? 'text-danger fw-bold' : 'fw-bold' }}">
                            ${{ number_format($producto->rebaja ? $producto->precio_rebajado : $producto->costo_precio_venta, 2) }}
                            @if($producto->rebaja)
                                <small class="text-success">({{ $producto->porcentaje_rebaja }}% Off)</small>
                            @endif
                        </p>
                        
                        <a href="{{ route('vista_producto_detalle', ['id' => $producto->id]) }}" class="btn btn-primary w-100">Ver detalles</a>
                    </div>
                    
                    @if($producto->rebaja)
                        <div class="position-absolute top-0 end-0 bg-danger text-white px-2 py-1" style="border-radius: 0 0 0 5px;">
                            -{{ $producto->porcentaje_rebaja }}%
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
