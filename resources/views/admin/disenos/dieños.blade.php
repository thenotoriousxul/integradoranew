@extends('admin.layouts.dashboard')

@section('content')
<div class="container">
    <h1>Lista de Diseños</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Costo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($disenos as $diseno)
            <tr>
                <td>{{ $diseno->nombre }}</td>
                <td>{{ $diseno->cantidad }}</td>
                <td>${{ number_format($diseno->costo, 2) }}</td>
                <td>
                    <!-- Botón para mostrar estampados -->
                    <button 
                        type="button" 
                        class="btn btn-info btn-sm" 
                        data-bs-toggle="modal" 
                        data-bs-target="#modal-estampados-{{ $diseno->id }}">
                        Ver Estampados
                    </button>

                    <!-- Modal para mostrar estampados -->
                    <div class="modal fade" id="modal-estampados-{{ $diseno->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $diseno->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLabel{{ $diseno->id }}">Estampados de {{ $diseno->nombre }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    @if ($diseno->estampados->isEmpty())
                                        <p>No hay estampados asociados a este diseño.</p>
                                    @else
                                        <ul>
                                            @foreach ($diseno->estampados as $estampado)
                                            <li>
                                                <strong>{{ $estampado->nombre }}</strong> - ${{ number_format($estampado->costo, 2) }}

                                                @if($estampado->imagen_estampado)
                                                    <br>
                                                    <img src="{{ Storage::url($estampado->imagen_estampado) }}" alt="Imagen de {{ $estampado->nombre }}" style="max-width: 100px; max-height: 100px;">
                                                @endif
                                                
                                            
                                                
                                            </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
