@extends('admin.layouts.dashboard')

@section('content')
<div class="container">
    <h1 class="text-center">Personaliza tu playera</h1>
    <br>
    <div class="personalization-container d-flex flex-wrap align-items-start justify-content-center">
        <div class="canvas-container">
            <canvas id="myCanvas" width="550" height="600"></canvas>
        </div>
        <div class="estampados-container ml-4">
            <h3>Estampados Disponibles</h3>
            <div class="estampados d-flex flex-wrap">
                @foreach($estampados as $estampado)
                <img onclick="agregarEstampado('{{ $estampado->imagen_estampado }}', '{{ $estampado->id }}')" 
                     src="{{ Storage::disk('s3')->url($estampado->imagen_estampado) }}" 
                     alt="{{ $estampado->nombre }}" 
                     class="img-thumbnail m-2" 
                     title="{{ $estampado->nombre }}">
                @endforeach
            </div>
            <div class="controls mt-3 d-flex flex-wrap justify-content-between">
                <button onclick="eliminarObjeto()" class="btn btn-danger mb-2">Eliminar Objeto</button>
                <button onclick="descargarImagen()" class="btn btn-primary mb-2">Descargar Diseño</button>
            </div>
        </div>
    </div>
    <br>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/4.5.0/fabric.min.js"></script>
<script>
    const canvas = new fabric.Canvas('myCanvas');
    const productId = {{ $producto->id }};
    let playeraBounds = null;
    let selectedEstampadoId = null;

    // Función para establecer la imagen de fondo
    function setBackground() {
        fabric.Image.fromURL('{{ $producto->imagen_producto }}', function(img) {
            img.set({
                left: 0,
                top: 0,
                selectable: false,
                evented: false
            });
            canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas));
            // Almacenar los límites de la playera
            playeraBounds = img.getBoundingRect();
        }, { crossOrigin: 'Anonymous' }); // Añadir crossOrigin
    }

    // Restaurar el canvas al cargar
    restoreCanvas();

    function agregarEstampado(imagePath, estampadoId) {
    const proxyURL = `/s3-image?image=${encodeURIComponent(imagePath)}&t=${new Date().getTime()}`; // Evitar caché

    fabric.Image.fromURL(proxyURL, function(img) {
        img.set({
            left: canvas.width / 2,
            top: canvas.height / 2,
            scaleX: 0.07,
            scaleY: 0.07,
            originX: 'center',
            originY: 'center',
            selectable: true,
            evented: true
        });
        canvas.add(img);
        canvas.setActiveObject(img);
        saveCanvas();

        // Establecer el ID del estampado seleccionado
        document.getElementById('estampado_id').value = estampadoId;
    });
}

    // Eventos para restringir movimiento y escalado dentro de la playera
    canvas.on('object:moving', function(e) {
        var obj = e.target;
        if (obj === canvas.backgroundImage) return;

        var objBounds = obj.getBoundingRect();

        // Restringir movimiento
        if (objBounds.left < playeraBounds.left) {
            obj.left = playeraBounds.left + obj.width * obj.scaleX / 2;
        }
        if (objBounds.top < playeraBounds.top) {
            obj.top = playeraBounds.top + obj.height * obj.scaleY / 2;
        }
        if (objBounds.left + objBounds.width > playeraBounds.left + playeraBounds.width) {
            obj.left = playeraBounds.left + playeraBounds.width - obj.width * obj.scaleX / 2;
        }
        if (objBounds.top + objBounds.height > playeraBounds.top + playeraBounds.height) {
            obj.top = playeraBounds.top + playeraBounds.height - obj.height * obj.scaleY / 2;
        }
    });

    canvas.on('object:scaling', function(e) {
        var obj = e.target;
        if (obj === canvas.backgroundImage) return;

        var objBounds = obj.getBoundingRect();

        // Restringir escalado
        if (objBounds.left < playeraBounds.left ||
            objBounds.top < playeraBounds.top ||
            objBounds.left + objBounds.width > playeraBounds.left + playeraBounds.width ||
            objBounds.top + objBounds.height > playeraBounds.top + playeraBounds.height) {
            obj.scaleX = obj.oldScaleX || obj.scaleX;
            obj.scaleY = obj.oldScaleY || obj.scaleY;
            obj.left = obj.oldLeft || obj.left;
            obj.top = obj.oldTop || obj.top;
        } else {
            obj.oldScaleX = obj.scaleX;
            obj.oldScaleY = obj.scaleY;
            obj.oldLeft = obj.left;
            obj.oldTop = obj.top;
        }
    });

    // Guardar el estado después de modificar objetos
    canvas.on('object:modified', function() {
        saveCanvas();
    });

    // Función para guardar el diseño y enviar el formulario
    function guardarDiseno() {
        try {
            // Obtener la imagen del canvas
            const canvasData = canvas.toDataURL('image/png');
            // Establecer el valor en el input oculto
            document.getElementById('imagen_personalizada').value = canvasData;
            // Enviar el formulario
            document.getElementById('personalizar-form').submit();
        } catch (error) {
            console.error('Error al guardar el diseño:', error);
            alert('Ocurrió un error al guardar el diseño. Por favor, asegúrate de que todas las imágenes se cargaron correctamente.');
        }
    }

    // Eliminar el objeto seleccionado
    function eliminarObjeto() {
        const activeObject = canvas.getActiveObject();
        if (activeObject && activeObject !== canvas.backgroundImage) {
            canvas.remove(activeObject);
            saveCanvas();
        } else {
            alert('Seleccione un objeto para eliminar.');
        }
    }

    function descargarImagen() {
    const link = document.createElement('a');
    link.href = canvas.toDataURL({ format: 'png' }); 
    link.download = 'mi_diseño.png'; 
    link.click();
}


    // Guardar el estado del canvas en localStorage por producto
    function saveCanvas() {
        const canvasData = JSON.stringify(canvas.toJSON(['objects']));
        localStorage.setItem('canvasState_' + productId, canvasData);
    }

    // Restaurar el estado del canvas desde localStorage
    function restoreCanvas() {
        const canvasData = localStorage.getItem('canvasState_' + productId);
        if (canvasData) {
            canvas.loadFromJSON(canvasData, function() {
                canvas.renderAll();
                // Asegurarse de que la imagen de fondo es la correcta después de restaurar
                setBackground();
            });
        } else {
            // Si no hay estado guardado, establecer la imagen de fondo
            setBackground();
        }
    }
    // Forzar recarga sin caché si es necesario
    if (performance.navigation.type === performance.navigation.TYPE_RELOAD) {
        const url = new URL(window.location.href);
        url.searchParams.set('t', new Date().getTime()); // Añadir timestamp para evitar el caché
        window.location.href = url.toString();
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
        flex: 1 1 550px;
        max-width: 100%;
        margin-right: 20px;
    }
    .estampados-container {
        flex: 1 1 300px;
        max-width: 100%;
        margin-left: 0;
    }
    .img-thumbnail {
        cursor: pointer;
        width: 100px;
        height: 100px;
        object-fit: cover;
        transition: transform 0.2s ease;
    }
    .img-thumbnail:hover {
        transform: scale(1.1);
    }
    .controls button {
        width: 48%;
    }
    @media (max-width: 1024px) {
        .img-thumbnail {
            width: 80px;
            height: 80px;
        }
    }
    @media (max-width: 768px) {
        .personalization-container {
            flex-direction: column;
            align-items: center;
        }
        .canvas-container, .estampados-container {
            flex: 1 1 100%;
            max-width: 100%;
            margin-right: 0;
            margin-left: 0;
        }
        .estampados {
            justify-content: center;
        }
        .controls button {
            width: 100%;
            margin-bottom: 10px;
        }
    }
    @media (max-width: 576px) {
        .img-thumbnail {
            width: 70px;
            height: 70px;
        }
        canvas {
            width: 100%;
            height: auto;
        }
    }
</style>
@endsection
