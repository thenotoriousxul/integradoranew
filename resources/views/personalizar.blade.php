@extends('admin.layouts.dashboard')

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
const productId = {{ $producto->id }};  // Asegúrate de que el producto tenga un ID único
let playeraBounds = null;

// Función para establecer la imagen de fondo
function setBackground() {
    const productImageURL = {{ $producto->imagen_producto }}?t=${new Date().getTime()}; // Usar timestamp para evitar caché
    fabric.Image.fromURL(productImageURL, function(img) {
        img.set({
            left: 0,
            top: 0,
            selectable: false,
            evented: false
        });
        canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas));
        playeraBounds = img.getBoundingRect();  // Guardar los límites de la playera
    }, { crossOrigin: 'Anonymous' });
}

// Llamar a setBackground para establecer la imagen de fondo al cargar la página
setBackground();

// Agregar estampado al canvas
function agregarEstampado(imagePath, estampadoId) {
    const proxyURL = /s3-image?image=${encodeURIComponent(imagePath)};

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
    });
}

// Eventos para restringir movimiento y escalado dentro de los límites de la playera
canvas.on('object:moving', function(e) {
    var obj = e.target;
    if (obj === canvas.backgroundImage) return;

    var objBounds = obj.getBoundingRect();

    // Restringir movimiento dentro de los límites de la playera
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

    // Restringir escalado dentro de los límites de la playera
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

// Eliminar el objeto seleccionado
function eliminarObjeto() {
    const activeObject = canvas.getActiveObject();
    if (activeObject && activeObject !== canvas.backgroundImage) {
        canvas.remove(activeObject);
    } else {
        alert('Seleccione un objeto para eliminar.');
    }
}

// Descargar la imagen personalizada
function descargarImagen() {
    const link = document.createElement('a');
    link.href = canvas.toDataURL({ format: 'png' }); // Generar la URL del diseño
    link.download = 'mi_diseño.png'; // Nombre del archivo descargado
    link.click();
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