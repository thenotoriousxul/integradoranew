@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 style="font-family: 'Bebas Neue', cursive; font-size: 4rem; letter-spacing: 2px; color: #fff; margin-top: 20px;">
            Mi Perfil
        </h1>
        <hr style="border: 1px solid #fff; max-width: 150px; margin: 0 auto;">
    </div>

    <div class="card mx-auto shadow-lg border-0" style="max-width: 650px; background-color: #212529; border-radius: 15px; overflow: hidden;">
        <div class="card-header text-white" style="background: #000; font-family: 'Bebas Neue', cursive; letter-spacing: 2px; font-size: 1.5rem;">
            Información del Usuario
        </div>
        <div class="card-body py-4 px-5" style="font-family: 'Inter', sans-serif; font-size: 1rem; color: #dee2e6;">
            <p class="card-text mb-4">
                <strong style="color: #fff;">Nombre:</strong> 
                <span style="color: #adb5bd;">{{ Auth::user()->name }}</span>
            </p>
            <p class="card-text mb-4">
                <strong style="color: #fff;">Email:</strong> 
                <span style="color: #adb5bd;">{{ Auth::user()->email }}</span>
            </p>
            <p class="card-text mb-4">
                <strong style="color: #fff;">Registrado el:</strong> 
                <span style="color: #adb5bd;">{{ Auth::user()->created_at->format('d/m/Y') }}</span>
            </p>
        </div>
    </div>

    <div class="card mx-auto shadow-lg border-0 mt-5" style="max-width: 650px; background-color: #212529; border-radius: 15px; overflow: hidden;">
        <div class="card-header text-white" style="background: #000; font-family: 'Bebas Neue', cursive; letter-spacing: 2px; font-size: 1.5rem;">
            Datos de Persona
        </div>
        <div class="card-body py-4 px-5" style="font-family: 'Inter', sans-serif; font-size: 1rem; color: #dee2e6;">
            <p class="card-text mb-4">
                <strong style="color: #fff;">Nombre:</strong> 
                <span style="color: #adb5bd;">Juan</span>
            </p>
            <p class="card-text mb-4">
                <strong style="color: #fff;">Apellido Paterno:</strong> 
                <span style="color: #adb5bd;">Pérez</span>
            </p>
            <p class="card-text mb-4">
                <strong style="color: #fff;">Apellido Materno:</strong> 
                <span style="color: #adb5bd;">López</span>
            </p>
            <p class="card-text mb-4">
                <strong style="color: #fff;">Fecha de Nacimiento:</strong> 
                <span style="color: #adb5bd;">01/01/1990</span>
            </p>
            <p class="card-text mb-4">
                <strong style="color: #fff;">Género:</strong> 
                <span style="color: #adb5bd;">Masculino</span>
            </p>
            <p class="card-text mb-4">
                <strong style="color: #fff;">Teléfono:</strong> 
                <span style="color: #adb5bd;">+52 123 456 7890</span>
            </p>
        </div>
    </div>

    <div class="card mx-auto shadow-lg border-0 mt-5" style="max-width: 650px; background-color: #212529; border-radius: 15px; overflow: hidden;">
        <div class="card-header text-white" style="background: #000; font-family: 'Bebas Neue', cursive; letter-spacing: 2px; font-size: 1.5rem;">
            Dirección
        </div>
        <div class="card-body py-4 px-5" style="font-family: 'Inter', sans-serif; font-size: 1rem; color: #dee2e6;">
            <p class="card-text mb-4">
                <strong style="color: #fff;">Calle:</strong> 
                <span style="color: #adb5bd;">Av. Reforma</span>
            </p>
            <p class="card-text mb-4">
                <strong style="color: #fff;">Colonia:</strong> 
                <span style="color: #adb5bd;">Centro</span>
            </p>
            <p class="card-text mb-4">
                <strong style="color: #fff;">Número Exterior:</strong> 
                <span style="color: #adb5bd;">123</span>
            </p>
            <p class="card-text mb-4">
                <strong style="color: #fff;">Número Interior:</strong> 
                <span style="color: #adb5bd;">4B</span>
            </p>
            <p class="card-text mb-4">
                <strong style="color: #fff;">Estado:</strong> 
                <span style="color: #adb5bd;">Ciudad de México</span>
            </p>
            <p class="card-text mb-4">
                <strong style="color: #fff;">Código Postal:</strong> 
                <span style="color: #adb5bd;">06000</span>
            </p>
            <p class="card-text mb-4">
                <strong style="color: #fff;">País:</strong> 
                <span style="color: #adb5bd;">México</span>
            </p>
            <p class="card-text mb-4">
                <strong style="color: #fff;">Creado el:</strong> 
                <span style="color: #adb5bd;">{{ now()->format('d/m/Y') }}</span>
            </p>
        </div>
    </div>
</div>

@section('styles')
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
<style>
    body {
        background-color: #121212; 
        color: #fff; 
    }
</style>
@endsection
@endsection
