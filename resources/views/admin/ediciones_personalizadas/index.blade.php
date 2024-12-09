@extends('admin.layouts.dashboard')

@section('content')
<div class="container my-4">
    <h1 class="text-center mb-4">Ediciones Personalizadas</h1>

    <a href="{{ route('admin.ediciones_personalizadas.create') }}" class="btn btn-primary mb-3">Nueva Edición Personalizada</a>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Edición</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($edicionesPersonalizadas as $edicion)
                <tr>
                    <td>{{ $edicion->id }}</td>
                    <td>{{ $edicion->nombre }}</td>
                    <td>{{ $edicion->edicion->nombre_edicion }}</td>
                    <td>{{ $edicion->cantidad }}</td>
                    <td>{{ ucfirst($edicion->estado) }}</td>
                    <td>
                        <a href="{{ route('admin.ediciones_personalizadas.edit', $edicion->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('admin.ediciones_personalizadas.destroy', $edicion->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No hay ediciones personalizadas registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4 d-flex justify-content-center">
        {{ $edicionesPersonalizadas->links('pagination::bootstrap-4')->withClass('pagination-sm') }}
    </div></div>
@endsection
