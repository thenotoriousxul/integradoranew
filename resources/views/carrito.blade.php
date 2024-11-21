@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="text-center mb-4">Carrito de Compras</h1>

    <div id="carrito-container" class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="carrito-body">
                @if(empty($contenidoCarrito) || count($contenidoCarrito) === 0)
                <tr>
                    <td colspan="5" class="text-center">Tu carrito está vacío.</td>
                </tr>
                @else
                    @foreach($contenidoCarrito as $item)
                        <tr data-id="{{ $item['id'] }}">
                            <td>
                                <img src="{{ $item['attributes']['imagen'] ?? 'ruta-a-imagen-default.jpg' }}" alt="{{ $item['name'] }}" style="width: 50px; height: 50px;">
                                {{ $item['name'] }}
                            </td>
                            <td>${{ number_format($item['price'], 2) }}</td>
                            <td>
                                <input type="number" name="cantidad" value="{{ $item['quantity'] }}" min="1" class="form-control actualizar-cantidad" style="width: 80px;">
                            </td>
                            <td class="subtotal">${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                            <td>
                                <button class="btn btn-sm btn-danger eliminar-producto" data-id="{{ $item['id'] }}">Eliminar</button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <div class="text-end mt-4">
        <button id="vaciar-carrito" class="btn btn-danger mt-3">Vaciar Carrito</button>
        <button id="comprar-carrito" class="btn btn-success mt-3">Proceder al Pago</button>
    </div>
</div>







<!-- Script para manejar la actualización y eliminación de productos -->

<script>
   document.addEventListener('DOMContentLoaded', function () {
    // URL base para las rutas
    const urlActualizar = "{{ route('carrito.actualizar', ':id') }}";
    const urlEliminar = "{{ route('carrito.eliminar', ':id') }}";
    const urlVaciar = "{{ route('carrito.vaciar') }}";

    // Actualizar cantidad del producto
    document.querySelectorAll('.actualizar-cantidad').forEach(input => {
        input.addEventListener('change', function () {
            const idProducto = this.closest('tr').dataset.id;
            const cantidad = this.value;

            // Reemplazar :id con el valor real
            const url = urlActualizar.replace(':id', idProducto);

            fetch(url, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ cantidad: cantidad })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Actualizar subtotal y total sin recargar
                    this.closest('tr').querySelector('.subtotal').innerText = `$${data.subtotal.toFixed(2)}`;
                    document.querySelector('#total-carrito').innerText = `Total: $${data.total.toFixed(2)}`;
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });

    // Eliminar producto
    document.querySelectorAll('.eliminar-producto').forEach(button => {
        button.addEventListener('click', function () {
            const idProducto = this.dataset.id;
            const url = urlEliminar.replace(':id', idProducto);

            fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Remover fila sin recargar la página
                    this.closest('tr').remove();
                    document.querySelector('#total-carrito').innerText = `Total: $${data.total.toFixed(2)}`;
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });

    // Vaciar carrito
    document.getElementById('vaciar-carrito').addEventListener('click', function () {
        fetch(urlVaciar, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Vaciar tabla sin recargar
                document.getElementById('carrito-body').innerHTML = '<tr><td colspan="5" class="text-center">Tu carrito está vacío.</td></tr>';
                document.querySelector('#total-carrito').innerText = 'Total: $0.00';
            }
        })
        .catch(error => console.error('Error:', error));
    });
});

</script>



@endsection
