@extends('admin.layouts.dashboard')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container my-4" style="background-color: #1f2937; padding: 2rem; border-radius: 2rem;">
    <h2 class="text-center mb-4 text-light">Crear Edición</h2>

    <form action="{{ route('ediciones.guardar') }}" method="POST" class="p-4 shadow rounded" style="background-color: #dde3eb; border-radius: 2rem;">
        @csrf

        <!-- Nombre de la Edición -->
        <div class="mb-3">
            <label for="nombre_edicion" class="form-label fw-bold">Nombre de la Edición</label>
            <input type="text" name="nombre_edicion" id="nombre_edicion" class="form-control" placeholder="Ingrese el nombre de la edición" required>
        </div>

        <!-- Descripción -->
        <div class="mb-3">
            <label for="descripcion" class="form-label fw-bold">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control" rows="3" placeholder="Ingrese la descripción" required></textarea>
        </div>

        <!-- Fecha de Salida -->
        <div class="mb-3">
            <label for="fecha_de_salida" class="form-label fw-bold">Fecha de Salida</label>
            <input type="date" name="fecha_de_salida" id="fecha_de_salida" class="form-control" required>
        </div>

        <!-- Lote Total -->
        <div class="mb-3">
            <label for="lote" class="form-label fw-bold">Lote Total</label>
            <input type="number" name="lote" id="lote" class="form-control" placeholder="Ingrese el lote total" required>
        </div>

        <!-- Existencias Iniciales -->
        <div class="mb-3">
            <label for="existencias" class="form-label fw-bold">Existencias Iniciales</label>
            <input type="number" name="existencias" id="existencias" class="form-control" placeholder="Ingrese las existencias iniciales" required>
        </div>

        <!-- Costo Extra -->
        <div class="mb-3">
            <label for="extra" class="form-label fw-bold">Costo Extra</label>
            <input type="number" name="extra" id="extra" class="form-control"  step="0.01" placeholder="Ingrese el costo extra">
        </div>

        <!-- Tipo -->
        <div class="mb-4">
            <label class="form-label fw-bold" for="tipo">Tipo</label>
            <select name="tipo" id="tipo" class="form-select border rounded" required style="background-color: #e9ecef; color: #495057;">
                <option value="" disabled selected>Seleccione el tipo</option>
                <option value="Edicion">Edición</option>
                <option value="Personalizada">Personalizada</option>
            </select>
        </div>

        <!-- Botón de Envío -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary w-50">Crear Edición</button>
        </div>
    </form>
</div>

@endsection
