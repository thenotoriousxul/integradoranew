{{-- resources/views/personalizacion.blade.php --}}
@extends('layouts.app')

@section('content')
    <!-- Importar la fuente "Bebas Neue" desde Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">

    <!-- Estilos Personalizados -->
    <style>
        /* Contenedor Principal */
        .custom-container {
            display: flex;
            flex-direction: row;
            margin-top: 30px;
            align-items: flex-start;
            justify-content: space-between;
            padding: 0 20px;
        }

        /* Estilos de Opciones */
        .opciones {
            width: 80px;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .opciones i {
            margin: 20px 0;
            cursor: pointer;
            color: #333; 
            transition: color 0.3s;
        }

        .opciones i:hover {
            color: #555; 
        }

        /* Estilos de la Card de Configuración */
        .custom-card {
            width: 350px; 
            background-color: #fff;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            font-family: 'Bebas Neue', sans-serif; /* Aplicar la fuente */
        }

        .custom-card .card-header {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: #333; 
            text-align: center;
            font-family: 'Bebas Neue', sans-serif; /* Aplicar la fuente */
        }

        /* Estilos de las Imágenes Preestablecidas */
        .imagen_plantilla {
            width: 48%;
            height: auto;
            cursor: pointer;
            margin: 1%;
            border: 2px solid transparent;
            border-radius: 5px;
            transition: border-color 0.3s;
            box-sizing: border-box;
        }

        .imagen_plantilla:hover {
            border-color: #333; 
        }

        /* Estilos de los Botones de Color */
        .btn-custom-red, .btn-custom-blue, .btn-custom-black, .btn-custom-crema, .btn-outline-light {
            border-radius: 50%;
            width: 30px; 
            height: 30px;
            border: none;
            color: white;
            cursor: pointer;
            display: inline-block;
            text-align: center;
            margin-right: 5px;
        }

        .btn-custom-red {
            background-color: red;
        }

        .btn-custom-red:hover {
            background-color: rgba(255, 7, 7, 0.626);
        }

        .btn-custom-blue {
            background-color: blue;
        }

        .btn-custom-blue:hover {
            background-color: rgb(140, 140, 212);
        }

        .btn-custom-black {
            background-color: #000;
        }

        .btn-custom-black:hover {
            background-color: rgb(45, 45, 41);
        }

        .btn-custom-crema {
            background-color: rgb(198, 152, 95);
        }

        .btn-custom-crema:hover {
            background-color: #948950;
        }

        .btn-outline-light {
            background-color: #f2f2f2ae;
            color: #000;
            border: #000;
        }

        .btn-outline-light:hover {
            background-color: rgb(202, 199, 175);
            color: white;
        }

        /* Estilos del Canvas */
        .Elcanvas-container {
            flex: 2; 
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0 20px;
        }

        #myCanvas {
            max-width: 100%;
            height: auto;
            border: 1px solid #8a09b1;
            border-radius: 10px;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .custom-container {
                flex-direction: column;
                align-items: center;
            }

            .opciones {
                flex-direction: row;
                width: 100%;
                justify-content: space-around;
                margin-right: 0;
                margin-bottom: 20px;
            }

            .custom-card {
                width: 90%;
                margin-left: 0;
            }

            .imagen_plantilla {
                width: 48%; 
                margin: 1%;
                max-width: 150px;
            }
        }

        @media (max-width: 576px) {
            .opciones {
                padding: 10px;
            }

            .btn-custom-red, .btn-custom-blue, .btn-custom-black, .btn-custom-crema, .btn-outline-light {
                width: 25px; 
                height: 25px;
            }

            .custom-card {
                padding: 10px;
                width: 100%;
            }

            #myCanvas {
                width: 100%;
                height: auto;
            }

            .imagen_plantilla {
                width: 48%;
                margin: 1%;
            }
        }
    </style>

    <!-- Contenedor Principal -->
    <div class="custom-container">
        <!-- Opciones de Personalización -->
        <div class="opciones">
            <i class="fa-solid fa-shirt fa-2xl" title="Productos" aria-label="Productos" role="button"></i>
            <i onclick="descargarImagen()" class="fa-solid fa-floppy-disk fa-2xl" title="Guardar" aria-label="Guardar" role="button"></i>
            <i onclick="eliminarObjeto()" class="fa-solid fa-trash fa-2xl" title="Eliminar" aria-label="Eliminar" role="button"></i>
        </div>

        <!-- Canvas para Personalización -->
        <div class="Elcanvas-container">
            <canvas id="myCanvas" width="550" height="600"></canvas>
        </div>

        <!-- Card de Opciones de Configuración -->
        <div class="custom-card">
            <div class="card-header">
                Opciones de Configuración
            </div>
            <div class="card-body">
                <h3>Color Producto</h3>
                <br>
                <button onclick="cambiarColor('#ffffff')" class="btn btn-outline-light" title="Blanco" aria-label="Blanco"></button>
                <button onclick="cambiarColor('#ff0000')" class="btn btn-custom-red" title="Rojo" aria-label="Rojo"></button>
                <button onclick="cambiarColor('#0000ff')" class="btn btn-custom-blue" title="Azul" aria-label="Azul"></button>
                <button onclick="cambiarColor('#000000')" class="btn btn-custom-black" title="Negro" aria-label="Negro"></button>
                <button onclick="cambiarColor('#e1c699')" class="btn btn-custom-crema" title="Crema" aria-label="Crema"></button>
                <br>
                <br>
            </div>
            <div class="card-body">
                <h3>Espacio para Personalización</h3>
                <br>
                <br>
                <div class="body-imagenes" style="display: flex; flex-wrap: wrap; justify-content: space-between;">
                    <img onclick="agregarImagenPreestablecida('imagen_gato')" class="imagen_plantilla" src="{{ asset('img/imagen_gato.png') }}" alt="Imagen Gato">
                    <img onclick="agregarImagenPreestablecida('san_valentin_rem')" class="imagen_plantilla" src="{{ asset('img/san_valentin_rem.png') }}" alt="San Valentín">
                    <img onclick="agregarImagenPreestablecida('dinero_rem')" class="imagen_plantilla" src="{{ asset('img/dinero_rem.png') }}" alt="Dinero">
                    <img onclick="agregarImagenPreestablecida('tenis_rem')" class="imagen_plantilla" src="{{ asset('img/tenis_rem.png') }}" alt="Tenis">
                </div>
            </div>
        </div>
    </div>

    <!-- Definir rutas de imágenes para uso en script.js -->
    <script>
        const imagePaths = {
            playera: "{{ asset('img/playera.png') }}",
            imagen_gato: "{{ asset('img/imagen_gato.png') }}",
            san_valentin_rem: "{{ asset('img/san_valentin_rem.png') }}",
            dinero_rem: "{{ asset('img/dinero_rem.png') }}",
            tenis_rem: "{{ asset('img/tenis_rem.png') }}"
        };
    </script>

    <!-- Fabric.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.1/fabric.min.js"></script>
    
    <!-- JavaScript Personalizado -->
    <script>
        // Inicializar el canvas de Fabric.js
        const canvas = new fabric.Canvas('myCanvas');

        let playera = null;
        let tshirtBounds = null; // Variable para almacenar los límites de la playera

        function crearPlayera() {
            fabric.Image.fromURL(imagePaths.playera, function(img) {
                img.set({
                    left: 4, 
                    top: 40, 
                    scaleX: 0.25,
                    scaleY: 0.25,
                    selectable: false // No permite mover la playera
                });

                playera = img;

                canvas.add(img);
                canvas.renderAll();

                // Calcular y almacenar los límites de la playera
                tshirtBounds = img.getBoundingRect();
            });
        }

        // Función para cambiar el color de la playera
        function cambiarColor(color) {
            if (playera) {
                playera.filters = []; 

                const colorMatrix = new fabric.Image.filters.ColorMatrix({
                    matrix: [
                        0, 0, 0, 0, 0, 
                        0, 0, 0, 0, 0, 
                        0, 0, 0, 0, 0, 
                        0, 0, 0, 1, 0,
                        0, 0, 0, 0, 0  
                    ]
                });

                const hexColor = colorToRGBA(color);

                colorMatrix.matrix[0] = hexColor[0]; 
                colorMatrix.matrix[5] = hexColor[1]; 
                colorMatrix.matrix[10] = hexColor[2]; 

                playera.filters.push(colorMatrix);
                playera.applyFilters();
                canvas.renderAll();
            }
        }
        
        // Convertir color hexadecimal a componentes RGBA normalizados
        function colorToRGBA(color) {
            if (color.startsWith('#')) {
                color = color.slice(1);
            }
            const r = parseInt(color.slice(0, 2), 16) / 255;
            const g = parseInt(color.slice(2, 4), 16) / 255;
            const b = parseInt(color.slice(4, 6), 16) / 255;
        
            return [r, g, b];
        }
        
        // Función para descargar la imagen personalizada
        function descargarImagen() {
            const link = document.createElement('a');
            link.href = canvas.toDataURL({ format: 'png' });
            link.download = 'mi_diseño.png'; 
            link.click();
        }
        
        var maxImg = 4; // Permitir hasta 4 imágenes

        function agregarImagenPreestablecida(imagenKey) {
            // Contar solo las imágenes añadidas (excluyendo la playera)
            var imageCount = canvas.getObjects('image').filter(obj => obj !== playera).length;
            if(imageCount >= maxImg) {
                alert('Excediste el número máximo de imágenes por playera');
                return;
            } else {
                fabric.Image.fromURL(imagePaths[imagenKey], function(img) {
                    img.set({
                        left: 170, 
                        top: 100,
                        scaleX: 0.5,
                        scaleY: 0.5,
                        selectable: true,
                        hasControls: true, // Permitir redimensionar
                        lockRotation: true, // Deshabilitar rotación
                        cornerStyle: 'circle', // Mejor apariencia de controles
                        cornerColor: 'blue',
                        cornerSize: 10,
                        transparentCorners: false,
                        minScaleLimit: 0.3, // Escala mínima
                        originX: 'center',
                        originY: 'center',
                        hasBorders: true,
                        hasControls: true,
                        lockMovementX: false,
                        lockMovementY: false,
                    });

                    // Restringir movimiento dentro de los límites de la playera
                    img.on('moving', function() {
                        if (!tshirtBounds) return;

                        var obj = img;
                        obj.setCoords();
                        var objBounding = obj.getBoundingRect();

                        // Ajustar posición si se sale por la izquierda
                        if(objBounding.left < tshirtBounds.left){
                            obj.left += tshirtBounds.left - objBounding.left;
                        }
                        // Ajustar posición si se sale por arriba
                        if(objBounding.top < tshirtBounds.top){
                            obj.top += tshirtBounds.top - objBounding.top;
                        }
                        // Ajustar posición si se sale por la derecha
                        if(objBounding.left + objBounding.width > tshirtBounds.left + tshirtBounds.width){
                            obj.left -= (objBounding.left + objBounding.width) - (tshirtBounds.left + tshirtBounds.width);
                        }
                        // Ajustar posición si se sale por abajo
                        if(objBounding.top + objBounding.height > tshirtBounds.top + tshirtBounds.height){
                            obj.top -= (objBounding.top + objBounding.height) - (tshirtBounds.top + tshirtBounds.height);
                        }
                    });

                    // Restringir redimensionamiento dentro de la playera
                    img.on('scaling', function() {
                        if (!tshirtBounds) return;

                        var obj = img;
                        var objBounding = obj.getBoundingRect();

                        // Evitar que se escale por debajo del límite
                        if(obj.scaleX < obj.minScaleLimit){
                            obj.scaleX = obj.minScaleLimit;
                        }
                        if(obj.scaleY < obj.minScaleLimit){
                            obj.scaleY = obj.minScaleLimit;
                        }

                        // Evitar que se escale más allá de la playera
                        if(objBounding.width > tshirtBounds.width){
                            obj.scaleX = tshirtBounds.width / obj.width;
                        }
                        if(objBounding.height > tshirtBounds.height){
                            obj.scaleY = tshirtBounds.height / obj.height;
                        }
                    });

                    canvas.add(img);
                    canvas.renderAll();
                });
            }
        }

        // Función para eliminar objetos (excluyendo la playera)
        function eliminarObjeto () {
            var activeObject = canvas.getActiveObject();
        
            if(activeObject && activeObject !== playera) {
                canvas.remove(activeObject);
                canvas.renderAll();
            } else{
                alert('Para eliminar, tienes que seleccionar una imagen en la playera :)');
            }
        }
        
        // Crear la playera al cargar la página
        crearPlayera();
    </script>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
@endsection
