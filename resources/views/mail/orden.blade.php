<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido Confirmado - Tu Tienda</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #000;
        }
        .container {
            max-width: 600px;
            margin: 2rem auto;
            background-color: white;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .logo {
            width: 120px;
            margin-bottom: 1rem;
        }
        h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        .success-message {
            font-size: 1.2rem;
            color: #00a86b;
            margin-bottom: 2rem;
        }
        .order-details {
            background-color: #f8f8f8;
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 2rem;
        }
        .order-number {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        .order-summary {
            margin-bottom: 1.5rem;
        }
        .order-summary h2 {
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            text-align: left;
            padding: 0.5rem;
            border-bottom: 1px solid #ddd;
        }
        .total {
            font-weight: 700;
            font-size: 1.1rem;
        }
        .shipping-info {
            margin-bottom: 1.5rem;
        }
        .shipping-info h2 {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }
        .btn {
            display: inline-block;
            padding: 0.8rem 1.5rem;
            background-color: #000;
            color: white;
            text-decoration: none;
            border-radius: 30px;
            transition: background-color 0.3s ease;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .btn:hover {
            background-color: #333;
        }
        .footer {
            text-align: center;
            margin-top: 2rem;
            color: #666;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('img/ozeztrc.png') }}" alt="Logo de la tienda" class="logo">
            <h1>¡Gracias por tu compra!</h1>
            <p class="success-message">Tu pedido ha sido confirmado y está siendo procesado.</p>
        </div>

        <div class="order-details">
            <p class="order-number">Número de pedido: <strong>{{$numeroPedido}}</strong> </p>
            <div class="order-summary">
                <h2>Resumen del pedido</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody>
    @foreach($productos as $producto)
        <tr>
            <td>{{ $producto->edicionProducto->nombre ?? 'Producto desconocido' }}</td>
            <td>{{ $producto->cantidad }}</td>
            <td>${{ number_format($producto->total, 2) }}</td>
        </tr>
    @endforeach
    <tr class="total">
        <td colspan="2">Total</td>
        <td>${{ number_format($total, 2) }}</td>
    </tr>
    </tbody>

                </table>
            </div>
            <div class="shipping-info">
                <h2>Información de envío</h2>
                <p>Tiempo estimado de entrega: 3-5 días hábiles</p>
            </div>
        </div>

        <div class="footer">
            <p>Si tienes alguna pregunta sobre tu pedido, por favor contáctanos en support@ozez.com</p>
            <p>&copy; 2023 Tu Tienda. Todos los derechos reservados.</p>
        </div>
    </div>
</body>
</html>

