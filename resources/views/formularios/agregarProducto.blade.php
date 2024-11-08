@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>agregar Producto</h1>
    </div>

    <div class="container">
        <form action="/agregar/producto" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 row">
                <label class="form-label" for="tipo">ingresa el tipo</label>
                <input value="{{old('tipo')}}" type="text" name="tipo" id="tipo" placeholder="tipo">
            </div>

            <div class="mb-3 row">
                <label class="form-label" for="tamaño">Ingresa el tamaño</label>
                <select name="tamaño" id="tamaño" required>
                    <option value="" disabled selected>Selecciona un tamaño</option>
                    <option value="CH">CH</option>
                    <option value="M">M</option>
                    <option value="S">S</option>
                    <option value="XL">XL</option>
                </select>
            </div>

            <div class="mb-3 row">
                <label class="form-label" for="color">Ingresa el color</label>
                <select name="color" id="color" required>
                    <option value="" disabled selected>Selecciona un color</option>
                    <option value="CH">blanco</option>
                    <option value="M">negro</option>
                    <option value="S">rojo</option>
                    <option value="XL">azul</option>
                </select>
            </div>

            <div class="mb-3 row">
                <label class="form-label" for="lote">Ingresa la cantidad de lote </label>
                <input value="{{old('lote')}}" type="number" name="lote" id="lote" placeholder="ingresa la cantidad">
            </div>

            <div class="mb-3 row">
                <label class="form-label" for="costo">Ingresa el costo base </label>
                <input value="{{old('costo')}}" type="text" name="costo" id="costo" placeholder="ingresa el costo">
            </div>

            <div class="mb-3 row">
                <label class="form-label" for="imagen_producto">Ingresa la imagen del producto </label>
                <input type="file" name="imagen_producto" id="" placeholder="ingresa la imagen del producto">
            </div>

            <div class="container">
            <button class="btn btn-success" type="submit">Guardar Producto</button>
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