@extends('admin.layouts.dashboard')

@section('content')
<h2>Detalle de Edición: {{ $edicion->nombre_edicion }}</h2>

<p><strong>Fecha de Salida:</strong> {{ $edicion->fecha_de_salida }}</p>
<p><strong>Lote:</strong> {{ $edicion->lote }}</p>
<p><strong>Costo de Fabricación:</strong> ${{ number_format($edicion->costo_fabricacion, 2) }}</p>
<p><strong>Precio de Venta:</strong> ${{ number_format($edicion->precio_de_venta, 2) }}</p>

<h4>Productos Asociados</h4>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Producto</th>
            <th>Color</th>
            <th>Costo</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($edicion->productos as $producto)
        <tr>
            <td>{{ $producto->tipo }}</td>
            <td>{{ $producto->color }}</td>
            <td>${{ number_format($producto->costo, 2) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
