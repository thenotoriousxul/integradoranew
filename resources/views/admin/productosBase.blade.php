@extends('admin.layouts.dashboard')

@section('content')
    <h2>Productos Base </h2>

    <table class="table table-responsive table-bordered table-hover table-sm">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Imagen</th>
                <th>Tipo</th>
                <th>Lote</th>
                <th>Fecha creacion</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($productos as $producto)
                <tr>
                    <td>
                    @if($producto->imagen_producto)
                        <img src="{{$producto->imagen_producto}}" alt="Imagen del producto" class="img-fluid" style="max-width: 50px; height: 50px;">
                    @else
                         <p>imagen no disponible</p>
                     @endif
                    </td>
                    <td>{{$producto->tipo}}</td>
                    <td>{{$producto->lote}}</td>
                    <td>{{ \Carbon\Carbon::parse($producto->created_at)->format('d-m-Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No se encontraron resultados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection