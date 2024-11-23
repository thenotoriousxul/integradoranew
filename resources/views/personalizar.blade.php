@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Personaliza tu Producto: {{ $producto->tipo }}</h1>
    <div class="custom-container">
        {{-- Aquí puedes incluir la lógica para mostrar y organizar estampados, colores, etc. --}}
        <div>
            <h3>Estampados Disponibles</h3>
            @foreach($estampados as $estampado)
                <button onclick="agregarEstampado('{{ $estampado->imagen_url }}', 0)" class="btn btn-secondary">
                    {{ $estampado->nombre }}
                </button>
            @endforeach
        </div>
        <div>
            {{-- Suponiendo que el producto tenga una imagen representativa que se pueda manipular --}}
            <img id="productoImagen" src="{{ $producto->imagen_producto }}" alt="Imagen de Producto">
        </div>
    </div>
</div>
@endsection
