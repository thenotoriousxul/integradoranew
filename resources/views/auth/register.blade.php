@extends('layouts.auth')

@section('content')
<style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        overflow: hidden;
    }

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
        height: 100vh;
    }

    .right-column {
        background-image: url('{{ asset('img/loginimg.jpeg') }}');
        background-size: contain;
        background-position: top 10% center;
        height: 100vh;
        padding: 0;
        margin: 0;
    }

    .form-title {
        font-size: 1.8rem;
        font-weight: bold;
        color: black;
        margin-bottom: 10px;
        text-align: center;
    }

    .logo {
        width: 120px;
        height: 110px;
        margin-top: 5px;
    }

    .login-link {
        margin-top: 10px;
        font-size: 0.9rem;
        text-align: center;
    }

    .form-container {
        width: 100%;
        max-width: 500px;
        margin-bottom: 30px;
    }

    .password-hint, .email-hint, .confirm-password-hint {
        font-size: 0.8rem;
        color: #6c757d;
        margin-top: 5px;
    }

    /* Media Queries */
    @media (max-width: 768px) {
        .container-auth {
            height: auto;
        }

        .left-column, .right-column {
            height: auto;
            padding: 20px;
        }

        .right-column {
            display: none; /* Oculta la columna de imagen en pantallas medianas */
        }

        .form-title {
            font-size: 1.5rem;
        }

        .logo {
            width: 100px;
            height: 90px;
        }

        #btn-primary {
            font-size: 0.9rem;
            padding: 10px;
        }
    }

    @media (max-width: 576px) {
        .form-title {
            font-size: 1.3rem;
        }

        .login-link {
            font-size: 0.8rem;
        }

        .form-container {
            max-width: 100%;
        }
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
                <form method="POST" action="{{ route('register') }}" id="registerForm">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('Nombre de usuario') }}</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Correo electrónico') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                        <div id="email-hint" class="email-hint"></div>
                        @error('email')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Contraseña') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                        <div id="password-hint" class="password-hint">
                            La contraseña debe tener al menos 8 caracteres, incluyendo mayúsculas, minúsculas y números.
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password-confirm" class="form-label">{{ __('Confirmar contraseña') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        <div id="confirm-password-hint" class="confirm-password-hint"></div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" id="btn-primary" class="btn">{{ __('Registrarse') }}</button>
                    </div>
                </form>

                <div class="login-link">
                    <p>¿Ya tienes cuenta? <a href="{{ route('login') }}">Iniciar sesión</a></p>
                </div>
            </div>
        </div>

        <div class="col-md-6 right-column"></div>
    </div>
</div>

<script>
    document.getElementById('password').addEventListener('input', function () {
        const password = this.value;
        const hint = document.getElementById('password-hint');
        const rules = [
            { regex: /.{8,}/, message: 'Mínimo 8 caracteres' },
            { regex: /[A-Z]/, message: 'Al menos una letra mayúscula' },
            { regex: /[a-z]/, message: 'Al menos una letra minúscula' },
            { regex: /\d/, message: 'Al menos un número' }
        ];

        const missingRules = rules.filter(rule => !rule.regex.test(password)).map(rule => rule.message);

        hint.innerHTML = missingRules.length ? `La contraseña necesita: ${missingRules.join(', ')}` : 'La contraseña cumple con los requisitos';
        hint.style.color = missingRules.length ? '#dc3545' : '#28a745';
    });

    document.getElementById('password-confirm').addEventListener('input', function () {
        const password = document.getElementById('password').value;
        const confirmPassword = this.value;
        const hint = document.getElementById('confirm-password-hint');

        if (confirmPassword !== password) {
            hint.innerHTML = 'Las contraseñas no coinciden';
            hint.style.color = '#dc3545';
        } else {
            hint.innerHTML = 'Las contraseñas coinciden';
            hint.style.color = '#28a745';
        }
    });

    document.getElementById('email').addEventListener('input', function () {
        const email = this.value;
        const hint = document.getElementById('email-hint');
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!emailPattern.test(email)) {
            hint.innerHTML = 'El correo electrónico no es válido';
            hint.style.color = '#dc3545';
        } else {
            hint.innerHTML = 'Correo electrónico válido';
            hint.style.color = '#28a745';
        }
    });
</script>
@endsection
