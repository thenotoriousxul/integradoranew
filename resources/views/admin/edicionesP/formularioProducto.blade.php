@extends('admin.layouts.dashboard')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li> 
            @endforeach
        </ul>
    </div>
@endif
<div class="container my-4" style="background-color: #1f2937; padding: 2rem; border-radius: 2rem;">
    <h1 class="text-center mb-4 text-light">Formulario para agregar un producto a una edición</h1>

    <form action="{{ route('store.productos') }}" method="POST"  enctype="multipart/form-data" class="p-4 shadow rounded" style="background-color: #dde3eb; border-radius: 2rem;">
        @csrf


        <div class="mb-3">
            <label for="nombre" class="form-label fw-bold">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" min="1" placeholder="Ingrese el nombre" required>
        </div>

        <div class="mb-3">
            <label for="edicion_id" class="form-label fw-bold">Edición</label>
            <select name="edicion_id" id="edicion_id" class="form-control" required>
                <option value="" disabled selected>Seleccione una edición</option>
                @foreach ($ediciones as $edicion)
                    <option value="{{ $edicion->id }}">{{ $edicion->nombre_edicion }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Producto</label>
            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#productosModal">
                Seleccionar Producto
            </button>
        </div>


        <input type="hidden" name="productos_id" id="productos_id" required>

        <div id="producto-seleccionado" class="alert alert-info d-none">
            <strong>Producto Seleccionado:</strong> <span id="producto-detalles"></span>
        </div>

        <!-- Cantidad -->
        <div class="mb-3">
            <label for="cantidad" class="form-label fw-bold">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad" class="form-control" min="1" placeholder="Ingrese la cantidad" required>
        </div>

          <div class="mb-4">
                <label class="form-label fw-semibold text-dark" for="imagen_producto_final">Ingresa la imagen del producto</label>
                <input type="file" name="imagen_producto_final" id="imagen_producto_final" class="form-control border rounded" style="background-color: #e9ecef; color: #495057;">
            </div>

        <div class="mb-4">
                <label class="form-label fw-semibold text-dark" for="imagen_producto_trasera">Ingresa la imagen del producto Trasera</label>
                <input type="file" name="imagen_producto_trasera" id="imagen_producto_trasera" class="form-control border rounded" style="background-color: #e9ecef; color: #495057;">
        </div>

        <!-- Botón de Envío -->
        <div class="text-center">
            <button type="submit" class="btn btn-success w-50">Agregar</button>
        </div>
    </form>
</div>



<!-- Modal para Seleccionar Producto -->
<div class="modal fade" id="productosModal" tabindex="-1" aria-labelledby="productosModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productosModalLabel">Seleccionar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    @foreach ($productos as $producto)
                        <div class="col-md-4">
                            <div class="card mb-3 producto-card" 
                                 data-id="{{ $producto->id }}" 
                                 data-detalles="{{ ucfirst($producto->tipo) }} - Color: {{ ucfirst($producto->color) }} - Talla: {{ strtoupper($producto->talla) }}">
                                
                                <!-- Imagen del Producto -->
                                <img src="{{ $producto->imagen_producto }}" 
                                     class="card-img-top" 
                                     alt="{{ ucfirst($producto->tipo) }}" 
                                     style="height: 200px; object-fit: cover;">

                                <div class="card-body">
                                    <h5 class="card-title">{{ ucfirst($producto->tipo) }}</h5>
                                    <p class="card-text">Color: {{ ucfirst($producto->color) }}</p>
                                    <p class="card-text">Talla: {{ strtoupper($producto->talla) }}</p>
                                    <p class="card-text">Lote actual: {{ strtoupper($producto->lote) }}</p>
                                    <button type="button" class="btn btn-primary seleccionar-producto">
                                        Seleccionar
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    document.querySelectorAll('.seleccionar-producto').forEach(button => {
    button.addEventListener('click', function () {
        // Obtener información del producto
        const card = this.closest('.producto-card');
        const productoId = card.getAttribute('data-id');
        const detalles = card.getAttribute('data-detalles');

        // Actualizar campo oculto y mostrar producto seleccionado
        document.getElementById('productos_id').value = productoId;
        document.getElementById('producto-detalles').textContent = detalles;

        // Mostrar el mensaje con el producto seleccionado
        const seleccionadoDiv = document.getElementById('producto-seleccionado');
        seleccionadoDiv.classList.remove('d-none');

        // Cerrar el modal
        const modal = document.querySelector('#productosModal');
        const modalInstance = bootstrap.Modal.getInstance(modal);
        modalInstance.hide();
    });
});

</script>
@endsection
