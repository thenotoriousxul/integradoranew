@extends('admin.layouts.dashboard')

@section('content')
<h2>Listado de Estampados</h2>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Imagen</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($estampados as $estampado)
        <tr>
            <td>{{ $estampado->nombre }}</td>
            <td>
                @if ($estampado->imagen_estampado)
                    <img src="{{ $estampado->imagen_estampado }}" alt="Imagen" style="width: 100px;">
                @else
                    Sin Imagen
                @endif
            </td>
            <td>
                <a href="{{ route('estampados.editar', $estampado->id) }}" class="btn btn-primary">Editar</a>
                <form action="{{ route('estampados.eliminar', $estampado->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este estampado?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="3">No se encontraron estampados.</td>
        </tr>
        @endforelse
    </tbody>
</table>
<div class="mt-4 d-flex justify-content-center">
    {{ $estampados->links('pagination::bootstrap-4')->withClass('pagination-sm') }}
</div>
@endsection
