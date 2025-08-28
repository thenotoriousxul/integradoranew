@extends('admin.layouts.dashboard')

@section('content')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    
    <div class="container my-4" style="background-color: #1f2937; padding: 2rem; border-radius: 2rem;">
        <h2 class="text-center mb-4 text-light">Crear Nuevo Proveedor</h2>
        
        <form action="{{ route('nuevoproveedor') }}" method="POST" class="p-4 shadow rounded" style="background-color: #dde3eb; border-radius: 2rem;">
            @csrf
    
            <div class="mb-3">
                <label for="nombre" class="form-label fw-bold">Nombre del Proveedor</label>
                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingrese el nombre del proveedor" required>
            </div>
    
            <div class="mb-3">
                <label for="numero_telefonico" class="form-label fw-bold">Número Telefónico</label>
                <input type="text" name="numero_telefonico" id="numero_telefonico" class="form-control" placeholder="Ingrese el número telefónico" required>
            </div>
    
            <div class="mb-3">
                <label for="tipo" class="form-label fw-bold">Tipo de Proveedor</label>
                <select name="tipo" id="tipo" class="form-control" required>
                    <option value="" disabled selected>Seleccione el tipo</option>
                    <option value="Servicio">Servicio</option>
                    <option value="Materia Prima">Materia Prima</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="calle" class="form-label fw-bold">Calle</label>
                <input type="text" name="calle" id="calle" class="form-control" placeholder="Ingrese la calle" required>
            </div>
    
            <div class="mb-3">
                <label for="numero_ext" class="form-label fw-bold">Número Exterior</label>
                <input type="text" name="numero_ext" id="numero_ext" class="form-control" placeholder="Ingrese el número exterior" required>
            </div>
    
            <div class="mb-3">
                <label for="numero_int" class="form-label fw-bold">Número Interior</label>
                <input type="text" name="numero_int" id="numero_int" class="form-control" placeholder="Ingrese el número interior (opcional)">
            </div>
    
            <div class="mb-3">
                <label for="colonia" class="form-label fw-bold">Colonia</label>
                <input type="text" name="colonia" id="colonia" class="form-control" placeholder="Ingrese la colonia" required>
            </div>
    
            <div class="mb-3">
                <label for="estado" class="form-label fw-bold">Estado</label>
                <input type="text" name="estado" id="estado" class="form-control" placeholder="Ingrese el estado" required>
            </div>
    
            <div class="mb-3">
                <label for="codigo_postal" class="form-label fw-bold">Código Postal</label>
                <input type="text" name="codigo_postal" id="codigo_postal" class="form-control" placeholder="Ingrese el código postal" required>
            </div>
    
            <div class="mb-3">
                <label for="pais" class="form-label fw-bold">País</label>
                <input type="text" name="pais" id="pais" class="form-control" placeholder="Ingrese el país" required>
            </div>
    
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('admin.agregarProveedor') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
    
@endsection
