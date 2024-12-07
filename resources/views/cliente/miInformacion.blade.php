@extends('cliente.layouts.dashboard')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container">

    <div class="row">
        <div class="col-md-11 mx-auto">
            <section class="mb-5">
                <h2 class="h5 mb-4">Datos personales</h2>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <p id="nombre" class="form-control">{{ $usuario->persona->nombre ?? 'Nombre no disponible' }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="apellido_p" class="form-label">Apellidos</label>
                        <p id="apellido_p" class="form-control">{{$usuario->persona->apellido_paterno}} {{$usuario->persona->apellido_materno}}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="apellido_m" class="form-label">Genero</label>
                        <p id="apellido_m" class="form-control">{{$usuario->persona->genero}}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="telefono" class="form-label">Telefono</label>
                        <p id="telefono" class="form-control">{{$usuario->persona->numero_telefonico}}</p>
                    </div>
                </div>
            </section>

            <form action="{{ route('direccion.actualizar', ['id' => $usuario->persona->direccion->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <section class="mb-5">
                    <h2 class="h5 mb-4">Dirección</h2>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="calle" class="form-label">Calle</label>
                            <input type="text" class="form-control" name="calle" id="calle" value="{{ $usuario->persona->direccion->calle }}">
                        </div>
                        <div class="col-12 mb-3">
                            <label for="colonia" class="form-label">Colonia</label>
                            <input type="text" class="form-control" name="colonia" id="colonia" value="{{ $usuario->persona->direccion->colonia }}">
                        </div>
                        <div class="col-12 mb-3">
                            <label for="codigo_postal" class="form-label">Código Postal</label>
                            <input type="text" class="form-control" name="codigo_postal" id="codigo_postal" value="{{ $usuario->persona->direccion->codigo_postal }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="numero_ext" class="numero_ext">Numero exterior</label>
                            <input type="text" class="form-control" name="numero_ext" id="numero_ext" value="{{ $usuario->persona->direccion->numero_ext }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="numero_int" class="form-label">Numero interior</label>
                            <input type="text" class="form-control" name="numero_int" id="numero_int" value="{{ $usuario->persona->direccion->numero_int }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="estado" class="form-label" >{{ __('Estado') }}</label>
                            <select id="estado" name="estado" class="form-control" >
                                <option  value="{{ $usuario->persona->direccion->estado }}" >{{ $usuario->persona->direccion->estado }}</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="pais" class="form-label">{{ __('País') }}</label>
                            <select id="pais" name="pais" class="form-select">
                                <option value="{{ $usuario->persona->direccion->pais }}">{{ $usuario->persona->direccion->pais }}</option>
                                <option value="US">Estados Unidos</option>
                                <option value="MX">México</option>
                                <option value="CA">Canadá</option>
                            </select>
                        </div>
                    </div>
                </section>

                <div class="text-center">
                    <button type="submit" class="btn btn-dark px-4 py-2">Actualizar Dirección</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .container {
        max-width: 900px;
    }
    .form-control {
        background-color: #f6f6f6;
        border: 1px solid #e2e2e2;
        padding: 0.75rem;
        border-radius: 4px;
    }
    .btn-dark {
        border-radius: 10px;
        background-color: #000;
        border: none;
    }
    .btn-dark:hover {
        background-color: #333;
    }
</style>

<script>
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

    const countrySelect = document.getElementById('pais');
    const stateSelect = document.getElementById('estado');

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