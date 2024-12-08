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

        <!-- Empleado que realiza la orden -->
        <input type="hidden" name="empleado_id" value="{{ auth()->id() }}">

        <!-- Fecha -->
        <div class="mb-3">
            <label for="fecha" class="form-label fw-bold">Fecha</label>
            <input type="date" name="fecha" id="fecha" class="form-control" value="{{ date('Y-m-d') }}" required>
        </div>

        <!-- Productos -->
        <div class="mb-3" id="productos">
            <h4 class="fw-bold">Detalle de la Orden</h4>
            <div class="producto-row mb-3">
                <div class="row">
                    <div class="col-md-4">
                        <label for="producto" class="form-label">Producto</label>
                        <input type="text" class="form-control" name="productos[]" placeholder="Nombre del producto" required>
                    </div>
                    <div class="col-md-2">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="number" class="form-control" name="cantidades[]" placeholder="Cantidad" required>
                    </div>
                    <div class="col-md-2">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="number" step="0.01" class="form-control" name="precios[]" placeholder="Precio" required>
                    </div>
                    <div class="col-md-2">
                        <label for="total_producto" class="form-label">Total</label>
                        <input type="number" step="0.01" class="form-control" name="totales[]" readonly>
                    </div>
                    <div class="col-md-2 d-flex align-items-center">
                        <button type="button" class="btn btn-danger remove-product" style="width: 100%;">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
        
        <button type="button" id="agregarProducto" class="btn btn-success mb-3">Agregar Producto</button>

        <!-- Total de la orden -->
        <div class="mb-3">
            <label for="total" class="form-label fw-bold">Total de la Orden</label>
            <input type="number" step="0.01" name="total" id="total" class="form-control" readonly>
        </div>

        <!-- Envío a domicilio -->
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
    // Agregar un producto
    document.getElementById('agregarProducto').addEventListener('click', function() {
        const productoRow = document.querySelector('.producto-row');
        const newRow = productoRow.cloneNode(true);
        const productosContainer = document.getElementById('productos');
        productosContainer.appendChild(newRow);
    });

    // Eliminar un producto
    document.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('remove-product')) {
            const row = e.target.closest('.producto-row');
            row.remove();
            calcularTotal();
        }
    });

    // Calcular total por producto
    document.addEventListener('input', function(e) {
        if (e.target && (e.target.name === 'cantidad[]' || e.target.name === 'precios[]')) {
            calcularTotal();
        }
    });

    // Función para calcular el total de la orden
    function calcularTotal() {
        let total = 0;
        const cantidades = document.querySelectorAll('input[name="cantidades[]"]');
        const precios = document.querySelectorAll('input[name="precios[]"]');
        const totales = document.querySelectorAll('input[name="totales[]"]');
        
        for (let i = 0; i < cantidades.length; i++) {
            const cantidad = parseFloat(cantidades[i].value) || 0;
            const precio = parseFloat(precios[i].value) || 0;
            const totalProducto = cantidad * precio;
            totales[i].value = totalProducto.toFixed(2);
            total += totalProducto;
        }

        document.getElementById('total').value = total.toFixed(2);
    }
</script>

@endsection
