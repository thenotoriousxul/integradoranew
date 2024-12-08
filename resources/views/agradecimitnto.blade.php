@extends('layouts.app')

@section('content')
<style>
    .thanks {
        background: url('{{ asset('img/iniciobynimg.jpeg') }}') no-repeat center center;
        background-size: cover;
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        margin: 0;
    }
    
    .thanks::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5); /* Filtro oscuro para mejor contraste */
        filter: blur(8px); /* Efecto de desenfoque */
        z-index: 1;
    }

    .card {
        position: relative;
        z-index: 2;
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
        <p class="mb-4">Tu pedido ha sido confirmado gracias</p>
        
        <section class="bg-light p-3 rounded mb-4">
            <p>Tu pedido llegará a la dirección proporcionada en una semana</p>
        </section>
        <section class="bg-light p-3 rounded mb-4">
            <p>Puedes ver el estado de tu pedido en tu perfil</p>
        </section>
        <a href="{{ route('pedidos') }}" class="btn btn-primary w-100 mb-2">Ver mis pedidos</a>
        <a href="{{ url('/') }}" class="btn btn-outline-primary w-100">Volver a la tienda</a>
    </div>
</div>

@endsection
