<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Bienvenida al Equipo' }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f6f9fc;
            color: #333;
            line-height: 1.6;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 30px 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
        }
        .content {
            padding: 40px 30px;
        }
        .welcome-message {
            font-size: 20px;
            color: #2c3e50;
            margin-bottom: 20px;
        }
        .credentials {
            background-color: #e8f5e9;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .credentials p {
            margin: 10px 0;
            font-size: 16px;
        }
        .credentials strong {
            color: #1b5e20;
        }
        .footer {
            background-color: #f4f4f4;
            color: #666;
            text-align: center;
            padding: 20px;
            font-size: 14px;
        }
        a {
            color: #4CAF50;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ $header ?? '¡Bienvenido a Nuestro Equipo!' }}</h1>
        </div>
        <div class="content">
            <p class="welcome-message">Estimado/a nuevo/a integrante,</p>
            <p>{{ $slot }}</p>
            <div class="credentials">
                <p><strong>Tu correo para iniciar sesión es:</strong> {{ $email }}</p>
                <p><strong>Tu contraseña temporal es:</strong> {{ $password }}</p>
            </div>
            <p>Por favor, cambia tu contraseña después del primer inicio de sesión por motivos de seguridad.</p>
            <p>Si tienes alguna pregunta, no dudes en contactar a nuestro equipo de soporte.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.</p>
            <p>Este es un correo electrónico automático, por favor no responda a este mensaje.</p>
        </div>
    </div>
</body>
</html>
