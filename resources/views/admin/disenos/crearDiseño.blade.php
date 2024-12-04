@extends('admin.layouts.dashboard')

@section('content')
<div class="container my-4" style="background-color: #1f2937; padding: 2rem; border-radius: 2rem;">
    <h1 class="text-center mb-4 text-light">Crear Nuevo Diseño</h1>

    <form action="{{ route('guardar.diseño') }}" method="POST" enctype="multipart/form-data" class="p-4 shadow rounded" style="background-color: #dde3eb; border-radius: 2rem;">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label fw-bold">Nombre del Diseño</label>
            <input type="text" id="nombre" name="nombre" class="form-control" required>
        </div>

        <div id="estampados-container">
            <h4 class="form-label fw-bold">Estampados</h4>
            <div class="estampado-item mb-4">
                <h5 class="form-label fw-bold">Estampado 1</h5>
                <hr>
                <div class="mb-3">
                    <label for="estampados[0][nombre]" class="form-label fw-bold">Nombre del Estampado</label>
                    <input type="text" name="estampados[0][nombre]" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="estampados[0][costo]" class="form-label fw-bold">Costo del Estampado</label>
                    <input type="number" name="estampados[0][costo]" step="0.01" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="estampados[0][imagen_estampado]" class="form-label fw-bold">Imagen del Estampado</label>
                    <input type="file" name="estampados[0][imagen_estampado]" class="form-control">
                </div>
            </div>
        </div>

        <button type="button" id="add-estampado" class="btn btn-secondary mb-3; margin-top;">Agregar Estampado</button>

        <button type="submit" class="btn btn-primary">Guardar Diseño</button>
    </form>
</div>

<script>
    document.getElementById('add-estampado').addEventListener('click', function () {
        const container = document.getElementById('estampados-container');
        const count = container.querySelectorAll('.estampado-item').length;

        const newEstampado = document.createElement('div');
        newEstampado.classList.add('estampado-item', 'mb-4');
        newEstampado.style.opacity = 0; 

        newEstampado.innerHTML = `
            <hr class="my-4">
            <h5 class="form-label fw-bold">Estampado ${count + 1}</h5>
            <div class="mb-3 form-label fw-bold">
                <label for="estampados[${count}][nombre]" class="form-label">Nombre del Estampado</label>
                <input type="text" name="estampados[${count}][nombre]" class="form-control" required>
            </div>
            <div class="mb-3 form-label fw-bold">
                <label for="estampados[${count}][costo]" class="form-label">Costo del Estampado</label>
                <input type="number" name="estampados[${count}][costo]" step="0.01" class="form-control" required>
            </div>
            <div class="mb-3 form-label fw-bold">
                <label for="estampados[${count}][imagen_estampado]" class="form-label">Imagen del Estampado</label>
                <input type="file" name="estampados[${count}][imagen_estampado]" class="form-control">
            </div>
        `;

        container.appendChild(newEstampado);

        setTimeout(() => {
            newEstampado.style.transition = 'opacity 0.5s';
            newEstampado.style.opacity = 1;
        }, 10);

        newEstampado.scrollIntoView({ behavior: 'smooth' });
    });
</script>
@endsection
