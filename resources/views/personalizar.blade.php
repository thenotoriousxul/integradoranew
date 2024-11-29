@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Personaliza tu playera</h1>
    <br>
    <div class="personalization-container d-flex flex-row flex-wrap align-items-start justify-content-center">
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
        <button onclick="descargarImagen()" class="btn btn-primary">Descargar Diseño</button>
        </div>
        </div>
    </div>
    <br>
    <br>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/4.5.0/fabric.min.js"></script>
<script>
    const canvas = new fabric.Canvas('myCanvas');
    const productId = {{ $producto->id }};
    let playeraBounds = null;
    let logoObject = null; // Variable para almacenar el logo agregado

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
            playeraBounds = img.getBoundingRect(); // Almacenar los límites de la playera
        }, { crossOrigin: 'Anonymous' });
    }

    // Restaurar el canvas al cargar
    restoreCanvas();

    // Agregar estampado al canvas
    function agregarEstampado(imagePath, estampadoId) {
        if (logoObject) {
            alert('Solo puedes agregar un logo a la vez. Elimina el logo actual antes de agregar otro.');
            return;
        }

        const proxyURL = `/s3-image?image=${encodeURIComponent(imagePath)}`;

        fabric.Image.fromURL(proxyURL, function(img) {
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

            // Asignar el logo al objeto global
            logoObject = img;

            // Establecer el ID del estampado seleccionado
            document.getElementById('estampado_id').value = estampadoId;
        });
    }

    // Eventos para restringir movimiento y escalado dentro de la playera
    canvas.on('object:moving', function(e) {
        const obj = e.target;
        if (obj === canvas.backgroundImage) return;

        const objBounds = obj.getBoundingRect();

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
        const obj = e.target;
        if (obj === canvas.backgroundImage) return;

        const objBounds = obj.getBoundingRect();

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

    // Guardar el diseño y enviar el formulario
    function guardarDiseno() {
        if (!logoObject) {
            alert('Debe agregar un logo antes de guardar el diseño.');
            return;
        }

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
            if (activeObject === logoObject) {
                logoObject = null; // Resetear la variable del logo si se elimina
                document.getElementById('estampado_id').value = ''; // Limpiar el ID del estampado
            }

            canvas.remove(activeObject);
            saveCanvas();
        } else {
            alert('Seleccione un objeto para eliminar.');
        }
    }

    // Descargar la imagen del diseño
    function descargarImagen() {
        const link = document.createElement('a');
        link.href = canvas.toDataURL({ format: 'png' }); // Generar la URL del diseño
        link.download = 'mi_diseño.png'; // Nombre del archivo descargado
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
                setBackground();
            });
        } else {
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