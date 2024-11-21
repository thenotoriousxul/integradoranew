{{-- resources/views/personalizacion.blade.php --}}
@extends('layouts.app')

@section('content')
    <!-- Estilos Personalizados -->
    <style>
        /* Contenedor Principal */
        .custom-container {
            display: flex;
            flex-direction: row;
            margin-top: 30px; /* Aumentado para más espacio desde la parte superior */
            flex-wrap: nowrap; /* Mantiene los elementos en una sola fila */
            align-items: flex-start; /* Alinea al inicio verticalmente */
            justify-content: space-between; /* Distribuye espacio equitativamente */
            padding: 0 20px; /* Espaciado horizontal */
        }

        /* Estilos de Opciones */
        .opciones {
            width: 80px; /* Ancho fijo para las opciones de personalización */
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
            color: #333; /* Color de los íconos cambiado a gris oscuro */
            transition: color 0.3s;
        }

        .opciones i:hover {
            color: #555; /* Color al pasar el cursor */
        }

        /* Estilos de la Card de Configuración */
        .custom-card {
            width: 250px; /* Ancho reducido para opciones de configuración */
            background-color: #fff;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-height: 700px; /* Altura máxima para evitar alargamiento excesivo */
            overflow-y: auto; /* Scroll vertical si el contenido excede la altura */
        }

        .custom-card .card-header {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: #333; /* Color de fuente cambiado a gris oscuro */
            text-align: center;
        }

        /* Estilos de las Imágenes Preestablecidas */
        .imagen_plantilla {
            width: 100%;
            max-width: 200px;
            height: auto;
            cursor: pointer;
            margin: 5px 0;
            border: 2px solid transparent;
            border-radius: 5px;
            transition: border-color 0.3s;
        }

        .imagen_plantilla:hover {
            border-color: #333; /* Color de borde al pasar el cursor */
        }

        /* Estilos de los Botones de Color */
        .btn-custom-red, .btn-custom-blue, .btn-custom-black, .btn-custom-crema, .btn-outline-light {
            border-radius: 50%;
            width: 30px; /* Reducido de 35px a 30px para mayor compactación */
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
            flex: 1; /* Toma el espacio restante */
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0 20px; /* Espaciado horizontal */
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
                max-height: none; /* Elimina la altura máxima en pantallas pequeñas */
            }

            .imagen_plantilla {
                max-width: 150px;
            }
        }

        @media (max-width: 576px) {
            .opciones {
                padding: 10px;
            }

            .btn-custom-red, .btn-custom-blue, .btn-custom-black, .btn-custom-crema, .btn-outline-light {
                width: 25px; /* Reducido a 25px */
                height: 25px;
            }

            .custom-card {
                padding: 10px;
            }

            #myCanvas {
                width: 100%;
                height: auto;
            }
        }
    </style>

    <!-- Contenedor Principal -->
    <div class="custom-container">
        <!-- Opciones de Personalización -->
        <div class="opciones">
            <i class="fa-solid fa-shirt fa-2xl" title="Productos" aria-label="Productos" role="button"></i>
            <i onclick="descargarImagen()" class="fa-solid fa-floppy-disk fa-2xl" title="Guardar" aria-label="Guardar" role="button"></i>
            <!-- Ícono "Agregar Texto" eliminado -->
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
                <!-- Sección "Color Personalizado" eliminada -->
            </div>
            <div class="card-body">
                <h3>Espacio para Personalización</h3>
                <br>
                <br>
                <div class="body-imagenes">
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
            });
        }
        
        // Se elimina el listener para 'color-picker' ya que no se usa más
        /*
        document.getElementById('color-picker').addEventListener('input', function(){
            const colorSeleccionado = this.value;
            cambiarColor(colorSeleccionado);
        });
        */
        
        function cambiarColor(color) {
            if (playera) {
                playera.filters = []; 
        
                // Crear un filtro de ColorMatrix
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
        
        function colorToRGBA(color) {
            if (color.startsWith('#')) {
                color = color.slice(1);
            }
            const r = parseInt(color.slice(0, 2), 16) / 255;
            const g = parseInt(color.slice(2, 4), 16) / 255;
            const b = parseInt(color.slice(4, 6), 16) / 255;
        
            return [r, g, b];
        }
        
        function descargarImagen() {
            const link = document.createElement('a');
            link.href = canvas.toDataURL({ format: 'png' });
            link.download = 'mi_diseño.png'; 
            link.click();
        }
        
        var maxImg = 2;
        
        function agregarImagenPreestablecida(imagenKey) {
            var imageCount = canvas.getObjects('image').length;
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
                        hasControls: false,
                        lockMovementX: true,
                        lockMovementY: true
                    });
                    canvas.add(img);
                    canvas.renderAll();
                });
            }
        }
        
        // Se elimina la función 'agregarTexto' ya que la opción ha sido eliminada
        /*
        function agregarTexto() {
            var textoEditable = new fabric.Textbox('Escribe aquí...', {
                left: 100,
                top: 100,
                width: 200,          
                fontSize: 30,
                hasControls: true,
                lockMovementX: false,
                lockMovementY: false,
                fill: '#000000',
                textAlign: 'center',
                borderColor: 'black', 
                cornerColor: 'blue',  
                cornerSize: 10       
            });
        
            canvas.add(textoEditable);
            canvas.renderAll();
        }
        */
        
        function eliminarObjeto () {
            var activeObject = canvas.getActiveObject();
        
            if(activeObject) {
                canvas.remove(activeObject);
                canvas.renderAll();
            } else{
                alert('Para eliminar, tienes que seleccionar la imagen o texto en la playera :)');
            }
        }
        
        crearPlayera();
    </script>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
@endsection
