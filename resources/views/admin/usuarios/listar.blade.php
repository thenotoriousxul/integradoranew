@extends('admin.layouts.dashboard')

@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="table-responsive">
    <table class="table table-striped table-hover table-bordered table-sm">
        <thead class="thead-dark text-center">
            <tr>
                <th>Email</th>
                <th>Nombre Completo</th>
                <th>Teléfono</th>
                <th>Género</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->email }}</td>
                    <td>
                        @if ($usuario->persona)
                            {{ $usuario->persona->nombre }}
                            {{ $usuario->persona->apellido_paterno }}
                            {{ $usuario->persona->apellido_materno }}
                        @else
                            <span class="text-muted">No registrado</span>
                        @endif
                    </td>
                    <td>
                        @if ($usuario->persona && $usuario->persona->numero_telefonico)
                            {{ $usuario->persona->numero_telefonico }}
                        @else
                            <span class="text-muted">No disponible</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if ($usuario->persona)
                            @if($usuario->persona->genero === 'M')
                                <span class="badge bg-primary">Masculino</span>
                            @else
                                <span class="badge bg-warning">Femenino</span>
                            @endif
                        @else
                            <span class="text-muted">Sin datos</span>
                        @endif
                    </td>
                    <td>
                        @if ($usuario->roles->isNotEmpty())
                            {{ $usuario->roles->pluck('name')->implode(', ') }}
                        @else
                            Sin rol asignado
                        @endif
                    </td>
                    
                    <td class="text-center">
                        @if($usuario->status === 'Activo')
                        <form action="{{ route('desactivar.usuarios', $usuario->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de desactivar este usuario?')">
                                <i class="fas fa-ban"></i> desactivar
                            </button>
                        </form>
                        @endif
                        @if($usuario->status === 'Inactivo')
                        <form action="{{ route('activar.usuarios', $usuario->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('¿Quieres volver a activar este usuario?')">
                                <i class="fas fa-check-circle"></i> Activar
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No se encontraron usuarios registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>
<div class="d-flex justify-content-start mt-4">
    {{ $usuarios->links('pagination::bootstrap-4') }}
</div>



@endsection
