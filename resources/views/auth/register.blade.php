@extends('layouts.auth')
@section('content')
<style>
    body {
        font-family: 'Inter', sans-serif;
    }
    .title {
        font-family: 'Inter', sans-serif;
        font-weight: bold;
    }
    .password-hint, .email-hint, .confirm-password-hint {
        font-size: 0.85rem;
        margin-top: 5px;
    }
</style>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li> 
            @endforeach
        </ul>
    </div>
@endif
<div class="container-fluid vh-100">
    <div class="row h-100">
        <!-- Columna izquierda: Formulario -->
        <div class="col-lg-6 d-flex align-items-center justify-content-center bg-white p-4">
            <div class="w-100" style="max-width: 400px;">
                <!-- Logo y título -->
                <div class="text-center mb-4">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('img/ozeztrc.png') }}" alt="Logo" class="img-fluid mb-3" style="max-height: 80px;">
                    </a>
                    <h2 class="title" style="font-size: 1.8rem;">{{ __('Regístrate') }}</h2>
                </div>

                <form method="POST" action="{{ route('register') }}" id="registerForm">
                    @csrf

                    <!-- Usuario -->
                    <h4 class="text-dark mb-3" style="font-size: 1rem;">{{ __('Información de Usuario') }}</h4>
                    <div class="mb-2">
                        <label for="name" class="form-label" style="font-size: 0.85rem;">{{ __('Nombre de usuario') }}</label>
                        <input id="name" type="text" class="form-control form-control-sm" name="name" required>
                        <div class="invalid-feedback">El nombre de usuario es obligatorio.</div>
                    </div>
                    <div class="mb-2">
                        <label for="email" class="form-label" style="font-size: 0.85rem;">{{ __('Correo') }}</label>
                        <input id="email" type="email" class="form-control form-control-sm" name="email" required>
                        <div id="email-hint" class="email-hint"></div>
                        <div class="invalid-feedback">Debe ingresar un correo válido.</div>
                    </div>
                    <div class="mb-2">
                        <label for="password" class="form-label" style="font-size: 0.85rem;">{{ __('Contraseña') }}</label>
                        <input id="password" type="password" class="form-control form-control-sm" name="password" required minlength="8">
                        <div id="password-hint" class="password-hint"></div>
                        <div class="invalid-feedback">La contraseña debe tener al menos 8 caracteres.</div>
                    </div>
                    <div class="mb-2">
                        <label for="password_confirmation" class="form-label" style="font-size: 0.85rem;">{{ __('Confirmar contraseña') }}</label>
                        <input id="password_confirmation" type="password" class="form-control form-control-sm" name="password_confirmation" required>
                        <div id="confirm-password-hint" class="confirm-password-hint"></div>
                        <div class="invalid-feedback">Las contraseñas deben coincidir.</div>
                    </div>

                    <!-- Información personal -->
                    <h4 class="text-dark mt-4 mb-3" style="font-size: 1rem;">{{ __('Información Personal') }}</h4>
                    <div class="mb-2">
                        <label for="nombre" class="form-label" style="font-size: 0.85rem;">{{ __('Nombre') }}</label>
                        <input id="nombre" type="text" class="form-control form-control-sm" name="nombre" required>
                        <div class="invalid-feedback">El nombre es obligatorio.</div>
                    </div>
                    <div class="mb-2">
                        <label for="apellido_paterno" class="form-label" style="font-size: 0.85rem;">{{ __('Apellido Paterno') }}</label>
                        <input id="apellido_paterno" type="text" class="form-control form-control-sm" name="apellido_paterno" required>
                        <div class="invalid-feedback">El apellido paterno es obligatorio.</div>
                    </div>
                    <div class="mb-2">
                        <label for="apellido_materno" class="form-label" style="font-size: 0.85rem;">{{ __('Apellido Materno') }}</label>
                        <input id="apellido_materno" type="text" class="form-control form-control-sm" name="apellido_materno" required>
                        <div class="invalid-feedback">El apellido materno es obligatorio.</div>
                    </div>
                    
                    <div class="mb-2">
                        <label for="genero" class="form-label" style="font-size: 0.85rem;">{{ __('Género') }}</label>
                        <select id="genero" class="form-select form-select-sm" name="genero" required>
                            <option value="M">{{ __('Masculino') }}</option>
                            <option value="F">{{ __('Femenino') }}</option>
                        </select>
                        <div class="invalid-feedback">El género es obligatorio.</div>
                    </div>
                    <div class="mb-2">
                        <label for="numero_telefonico" class="form-label" style="font-size: 0.85rem;">{{ __('Número Telefónico') }}</label>
                        <input id="numero_telefonico" type="text" class="form-control form-control-sm" name="numero_telefonico" required pattern="\d+">
                        <div class="invalid-feedback">El número telefónico es obligatorio y debe ser numérico.</div>
                    </div>

                    <!-- Dirección -->
                    <h4 class="text-dark mt-4 mb-3" style="font-size: 1rem;">{{ __('Dirección') }}</h4>
                    <div class="mb-2">
                        <label for="calle" class="form-label" style="font-size: 0.85rem;">{{ __('Calle') }}</label>
                        <input id="calle" type="text" class="form-control form-control-sm" name="calle" required>
                        <div class="invalid-feedback">La calle es obligatoria.</div>
                    </div>
                    <div class="mb-2">
                        <label for="numero_ext" class="form-label" style="font-size: 0.85rem;">{{ __('Número exterior') }}</label>
                        <input id="numero_ext" type="text" class="form-control form-control-sm" name="numero_ext" required>
                        <div class="invalid-feedback">El número exterior es obligatorio.</div>
                    </div>
                    <div class="mb-2">
                        <label for="numero_int" class="form-label" style="font-size: 0.85rem;">{{ __('Número interior (opcional)') }}</label>
                        <input id="numero_int" type="text" class="form-control form-control-sm" name="numero_int">
                    </div>
                    <div class="mb-2">
                        <label for="colonia" class="form-label" style="font-size: 0.85rem;">{{ __('Colonia') }}</label>
                        <input id="colonia" type="text" class="form-control form-control-sm" name="colonia" required>
                        <div class="invalid-feedback">La colonia es obligatoria.</div>
                    </div>
                    <div class="mb-2">
                        <label for="estado" class="form-label" style="font-size: 0.85rem;">{{ __('Estado') }}</label>
                        <input id="estado" type="text" class="form-control form-control-sm" name="estado" required>
                        <div class="invalid-feedback">El estado es obligatorio.</div>
                    </div>
                    <div class="mb-2">
                        <label for="codigo_postal" class="form-label" style="font-size: 0.85rem;">{{ __('Código Postal') }}</label>
                        <input id="codigo_postal" type="text" class="form-control form-control-sm" name="codigo_postal" required pattern="\d{5}">
                        <div class="invalid-feedback">El código postal debe tener 5 dígitos.</div>
                    </div>
                    <div class="mb-2">
                        <label for="pais" class="form-label" style="font-size: 0.85rem;">{{ __('País') }}</label>
                        <input id="pais" type="text" class="form-control form-control-sm" name="pais" required>
                        <div class="invalid-feedback">El país es obligatorio.</div>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-dark btn-sm">{{ __('Registrarse') }}</button>
                    </div>
                </form>

                <div class="text-center mt-3">
                    <p style="font-size: 0.85rem;">{{ __('¿Ya tienes cuenta?') }} <a href="{{ route('login') }}" class="text-dark fw-bold">{{ __('Inicia sesión') }}</a></p>
                </div>
            </div>
        </div>

        <!-- Columna derecha: Imagen -->
        <div class="col-lg-6 bg-image d-none d-lg-block" style="background-image: url('{{ asset('img/mujer.jpeg') }}'); background-size: cover; background-position: center;">
        </div>
    </div>
</div>

<script>
    document.getElementById('registerForm').addEventListener('submit', function(event) {
        const form = this;
        const inputs = form.querySelectorAll('input, select');
        let valid = true;

        inputs.forEach(input => {
            if (!input.checkValidity()) {
                valid = false;
                input.classList.add('is-invalid');
            } else {
                input.classList.remove('is-invalid');
            }
        });

        if (!valid) {
            event.preventDefault(); // Evitar envío si hay errores
        }
    });

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

    document.getElementById('password_confirmation').addEventListener('input', function () {
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
