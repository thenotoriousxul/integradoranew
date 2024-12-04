@extends('admin.layouts.dashboard')

@section('content')

@if($errors->any())
<div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    
    <div class="container my-4" style="background-color: #1f2937; padding: 2rem; border-radius: 2rem;">
        <h2 class="text-center mb-4 text-light">Crear Nueva Orden</h2>
        
        <form action="{{ route('admins.ordenes.store') }}" method="POST" class="p-4 shadow rounded" style="background-color: #dde3eb; border-radius: 2rem;">
            @csrf
        
            <div class="mb-3">
                <label for="tipo_personas_id" class="form-label fw-bold">Cliente (ID)</label>
                <input type="number" name="tipo_personas_id" id="tipo_personas_id" class="form-control" placeholder="Ingrese el ID del cliente" required>
            </div>
        
            <div class="mb-3">
                <label for="fecha" class="form-label fw-bold">Fecha</label>
                <input type="date" name="fecha" id="fecha" class="form-control" value="{{ date('Y-m-d') }}" required>
            </div>
        
            <div class="mb-3">
                <label for="total" class="form-label fw-bold">Total</label>
                <input type="number" step="0.01" name="total" id="total" class="form-control" placeholder="Ingrese el total de la orden" required>
            </div>
        
            <div class="mb-3">
                <label for="envios_domicilio" class="form-label fw-bold">Envío a domicilio</label>
                <select name="envios_domicilio" id="envios_domicilio" class="form-select" required>
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
            </div>
        
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('admins.ordenes.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
</div>
@endsection
