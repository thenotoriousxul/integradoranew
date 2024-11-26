@extends('layouts.app')

@section('content')

<style>
    .thanks {
        background-color: #f8f9fa;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        margin: 0;
    }
    .icon {
        font-size: 3rem;
        color: #0d6efd;
    }
</style>
<div class="thanks">
<div class="card shadow p-4 text-center" style="max-width: 400px;">
    <i class="bi bi-check-circle icon mb-3"></i>
    <h1 class="h3 mb-3">¡Gracias por tu compra!</h1>
    <p class="mb-4">Tu pedido ha sido confirmado</p>
    
    <section class="bg-light p-3 rounded mb-4 text-start">
        <div class="d-flex align-items-center mb-3">
            <i class="bi bi-box me-3 text-primary"></i>
            <div>
                <h2 class="h5 mb-0">Producto Comprado</h2>
                <p class="mb-0 text-muted">Camiseta Premium</p>
            </div>
        </div>
        <div class="d-flex align-items-center">
            <i class="bi bi-truck me-3 text-primary"></i>
            <div>
                <h2 class="h5 mb-0">Envío Estimado</h2>
                <p class="mb-0 text-muted">3-5 días hábiles</p>
            </div>
        </div>
    </section>
    
    <a href="#" class="btn btn-primary w-100 mb-2">Ver mis pedidos</a>
    <a href="#" class="btn btn-outline-primary w-100">Volver a la tienda</a>
</div>
</div>

@endsection