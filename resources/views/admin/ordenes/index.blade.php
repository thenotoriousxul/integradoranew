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
    <h4>Filtrar por Fechas</h4>
    <form action="{{ route('admins.ordenes.filtrar') }}" method="GET">
        @csrf
        <div class="form-colum">
            <div class="col-auto">
                <label for="fecha_inicio" class="col-form-label">Fecha Inicio:</label>
                <input type="date" name="fecha_inicio" class="form-control form-control-sm" required>
            </div>
            <div class="col-auto">
                <label for="fecha_fin" class="col-form-label">Fecha Fin:</label>
                <input type="date" name="fecha_fin" class="form-control form-control-sm" required>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary btn-sm">Filtrar</button>
            </div>
        </div>
    </form>
</div>





<!-- Opciones de filtrado y ordenación -->
<div class="mb-3">
    <h4>Ordenar y filtrar</h4>
    <a href="{{route('admin.orden.pendientes', 'Pendiente')}}" class="btn btn-warning btn-sm">
        Mostrar Pendientes
    </a>
    <a href="{{ route('admins.ordenes.index') }}" class="btn btn-secondary btn-sm">
        Restablecer filtros
    </a>
</div>

<!-- Tabla de órdenes -->
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Cliente/Empleado</th>
            <th>Fecha</th>
            <th>Total</th>
            <th>Envío</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($ordenes as $orden)
        <tr>
            <td>{{ $orden->id }}</td>
            <td>{{ $orden->tipoPersona->persona->nombre }}</td>
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

<!-- Paginación -->
<div class="mt-4 d-flex justify-content-center">
    {{ $ordenes->links('pagination::bootstrap-4')->withClass('pagination-sm') }}
</div>

@endsection
