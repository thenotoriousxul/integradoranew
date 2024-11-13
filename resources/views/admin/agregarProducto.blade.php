@extends('admin.layouts.dash')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4 display-5 fw-bold ">Agregar Producto</h1>

        <form action="/agregar/producto" method="POST" enctype="multipart/form-data" class="bg-light p-5 shadow-sm rounded border">
            @csrf

            <div class="mb-4">
                <label class="form-label fw-semibold" for="tipo">Ingresa el tipo</label>
                <input value="{{old('tipo')}}" type="text" name="tipo" id="tipo" class="form-control border rounded" placeholder="Tipo de producto" required>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold" for="tamaño">Ingresa el tamaño</label>
                <select name="tamaño" id="tamaño" class="form-select border rounded" required>
                    <option value="" disabled selected>Selecciona un tamaño</option>
                    <option value="CH">CH</option>
                    <option value="M">M</option>
                    <option value="S">S</option>
                    <option value="XL">XL</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold" for="color">Ingresa el color</label>
                <select name="color" id="color" class="form-select border rounded" required>
                    <option value="" disabled selected>Selecciona un color</option>
                    <option value="blanco">Blanco</option>
                    <option value="negro">Negro</option>
                    <option value="rojo">Rojo</option>
                    <option value="azul">Azul</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold" for="lote">Ingresa la cantidad de lote</label>
                <input value="{{old('lote')}}" type="number" name="lote" id="lote" class="form-control border rounded" placeholder="Cantidad de lote" required>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold" for="costo">Ingresa el costo base</label>
                <input value="{{old('costo')}}" type="text" name="costo" id="costo" class="form-control border rounded" placeholder="Costo base" required>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold" for="imagen_producto">Ingresa la imagen del producto</label>
                <input type="file" name="imagen_producto" id="imagen_producto" class="form-control border rounded">
            </div>

            <div class="text-center">
                <button class="btn btn-primary btn-lg w-100 rounded" type="submit">Guardar Producto</button>
            </div>

            @if(session('success'))
                <div class="alert alert-success mt-4 text-center">
                    {{ session('success') }}
                </div>
            @endif

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
