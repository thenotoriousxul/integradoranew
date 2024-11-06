@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="text-center mb-4">Dashboard del Cliente</h1>
    
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Mis Pedidos</h5>
            <p class="card-text">Visualiza y realiza un seguimiento de tus pedidos recientes.</p>
            <a href="#" class="btn btn-primary">Ver Mis Pedidos</a>
        </div>
    </div>
    
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Mi Perfil</h5>
            <p class="card-text">Actualiza tu información personal y cambia tu contraseña.</p>
            <a href="{{ route('perfil') }}" class="btn btn-secondary">Ir a Mi Perfil</a>
        </div>
    </div>
</div>
@endsection
