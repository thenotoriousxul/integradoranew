@extends('admin.layouts.dashboard')

@section('content')
<h2>Crear Estampado</h2>

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('estampados.guardar') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre del Estampado</label>
        <input type="text" name="nombre" id="nombre" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="imagen_diseño" class="form-label">Imagen del Estampado</label>
        <input type="file" name="imagen_diseño" id="imagen_diseño" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="{{ route('estampados.listar') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
 