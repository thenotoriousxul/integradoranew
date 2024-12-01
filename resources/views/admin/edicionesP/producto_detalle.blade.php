@extends('layouts.app')

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
    </div>
@endif

<style>
    :root {
        --primary-color: #5865F2;
        --secondary-color: #99AAB5;
        --background-color: #ffffff;
        --text-color: #2c2f33;
        --border-color: #e3e5e8;
    }

    .product-image-container {
        position: relative;
        background-color: #f6f6f6;
        border-radius: 8px;
        overflow: hidden;
    }

    .product-image {
        width: 100%;
        height: auto;
        object-fit: cover;
    }

    .product-title {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .product-price {
        font-size: 20px;
        color: var(--primary-color);
        font-weight: 600;
        margin-bottom: 24px;
    }

    .size-options {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-bottom: 24px;
    }

    .size-option {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        width: 50px;
        height: 50px;
        border: 1px solid var(--border-color);
        border-radius: 50%;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
        color: var(--text-color);
    }

    /* Estilo para tallas disponibles */
    .size-option.available {
        background-color: #ffffff;
        color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .size-option.available:hover {
        background-color: var(--primary-color);
        color: white;
        transform: scale(1.1);
    }

    /* Estilo para tallas agotadas */
    .size-option.unavailable {
        background-color: #f6f6f6;
        color: #999999;
        border-color: #cccccc;
        cursor: not-allowed;
        text-decoration: line-through;
    }

    .btn-add-cart {
        background-color: var(--primary-color);
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 4px;
        font-weight: 600;
        width: 100%;
        transition: all 0.2s ease;
    }

    .btn-add-cart:hover {
        background-color: #4752c4;
        color: white;
    }

    .btn-add-cart:disabled {
        background-color: #cccccc;
        cursor: not-allowed;
    }
</style>

<div class="container py-5">
    <a href="{{ route('mostrar.productos') }}" class="back-link mb-4">
        <i class="bi bi-arrow-left me-2"></i>
        Volver a la Tienda
    </a>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="row">
        <div class="col-md-6 mb-4 mb-md-0">
            <div class="product-image-container">
                <img src="{{ $producto->imagen_producto_final ?? '/placeholder.svg?height=600&width=600' }}" alt="{{ $producto->nombre }}" class="product-image">
            </div>
        </div>
        <div class="col-md-6">
            <h1 class="product-title">{{ ucfirst($producto->nombre) }}</h1>
            @if($producto->rebaja)
            <div class="product-price"> ${{ number_format($producto->rebaja ? $producto->precio_rebajado : $producto->costo_precio_venta, 2) }}</div>            
            @else
            <div class="product-price">${{ number_format($producto->costo_precio_venta, 2) }}</div>
            @endif
            <div class="mb-4">
                <label class="form-label">Medidas</label>
                <div class="size-options">
                    @foreach ($tallas as $talla)
                        @if ($talla['cantidad'] > 0)
                            <div class="size-option available"
                                data-talla="{{ $talla['talla'] }}"
                                data-cantidad="{{ $talla['cantidad'] }}"
                                title="{{ $talla['cantidad'] }} disponibles">
                                {{ $talla['talla'] }}
                            </div>
                        @else
                            <div class="size-option unavailable" title="Agotada">
                                {{ $talla['talla'] }}
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
 
            <form action="{{ route('carrito.agregar', $producto->id) }}" method="POST">
                @csrf
                <input type="hidden" name="talla" id="talla-seleccionada" value="">

                <div class="mb-4">
                    <label class="form-label">Cantidad</label>
                    <select class="form-select quantity-selector" name="cantidad">
                        <!-- Opciones de cantidad se actualizarán dinámicamente -->
                    </select>
                    <p>Selecciona una talla para ver el stock disponible.</p>
                </div>

                <button type="submit" class="btn btn-add-cart" id="agregar-carrito" disabled>
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

            // Establecer el máximo entre 1 y 5 (o menos si no hay suficiente stock)
            const maxSeleccionable = Math.min(stockDisponible, 5);

            // Actualizar las opciones del selector de cantidad
            quantitySelector.innerHTML = ''; // Vaciar las opciones actuales
            for (let i = 1; i <= maxSeleccionable; i++) {
                const option = document.createElement('option');
                option.value = i;
                option.textContent = i;
                quantitySelector.appendChild(option);
            }

            // Habilitar el botón de agregar al carrito
            agregarCarritoButton.disabled = false;

            console.log('Talla seleccionada:', this.dataset.talla, 'Stock disponible:', stockDisponible, 'Max permitido:', maxSeleccionable);
        });
    });
});

</script>
@endsection
