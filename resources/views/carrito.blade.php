@extends('layouts.app')

@section('content')
<head>
    <!-- Otras etiquetas -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Otros estilos y scripts -->
</head>

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
                <tr class="table-light text-dark">
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
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['attributes']['talla'] }}</td>
                            <td>${{ number_format($item['price'], 2) }}</td>
                            <td>  {{ $item['quantity'] }} 
                            <td class="subtotal">${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                            <td>
                                <button class="btn btn-sm btn-danger eliminar-producto" data-id="{{ $key }}">Eliminar</button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        
        <div class="text-end mt-4">
            <h3 id="carrito-total">Total: ${{ number_format($totalMonto, 2) }}</h3>
            <button id="vaciar-carrito" class="btn btn-danger mt-3">Vaciar Carrito</button>
            <a href="{{ route('detalleOrden') }}" id="comprar-carrito" class="btn btn-success mt-3 {{ empty($contenidoCarrito) || count($contenidoCarrito) === 0 ? 'disabled' : '' }}">Continuar con la compra</a>
        </div>
        
    
</div>

<script>

    document.addEventListener('DOMContentLoaded', () => {

        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        document.getElementById('vaciar-carrito').addEventListener('click', () => {
            fetch('/carrito/vaciar', {
                method: 'POST',
                headers: { 
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
        if (data.success) {
            window.location.reload(); 
        }
    })
    .catch(error => console.error('Error:', error));            
        });

        function actualizarTotal(total) {
            document.querySelector('#carrito-total').textContent = `Total: $${parseFloat(total).toFixed(2)}`;
        }

        const urlEliminar = "{{ route('carrito.eliminar', ':id') }}";


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
                const total = parseFloat(data.total);

                if (total <= 0) {

                location.reload();

                }
                else{
                    const carritoTotal = document.querySelector('#carrito-total');
                    carritoTotal.textContent = `Total: $${total.toFixed(2)}`;
                }
            }
        })
        .catch(error => console.error('Error:', error));
    });
});
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
