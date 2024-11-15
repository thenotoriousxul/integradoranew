@extends('admin.layouts.dashboard')

@section('content')
<h2>Crear Edición</h2>

<form action="{{ route('ediciones.guardar') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="nombre_edicion" class="form-label">Nombre de la Edición</label>
        <input type="text" name="nombre_edicion" id="nombre_edicion" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="fecha_de_salida" class="form-label">Fecha de Salida</label>
        <input type="date" name="fecha_de_salida" id="fecha_de_salida" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="lote" class="form-label">Lote Total</label>
        <input type="number" name="lote" id="lote" class="form-control" min="1" required>
    </div>

    <div class="mb-3">
        <label for="existencias" class="form-label">Existencias Iniciales</label>
        <input type="number" name="existencias" id="existencias" class="form-control" min="1" required>
    </div>

    <div class="mb-3">
        <label for="extra" class="form-label">Costo Extra</label>
        <input type="number" name="extra" id="extra" class="form-control" min="0" step="0.01">
    </div>

    <div class="mb-3">
        <label for="precio_de_venta" class="form-label">Precio de Venta</label>
        <input type="number" name="precio_de_venta" id="precio_de_venta" class="form-control" min="0" step="0.01" required>
    </div>

    <div class="mb-3">
        <label for="imagen_producto" class="form-label">Imagen del Producto</label>
        <input type="file" name="imagen_producto" id="imagen_producto" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Crear Edición</button>
</form>
@endsection
