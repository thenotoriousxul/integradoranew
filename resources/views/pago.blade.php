@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-4">Proceso de Pago</h1>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form id="form-pago">
                        <h4 class="mb-3">Información de Envío</h4>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre Completo</label>
                            <input type="text" class="form-control" id="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="direccion" required>
                        </div>
                        <div class="mb-3">
                            <label for="ciudad" class="form-label">Ciudad</label>
                            <input type="text" class="form-control" id="ciudad" required>
                        </div>
                        <div class="mb-3">
                            <label for="codigo-postal" class="form-label">Código Postal</label>
                            <input type="text" class="form-control" id="codigo-postal" required>
                        </div>

                        <h4 class="mt-4 mb-3">Información de Pago</h4>
                        <div class="mb-3">
                            <label for="numero-tarjeta" class="form-label">Número de Tarjeta</label>
                            <input type="text" class="form-control" id="numero-tarjeta" placeholder="1234 5678 9012 3456" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="fecha-expiracion" class="form-label">Fecha de Expiración</label>
                                <input type="text" class="form-control" id="fecha-expiracion" placeholder="MM/AA" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="cvc" class="form-label">CVC</label>
                                <input type="text" class="form-control" id="cvc" placeholder="123" required>
                            </div>
                        </div>

                        <button type="button" class="btn btn-success w-100 mt-4" onclick="procesarPago()">Realizar Pago</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script de Pago Simulado -->
<script>
    function procesarPago() {
        alert("Pago realizado con éxito. ¡Gracias por tu compra!");
    }
</script>
@endsection
