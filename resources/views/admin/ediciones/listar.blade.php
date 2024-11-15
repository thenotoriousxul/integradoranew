@extends('admin.layouts.dashboard')

@section('content')
<h2>Listado de Ediciones</h2>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Fecha de Salida</th>
            <th>Lote</th>
            <th>Existencias</th>
            <th>Costo Extra</th>
            <th>Precio de Venta</th>
            <th>Imagen</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($ediciones as $edicion)
        <tr>
            <td>{{ $edicion->nombre_edicion }}</td>
            <td>{{ $edicion->fecha_de_salida }}</td>
            <td>{{ $edicion->lote }}</td>
            <td>{{ $edicion->existencias }}</td>
            <td>${{ number_format($edicion->extra, 2) }}</td>
            <td>${{ number_format($edicion->precio_de_venta, 2) }}</td>
            <td>
                @if ($edicion->imagen_producto)
                    <img src="{{ $edicion->imagen_producto }}" alt="Imagen" style="width: 100px;">
                @else
                    Sin Imagen
                @endif
            </td>
            <td>
                <a href="{{ route('ediciones.editar', $edicion->id) }}" class="btn btn-primary">Editar</a>
                <form action="{{ route('ediciones.eliminar', $edicion->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta edición?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="8">No se encontraron ediciones.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
