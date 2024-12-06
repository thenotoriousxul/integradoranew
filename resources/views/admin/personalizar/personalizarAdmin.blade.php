@extends('admin.layouts.dashboard')

@section('content')
    <style>
        .custom-container {
            display: flex;
            flex-direction: row;
            margin-top: 30px;
            flex-wrap: nowrap;
            align-items: flex-start;
            justify-content: space-between;
            padding: 0 20px;
        }

        .opciones {
            width: 120px;
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

        .Elcanvas-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 20px;
        }

        #myCanvas {
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f2f2f2;
        }

        .custom-card {
            width: 300px;
            background-color: #fff;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-height: 700px;
            overflow-y: auto;
        }

        .custom-card .card-header {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: #333;
            text-align: center;
        }

        .estampado-img {
            width: 100%;
            max-width: 100px;
            height: auto;
            cursor: pointer;
            margin: 5px 0;
            border: 2px solid transparent;
            border-radius: 5px;
            transition: border-color 0.3s;
        }

        .estampado-img:hover {
            border-color: #333;
        }

        .color-btn {
            border-radius: 50%;
            width: 30px;
            height: 30px;
            border: none;
            margin: 5px;
            cursor: pointer;
        }

        .btn-red { background-color: red; }
        .btn-blue { background-color: blue; }
        .btn-black { background-color: black; }
        .btn-white { background-color: white; border: 1px solid #ddd; }
        .btn-cream { background-color: #e1c699; }
    </style>

    <div class="custom-container">
        <div class="opciones">
            <i onclick="eliminarObjeto()" class="fa-solid fa-trash fa-2xl" title="Eliminar"></i>
        </div>

        <div class="Elcanvas-container">
            <canvas id="myCanvas" width="550" height="600"></canvas>
        </div>

        <div class="custom-card">
            <div class="card-header">
                Configuración y Estampados
            </div>
            <div class="card-body">
                <h3>Colores</h3>
                <div class="d-flex flex-wrap">
                    <button class="color-btn btn-white" onclick="cambiarColor('#ffffff')"></button>
                    <button class="color-btn btn-red" onclick="cambiarColor('#ff0000')"></button>
                    <button class="color-btn btn-blue" onclick="cambiarColor('#0000ff')"></button>
                    <button class="color-btn btn-black" onclick="cambiarColor('#000000')"></button>
                    <button class="color-btn btn-cream" onclick="cambiarColor('#e1c699')"></button>
                </div>
                <br>
                <h3>Estampados</h3>
                <div class="body-imagenes">
                    @foreach($estampados as $estampado)
                        <img 
                            src="{{ $estampado->imagen_estampado }}" 
                            alt="{{ $estampado->nombre }}" 
                            class="estampado-img"
                            onclick="agregarEstampado('{{ $estampado->imagen_estampado }}', '{{ $estampado->id }}')" 
                        >
                    @endforeach
                </div>
                <br>
                <button id="descargarBtn" class="btn btn-success" onclick="descargarImagen()">Descargar Imagen</button>
            </div>
        </div>
    </div>

    <input type="hidden" id="estampado_id" name="estampado_id" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.1/fabric.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const canvas = new fabric.Canvas('myCanvas');
        let playera = null;
        let logoObject = null;
        let playeraBounds = null;

        function crearPlayera() {
            fabric.Image.fromURL('{{ asset('img/playera.png') }}', function(img) {
                img.set({
                    left: 0,
                    top: 0,
                    scaleX: canvas.width / img.width,
                    scaleY: canvas.height / img.height,
                    selectable: false
                });
                canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas));
                playera = img;

                playeraBounds = img.getBoundingRect();
            });
        }

        function cambiarColor(color) {
            if (playera) {
                playera.filters = [];
                playera.filters.push(new fabric.Image.filters.Tint({ color: color }));
                playera.applyFilters();
                canvas.renderAll();
            }
        }

        function agregarEstampado(imagen, estampado_id) {
            fabric.Image.fromURL(imagen, function(img) {
                img.set({
                    left: canvas.width / 2 - img.width / 2,
                    top: canvas.height / 2 - img.height / 2,
                    selectable: true,
                    estampadoId: estampado_id
                });
                canvas.add(img);
                logoObject = img;

                document.getElementById('estampado_id').value = estampado_id;
            });
        }

        function eliminarObjeto() {
            // Eliminar todos los objetos estampados (logoObject y cualquier otro en el canvas)
            canvas.getObjects().forEach(function(obj) {
                if (obj.estampadoId) {
                    canvas.remove(obj);
                }
            });
            canvas.renderAll();

            // Limpiar el campo oculto
            document.getElementById('estampado_id').value = '';
        }

    function descargarImagen() {
     if (!logoObject) {
         alert("Primero debes agregar un estampado para descargar la imagen.");
         return;
     }

     // Convierte el canvas a una imagen en formato base64
     const dataURL = canvas.toDataURL({
         format: 'png',
         quality: 1.0
     });

     // Crea un enlace temporal para la descarga
     const enlace = document.createElement('a');
     enlace.href = dataURL;
     enlace.download = 'playera_con_estampado.png';
     enlace.click();
     }


        $(document).ready(function() {
            crearPlayera();
        });
    </script>
@endsection
