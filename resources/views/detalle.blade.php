@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="text-center mb-4">Detalle del Pedido</h1>
    <p><strong>Fecha:</strong> {{ $pedido->fecha->format('d-m-Y') }}</p>
    <p><strong>Total:</strong> ${{ number_format($pedido->total, 2) }}</p>
    <p><strong>Estado:</strong> {{ $pedido->estado }}</p>

    <h3>Productos</h3>
    <ul>
        @foreach ($pedido->productos as $producto)
            <li>{{ $producto->nombre }} - Cantidad: {{ $producto->pivot->cantidad }}</li>
        @endforeach
    </ul>
</div>
@endsection
