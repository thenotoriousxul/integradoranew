@extends('admin.layouts.dashboard')

@section('content') 
<div class="container my-4" style="background-color: #1f2937; padding: 2rem; border-radius: 2rem;">
    <h2 class="text-center mb-4 text-light">Crear Edición</h2>

    <form action="{{ route('ediciones.guardar') }}" method="POST" enctype="multipart/form-data" class="p-4 shadow rounded" style="background-color: #dde3eb; border-radius: 2rem;>
        @csrf
    
        <div class="mb-3">
            <label for="nombre_edicion" class="form-label fw-bold">Nombre de la Edición</label>
            <input type="text" name="nombre_edicion" id="nombre_edicion" class="form-control" required>
        </div>
    
        <div class="mb-3">
            <label for="descripcion" class="form-label fw-bold">Ingresa la descripcion de la edicion</label>
            <input type="text" name="descripcion" id="descripcion" class="form-control" required>
        </div>
    
        <div class="mb-3">
            <label for="fecha_de_salida" class="form-label fw-bold">Fecha de Salida</label>
            <input type="date" name="fecha_de_salida" id="fecha_de_salida" class="form-control" required>
        </div>
    
        <div class="mb-3">
            <label for="lote" class="form-label fw-bold">Lote total</label>
            <input type="number" name="lote" id="lote" class="form-control" required>
        </div>
    
        <div class="mb-3">
            <label for="existencias" class="form-label fw-bold">Existencias iniciales</label>
            <input type="number" name="existencias" id="existencias" class="form-control" required>
        </div>
    
        <div class="mb-3">
            <label for="extra" class="form-label fw-bold">Costo extra</label>
            <input type="number" name="extra" id="extra" class="form-control" min="0" step="0.01">
        </div>
    
        <div class="mb-4">
            <label class="form-label fw-semibold text-dark" for="talla">Ingresa el tipo</label>
            <select name="tipo" id="tipo" class="form-select border rounded" required style="background-color: #e9ecef; color: #495057;">
                <option value="" disabled selected>Selecciona el tipo</option>
                <option value="Edicion">Edicion</option>
                <option value="Personalizada">Personalizada</option>
            </select>
        </div>
    
        
    
        <button type="submit" class="btn btn-primary">Crear Edición</button>
    </form>
</div>

@endsection
