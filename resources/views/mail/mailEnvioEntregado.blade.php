<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Entrega</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
        }
        .container {
            background-color: #ffffff;
            padding: 30px;
            border: 1px solid #e0e0e0;
        }
        .header {
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        h1 {
            color: #000;
            margin: 0;
        }
        .content {
            margin-top: 20px;
        }
        .delivery-details {
            background-color: #f5f5f5;
            padding: 15px;
            margin: 20px 0;
            border-left: 3px solid #333;
        }
        .footer {
            margin-top: 30px;
            padding-top: 10px;
            border-top: 1px solid #e0e0e0;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Su Envío ha sido Entregado</h1>
        </div>
        <div class="content">
            <p>Estimado cliente,</p>
            <p>Nos complace informarle que su envío ha sido entregado con éxito.</p>
            <div class="delivery-details">
                <p><strong>Detalles de la entrega:</strong></p>
                <p>Fecha de Entrega: 8 de diciembre de 2024</p>
                <p>Dirección de Entrega: Calle Principal 123, Ciudad, País</p>
            </div>
            <p>Su pedido ha sido entregado en la dirección proporcionada. La orden se ha eliminado automáticamente de su panel de control.</p>
            <p>Si tiene alguna pregunta o inquietud sobre su entrega, no dude en contactar a nuestro equipo de atención al cliente.</p>
            <p>Gracias por confiar en nuestros servicios de envío.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.</p>
            <p>Este es un correo electrónico automático, por favor no responda a este mensaje.</p>
        </div>
    </div>
</body>
</html>