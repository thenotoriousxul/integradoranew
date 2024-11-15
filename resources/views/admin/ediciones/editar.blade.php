@extends('admin.layouts.dashboard')

@section('content')
<h2>Editar Edición</h2>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('ediciones.actualizar', $edicion->id) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="nombre_edicion" class="form-label">Nombre de la Edición</label>
        <input type="text" name="nombre_edicion" id="nombre_edicion" class="form-control" value="{{ $edicion->nombre_edicion }}" required>
    </div>

    <div class="mb-3">
        <label for="fecha_de_salida" class="form-label">Fecha de Salida</label>
        <input type="date" name="fecha_de_salida" id="fecha_de_salida" class="form-control" value="{{ $edicion->fecha_de_salida }}" required>
    </div>

    <div class="mb-3">
        <label for="lote" class="form-label">Lote</label>
        <input type="number" name="lote" id="lote" class="form-control" value="{{ $edicion->lote }}" required>
    </div>

    <div class="mb-3">
        <label for="existencias" class="form-label">Existencias</label>
        <input type="number" name="existencias" id="existencias" class="form-control" value="{{ $edicion->existencias }}" required>
    </div>

    <div class="mb-3">
        <label for="extra" class="form-label">Costo Extra</label>
        <input type="number" name="extra" id="extra" class="form-control" value="{{ $edicion->extra }}" step="0.01">
    </div>

    <div class="mb-3">
        <label for="precio_de_venta" class="form-label">Precio de Venta</label>
        <input type="number" name="precio_de_venta" id="precio_de_venta" class="form-control" value="{{ $edicion->precio_de_venta }}" step="0.01" required>
    </div>

    <div class="mb-3">
        <label for="imagen_producto" class="form-label">Imagen del Producto</label>
        @if ($edicion->imagen_producto)
            <img src="{{ $edicion->imagen_producto }}" alt="Imagen" class="img-thumbnail mb-3" style="width: 150px;">
        @endif
        <input type="file" name="imagen_producto" id="imagen_producto" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Actualizar Edición</button>
    <a href="{{ route('ediciones.listar') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
