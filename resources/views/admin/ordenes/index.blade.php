@extends('admin.layouts.dashboard')

@section('content')
<h2>Listado de Órdenes</h2>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<br>
<div class="mb-3">
    <h4>Ordenar y filtrar</h4>
    <a href="#" class="btn btn-success btn-sm">
        Ordenar por ID descendente
    </a>
    <a href="{{route('admin.orden.pendientes', 'Pendiente')}}" class="btn btn-warning btn-sm">
        Mostrar Pendientes
    </a>
    <a href="{{ route('admins.ordenes.index') }}" class="btn btn-secondary btn-sm">
        Restablecer filtros
    </a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Cliente (ID)</th>
            <th>Fecha</th>
            <th>Total</th>
            <th>Envío</th>
            <th>EStado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($ordenes as $orden)
        <tr>
            <td>{{ $orden->id }}</td>
            <td>{{ $orden->tipo_personas_id}}</td>
            <td>{{ $orden->fecha_orden }}</td>
            <td>${{ number_format($orden->total, 2) }}</td>
            <td>{{ $orden->envios_domicilio ? 'Sí' : 'No' }}</td>
            <td>
                @if($orden->estado === 'Pagada')
                    <p class="bg-success text-white rounded">Completada</p>
                @elseif($orden->estado === 'Devuelta')
                    <p class="bg-warning text-white rounded">Orden Cancelada</p>
                @elseif($orden->estado === 'Pendiente')
                    <p class="bg-secondary text-white rounded">Pendiente</p>
                @endif
            </td>            
            <td>
                <a href="{{ route('admins.ordenes.show', $orden->id) }}" class="btn btn-info btn-sm">Ver</a>
                <a href="{{ route('admins.ordenes.edit', $orden->id) }}" class="btn btn-primary btn-sm">Editar</a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6">No se encontraron órdenes registradas.</td>
        </tr>
        @endforelse
    </tbody>
</table>
<div class="mt-4 d-flex justify-content-center">
    {{ $ordenes->links('pagination::bootstrap-4')->withClass('pagination-sm') }}
</div>
@endsection
