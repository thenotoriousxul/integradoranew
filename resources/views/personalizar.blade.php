@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Personaliza tu playera</h1>
    <div class="personalization-container d-flex flex-row flex-wrap align-items-start justify-content-center">
        <div class="canvas-container">
            <canvas id="myCanvas" width="550" height="600"></canvas>
        </div>
        <div class="estampados-container ml-4">
            <h3>Estampados Disponibles</h3>
            <div class="estampados d-flex flex-wrap">
                @foreach($estampados as $estampado)
                    <img onclick="agregarEstampado('{{ Storage::disk('s3')->url($estampado->imagen_estampado) }}', '{{ $estampado->id }}')" 
                         src="{{ Storage::disk('s3')->url($estampado->imagen_estampado) }}" 
                         alt="{{ $estampado->nombre }}" 
                         class="img-thumbnail m-2" 
                         title="{{ $estampado->nombre }}">
                @endforeach
            </div>
            <!-- Formulario para enviar los datos -->
            <form id="personalizar-form" action="{{ route('personalizar.guardar') }}" method="POST">
                @csrf
                <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                <input type="hidden" name="estampado_id" id="estampado_id" value="">
                <input type="hidden" name="imagen_personalizada" id="imagen_personalizada" value="">
                <button type="button" onclick="guardarDiseno()" class="btn btn-success mt-3">Agregar al carrito</button>
            </form>
            <!-- Botón para eliminar objetos -->
            <div class="controls mt-3">
                <button onclick="eliminarObjeto()" class="btn btn-danger">Eliminar Objeto</button>
            </div>
        </div>
    </div>
</div>
<!-- Agregar la librería Fabric.js -->
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

    // Agregar estampado al canvas
    function agregarEstampado(imagePath, estampadoId) {
        fabric.Image.fromURL(imagePath, function(img) {
            img.set({
                left: canvas.width / 2,
                top: canvas.height / 2,
                scaleX: 0.2,
                scaleY: 0.2,
                originX: 'center',
                originY: 'center',
                selectable: true,
                evented: true
            });
            canvas.add(img);
            canvas.setActiveObject(img);
            saveCanvas();
            // Establecer el ID del estampado seleccionado
            selectedEstampadoId = estampadoId;
            document.getElementById('estampado_id').value = estampadoId;
        }, { crossOrigin: 'Anonymous' }); // Añadir crossOrigin
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
        width: 80px;
        height: 80px;
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
