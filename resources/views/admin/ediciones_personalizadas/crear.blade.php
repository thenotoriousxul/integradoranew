@extends('admin.layouts.dashboard')

@section('content')
<div class="container my-4" style="background-color: #1f2937; padding: 2rem; border-radius: 2rem;">
    <h1 class="text-center mb-4 text-light">Crear Edición Personalizada</h1>

    <form action="{{ route('admin.ediciones_personalizadas.store') }}" method="POST" enctype="multipart/form-data" class="p-4 shadow rounded" style="background-color: #dde3eb; border-radius: 2rem;">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label fw-bold">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingrese el nombre" required>
        </div>

        <div class="mb-3">
            <label for="edicion_id" class="form-label fw-bold">Edición</label>
            <select name="edicion_id" id="edicion_id" class="form-control" required>
                <option value="" disabled selected>Seleccione una edición</option>
                @foreach ($ediciones as $edicion)
                    <option value="{{ $edicion->id }}">{{ $edicion->nombre_edicion }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="productos_id" class="form-label fw-bold">Producto</label>
            <select name="productos_id" id="productos_id" class="form-control" required>
                <option value="" disabled selected>Seleccione un producto</option>
                @foreach ($productos as $producto)
                    <option value="{{ $producto->id }}">{{ ucfirst($producto->tipo) }} - {{ ucfirst($producto->color) }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="cantidad" class="form-label fw-bold">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad" class="form-control" min="1" placeholder="Ingrese la cantidad" required>
        </div>

        <div class="mb-4">
            <label class="form-label fw-bold">Imagen Producto Final</label>
            <input type="file" name="imagen_producto_final" id="imagen_producto_final" class="form-control" accept="image/*">
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success w-50">Crear Edición</button>
        </div>
    </form>
</div>
@endsection
