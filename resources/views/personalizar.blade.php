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
                @foreach($estampados as $estampado)
                    <img onclick="agregarEstampado('{{ $estampado->imagen_estampado }}')" 
                         src="{{ Storage::disk('s3')->url($estampado->imagen_estampado) }}" 
                         alt="{{ $estampado->nombre }}" 
                         class="img-thumbnail m-2" 
                         title="{{ $estampado->nombre }}">
                @endforeach
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
                <button onclick="descargarCanvas()" class="btn btn-primary mt-2">Descargar Canvas</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/4.5.0/fabric.min.js"></script>
<script>
    const canvas = new fabric.Canvas('myCanvas');
    let logoAdded = false; // Control para añadir solo un logo

    // Cargar el producto base como fondo del canvas
    fabric.Image.fromURL('{{ $producto->imagen_producto }}', function(img) {
        img.set({
            left: canvas.width / 2 - img.getScaledWidth() / 2,
            top: canvas.height / 2 - img.getScaledHeight() / 2,
            selectable: false,
            evented: false
        });
        canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas));
    });

    // Agregar estampado al canvas
    function agregarEstampado(imagePath) {
        if (logoAdded) {
            alert("Ya se ha añadido un logo. Elimine el existente para añadir uno nuevo.");
            return;
        }
        fabric.Image.fromURL(imagePath, function(img) {
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

    // Cambiar tamaño del logo
    function cambiarTamañoLogo() {
        const size = parseFloat(document.getElementById('logoSize').value);
        const activeObject = canvas.getActiveObject();
        if (activeObject) {
            activeObject.scaleX = activeObject.scaleY = size;
            activeObject.setCoords();
            canvas.requestRenderAll();
        }
    }

    // Descargar la imagen del canvas
    function descargarImagen() {
        const link = document.createElement('a');
        link.download = 'personalizacion.png';
        link.href = canvas.toDataURL('image/png').replace('image/png', 'image/octet-stream');
        link.click();
    }

    // Descargar el canvas como archivo
    function descargarCanvas() {
    try {
        const dataURL = canvas.toDataURL({
            format: 'png',
            quality: 1.0
        });

        // Crear un enlace temporal para la descarga
        const link = document.createElement('a');
        link.download = 'canvas.png';
        link.href = dataURL;

        // Simular un clic para iniciar la descarga
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    } catch (error) {
        console.error("Error al descargar el canvas:", error);
        alert("Ocurrió un error al intentar descargar el canvas. Verifica los permisos del navegador.");
    }
}


    // Eliminar el objeto seleccionado
    function eliminarObjeto() {
        const activeObject = canvas.getActiveObject();
        if (activeObject) {
            canvas.remove(activeObject);
            logoAdded = false; // Restablecer el indicador
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
