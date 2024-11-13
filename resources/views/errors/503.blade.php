<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sitio en Mantenimiento</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #333;
        }
        .container {
            text-align: center;
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 80%;
        }
        h1 {
            color: #e74c3c;
            margin-bottom: 1rem;
        }
        p {
            margin-bottom: 1.5rem;
        }
        .icon {
            font-size: 4rem;
            margin-bottom: 1rem;
            animation: spin 4s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        @media (max-width: 600px) {
            .container {
                padding: 1rem;
            }
            h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container" role="main">
        <div class="icon" aria-hidden="true">🛠️</div>
        <h1>Sitio en Mantenimiento</h1>
        <p>Estamos realizando algunas mejoras. Por favor, vuelve a intentarlo más tarde.</p>
        <p>Disculpa las molestias. ¡Gracias por tu paciencia!</p>
        <p>esperamos vuelvas pronto</p>
    </div>
</body>
</html>