@extends('admin.layouts.dashboard')

@section('content')
    <!-- Estilos Personalizados -->
    <style>
        /* Manteniendo los estilos existentes */
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
                max-height: none;
            }

            .estampado-img {
                max-width: 80px;
            }
        }

        @media (max-width: 576px) {
            .opciones {
                padding: 10px;
            }

            .custom-card {
                padding: 10px;
            }
        }
    </style>

    <!-- Contenedor Principal -->
    <div class="custom-container">
        <!-- Opciones de Personalización -->
        <div class="opciones">
            <i onclick="descargarImagen()" class="fa-solid fa-floppy-disk fa-2xl" title="Guardar"></i>
            <i onclick="eliminarObjeto()" class="fa-solid fa-trash fa-2xl" title="Eliminar"></i>
        </div>

        <!-- Canvas para Personalización -->
        <div class="Elcanvas-container">
            <canvas id="myCanvas" width="550" height="600"></canvas>
        </div>

        <!-- Estampados Disponibles -->
        <div class="custom-card">
            <div class="card-header">
                Estampados Disponibles
            </div>
            <div class="card-body">
                <div class="body-imagenes">
                    @foreach($estampados as $estampado)
                        <img 
                            src="{{ $estampado->imagen_estampado }}" 
                            alt="{{ $estampado->nombre }}" 
                            class="estampado-img" 
                            onclick="agregarEstampado('{{ $estampado->imagen_estampado }}')" 
                        >
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Personalizado -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.1/fabric.min.js"></script>
    <script>
        const canvas = new fabric.Canvas('myCanvas');
        let playera = null;
        let logoObject = null;

        // Cargar playera inicial
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
            });
        }

        // Agregar estampado al canvas
        function agregarEstampado(imagePath) {
            if (logoObject) {
                alert('Solo puedes agregar un estampado a la vez. Elimina el actual antes de agregar otro.');
                return;
            }

            fabric.Image.fromURL(imagePath, function(img) {
                img.set({
                    left: canvas.width / 2,
                    top: canvas.height / 2,
                    scaleX: 0.3,
                    scaleY: 0.3,
                    originX: 'center',
                    originY: 'center',
                    selectable: true
                });

                canvas.add(img);
                canvas.setActiveObject(img);
                logoObject = img;
            });
        }

        // Eliminar estampado
        function eliminarObjeto() {
            if (logoObject) {
                canvas.remove(logoObject);
                logoObject = null;
            } else {
                alert('No hay estampados para eliminar.');
            }
        }

        // Descargar diseño
        function descargarImagen() {
            const link = document.createElement('a');
            link.href = canvas.toDataURL('image/png');
            link.download = 'diseño_personalizado.png';
            link.click();
        }

        // Inicializar canvas y cargar playera
        crearPlayera();
    </script>
@endsection
