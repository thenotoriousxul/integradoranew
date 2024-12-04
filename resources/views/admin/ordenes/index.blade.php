@extends('admin.layouts.dashboard')

@section('content')
<h2>Listado de Órdenes</h2>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Cliente (ID)</th>
            <th>Fecha</th>
            <th>Total</th>
            <th>Envío</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($ordenes as $orden)
        <tr>
            <td>{{ $orden->id }}</td>
            <td>{{ $orden->tipo_personas_id}}</td>
            <td>{{ $orden->fecha }}</td>
            <td>${{ number_format($orden->total, 2) }}</td>
            <td>{{ $orden->envios_domicilio ? 'Sí' : 'No' }}</td>
            <td>
                <a href="{{ route('admins.ordenes.show', $orden->id) }}" class="btn btn-info btn-sm">Ver</a>
                <a href="{{ route('admins.ordenes.edit', $orden->id) }}" class="btn btn-primary btn-sm">Editar</a>
                <form action="{{ route('admins.ordenes.destroy', $orden->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de eliminar esta orden?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6">No se encontraron órdenes registradas.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
