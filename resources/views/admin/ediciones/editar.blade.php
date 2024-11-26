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

<form action="{{ route('ediciones.actualizar', $edicion->id) }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="nombre_edicion" class="form-label">Nombre de la Edición</label>
        <input type="text" name="nombre_edicion" id="nombre_edicion" class="form-control" value="{{ $edicion->nombre_edicion }}" required>
    </div>

    <div class="mb-3">
        <label for="descripcion" class="form-label">descripcion</label>
        <input type="text" name="descripcion" id="descripcion" class="form-control" value="{{ $edicion->descripcion }}" step="0.01">
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

    <div class="mb-4">
        <label class="form-label fw-bold" for="tipo">Tipo</label>
        <select name="tipo" id="tipo" class="form-select border rounded" required style="background-color: #e9ecef; color: #495057;">
            <option value="" disabled selected>Seleccione el tipo</option>
            <option value="Edicion">Edición</option>
            <option value="Personalizada">Personalizada</option>
        </select>
    </div>


    <button type="submit" class="btn btn-primary">Actualizar Edición</button>
    <a href="{{ route('ediciones.listar') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
