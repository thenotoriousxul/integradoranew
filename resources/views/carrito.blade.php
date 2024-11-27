@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-4">
        <h1 style="font-family: 'Bebas Neue', cursive; font-size: 3rem; letter-spacing: 2px; color: #000;">
            Carrito de Compras
        </h1>
        <hr style="border: 1px solid #fff; max-width: 200px; margin: 0 auto;">
    </div>

    <div id="carrito-container" class="table-responsive bg-dark p-4 rounded shadow-lg">
        <table class="table table-dark table-hover text-center align-middle">
            <thead>
                <tr class="table-light text-dark" style="font-family: 'Bebas Neue', cursive; font-size: 1.2rem;">
                    <th>Producto</th>
                    <th>Talla</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="carrito-body">
                @if(empty($contenidoCarrito) || count($contenidoCarrito) === 0)
                <tr>
                    <td colspan="6" class="text-center text-white">Tu carrito está vacío.</td>
                </tr>
                @else
                    @foreach($contenidoCarrito as $key => $item)
                        <tr data-id="{{ $key }}">
                            <td class="d-flex align-items-center justify-content-center">
                                <img src="{{ $item['attributes']['imagen'] ?? asset('img/default.jpg') }}" alt="{{ $item['name'] }}" class="me-3 rounded-circle" style="width: 50px; height: 50px;">
                                <span style="font-family: 'Inter', sans-serif;">{{ $item['name'] }}</span>
                            </td>
                            <td>{{ $item['attributes']['talla'] ?? 'N/A' }}</td>
                            <td style="font-family: 'Inter', sans-serif;">${{ number_format($item['price'], 2) }}</td>
                            <td>
                                <input type="number" name="cantidad" value="{{ $item['quantity'] }}" min="1" class="form-control actualizar-cantidad text-center mx-auto" style="width: 80px; font-family: 'Inter', sans-serif;">
                            </td>
                            <td class="subtotal" style="font-family: 'Inter', sans-serif;">${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                            <td>
                                <button class="btn btn-sm btn-danger eliminar-producto" data-id="{{ $key }}" style="font-family: 'Bebas Neue', cursive;">Eliminar</button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <div class="text-end mt-4">
        <h3 id="carrito-total" style="font-family: 'Inter', sans-serif;">Total: ${{ number_format($totalMonto, 2) }}</h3>
        <button id="vaciar-carrito" class="btn btn-danger mt-3 px-4 py-2" style="font-family: 'Bebas Neue', cursive; font-size: 1.2rem;">Vaciar Carrito</button>
        <a href="{{ route('detalleOrden') }}" id="comprar-carrito" 
           class="btn btn-success mt-3 px-4 py-2 {{ empty($contenidoCarrito) || count($contenidoCarrito) === 0 ? 'disabled' : '' }}" 
           style="font-family: 'Bebas Neue', cursive; font-size: 1.2rem;">Continuar con la compra</a>
    </div>
    
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        // Actualizar cantidad
        document.querySelectorAll('.actualizar-cantidad').forEach(input => {
            input.addEventListener('change', function () {
                fetch(`/carrito/actualizar/${this.closest('tr').dataset.id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ cantidad: this.value })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        this.closest('tr').querySelector('.subtotal').textContent = `$${data.subtotal.toFixed(2)}`;
                        actualizarTotal(data.total);
                    }
                });
            });
        });

        // Eliminar producto
        document.querySelectorAll('.eliminar-producto').forEach(button => {
            button.addEventListener('click', function () {
                const productoId = this.dataset.id;

                fetch(`/carrito/eliminar/${productoId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Eliminar la fila de la tabla
                        this.closest('tr').remove();
                        actualizarTotal(data.total);

                        // Si el carrito está vacío, mostrar mensaje
                        if (data.total == 0) {
                            document.querySelector('#carrito-body').innerHTML = '<tr><td colspan="6" class="text-center text-white">Tu carrito está vacío.</td></tr>';
                            document.getElementById('comprar-carrito').classList.add('disabled');
                        }
                    }
                });
            });
        });

        // Vaciar carrito
        document.getElementById('vaciar-carrito').addEventListener('click', () => {
            fetch('/carrito/vaciar', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': csrfToken }
            }).then(() => {
                location.reload(); 
            }).catch(error => console.error('Error al vaciar el carrito:', error));
        });

        function actualizarTotal(total) {
            document.querySelector('#carrito-total').textContent = `Total: $${total.toFixed(2)}`;
        }
    });
</script>

@section('styles')
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
<style>
    body {
        background-color: #121212;
        color: #fff;
    }
    table th {
        border-bottom: 2px solid #343a40;
    }
    table td {
        vertical-align: middle;
    }
</style>
@endsection
@endsection
