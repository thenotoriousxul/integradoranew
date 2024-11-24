@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-4">Datos del cliente</h1>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form id="form-pago">
                       
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
                        <a href="{{ route('/detalleOrden') }}" id="detalle" class="btn btn-success mt-3 px-4 py-2" style="font-family: 'Bebas Neue', cursive; font-size: 1.2rem;">Continuar Proceso</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
