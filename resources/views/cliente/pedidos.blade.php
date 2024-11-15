@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mis Pedidos</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($ordenes->isEmpty())
        <p>No tienes pedidos registrados.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Envío a domicilio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ordenes as $orden)
                    <tr>
                        <td>{{ $orden->id }}</td>
                        <td>{{ $orden->fecha }}</td>
                        <td>${{ number_format($orden->total, 2) }}</td>
                        <td>{{ $orden->envios_domicilio ? 'Sí' : 'No' }}</td>
                        <td>
                            <a href="{{ route('admins.ordenes.show', $orden->id) }}" class="btn btn-info btn-sm">Ver Detalles</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
