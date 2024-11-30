@extends('cliente.layouts.dashboard')

@section('content')
<div class="container">
    <header class="text-center mb-5">
        <h1 class="h2">OZEZ</h1>
    </header>

    <div class="row">
        <div class="col-md-11 mx-auto">
            <section class="mb-5">
                <h2 class="h5 mb-4">Datos personales</h2>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <p class="form-control">{{ $usuario->persona->nombre ?? 'Nombre no disponible' }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="form-control">{{$usuario->persona->apellido_paterno}} {{$usuario->persona->apellido_materno}}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="form-control">{{$usuario->persona->genero}}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="form-control">{{$usuario->persona->numero_telefonico}}</p>
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
                            <input type="text" class="form-control" name="calle" id="calle" value="{{ $usuario->persona->direccion->calle }}">
                        </div>
                        <div class="col-12 mb-3">
                            <input type="text" class="form-control" name="colonia" id="colonia" value="{{ $usuario->persona->direccion->colonia }}">
                        </div>
                        <div class="col-12 mb-3">
                            <input type="text" class="form-control" name="codigo_postal" id="codigo_postal" value="{{ $usuario->persona->direccion->codigo_postal }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control" name="numero_ext" id="numero_ext" value="{{ $usuario->persona->direccion->numero_ext }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control" name="numero_int" id="numero_int" value="{{ $usuario->persona->direccion->numero_int }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control" name="estado" id="estado" value="{{ $usuario->persona->direccion->estado }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control" name="pais" id="pais" value="{{ $usuario->persona->direccion->pais }}">
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

@endsection