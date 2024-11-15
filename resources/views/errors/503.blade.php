<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sitio en Mantenimiento</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Bebas Neue', sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #333;
            text-align: center;
            box-sizing: border-box;
            overflow: hidden;
        }
        .container {
            text-align: center;
            background-color: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 90%;
            width: 500px; /* Ancho predeterminado */
        }
        .logo {
            max-width: 100px;
            margin: 0 auto 1rem;
        }
        h1 {
            color: #333;
            margin-bottom: 0.8rem;
            font-size: 1.8rem;
        }
        p {
            margin-bottom: 1rem;
            font-size: 1rem;
            color: #666;
        }
        .animation {
            width: 250px;
            height: 250px;
            margin: 0 auto 1rem;
        }

        /* Ajuste de ancho para pantallas grandes */
        @media (min-width: 1024px) {
            .container {
                width: 700px; /* Ancho más amplio en pantallas grandes */
            }
            .animation {
                width: 300px;
                height: 300px;
            }
            h1 {
                font-size: 2rem;
            }
            p {
                font-size: 1.1rem;
            }
        }

        @media (max-width: 480px) {
            .container {
                width: 100%;
                padding: 1rem;
            }
            h1 {
                font-size: 1.5rem;
            }
            p {
                font-size: 0.9rem;
            }
            .animation {
                width: 200px;
                height: 200px;
            }
        }
    </style>
    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
</head>
<body>
    <div class="container" role="main">
        <img src="{{ asset('img/ozeztrc.png') }}" alt="Logo" class="logo">

        <dotlottie-player 
            src="https://lottie.host/45263978-a833-4002-906a-e209513abf42/e4b9DTR3dx.json" 
            background="transparent" 
            speed="1" 
            style="width: 250px; height: 250px;" 
            loop 
            autoplay 
            class="animation">
        </dotlottie-player>

        <h1>Sitio en Mantenimiento</h1>
        <p>Estamos realizando algunas mejoras. Por favor, vuelve a intentarlo más tarde.</p>
        <p>Disculpa las molestias. ¡Gracias por tu paciencia!</p>
        <p>Esperamos vuelvas pronto.</p>
    </div>
</body>
</html>
