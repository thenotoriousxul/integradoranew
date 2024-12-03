@extends('admin.layouts.dashboard')

@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<table class="table table-responsive table-bordered table-hover table-sm">
    <thead class="thead-dark">
        <tr>
            <th>Email</th>
            <th>Nombre</th>
            <td>NUmero Telefono</td>
            <td>Costo</td>
            <th>Fecha creacion</th>
            <th>Estado</th>
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
                        {{ $usuario->persona->apellido_paterno}}
                        {{ $usuario->persona->apellido_materno}}
                    @else
                        Sin persona relacionada
                    @endif
                </td>
                <td>
                    @if ($usuario->persona)
                        {{ $usuario->persona->numero_telefonico}}
                    @else
                        Sin numero relacionado
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3">No se encontraron resultados.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection