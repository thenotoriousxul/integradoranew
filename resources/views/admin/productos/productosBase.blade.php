@extends('admin.layouts.dashboard')

@section('content')
    <h2>Productos Base </h2>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    
    <div class="d-flex justify-content-end dropdown mb-3">
        <button class="btn btn-primary btn-animated mb-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#filtroOffcanvas" aria-controls="filtroOffcanvas">
            <i class="bi bi-funnel-fill"></i> Filtrar
        </button>
    </div>

    <table class="table table-responsive table-bordered table-hover table-sm">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Imagen</th>
                <th>Tipo</th>
                <th>Lote</th>
                <td>Talla</td>
                <td>Costo</td>
                <th>Fecha creacion</th>
                <th>Estado</th>
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
                    <td>{{$producto->talla}}</td>
                    <td>{{$producto->costo}}</td>
                    <td>{{ \Carbon\Carbon::parse($producto->created_at)->format('d-m-Y') }}</td>
                    <td>
                        <span class="badge {{ $producto->estado == 'Activo' ? 'bg-success' : 'bg-danger' }}">
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
                                    <a class="dropdown-item" href="{{ route('editar.producto', $producto->id)}}}">Editar</a>
                                </li>
                               
                                @if ($producto->estado == 'Activo')
                                    <li>
                                        <form method="POST" action="{{ route('inactivar.producto', $producto->id) }}" style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="dropdown-item">Inactivar</button>
                                        </form>
                                    </li>
                                @else
                                    <li>
                                        <form method="POST" action="{{ route('activar.producto', $producto->id) }}" style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="dropdown-item">Activar</button>
                                        </form>
                                    </li>
                                @endif
                                <!-- Acción 3: Eliminar -->
                                <li>
                                    <form method="POST" action="" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?')">Eliminar</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No se encontraron resultados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="offcanvas offcanvas-start" tabindex="-1" id="filtroOffcanvas" aria-labelledby="filtroOffcanvasLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="filtroOffcanvasLabel">Filtros</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form method="GET" action="{{ route('filtros') }}">
                <!-- Filtro por Precio -->
                <h6>Filtrar por Precio</h6>
                <div class="mb-3">
                    <label for="costo_min" class="form-label">Costo Mínimo</label>
                    <input type="number" name="costo_min" id="costo_min" class="form-control mb-2" value="{{ request('costo_min') }}">
                </div>
                <div class="mb-3">
                    <label for="costo_max" class="form-label">Costo Máximo</label>
                    <input type="number" name="costo_max" id="costo_max" class="form-control mb-2" value="{{ request('costo_max') }}">
                </div>

                <h6>filtrar por tipo</h6>
                <div class="mb-3">
                    <label for="tipo" class="form-label">tipo producto</label>
                    <input type="text" name="tipo" id="tipo" class="form-control mb-2" value="{{ request('tipo') }}">
                </div>
    
                <!-- Filtro por Tipo -->
                <h6>Filtrar por Talla</h6>
                <div class="mb-3">
                    <label for="talla" class="form-label">Talla</label>
                    <select name="talla" id="talla" class="form-select">
                        <option value="">-- Seleccionar la talla --</option>
                        <option value="CH" {{ request('talla') == 'CH' ? 'selected' : '' }}>CH</option>
                        <option value="M" {{ request('talla') == 'M' ? 'selected' : '' }}>M</option>
                        <option value="XL" {{ request('talla') == 'XL' ? 'selected' : '' }}>XL</option>
                        <option value="XXL" {{ request('talla') == 'XXL' ? 'selected' : '' }}>XXL</option>
                    </select>
                </div>
    
                <button type="submit" class="btn btn-primary">Aplicar Filtros</button>
            </form>
    
            <br>
            <form method="GET" action="{{ route('dash.productosBase') }}">
                <button type="submit" class="btn btn-dark">Limpiar Filtros</button>
            </form>
        </div>
    </div>
    
    
@endsection