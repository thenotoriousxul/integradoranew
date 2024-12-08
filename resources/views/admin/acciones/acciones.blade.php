@extends('admin.layouts.dashboard')

@section('content')
<table class="table">
    <thead>
        <tr>
            <th>Tipo de Auditoría</th>
            <th>Entidad</th>
            <th>Modificador</th>
            <th>Acción</th>
            <th>Estado Anterior</th>
            <th>Estado Actual</th>
            <th>Fecha</th>
        </tr>
    </thead>
    <tbody>
        @foreach($auditorias as $auditoria)
            <tr>
                <td>{{ $auditoria->tipo_auditoria }}</td>
                <td>{{ $auditoria->entidad_nombre ?? 'N/A' }}</td>
                <td>{{ $auditoria->modificador }}</td>
                <td>{{ $auditoria->accion }}</td>
                <td>{{ json_encode($auditoria->estado_anterior) }}</td>
                <td>{{ json_encode($auditoria->estado_actual) }}</td>
                <td>{{ $auditoria->fecha }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
