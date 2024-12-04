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
    .form-section {
        display: none;
    }
    .form-section.active {
        display: block;
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

                <form method="POST" action="{{ route('guardar.empleado') }}" id="registerForm">
                    @csrf

                    <div id="section1" class="form-section active">
                        <h4 class="text-dark mb-3">{{ __('Información de Usuario') }}</h4>
                        <div class="mb-2">
                            <label for="name" class="form-label">{{ __('Nombre de Usuario') }}</label>
                            <input id="name" type="text" class="form-control" name="name" required>
                            <div class="invalid-feedback">El nombre de usuario es obligatorio.</div>
                        </div>
                        <div class="mb-2">
                            <label for="email" class="form-label">{{ __('Correo') }}</label>
                            <input id="email" type="email" class="form-control" name="email" required>
                            <div id="email-hint" class="email-hint"></div>
                            <div class="invalid-feedback">Debe ingresar un correo válido.</div>
                        </div>
                        <div class="mb-2">
                            <label for="password" class="form-label">{{ __('Contraseña') }}</label>
                            <input id="password" type="password" class="form-control" name="password" required minlength="8">
                            <div id="password-hint" class="password-hint"></div>
                            <div class="invalid-feedback">La contraseña debe tener al menos 8 caracteres.</div>
                        </div>
                        <div class="mb-2">
                            <label for="password_confirmation" class="form-label">{{ __('Confirmar Contraseña') }}</label>
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                            <div id="confirm-password-hint" class="confirm-password-hint"></div>
                            <div class="invalid-feedback">Las contraseñas deben coincidir.</div>
                        </div>
                        <div class="d-grid mt-4">
                            <button type="button" class="btn btn-dark" onclick="nextSection(2)">{{ __('Siguiente') }}</button>
                        </div>
                    </div>

                    <div id="section2" class="form-section">
                        <h4 class="text-dark mb-3">{{ __('Información Personal') }}</h4>
                        <div class="mb-2">
                            <label for="nombre" class="form-label">{{ __('Nombre') }}</label>
                            <input id="nombre" type="text" class="form-control" name="nombre" required>
                            <div class="invalid-feedback">El nombre es obligatorio.</div>
                        </div>
                        <div class="mb-2">
                            <label for="apellido_paterno" class="form-label">{{ __('Apellido Paterno') }}</label>
                            <input id="apellido_paterno" type="text" class="form-control" name="apellido_paterno" required>
                            <div class="invalid-feedback">El apellido paterno es obligatorio.</div>
                        </div>
                        <div class="mb-2">
                            <label for="apellido_materno" class="form-label">{{ __('Apellido Materno') }}</label>
                            <input id="apellido_materno" type="text" class="form-control" name="apellido_materno">
                        </div>
                        <div class="mb-2">
                            <label for="genero" class="form-label">{{ __('Género') }}</label>
                            <select id="genero" class="form-select" name="genero" required>
                                <option value="M">{{ __('Masculino') }}</option>
                                <option value="F">{{ __('Femenino') }}</option>
                            </select>
                            <div class="invalid-feedback">El género es obligatorio.</div>
                        </div>
                        <div class="mb-2">
                            <label for="numero_telefonico" class="form-label">{{ __('Número Telefónico') }}</label>
                            <input id="numero_telefonico" type="text" class="form-control" name="numero_telefonico" required pattern="\d+">
                            <div class="invalid-feedback">El número telefónico es obligatorio y debe ser numérico.</div>
                        </div>
                        <div class="d-grid mt-4">
                            <button type="button" class="btn btn-secondary mb-2" onclick="prevSection(1)">{{ __('Anterior') }}</button>
                            <button type="button" class="btn btn-dark" onclick="nextSection(3)">{{ __('Siguiente') }}</button>
                        </div>
                    </div>

                    <div id="section3" class="form-section">
                        <h4 class="text-dark mb-3">{{ __('Dirección') }}</h4>
                        <div class="mb-2">
                            <label for="calle" class="form-label">{{ __('Calle') }}</label>
                            <input id="calle" type="text" class="form-control" name="calle" required>
                            <div class="invalid-feedback">La calle es obligatoria.</div>
                        </div>
                        <div class="mb-2">
                            <label for="numero_ext" class="form-label">{{ __('Número Exterior') }}</label>
                            <input id="numero_ext" type="text" class="form-control" name="numero_ext" required>
                        </div>
                        <div class="mb-2">
                            <label for="colonia" class="form-label">{{ __('Colonia') }}</label>
                            <input id="colonia" type="text" class="form-control" name="colonia" required>
                        </div>
                        <div class="mb-2">
                            <label for="pais" class="form-label" style="font-size: 0.85rem;">{{ __('País') }}</label>
                            <select id="country-select" name="pais" class="form-select">
                                <option value="">Selecciona un país</option>
                                <option value="US">Estados Unidos</option>
                                <option value="MX">México</option>
                                <option value="CA">Canadá</option>
                            </select>
                            <div class="invalid-feedback">El país es obligatorio.</div>
                        </div>
                        
                        <div class="mb-2">
                            <label for="estado" class="form-label" style="font-size: 0.85rem;">{{ __('Estado') }}</label>
                            <select id="state-select" name="estado" class="form-select" disabled>
                                <option value="">Selecciona un estado</option>
                            </select>
                            <div class="invalid-feedback">El estado es obligatorio.</div>
                        </div>

                        <div class="mb-2">
                            <label for="codigo_postal" class="form-label">{{ __('Código Postal') }}</label>
                            <input id="codigo_postal" type="text" class="form-control" name="codigo_postal" required>
                        </div>
                        <div class="d-grid mt-4">
                            <button type="button" class="btn btn-secondary mb-2" onclick="prevSection(2)">{{ __('Anterior') }}</button>
                            <button type="submit" class="btn btn-dark">{{ __('Registrar') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-6 bg-image d-none d-lg-block" style="background-image: url('{{ asset('img/mujer.jpeg') }}'); background-size: cover; background-position: center;"></div>
    </div>
</div>

<script>
    function nextSection(sectionNumber) {
        if (validateSection(sectionNumber - 1)) {
            toggleSection(sectionNumber - 1, sectionNumber);
        }
    }

    function prevSection(sectionNumber) {
        toggleSection(sectionNumber + 1, sectionNumber);
    }

    function toggleSection(current, next) {
        document.getElementById(`section${current}`).classList.remove('active');
        document.getElementById(`section${next}`).classList.add('active');
    }

    function validateSection(sectionNumber) {
        const inputs = document.querySelectorAll(`#section${sectionNumber} input, #section${sectionNumber} select`);
        let valid = true;

        inputs.forEach(input => {
            if (!input.checkValidity()) {
                input.classList.add('is-invalid');
                valid = false;
            } else {
                input.classList.remove('is-invalid');
            }
        });

        return valid;
    }

    document.getElementById('registerForm').addEventListener('submit', function (event) {
        if (!validateSection(3)) {
            event.preventDefault();
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

      const countriesStates = {
        "US": ["California", "Texas", "Florida", "New York"],
        "MX": [
            "Aguascalientes", "Baja California", "Baja California Sur", "Campeche", 
            "Chiapas", "Chihuahua", "Ciudad de México", "Coahuila", "Colima", 
            "Durango", "Estado de México", "Guanajuato", "Guerrero", "Hidalgo", 
            "Jalisco", "Michoacán", "Morelos", "Nayarit", "Nuevo León", "Oaxaca", 
            "Puebla", "Querétaro", "Quintana Roo", "San Luis Potosí", "Sinaloa", 
            "Sonora", "Tabasco", "Tamaulipas", "Tlaxcala", "Veracruz", "Yucatán", "Zacatecas"
        ],
        
       "CA": ["Ontario", "Quebec", "British Columbia", "Alberta"]
    };

    const countrySelect = document.getElementById('country-select');
    const stateSelect = document.getElementById('state-select');

    countrySelect.addEventListener('change', function () {
        const country = this.value;
        stateSelect.innerHTML = '<option value="">Selecciona un estado</option>'; 

        if (country && countriesStates[country]) {
            stateSelect.disabled = false;
            countriesStates[country].forEach(state => {
                const option = document.createElement('option');
                option.value = state;
                option.textContent = state;
                stateSelect.appendChild(option);
            });
        } else {
            stateSelect.disabled = true;
        }
    });
</script>
@endsection
