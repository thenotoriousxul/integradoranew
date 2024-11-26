@extends('layouts.auth')
@section('content')
<style>
    .step {
        display: none; /* Oculta todos los pasos por defecto */
    }

    .step.active {
        display: block; /* Muestra solo el paso activo */
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
        <div class="col-lg-6 d-flex align-items-center justify-content-center bg-white p-4">
            <div class="w-100" style="max-width: 400px;">
                <div class="text-center mb-4">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('img/ozeztrc.png') }}" alt="Logo" class="img-fluid mb-3" style="max-height: 80px;">
                    </a>
                    <h2 class="title">{{ __('Registrar Empleado') }}</h2>
                </div>

                <form id="multiStepForm" method="POST" action="{{ route('guardar.empleado') }}">
                    @csrf
                    <!-- Paso 1: Información de Usuario -->
                    <div class="step active">
                        <h4>Información de Usuario</h4>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre de Usuario</label>
                            <input id="name" type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input id="email" type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input id="password" type="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="nextStep()">Siguiente</button>
                    </div>

                    <!-- Paso 2: Información Personal -->
                    <div class="step">
                        <h4>Información Personal</h4>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input id="nombre" type="text" name="nombre" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="apellido_paterno" class="form-label">Apellido Paterno</label>
                            <input id="apellido_paterno" type="text" name="apellido_paterno" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="apellido_materno" class="form-label">Apellido Materno</label>
                            <input id="apellido_materno" type="text" name="apellido_materno" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="genero" class="form-label">Género</label>
                            <select id="genero" name="genero" class="form-select" required>
                                <option value="M">Masculino</option>
                                <option value="F">Femenino</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="numero_telefonico" class="form-label">Número Telefónico</label>
                            <input type="text" id="numero_telefonico" name="numero_telefonico" class="form-control" required>
                        </div>
                        <button type="button" class="btn btn-secondary" onclick="prevStep()">Anterior</button>
                        <button type="button" class="btn btn-primary" onclick="nextStep()">Siguiente</button>
                    </div>

                    <!-- Paso 3: Dirección -->
                    <div class="step">
                        <h4>Dirección</h4>
                        <div class="mb-3">
                            <label for="calle" class="form-label">Calle</label>
                            <input id="calle" type="text" name="calle" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="numero_ext" class="form-label">Número Exterior</label>
                            <input id="numero_ext" type="text" name="numero_ext" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="colonia" class="form-label">Colonia</label>
                            <input id="colonia" type="text" name="colonia" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <input id="estado" type="text" name="estado" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="codigo_postal" class="form-label">Código Postal</label>
                            <input id="codigo_postal" type="text" name="codigo_postal" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="pais" class="form-label">País</label>
                            <input type="text" id="pais" name="pais" class="form-control" required>
                        </div>
                        <button type="button" class="btn btn-secondary" onclick="prevStep()">Anterior</button>
                        <button type="submit" class="btn btn-success">Finalizar</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-6 bg-image d-none d-lg-block" style="background-image: url('{{ asset('img/mujer.jpeg') }}'); background-size: cover; background-position: center;">
        </div>
    </div>
</div>

<script>
    let currentStep = 0; // Comenzar en el paso 0 (primer paso)
    const steps = document.querySelectorAll('.step');

    function showStep(stepIndex) {
        steps.forEach((step, index) => {
            step.classList.toggle('active', index === stepIndex);
        });
    }

    function nextStep() {
        if (currentStep < steps.length - 1) {
            currentStep++;
            showStep(currentStep);
        }
    }

    function prevStep() {
        if (currentStep > 0) {
            currentStep--;
            showStep(currentStep);
        }
    }

    showStep(currentStep); // Mostrar el primer paso al cargar

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
