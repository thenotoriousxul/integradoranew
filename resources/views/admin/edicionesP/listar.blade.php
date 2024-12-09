@extends('admin.layouts.dashboard')

@section('content')
    <h2>Ediciones Productos</h2>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    
    <table class="table table-responsive table-bordered table-hover table-sm">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Talla</th>
                <th>Imagen Frente</th>
                <th>Imagen Trasera</th>
                <th>Costo Fábrica</th>
                <th>Costo Precio Venta</th>
                <th>Stock</th>
                <th>Personalizada</th>
                <th>rebaja</th>
                <th>Precio de rebaja</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($productos as $producto)
                <tr>
                    <td>{{ $producto->id }}</td>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->talla }}</td>
                    <td>
                        @if($producto->imagen_producto_final)
                            <img src="{{ $producto->imagen_producto_final }}" alt="Imagen Producto Final" class="img-fluid" style="max-width: 50px; height: 50px;">
                        @else
                            No disponible
                        @endif
                    </td>
                    <td>
                        @if($producto->imagen_producto_trasera)
                            <img src="{{ $producto->imagen_producto_trasera }}" alt="Imagen Producto Trasera" class="img-fluid" style="max-width: 50px; height: 50px;">
                        @else
                            No disponible
                        @endif
                    </td>
                    <td>{{ number_format($producto->costo_fabrica, 2) }}</td>
                    <td>{{ number_format($producto->costo_precio_venta, 2) }}</td>
                    <td>{{ $producto->cantidad }}</td>
                    <td>{{ $producto->personalizada ? 'Sí' : 'No' }}</td>
                    <td>{{ $producto->rebaja ? 'Con rebaja' : 'Sin rebaja' }}</td>
                    <td>{{ number_format($producto->rebaja, 2) }}</td>
                    <td>
                        <span class="badge {{ $producto->estado == 'activo' ? 'bg-success' : 'bg-danger' }}">
                            {{ ucfirst($producto->estado) }}
                        </span>
                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton-{{ $producto->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                Acciones
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton-{{ $producto->id }}">
                                <li>
                                    <a class="dropdown-item" href="#', $producto->id) }}">Editar</a>
                                </li>
                             @if ($producto->estado == 'activo')
                                <li>
                                    <form method="POST" action="{{ route('inactivar', $producto->id) }}" style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="dropdown-item">Inactivar</button>
                                    </form>
                                </li>
                            @else
                                <li>
                                    <form method="POST" action="{{ route('activar', $producto->id) }}" style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="dropdown-item">Activar</button>
                                    </form>
                                </li>
                            @endif
                                <li>
                                    <form method="POST" action="#', $producto->id) }}" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item" onclick="return confirm('¿Estás seguro de eliminar este producto?')">Eliminar</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="11">No se encontraron ediciones de productos.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-4 d-flex justify-content-center">
        {{ $productos->links('pagination::bootstrap-4')->withClass('pagination-sm') }}
    </div>
@endsection 