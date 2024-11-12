<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página no encontrada</title>

    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">

    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #ffffff; 
            font-family: 'Bebas Neue', sans-serif;
            color: #000000; 
            text-align: center;
        }
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        h1 {
            font-size: 2em;
            margin: 8px 0; 
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #000000; 
            color: white;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            font-size: 1.3em;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #333333;
        }

        .animation {
            width: 60vw;
            height: 60vh;
            max-width: 300px;
            max-height: 300px;
        }
        p {
            font-size: 1.4em;
            margin: 8px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
        <dotlottie-player 
            src="https://lottie.host/612c2308-cc00-4ffc-b352-5b89d90a96f6/Vg8fL0LNdF.json" 
            background="transparent" 
            speed="1" 
            loop 
            autoplay 
            class="animation">
        </dotlottie-player>

        <h1>Oops! Página no encontrada</h1>
        <p>La página que estás buscando no existe.</p>
        <a href="{{ url('/') }}" class="btn">Volver al inicio</a>
    </div>
</body>
</html>
