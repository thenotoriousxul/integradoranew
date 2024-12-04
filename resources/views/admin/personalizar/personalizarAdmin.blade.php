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
            <i onclick="descargarImagen()" class="fa-solid fa-floppy-disk fa-2xl" title="Guardar"></i>
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
                            onclick="agregarEstampado('{{ $estampado->imagen_estampado }}')" 
                        >
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.1/fabric.min.js"></script>
    <script>
        const canvas = new fabric.Canvas('myCanvas');
        let playera = null;
        let logoObject = null;

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

        function cambiarColor(color) {
            if (playera) {
                playera.filters = [];
                playera.filters.push(new fabric.Image.filters.BlendColor({
                    color: color,
                    mode: 'multiply'
                }));
                playera.applyFilters();
                canvas.renderAll();
            }
        }

        function agregarEstampado(imagePath) {
            if (logoObject) {
                alert('Solo puedes agregar un estampado a la vez. Elimina el actual antes de agregar otro.');
                return;
            }

            fabric.Image.fromURL(imagePath, function(img) {
                img.set({
                    left: canvas.width / 2,
                    top: canvas.height / 2,
                    scaleX: 0.2,
                    scaleY: 0.2,
                    originX: 'center',
                    originY: 'center',
                    selectable: true
                });

                canvas.add(img);
                canvas.setActiveObject(img);
                logoObject = img;
            }),{CrossOrigin: 'anonymous'};
        }

        function eliminarObjeto() {
            if (logoObject) {
                canvas.remove(logoObject);
                logoObject = null;
            } else {
                alert('No hay estampados para eliminar.');
            }
        }
        function descargarImagen() {
            const link = document.createElement('a');
            link.href = canvas.toDataURL({ format: 'png' });
            link.download = 'mi_diseño.png'; 
            link.click();
        }
        
        var maxImg = 2;

        crearPlayera();
    </script>
@endsection
