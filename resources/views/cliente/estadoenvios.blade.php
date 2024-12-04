@extends('cliente.layouts.dashboard')

@section('content')
<h1>Mis Envíos Pendientes</h1>
    @if($envios->isEmpty())
        <p>No tienes envíos pendientes en este momento.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Orden</th>
                    <th>Costo Envío</th>
                    <th>Estado</th>
                    <th>Fecha de Envío</th>
                    <th>Fecha Estimada de Entrega</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>
                @foreach($envios as $envio)
                    <tr>
                        <td>{{ $envio->total_orden }}</td>
                        <td>${{ number_format($envio->costo_envio, 2) }}</td>
                        <td>{{ $envio->estado_envio }}</td>
                        <td>{{ $envio->fecha_envio }}</td>
                        <td>{{ $envio->fecha_entrega }}</td>
                        <td>
                            <button class="btn btn-primary ver-detalles" data-id="{{ $envio->orden_id }}" data-bs-toggle="modal" data-bs-target="#detallesOrdenModal">
                                Ver orden
                            </button>
                        </td>                        
                    </tr>
                @endforeach
            </tbody>
            
        </table>
    @endif


<div class="modal fade" id="detallesOrdenModal" tabindex="-1" aria-labelledby="detallesOrdenModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detallesOrdenModalLabel">Detalles de la Orden</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="detallesOrdenContenido">
                    Cargando detalles...
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>

        document.addEventListener('DOMContentLoaded', function () {
    const botonesVerDetalles = document.querySelectorAll('.ver-detalles');

    botonesVerDetalles.forEach(boton => {
        boton.addEventListener('click', function () {
            const ordenId = this.getAttribute('data-id');
            const detallesOrdenContenido = document.getElementById('detallesOrdenContenido');
            
            detallesOrdenContenido.innerHTML = 'Cargando detalles...';

            fetch(`/envios-detalles/${ordenId}`)
                .then(response => response.json())
                .then(data => {
                    let contenido = '<ul>';
                    data.forEach(producto => {
                        contenido += `
                            <li>
                                <img src="${producto.imagen_producto_final}" alt="Imagen de producto" style="width: 50px;">
                                ${producto.producto_nombre} (${producto.talla}) - ${producto.cantidad} x $${producto.detalle_total}
                            </li>`;
                    });
                    contenido += '</ul>';

                    detallesOrdenContenido.innerHTML = contenido;
                })
                .catch(error => {
                    detallesOrdenContenido.innerHTML = 'Error al cargar los detalles.';
                    console.error(error);
                });
        });
    });
});

</script>
@endsection