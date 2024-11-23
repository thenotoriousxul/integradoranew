@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-4">Simulación de Envío</h1>
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form id="envioForm">
                        <!-- Dirección -->
                        <h4 class="mb-3">Dirección de Envío</h4>
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

                        

                        <!-- Resultado de la Simulación -->
                        <div id="resultadoEnvio" class="mt-4 d-none">
                            <h5>Estimación de Envío</h5>
                            <p><strong>Costo:</strong> $<span id="costoEnvio"></span></p>
                            <p><strong>Tiempo Estimado:</strong> <span id="tiempoEnvio"></span></p>
                        </div>

                        <!-- Botón de Simulación -->
                        <button type="button" class="btn btn-primary w-100 mt-4" onclick="simularEnvio()">Simular Envío</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script de Simulación de Envío -->
<script>
    function simularEnvio() {
        const opcionEnvio = document.getElementById('opcionEnvio').value;
        const resultadoEnvio = document.getElementById('resultadoEnvio');
        const costoEnvio = document.getElementById('costoEnvio');
        const tiempoEnvio = document.getElementById('tiempoEnvio');

        if (opcionEnvio === 'estandar') {
            costoEnvio.innerText = '10.00';
            tiempoEnvio.innerText = '3-5 días';
        } else if (opcionEnvio === 'expres') {
            costoEnvio.innerText = '20.00';
            tiempoEnvio.innerText = '1-2 días';
        } else {
            alert('Por favor, seleccione una opción de envío.');
            return;
        }

        // Mostrar los resultados de la simulación
        resultadoEnvio.classList.remove('d-none');
    }
</script>
@endsection
