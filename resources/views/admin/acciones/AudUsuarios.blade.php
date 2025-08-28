@extends('admin.layouts.dashboard')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Auditoría de Usuarios</h1>

    <!-- Filtros -->
    <form method="GET" class="mb-4 row g-3">
        <div class="col-md-3">
            <label for="operacion" class="form-label">Operación</label>
            <select name="operacion" id="operacion" class="form-select">
                <option value="" {{ !request('operacion') ? 'selected' : '' }}>Todas</option>
                <option value="INSERT" {{ request('operacion') === 'INSERT' ? 'selected' : '' }}>INSERT</option>
                <option value="UPDATE" {{ request('operacion') === 'UPDATE' ? 'selected' : '' }}>UPDATE</option>
                <option value="DELETE" {{ request('operacion') === 'DELETE' ? 'selected' : '' }}>DELETE</option>
            </select>
        </div>

        <div class="col-md-3">
            <label for="usuario" class="form-label">Usuario</label>
            <input
                type="text"
                name="usuario"
                id="usuario"
                value="{{ request('usuario') }}"
                class="form-control"
                placeholder="Buscar usuario"
            />
        </div>

        <div class="col-md-3">
            <label for="orden" class="form-label">Ordenar por</label>
            <select name="orden" id="orden" class="form-select">
                <option value="desc" {{ request('orden') === 'desc' || !request('orden') ? 'selected' : '' }}>Más reciente</option>
                <option value="asc" {{ request('orden') === 'asc' ? 'selected' : '' }}>Más antiguo</option>
            </select>
        </div>

        <div class="col-md-3 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Filtrar</button>
        </div>
    </form>

    <!-- Tabla de resultados -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Operación</th>
                    <th>Usuario</th>
                    <th>Datos Anteriores</th>
                    <th>Datos Nuevos</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($auditorias as $auditoria)
                <tr>
                    <td>{{ $auditoria->operacion }}</td>
                    <td>{{ $auditoria->usuario_nombre }}</td>
                    <td><pre class="mb-0">{{ $auditoria->datos_anterior }}</pre></td>
                    <td><pre class="mb-0">{{ $auditoria->datos_nuevo }}</pre></td>
                    <td>{{ $auditoria->fecha }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">No se encontraron registros</td>
                </tr>
                @endforelse
            </tbody>
            <tfoot class="table-light">
                <tr>
                    <td colspan="5" class="text-center">Total de registros: {{ $auditorias->total() }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- Paginación -->
    <div class="mt-4">
        {{ $auditorias->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
