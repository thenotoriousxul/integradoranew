@extends('layouts.app')


@section('content')

    <div class="container my-4" style="background-color: #1f2937; padding: 2rem; border-radius: 1rem;">
        <h1 class="text-center mb-4 text-light">Agregar Proveedor</h1>
        <div class="container">
            <form action="/agregar/producto" method="POST" enctype="multipart/form-data" class="p-4 shadow rounded" style="background-color: #dde3eb; border-radius: 2rem;">
                @csrf
                <div class="mb-3 row">
                    <label class="form-label fw-bold"for="nombre">Nombre</label>
                    <input value="{{old('nombre')}}" type="text" name="nombre" id="nombre" placeholder="Ingresa el nombre">
                </div>
    
                <div class="mb-3 row">
                    <label class="form-label fw-bold"for="numero_telefonico">Telefono</label>
                    <input value="{{old('numero_telefonico')}}" type="text" name="numero_telefonico" id="numero_telefonico" placeholder="Ingresa numero telefonico">
                </div>
    
                <div class="mb-3 row">
                    <label class="form-label fw-bold" for="tipo">Selecciona un tipo de proveedor</label>
                    <select name="tipo" id="tipo" required>
                        <option value="" disabled selected>Ingresa el tipo de proveedor</option>
                        <option value="Servicios">Servicios</option>
                        <option value="Materia Prima">Materia Prima</option>
                    </select>
                </div>
    
                <h3 class="form-label fw-bold">Direccion</h3>
    
                <div class="mb-3 row">
                    <label class="form-label fw-bold"for="calle">Ingresa la cantidad de calle </label>
                    <input value="{{old('calle')}}" type="number" name="calle" id="calle" placeholder="Ingresa la calle">
                </div>
    
                <div class="mb-3 row">
                    <label class="form-label fw-bold" for="numero_int">Ingresa el numero interior</label>
                    <input value="{{old('numero_int')}}" type="text" name="numero_int" id="numero_int" placeholder="Ingresa el numero interior">
                </div>
    
                <div class="mb-3 row">
                    <label class="form-label fw-bold"for="numero_ext">Ingresa el numero exterior</label>
                    <input value="{{old('numero_ext')}}" type="text" name="numero_ext" id="numero_ext" placeholder="Ingresa el numero exterior">
                </div>
    
                <div class="mb-3 row">
                    <label class="form-label fw-bold" for="estado">Ingresa el estado</label>
                    <input value="{{old('estado')}}" type="text" name="estado" id="estado" placeholder="Ingresa el estado">
                </div>
    
    
                <div class="mb-3 row">
                    <label class="form-label fw-bold" for="codigo_postal">Ingresa el codigo postal</label>
                    <input value="{{old('codigo_postal')}}" type="text" name="codigo_postal" id="codigo_postal" placeholder="Ingresa el codigo postal">
                </div>
    
                <div class="mb-3 row">
                    <label class="form-label fw-bold" for="pais">Ingresa el pais</label>
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
    
    </div>

   
@endsection