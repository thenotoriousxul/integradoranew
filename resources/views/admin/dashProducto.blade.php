@extends('admin.layouts.dashboard')

    @section('content')
    <div class="container mt-5" style="background-color: #f8f9fa; padding: 2rem; border-radius: 0.5rem;">
        <h1 class="text-center mb-4 display-5 fw-bold text-dark">Agregar Producto</h1>
    
        <form action="/agregar/producto" method="POST" enctype="multipart/form-data" style="background-color: #ffffff; padding: 2rem; border-radius: 0.5rem;" class="shadow-sm border">
            @csrf

            @if(session('success'))
                <div class="alert alert-success mt-4 text-center">
                    {{ session('success') }}
                </div>
            @endif
    
            <div class="mb-4">
                <label class="form-label fw-semibold text-dark" for="tipo">Ingresa el tipo</label>
                <input value="{{old('tipo')}}" type="text" name="tipo" id="tipo" class="form-control border rounded" placeholder="Tipo de producto" required style="background-color: #e9ecef; color: #495057;">
            </div>
    
            <div class="mb-4">
                <label class="form-label fw-semibold text-dark" for="tamaño">Ingresa el tamaño</label>
                <select name="tamaño" id="tamaño" class="form-select border rounded" required style="background-color: #e9ecef; color: #495057;">
                    <option value="" disabled selected>Selecciona un tamaño</option>
                    <option value="CH">CH</option>
                    <option value="M">M</option>
                    <option value="S">S</option>
                    <option value="XL">XL</option>
                </select>
            </div>
    
            <div class="mb-4">
                <label class="form-label fw-semibold text-dark" for="color">Ingresa el color</label>
                <select name="color" id="color" class="form-select border rounded" required style="background-color: #e9ecef; color: #495057;">
                    <option value="" disabled selected>Selecciona un color</option>
                    <option value="blanco">Blanco</option>
                    <option value="negro">Negro</option>
                    <option value="rojo">Rojo</option>
                    <option value="azul">Azul</option>
                </select>
            </div>
    
            <div class="mb-4">
                <label class="form-label fw-semibold text-dark" for="lote">Ingresa la cantidad de lote</label>
                <input value="{{old('lote')}}" type="number" name="lote" id="lote" class="form-control border rounded" placeholder="Cantidad de lote" required style="background-color: #e9ecef; color: #495057;">
            </div>
    
            <div class="mb-4">
                <label class="form-label fw-semibold text-dark" for="costo">Ingresa el costo base</label>
                <input value="{{old('costo')}}" type="text" name="costo" id="costo" class="form-control border rounded" placeholder="Costo base" required style="background-color: #e9ecef; color: #495057;">
            </div>
    
            <div class="mb-4">
                <label class="form-label fw-semibold text-dark" for="imagen_producto">Ingresa la imagen del producto</label>
                <input type="file" name="imagen_producto" id="imagen_producto" class="form-control border rounded" style="background-color: #e9ecef; color: #495057;">
            </div>
    
            <div class="text-center">
                <button class="btn btn-primary btn-lg w-100 rounded" type="submit" style="background-color: #007bff; border: none;">Guardar Producto</button>
            </div>
    
    
            @if ($errors->any())
                <div class="alert alert-danger mt-4">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>      
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
    </div>
    
    @endsection
