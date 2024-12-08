@extends('admin.layouts.dashboard')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Auditoría de Usuarios</h1>

    <form method="GET" class="mb-4 row g-3">
        <div class="col-md-3">
            <select name="operacion" class="form-select">
                <option value="" {{ !request('operacion') ? 'selected' : '' }}>Todas</option>
                <option value="INSERT" {{ request('operacion') === 'INSERT' ? 'selected' : '' }}>INSERT</option>
                <option value="UPDATE" {{ request('operacion') === 'UPDATE' ? 'selected' : '' }}>UPDATE</option>
                <option value="DELETE" {{ request('operacion') === 'DELETE' ? 'selected' : '' }}>DELETE</option>
            </select>
        </div>

        <div class="col-md-3">
            <input
                type="text"
                name="usuario"
                value="{{ request('usuario') }}"
                class="form-control"
                placeholder="Buscar usuario"
            />
        </div>

        <div class="col-md-3">
            <select name="orden" class="form-select">
                <option value="desc" {{ request('orden') === 'desc' || !request('orden') ? 'selected' : '' }}>Más reciente</option>
                <option value="asc" {{ request('orden') === 'asc' ? 'selected' : '' }}>Más antiguo</option>
            </select>
        </div>

        <div class="col-md-3">
            <button type="submit" class="btn btn-primary w-100">Filtrar</button>
        </div>
    </form>

    <!-- Tabla -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Operación</th>
                    <th>Usuario</th>
                    <th>Datos Anterior</th>
                    <th>Datos Nuevo</th>
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
                    <td colspan="5" class="text-center">No se encontraron resultados</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $auditorias->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
