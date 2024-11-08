@extends('layouts.auth')

@section('content')
<style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        overflow: hidden;

    #btn-primary {
        background-color: black;
        color: white;
        border: none;
    }

    .container-auth {
        width: 100%;
        height: 100vh;
        padding: 0;
    }

    .left-column {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 40px;
        height: 100%;
    }

    .right-column {
        background-image: url('{{ asset('img/playera.jpeg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 100vh;
        padding: 0;
        margin: 0;
    }

    .form-title {
        font-size: 1.8rem;
        font-weight: bold;
        color: black;
        margin-bottom: 20px;
        text-align: center;
    }

    .logo {
        width: 100px;
        height: 100px;
        margin-bottom: 20px;
    }

    .login-link {
        margin-top: 15px;
        font-size: 0.9rem;
        text-align: center;
    }

    .form-container {
        width: 100%;
        max-width: 400px;
        padding: 20px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        background-color: #fff;
        margin-bottom:1.5rem;
    }

    .row.g-0 {
        margin: 0;
        height: 100vh;
    }
</style>

<div class="container-fluid container-auth">
    <div class="row g-0">
        <div class="col-md-6 left-column">
            <a href="{{ url('/') }}">
                <img src="{{ asset('img/ozeztrc.png') }}" alt="OZEZ Logo" class="logo">
            </a>

            <h2 class="form-title text-center">{{ __('Registrarse') }}</h2>

            <div class="form-container">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('Nombre de usuario') }}</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Correo Electrónico') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
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

                    <div class="mb-3">
                        <label for="password-confirm" class="form-label">{{ __('Confirmar Contraseña') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" id="btn-primary" class="btn">{{ __('Registrarse') }}</button>
                    </div>
                </form>

                <!-- Enlace para iniciar sesión si ya tiene una cuenta -->
                <div class="login-link">
                    <p>¿Ya tienes cuenta? <a href="{{ route('login') }}">Iniciar sesión</a></p>
                </div>
            </div>
        </div>

        <div class="col-md-6 right-column"></div>
    </div>
</div>
@endsection
