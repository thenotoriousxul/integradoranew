@extends('layouts.app')

@section('content')
<div class="container py-4" id="personalizationContainer">
    <h1 class="text-center mb-4">Personaliza tu Playera</h1>

    <form id="personalizationForm" action="{{ route('personalizacion.guardar') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="color" class="form-label">Color de la Playera</label>
            <select class="form-select" name="color" id="color" required>
                <option value="Blanco">Blanco</option>
                <option value="Negro">Negro</option>
                <option value="Rojo">Rojo</option>
                <option value="Azul">Azul</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="tamaño" class="form-label">Tamaño</label>
            <select class="form-select" name="tamaño" id="tamaño" required>
                <option value="CH">CH</option>
                <option value="M">M</option>
                <option value="XL">XL</option>
                <option value="XXL">XXL</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="estampado" class="form-label">Selecciona un Estampado</label>
            <select class="form-select" name="estampado" id="estampado" required>
                @foreach ($estampados as $estampado)
                <option value="{{ $estampado->id }}">{{ $estampado->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="logo" class="form-label">Sube tu Propio Diseño (Opcional)</label>
            <input type="file" name="logo" id="logo" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary w-100">Personalizar Playera</button>
    </form>
</div>

<!-- Mensaje de "Próximamente" que se mostrará después de enviar el formulario -->
<div id="comingSoonMessage" class="text-center" style="display: none; margin-top: 50px;">
    <h2>Próximamente</h2>
    <p>Estamos procesando tu solicitud. ¡Gracias por personalizar tu playera!</p>
</div>

<script>
    // Capturar el evento de envío del formulario
    document.getElementById('personalizationForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevenir el comportamiento por defecto del formulario

        // Eliminar todo el contenido de la página (formulario y mensaje)
        document.getElementById('personalizationContainer').innerHTML = '';

        // Mostrar el mensaje de "Próximamente" (este div está fuera del contenido que se eliminará)
        document.getElementById('comingSoonMessage').style.display = 'block';
    });
</script>
@endsection
