@extends('layouts.auth')

@section('content')
<style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        overflow-x: hidden;
    }

    .container-auth, .row.g-0 {
        width: 100%;
        height: 100vh;
        margin: 0;
        padding: 0;
    }

    #btn-black {
        background-color: black;
        color: white;
        border: none;
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
        margin-bottom: 20px;
        height:100px;
    }

    .register-link {
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
    }
</style>

<div class="container-fluid container-auth">
    <div class="row g-0">
        <div class="col-md-6 left-column">
            <a href="{{ url('/') }}">
                <img src="{{ asset('img/ozeztrc.png') }}" alt="OZEZ Logo" class="logo">
            </a>

            <div class="form-container">
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

                <div class="register-link">
                    <p>¿No tienes una cuenta? <a href="{{ route('register') }}">Regístrate</a></p>
                </div>
            </div>
        </div>

        <div class="col-md-6 right-column"></div>
    </div>
</div>
@endsection
