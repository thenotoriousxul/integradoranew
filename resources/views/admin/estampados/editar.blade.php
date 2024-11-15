@extends('admin.layouts.dashboard')

@section('content')
<h2>Editar Estampado</h2>

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('estampados.actualizar', $estampado->id) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre del Estampado</label>
        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $estampado->nombre }}" required>
    </div>

    <div class="mb-3">
        <label for="imagen_diseño" class="form-label">Imagen del Estampado</label>
        @if ($estampado->imagen_diseño)
            <img src="{{ $estampado->imagen_diseño }}" alt="Imagen" class="img-thumbnail mb-3" style="width: 150px;">
        @endif
        <input type="file" name="imagen_diseño" id="imagen_diseño" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Actualizar</button>
    <a href="{{ route('estampados.listar') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
