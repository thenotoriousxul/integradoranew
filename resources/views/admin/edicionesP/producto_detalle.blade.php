

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
    .items-left-badge {
        position: absolute;
        top: 16px;
        right: 16px;
        background-color: var(--primary-color);
        color: white;
        padding: 8px 12px;
        border-radius: 4px;
        font-size: 14px;
        font-weight: 600;
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

    .nav-tabs {
        border-bottom: 1px solid var(--border-color);
        margin-bottom: 24px;
    }

    .nav-tabs .nav-link {
        color: var(--text-color);
        border: none;
        padding: 8px 16px;
        font-weight: 500;
    }

    .nav-tabs .nav-link.active {
        color: var(--primary-color);
        border-bottom: 2px solid var(--primary-color);
        background: none;
    }

    .color-options {
        display: flex;
        gap: 8px;
        margin-bottom: 24px;
    }

    .color-option {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        border: 2px solid var(--border-color);
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .color-option.active {
        border-color: var(--primary-color);
        transform: scale(1.1);
    }

    .size-options {
        display: flex;
        gap: 8px;
        margin-bottom: 24px;
    }

    .size-option {
        padding: 8px 16px;
        border: 1px solid var(--border-color);
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .size-option.active {
        background-color: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }

    .quantity-selector {
        width: 120px;
        margin-bottom: 24px;
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

    .back-link {
        color: var(--text-color);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        margin-bottom: 24px;
    }

    .back-link:hover {
        color: var(--primary-color);
    }
</style>



<div class="container py-5">
    <a href="" class="back-link mb-4">
        <i class="bi bi-arrow-left me-2"></i>
        Volver a la Tienda
    </a>

    <div class="row">
        <div class="col-md-6 mb-4 mb-md-0">
            <div class="product-image-container">
                <img src="{{ $producto->imagen_producto_final ?? '/placeholder.svg?height=600&width=600' }}" alt="{{ $producto->nombre }}" class="product-image">
            </div>
        </div>
        <div class="col-md-6">
            <h1 class="product-title">{{ $producto->nombre }}</h1>
            <div class="product-price">${{ number_format($producto->costo_precio_venta, 2) }}</div>

            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <div class="nav-link active" href="#description">DESCRIPTION</div>
                </li>
            </ul>

            <div class="tab-content mb-4">
                <div class="tab-pane fade show active" id="description">
                    <p>{{ $producto->descripcion }}</p>
                    <p class="text-danger">watsthisshit</p>
                </div>
            </div>


            

            <div class="mb-4">
                <label class="form-label">Medidas</label>
                <div class="size-options">
                    <div class="size-option">XS</div>
                    <div class="size-option">S</div>
                    <div class="size-option active">M</div>
                    <div class="size-option">L</div>
                    <div class="size-option">XL</div>
                </div>
            </div>

            <form action="{{ route('carrito.agregar', $producto->id) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="form-label">QUANTITY</label>
                    <select class="form-select quantity-selector" name="cantidad">
                        @for ($i = 1; $i <= min(5, $producto->stock); $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <button type="submit" class="btn btn-add-cart">
                  Agregar al Carrito
                </button>
            </form>
        </div>
    </div>
</div>

    <div class="card border-0 shadow rounded-3">
        <div class="card-body p-4">
            <h4 class="card-title mb-4">¿Necesitas ayuda?</h4>
            <p>Nuestro equipo de atención al cliente está disponible para responder tus preguntas.</p>
            <a href="#" class="btn btn-outline-primary w-100 py-2 rounded-pill">
                <i class="bi bi-chat-dots me-2"></i> Chatear ahora
            </a>
        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const sizeOptions = document.querySelectorAll('.size-option');
    
    sizeOptions.forEach(option => {
        option.addEventListener('click', function() {
            // Remove 'active' class from all options
            sizeOptions.forEach(opt => opt.classList.remove('active'));
            
            // Add 'active' class to the clicked option
            this.classList.add('active');
            
            // You can add additional logic here, such as updating a hidden input
            // or triggering other actions based on the selected size
            console.log('Selected size:', this.textContent);
        });
    });
});
</script>
@endsection
