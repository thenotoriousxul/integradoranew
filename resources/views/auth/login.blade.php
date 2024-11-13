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
        width: 120px;
        margin-bottom: 20px;
        height: 110px;
    }

    .register-link {
        margin-top: 15px;
        font-size: 0.9rem;
        text-align: center;
    }

    form {
        width: 100%;
        max-width: 500px;
    }

    @media (max-width: 768px) {
        .container-auth {
            height: auto;
        }

        .left-column, .right-column {
            height: auto;
            padding: 20px;
        }

        .right-column {
            display: none; 
        }

        .form-title {
            font-size: 1.5rem;
        }
    }

    @media (max-width: 576px) {
        .form-title {
            font-size: 1.3rem;
        }

        .logo {
            width: 100px;
            height: 90px;
        }

        #btn-black {
            font-size: 0.9rem;
            padding: 10px;
        }
    }
</style>

<div class="container-fluid container-auth">
    <div class="row g-0">
        <div class="col-md-6 left-column">
            <a href="{{ url('/') }}">
                <img src="{{ asset('img/ozeztrc.png') }}" alt="OZEZ Logo" class="logo">
            </a>

            <h2 class="form-title text-center">{{ __('Iniciar sesión') }}</h2>

            <form id="loginForm" method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Correo Electrónico') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                    <div id="emailFeedback" class="invalid-feedback">El correo electrónico no es válido.</div>
                    @error('email')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('Contraseña') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                    <div id="passwordFeedback" class="invalid-feedback">La contraseña debe tener al menos 8 caracteres.</div>
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

        <div class="col-md-6 right-column"></div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const emailField = document.getElementById('email');
        const passwordField = document.getElementById('password');
        const loginForm = document.getElementById('loginForm');

        emailField.addEventListener('input', function() {
            if (emailField.validity.typeMismatch || emailField.validity.valueMissing) {
                emailField.classList.add('is-invalid');
            } else {
                emailField.classList.remove('is-invalid');
            }
        });

        passwordField.addEventListener('input', function() {
            if (passwordField.value.length < 8) {
                passwordField.classList.add('is-invalid');
            } else {
                passwordField.classList.remove('is-invalid');
            }
        });

        loginForm.addEventListener('submit', function(event) {
            if (!emailField.checkValidity() || passwordField.value.length < 8) {
                event.preventDefault();
                if (emailField.validity.valueMissing || emailField.validity.typeMismatch) {
                    emailField.classList.add('is-invalid');
                }
                if (passwordField.value.length < 8) {
                    passwordField.classList.add('is-invalid');
                }
            }
        });
    });
</script>
@endsection
