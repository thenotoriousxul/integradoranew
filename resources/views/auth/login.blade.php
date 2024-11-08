@extends('layouts.auth')

@section('content')
<style>
    #btn-black {
        background-color: black;
        color: white;
        border: none;
    }

    .left-column {
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 40px;
        height: 100vh;
    }

    .right-column {
        background-image: url('{{ asset('img/playera.jpeg') }}');
        background-size: cover;
        background-position: center;
        height: 100vh;
        padding: 0; /* Elimina cualquier espacio */
        margin: 0; /* Elimina el margen */
    }

    .form-title {
        font-size: 1.8rem;
        font-weight: bold;
        color: black;
        margin-bottom: 20px;
    }

    /* Limita el ancho del contenedor para que no afecte el navbar */
    .container-auth {
        max-width: 100%; /* Ocupa todo el ancho de la pantalla */
    }
</style>

<div class="container-fluid container-auth">
    <div class="row g-0">
        <!-- Columna izquierda con el formulario -->
        <div class="col-md-6 left-column">
            <h2 class="form-title text-center">{{ __('Iniciar sesión') }}</h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Correo Electrónico') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('Contraseña') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                    @error('password')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" name="remember" id="remember">
                    <label class="form-check-label" for="remember">{{ __('Recordarme') }}</label>
                </div>

                <div class="d-grid">
                    <button type="submit" id="btn-black" class="btn">{{ __('Ingresar') }}</button>
                </div>
                <div class="text-center mt-3">
                    <a href="{{ route('password.request') }}">{{ __('¿Olvidaste tu contraseña?') }}</a>
                </div>
            </form>
        </div>

        <!-- Columna derecha con la imagen de fondo -->
        <div class="col-md-6 right-column"></div>
    </div>
</div>
@endsection
