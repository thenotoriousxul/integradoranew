@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Personaliza tu producto: {{ $producto->tipo }}</h1>
    <div class="personalization-container d-flex flex-row flex-wrap align-items-start justify-content-center">
        <!-- Canvas para Personalización -->
        <div class="canvas-container">
            <canvas id="myCanvas" width="550" height="600"></canvas>
        </div>
        <!-- Estampados Disponibles y Botones de Acción -->
        <div class="estampados-container ml-4">
            <h3>Estampados Disponibles</h3>
            <div class="estampados d-flex flex-wrap">
                <img onclick="agregarEstampado('imagen_gato')" src="{{ asset('img/imagen_gato.png') }}" alt="Gato" class="img-thumbnail m-2">
                <img onclick="agregarEstampado('san_valentin_rem')" src="{{ asset('img/san_valentin_rem.png') }}" alt="San Valentín" class="img-thumbnail m-2">
                <img onclick="agregarEstampado('dinero_rem')" src="{{ asset('img/dinero_rem.png') }}" alt="Dinero" class="img-thumbnail m-2">
                <img onclick="agregarEstampado('tenis_rem')" src="{{ asset('img/tenis_rem.png') }}" alt="Tenis" class="img-thumbnail m-2">
            </div>
            <!-- Selector de Tamaño con Diseño Bootstrap -->
            <div class="mt-3">
                <label for="logoSize" class="form-label">Tamaño del Logo:</label>
                <select id="logoSize" class="form-select" onchange="cambiarTamañoLogo()">
                    <option value="0.25">Pequeño</option>
                    <option value="0.5" selected>Mediano</option>
                    <option value="0.75">Grande</option>
                </select>
            </div>
            <!-- Botones de Acción -->
            <div class="controls mt-3">
                <button onclick="descargarImagen()" class="btn btn-success">Guardar Diseño</button>
                <button onclick="eliminarObjeto()" class="btn btn-danger">Eliminar Objeto</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/4.5.0/fabric.min.js"></script>
<script>
    const canvas = new fabric.Canvas('myCanvas');
    let logoAdded = false; // Control para añadir solo un logo

    fabric.Image.fromURL('{{ $producto->imagen_producto }}', function(img) {
        img.set({
            left: canvas.width / 2 - img.getScaledWidth() / 2,
            top: canvas.height / 2 - img.getScaledHeight() / 2,
            selectable: false,
            evented: false
        });
        canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas));
    });

    function agregarEstampado(imageKey) {
        if (logoAdded) {
            alert("Ya se ha añadido un logo. Elimine el existente para añadir uno nuevo.");
            return;
        }
        const path = '{{ asset('img') }}/' + imageKey + '.png';
        fabric.Image.fromURL(path, function(img) {
            img.set({
                left: 100,
                top: 100,
                scaleX: 0.5,
                scaleY: 0.5,
                borderColor: 'red',
                cornerColor: 'green',
                cornerSize: 6,
                transparentCorners: false,
                lockRotation: true
            });
            canvas.add(img);
            logoAdded = true; // Marcar que un logo ha sido añadido
        });
    }

    function cambiarTamañoLogo() {
        let size = parseFloat(document.getElementById('logoSize').value);
        const activeObject = canvas.getActiveObject();
        if (activeObject) {
            activeObject.scaleX = activeObject.scaleY = size;
            activeObject.setCoords();
            canvas.requestRenderAll();
        }
    }

    function descargarImagen() {
        const link = document.createElement('a');
        link.download = 'personalizacion.png';
        link.href = canvas.toDataURL('image/png').replace('image/png', 'image/octet-stream');
        link.click();
    }

    function eliminarObjeto() {
        const activeObject = canvas.getActiveObject();
        if (activeObject) {
            canvas.remove(activeObject);
            logoAdded = false; // Restablecer el indicador cuando se elimina el logo
        }
    }
</script>
<style>
    .personalization-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: flex-start;
    }
    .canvas-container {
        flex: 1;
        min-width: 300px;
        margin-right: 20px;
    }
    .estampados-container {
        flex: 1;
        min-width: 300px;
    }
    .img-thumbnail {
        cursor: pointer;
        width: 100px;
        height: 100px;
    }
    @media (max-width: 768px) {
        .personalization-container {
            flex-direction: column;
            align-items: center;
        }
        .canvas-container, .estampados-container {
            min-width: 100%;
            max-width: 550px;
            margin-right: 0;
        }
        .controls, .estampados {
            justify-content: center;
        }
    }
</style>
@endsection
