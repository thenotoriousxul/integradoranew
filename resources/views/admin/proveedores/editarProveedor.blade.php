@extends('admin.layouts.dashboard')

@section('content')
    <h2>Editar Proveedor</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('admin.actualizarProveedor', $proveedor->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $proveedor->nombre) }}" required>
        </div>

        <div class="mb-3">
            <label for="numero_telefonico" class="form-label">Número Telefónico</label>
            <input type="text" name="numero_telefonico" id="numero_telefonico" class="form-control" value="{{ old('numero_telefonico', $proveedor->numero_telefonico) }}" required>
        </div>

        <h4>Dirección</h4>

        <div class="mb-3">
            <label for="calle" class="form-label">Calle</label>
            <input type="text" name="calle" id="calle" class="form-control" value="{{ old('calle', $proveedor->direccion->calle) }}" required>
        </div>

        <div class="mb-3">
            <label for="numero_ext" class="form-label">Número Exterior</label>
            <input type="text" name="numero_ext" id="numero_ext" class="form-control" value="{{ old('numero_ext', $proveedor->direccion->numero_ext) }}" required>
        </div>

        <div class="mb-3">
            <label for="numero_int" class="form-label">Número Interior</label>
            <input type="text" name="numero_int" id="numero_int" class="form-control" value="{{ old('numero_int', $proveedor->direccion->numero_int) }}">
        </div>

        <div class="mb-3">
            <label for="colonia" class="form-label">Colonia</label>
            <input type="text" name="colonia" id="colonia" class="form-control" value="{{ old('colonia', $proveedor->direccion->colonia) }}" required>
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <input type="text" name="estado" id="estado" class="form-control" value="{{ old('estado', $proveedor->direccion->estado) }}" required>
        </div>

        <div class="mb-3">
            <label for="codigo_postal" class="form-label">Código Postal</label>
            <input type="text" name="codigo_postal" id="codigo_postal" class="form-control" value="{{ old('codigo_postal', $proveedor->direccion->codigo_postal) }}" required>
        </div>

        <div class="mb-3">
            <label for="pais" class="form-label">País</label>
            <input type="text" name="pais" id="pais" class="form-control" value="{{ old('pais', $proveedor->direccion->pais) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Proveedor</button>
        <a href="{{ route('proveedores.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
