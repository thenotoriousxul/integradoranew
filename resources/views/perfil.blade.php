@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="text-center mb-4">Mi Perfil</h1>
    
    <div class="card mx-auto" style="max-width: 600px;">
        <div class="card-body">
            <h5 class="card-title">Información del Usuario</h5>
            <p class="card-text"><strong>Nombre:</strong> {{ Auth::user()->name }}</p>
            <p class="card-text"><strong>Email:</strong> {{ Auth::user()->email }}</p>
            <p class="card-text"><strong>Registrado el:</strong> {{ Auth::user()->created_at->format('d/m/Y') }}</p>

            <a href="#" class="btn btn-primary">Editar Perfil</a>
        </div>
    </div>
</div>
@endsection
