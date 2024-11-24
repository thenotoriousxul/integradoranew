@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-4">Datos del cliente</h1>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form id="form-pago">
                        <h4 class="mb-3">Información del Cliente</h4>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre </label>
                            <input type="text" class="form-control" id="nombre" >
                        </div>
                        <div class="mb-3">
                            <label for="apellido_p" class="form-label">Apellido Paterno</label>
                            <input type="text" class="form-control" id="apellido_p" >
                        </div>
                        <div class="mb-3">
                            <label for="apellido_m" class="form-label">Apellido Materno</label>
                            <input type="text" class="form-control" id="apellido_m" >
                        </div>
                        <div class="mb-3">
                            <label for="fecha_nac" class="form-label">Fecha de Nacimiento </label>
                            <input type="Date" class="form-control" id="fecha_nac" >
                        </div>
                        <div class="mb-3">
                            <label for="genero" class="form-label">Genero</label>
                            <input type="text" class="form-control" id="genero" >
                        </div>
                       
                        <h4 class="mt-4 mb-3">Información de Envio</h4>
                        
                        <div class="mb-3">
                            <label for="ciudad" class="form-label">Ciudad</label>
                            <input type="text" class="form-control" id="ciudad" >
                        </div>
                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <input type="text" class="form-control" id="estado" >
                        </div>
                        <div class="mb-3">
                            <label for="codigo-postal" class="form-label">Código Postal</label>
                            <input type="text" class="form-control" id="codigo-postal" >
                        </div>
                        <div class="mb-3">
                            <label for="colonia" class="form-label">Colonia</label>
                            <input type="text" class="form-control" id="colonia" >
                        </div>
                        <div class="mb-3">
                            <label for="calle" class="form-label">Calle</label>
                            <input type="text" class="form-control" id="calle" >
                        </div>
                        <div class="mb-3">
                            <label for="n_ex" class="form-label">Numero exterior</label>
                            <input type="text" class="form-control" id="n_ex" >
                        </div>
                       <input type="submit" value="GUARDAR DATOS">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
