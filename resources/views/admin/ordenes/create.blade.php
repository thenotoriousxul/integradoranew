@extends('admin.layouts.dashboard')

@section('content')

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container my-4" style="background-color: #1f2937; padding: 2rem; border-radius: 2rem;">
    <h2 class="text-center mb-4 text-light">Crear Nueva Orden (Punto de Venta)</h2>

    <form action="{{ route('admins.ordenes.store') }}" method="POST" class="p-4 shadow rounded" style="background-color: #dde3eb; border-radius: 2rem;">
        @csrf

        <div class="mb-3" id="productos">
            <h4 class="fw-bold">Detalle de la Orden</h4>
            <div class="producto-row mb-3">
                <div class="row">
                    <div class="col-md-4">
                        <label for="producto" class="form-label">Producto</label>
                        <select name="productos[]" class="form-control producto" required>
                            <option value="">Seleccione un producto</option>
                            @foreach($productos as $producto)
                                <option value="{{ $producto->id }}" data-precio="{{ $producto->costo_precio_venta }}" data-lote="{{ $producto->cantidad }}">
                                    {{ $producto->nombre }} - ${{ $producto->costo_precio_venta }} - lote: {{$producto->cantidad}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="number" class="form-control cantidad" name="cantidades[]" placeholder="Cantidad" required>
                    </div>
                    <div class="col-md-2">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="number" step="0.01" class="form-control precio" name="precios[]" placeholder="Precio" readonly>
                    </div>
                    <div class="col-md-2">
                        <label for="total_producto" class="form-label">Total</label>
                        <input type="number" step="0.01" class="form-control total_producto" name="totales[]" readonly>
                    </div>
                    <div class="col-md-2 d-flex align-items-center">
                        <button type="button" class="btn btn-danger remove-product" style="width: 100%;">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>

        <button type="button" id="agregarProducto" class="btn btn-success mb-3">Agregar Producto</button>

       
        <div class="mb-3">
            <label for="total" class="form-label fw-bold">Total de la Orden</label>
            <input type="number" step="0.01" name="total" id="total" class="form-control" readonly>
        </div>

      
        <div class="mb-3">
            <label for="envios_domicilio" class="form-label fw-bold">Envío a domicilio</label>
            <select name="envios_domicilio" id="envios_domicilio" class="form-select" required>
                <option value="1">Sí</option>
                <option value="0">No</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Orden</button>
        <a href="{{ route('admins.ordenes.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<script>
    document.getElementById('agregarProducto').addEventListener('click', function() {
        const productoRow = document.querySelector('.producto-row');
        const newRow = productoRow.cloneNode(true);
        const productosContainer = document.getElementById('productos');

        newRow.querySelectorAll('input').forEach(input => input.value = '');
        productosContainer.appendChild(newRow);
    });

    document.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('remove-product')) {
            const row = e.target.closest('.producto-row');
            row.remove();
            actualizarTotalOrden();
        }
    });

    
    document.getElementById('productos').addEventListener('change', function(e) {
        if (e.target && e.target.classList.contains('producto')) {
            const producto = e.target.selectedOptions[0];
            const precio = parseFloat(producto.dataset.precio) || 0;
            const cantidadInput = e.target.closest('.producto-row').querySelector('.cantidad');
            const precioInput = e.target.closest('.producto-row').querySelector('.precio');
            const totalInput = e.target.closest('.producto-row').querySelector('.total_producto');
            const cantidadDisponible = parseInt(producto.dataset.lote) || 0; 
            precioInput.value = precio;

            
            cantidadInput.max = cantidadDisponible;
            
            
            cantidadInput.addEventListener('input', function() {
                let cantidad = parseInt(cantidadInput.value) || 0;
                if (cantidad > cantidadDisponible) {
                    cantidad = cantidadDisponible;
                    cantidadInput.value = cantidad;
                    alert("La cantidad seleccionada excede el stock disponible.");
                }
                totalInput.value = (precio * cantidad).toFixed(2);
                actualizarTotalOrden();
            });
        }
    });

    // Calcular el total de la orden
    function actualizarTotalOrden() {
        let totalOrden = 0;
        document.querySelectorAll('.total_producto').forEach(function(input) {
            totalOrden += parseFloat(input.value) || 0;
        });
        document.getElementById('total').value = totalOrden.toFixed(2);
    }
</script>

@endsection
