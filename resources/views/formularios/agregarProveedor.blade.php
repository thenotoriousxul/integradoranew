@extends('layouts.app')


@section('content')

    <div class="container">
        <h1>Agregar Proveedor</h1>
    </div>

    <div class="container">
        <form action="/agregar/producto" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 row">
                <label class="form-label" for="nombre">Ingresa el nombre</label>
                <input value="{{old('nombre')}}" type="text" name="nombre" id="nombre" placeholder="Nombre">
            </div>

            <div class="mb-3 row">
                <label class="form-label" for="numero_telefonico">Ingresa el numero de telefono</label>
                <input value="{{old('numero_telefonico')}}" type="text" name="numero_telefonico" id="numero_telefonico" placeholder="Numero telefonico">
            </div>

            <div class="mb-3 row">
                <label class="form-label" for="tipo">Ingresa el tipo proveedor</label>
                <select name="tipo" id="tipo" required>
                    <option value="" disabled selected>Selecciona un tipo de proveedor</option>
                    <option value="Servicios">Servicios</option>
                    <option value="Materia Prima">Materia Prima</option>
                </select>
            </div>

            <h3>Direccion</h3>

            <div class="mb-3 row">
                <label class="form-label" for="calle">Ingresa la cantidad de calle </label>
                <input value="{{old('calle')}}" type="number" name="calle" id="calle" placeholder="Ingresa la calle">
            </div>

            <div class="mb-3 row">
                <label class="form-label" for="numero_int">Ingresa el numero interior</label>
                <input value="{{old('numero_int')}}" type="text" name="numero_int" id="numero_int" placeholder="Ingresa el numero interior">
            </div>

            <div class="mb-3 row">
                <label class="form-label" for="numero_ext">Ingresa el numero exterior</label>
                <input value="{{old('numero_ext')}}" type="text" name="numero_ext" id="numero_ext" placeholder="Ingresa el numero exterior">
            </div>

            <div class="mb-3 row">
                <label class="form-label" for="estado">Ingresa el estado</label>
                <input value="{{old('estado')}}" type="text" name="estado" id="estado" placeholder="Ingresa el estado">
            </div>


            <div class="mb-3 row">
                <label class="form-label" for="codigo_postal">Ingresa el codigo postal</label>
                <input value="{{old('codigo_postal')}}" type="text" name="codigo_postal" id="codigo_postal" placeholder="Ingresa el codigo postal">
            </div>

            <div class="mb-3 row">
                <label class="form-label" for="pais">Ingresa el pais</label>
                <input value="{{old('pais')}}" type="text" name="pais" id="pais" placeholder="Ingresa el pais">
            </div>


            <div class="container">
            <button class="btn btn-success" type="submit">Guardar Proveedor</button>
            </div>

            @if(session('success'))
            <div style="color: green;">
                {{ session('success') }}
            </div>
            @endif

            @if ($errors->any())
            <div style="color: red;" class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>      
                    @endforeach
                </ul>
            </div>
            @endif
        </form>
    </div>

@endsection