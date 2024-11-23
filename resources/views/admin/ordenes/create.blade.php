@extends('admin.layouts.dashboard')

@section('content')
<h2>Crear Nueva Orden</h2>

<!-- Mostrar errores de validación -->
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
 
<form action="{{ route('admins.ordenes.store') }}" method="POST">
    @csrf

    <!-- Cliente -->
    <div class="mb-3">
        <label for="tipo_personas_id" class="form-label">Cliente (ID)</label>
        <input type="number" name="tipo_personas_id" id="tipo_personas_id" class="form-control" placeholder="Ingrese el ID del cliente" required>
    </div>

    <!-- Fecha -->
    <div class="mb-3">
        <label for="fecha" class="form-label">Fecha</label>
        <input type="date" name="fecha" id="fecha" class="form-control" value="{{ date('Y-m-d') }}" required>
    </div>

    <!-- Total -->
    <div class="mb-3">
        <label for="total" class="form-label">Total</label>
        <input type="number" step="0.01" name="total" id="total" class="form-control" placeholder="Ingrese el total de la orden" required>
    </div>

    <!-- Envío a domicilio -->
    <div class="mb-3">
        <label for="envios_domicilio" class="form-label">Envío a domicilio</label>
        <select name="envios_domicilio" id="envios_domicilio" class="form-select" required>
            <option value="1">Sí</option>
            <option value="0">No</option>
        </select>
    </div>

    <!-- Botones -->
    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="{{ route('admins.ordenes.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
