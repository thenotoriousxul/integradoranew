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
<div class="container my-4" style="background-color: #1f2937; padding: 2rem; border-radius: 1rem;">
    <h2 class="text-center mb-4 text-light">Crear Estampado</h2>
    
    <form action="{{ route('estampados.guardar') }}" method="POST" enctype="multipart/form-data" class="p-4 shadow rounded" style="background-color: #dde3eb; border-radius: 2rem;">
        @csrf
        
        <div class="mb-3">
            <label for="nombre" class="form-label fw-bold">Nombre del estampado</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>
    
        <div class="mb-3">
            <label for="imagen_diseño" class="form-label fw-bold">Imagen del estampado</label>
            <input type="file" name="imagen_diseño" id="imagen_diseño" class="form-control">
        </div>
    
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('estampados.listar') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
 