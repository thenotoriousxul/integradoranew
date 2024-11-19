@extends('admin.layouts.dashboard')

@section('content')
<div class="container">
    <h1>Crear Nuevo Diseño</h1>

    <form action="{{ route('guardar.diseño') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Nombre del Diseño -->
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Diseño</label>
            <input type="text" id="nombre" name="nombre" class="form-control" required>
        </div>

        <!-- Contenedor para Estampados -->
        <div id="estampados-container">
            <h4>Estampados</h4>
            <div class="estampado-item mb-4">
                <h5>Estampado 1</h5>
                <hr>
                <!-- Nombre del Estampado -->
                <div class="mb-3">
                    <label for="estampados[0][nombre]" class="form-label">Nombre del Estampado</label>
                    <input type="text" name="estampados[0][nombre]" class="form-control" required>
                </div>

                <!-- Costo del Estampado -->
                <div class="mb-3">
                    <label for="estampados[0][costo]" class="form-label">Costo del Estampado</label>
                    <input type="number" name="estampados[0][costo]" step="0.01" class="form-control" required>
                </div>

                <!-- Imagen del Estampado -->
                <div class="mb-3">
                    <label for="estampados[0][imagen_estampado]" class="form-label">Imagen del Estampado</label>
                    <input type="file" name="estampados[0][imagen_estampado]" class="form-control">
                </div>
            </div>
        </div>

        <!-- Botón para Agregar Más Estampados -->
        <button type="button" id="add-estampado" class="btn btn-secondary mb-3">Agregar Estampado</button>

        <!-- Botón para Enviar el Formulario -->
        <button type="submit" class="btn btn-primary">Guardar Diseño</button>
    </form>
</div>

<script>
    document.getElementById('add-estampado').addEventListener('click', function () {
        const container = document.getElementById('estampados-container');
        const count = container.querySelectorAll('.estampado-item').length;

        // Crear un nuevo grupo de campos para estampados
        const newEstampado = document.createElement('div');
        newEstampado.classList.add('estampado-item', 'mb-4');
        newEstampado.style.opacity = 0; // Comienza invisible

        newEstampado.innerHTML = `
            <hr class="my-4">
            <h5>Estampado ${count + 1}</h5>
            <div class="mb-3">
                <label for="estampados[${count}][nombre]" class="form-label">Nombre del Estampado</label>
                <input type="text" name="estampados[${count}][nombre]" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="estampados[${count}][costo]" class="form-label">Costo del Estampado</label>
                <input type="number" name="estampados[${count}][costo]" step="0.01" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="estampados[${count}][imagen_estampado]" class="form-label">Imagen del Estampado</label>
                <input type="file" name="estampados[${count}][imagen_estampado]" class="form-control">
            </div>
        `;

        // Insertar el nuevo estampado en el contenedor
        container.appendChild(newEstampado);

        // Animar la opacidad
        setTimeout(() => {
            newEstampado.style.transition = 'opacity 0.5s';
            newEstampado.style.opacity = 1;
        }, 10);

        // Hacer scroll hacia el nuevo estampado
        newEstampado.scrollIntoView({ behavior: 'smooth' });
    });
</script>
@endsection
