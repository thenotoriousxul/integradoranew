@extends('admin.layouts.dashboard')

@section('content')
<div class="container">
    <h2>Editar Producto</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form action="{{ route('store.productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" id="nombre" name="nombre" class="form-control" value="{{ $producto->nombre }}" required>
        </div>
        
        <div class="mb-3">
            <label for="talla" class="form-label">Talla</label>
            <select id="talla" name="talla" class="form-control" required>
                <option value="CH" {{ $producto->talla == 'CH' ? 'selected' : '' }}>CH</option>
                <option value="M" {{ $producto->talla == 'M' ? 'selected' : '' }}>M</option>
                <option value="XL" {{ $producto->talla == 'XL' ? 'selected' : '' }}>XL</option>
                <option value="XXL" {{ $producto->talla == 'XXL' ? 'selected' : '' }}>XXL</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="imagen_producto_final" class="form-label">Imagen Frente</label>
            <input type="file" id="imagen_producto_final" name="imagen_producto_final" class="form-control">
        </div>

        <div class="mb-3">
            <label for="imagen_producto_trasera" class="form-label">Imagen Trasera</label>
            <input type="file" id="imagen_producto_trasera" name="imagen_producto_trasera" class="form-control">
        </div>

        <div class="mb-3">
            <label for="costo_precio_venta" class="form-label">Costo Precio Venta</label>
            <input type="number" id="costo_precio_venta" name="costo_precio_venta" class="form-control" value="{{ $producto->costo_precio_venta }}" required>
        </div>

        <div class="mb-3">
            <label for="cantidad" class="form-label">Stock</label>
            <input type="number" id="cantidad" name="cantidad" class="form-control" value="{{ $producto->cantidad }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        <a href="{{ route('listar.productos') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
