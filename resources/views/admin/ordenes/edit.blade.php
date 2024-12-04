@extends('admin.layouts.dashboard')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Editar Orden #{{ $orden->id }}</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admins.ordenes.update', $orden->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="tipo_personas_id" class="form-label">Cliente (ID)</label>
                    <input type="number" name="tipo_personas_id" id="tipo_personas_id" value="{{ $orden->tipo_personas_id }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input type="date" name="fecha" id="fecha" value="{{ $orden->fecha }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="total" class="form-label">Total</label>
                    <input type="number" step="0.01" name="total" id="total" value="{{ $orden->total }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="envios_domicilio" class="form-label">Envío a domicilio</label>
                    <select name="envios_domicilio" id="envios_domicilio" class="form-select" required>
                        <option value="1" {{ $orden->envios_domicilio ? 'selected' : '' }}>Sí</option>
                        <option value="0" {{ !$orden->envios_domicilio ? 'selected' : '' }}>No</option>
                    </select>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success me-2">Actualizar Orden</button>
                    <a href="{{ route('admins.ordenes.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
