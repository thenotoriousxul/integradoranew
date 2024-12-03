@extends('layouts.app')

@section('content')
<div class="container py-5">
    <a href="{{ route('personalizacion') }}" class="btn btn-outline-secondary mb-4">
        <i class="bi bi-arrow-left me-2"></i>
        Volver al Catálogo
    </a>

    <div class="row">
        <!-- Imagen del producto -->
        <div class="col-md-6 mb-4">
            <img src="{{ $producto->imagen_producto_final }}" alt="Imagen de {{ $producto->nombre }}" class="img-fluid rounded">
        </div>

        <!-- Detalles del producto -->
        <div class="col-md-6">
            <h1 class="mb-4">{{ $producto->nombre }}</h1>
            <p class="lead">Cantidad total disponible: {{ $producto->cantidad }}</p>
            <p>Estado: {{ ucfirst($producto->estado) }}</p>
            @if ($producto->rebaja)
                <p class="text-danger">Precio con rebaja: ${{ number_format($producto->precio_rebajado, 2) }}</p>
            @else
                <p>Precio: ${{ number_format($producto->costo_precio_venta, 2) }}</p>
            @endif

            <!-- Filtro por tallas -->
           <!-- Filtro por tallas -->
<div class="mb-4">
    <label class="form-label">Tallas Disponibles:</label>
    <div class="size-options d-flex flex-wrap gap-2">
        @forelse ($tallas as $talla)
            @if ((int) $talla['cantidad'] > 0)
                <button type="button" 
                    class="btn btn-outline-primary size-option available" 
                    data-talla="{{ $talla['talla'] }}" 
                    data-cantidad="{{ $talla['cantidad'] }}" 
                    title="{{ $talla['cantidad'] }} disponibles">
                    {{ $talla['talla'] }}
                </button>
            @else
                <button type="button" 
                    class="btn btn-outline-secondary size-option unavailable" 
                    title="Agotada" 
                    disabled>
                    {{ $talla['talla'] }}
                </button>
            @endif
        @empty
            <p>No hay tallas disponibles para este producto.</p>
        @endforelse
    </div>
</div>


            <!-- Formulario para agregar al carrito -->
            <form action="{{ route('carrito.agregar', $producto->id) }}" method="POST">
                @csrf
                <input type="hidden" name="talla" id="talla-seleccionada" value="">

                <div class="mb-4">
                    <label class="form-label">Cantidad:</label>
                    <select class="form-select quantity-selector" name="cantidad" disabled>
                        <option value="">Seleccione una talla primero</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary w-100" id="agregar-carrito" disabled>
                    Agregar al Carrito
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sizeOptions = document.querySelectorAll('.size-option.available');
        const hiddenTallaInput = document.getElementById('talla-seleccionada');
        const agregarCarritoButton = document.getElementById('agregar-carrito');
        const quantitySelector = document.querySelector('.quantity-selector');

        sizeOptions.forEach(option => {
            option.addEventListener('click', function() {
                // Remover la clase 'active' de todas las opciones
                sizeOptions.forEach(opt => opt.classList.remove('active'));

                // Agregar la clase 'active' a la opción seleccionada
                this.classList.add('active');

                // Actualizar el campo oculto con la talla seleccionada
                hiddenTallaInput.value = this.dataset.talla;

                // Obtener el stock disponible para la talla seleccionada
                const stockDisponible = parseInt(this.dataset.cantidad);

                // Actualizar las opciones del selector de cantidad
                quantitySelector.innerHTML = '';
                for (let i = 1; i <= Math.min(stockDisponible, 5); i++) {
                    const option = document.createElement('option');
                    option.value = i;
                    option.textContent = i;
                    quantitySelector.appendChild(option);
                }

                // Habilitar el botón de agregar al carrito y el selector
                agregarCarritoButton.disabled = false;
                quantitySelector.disabled = false;
            });
        });
    });
</script>

@endsection
