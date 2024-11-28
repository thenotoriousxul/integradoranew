@extends('cliente.layouts.dashboard')

@section('content')

<style>

.main-container {
            padding: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }
        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            text-decoration: none;
            color: #000;
        }

        .section-title {
            font-size: 1.25rem;
            margin-bottom: 1.5rem;
            font-weight: 500;
        }

        .orders-list {
            display: grid;
            gap: 1.5rem;
        }

        .order-card {
            border: 1px solid #e2e2e2;
            border-radius: 4px;
            padding: 1.5rem;
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .order-number {
            font-weight: bold;
        }

        .order-date {
            color: #666;
        }

        .order-details {
            display: grid;
            gap: 1rem;
        }

        .order-item {
            display: flex;
            gap: 1rem;
        }

        .item-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 4px;
        }

        .item-info {
            flex: 1;
        }

        .item-name {
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .item-details {
            color: #666;
            font-size: 0.9rem;
        }

        .order-total {
            text-align: right;
            font-weight: bold;
            margin-top: 1rem;
        }
</style>

<div class="main-container">
    <header class="header">
        <a href="#" class="logo">OZEZ</a>
    </header>

    <section>
        <h2 class="section-title">Mis Órdenes</h2>
        
        @if ($ordenes->isEmpty())
        <p>No tienes pedidos registrados.</p>
    @else
    @foreach ($ordenes as $orden)
        <div class="orders-list">
            <div class="order-card">
                <div class="order-header">
                    <span class="order-number">Orden {{ $orden->id }}</span>
                    <span class="order-date">{{ $orden->fecha }}</span>
                </div>
                <div class="order-details">
                    <div class="order-item">
                        <img src="/placeholder.svg?height=80&width=80" alt="Camiseta básica" class="item-image">
                        <div class="item-info">
                            <div class="item-name">Camiseta básica</div>
                            <div class="item-details">Talla: M | Color: Negro | Cantidad: 2</div>
                        </div>
                    </div>
                    
                </div>
                <div class="order-total">${{ number_format($orden->total, 2) }}</div>
            </div>
            @endforeach
            @endif

        </div>
    </section>
</div>
@endsection
