<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manual de Usuario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .container {
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1, h2, h3 {
            color: #2c3e50;
            margin-top: 20px;
        }

        p {
            margin: 10px 0;
            color: #34495e;
        }

        ul {
            padding-left: 20px;
        }

        ul li {
            margin: 8px 0;
        }

        .section {
            margin-bottom: 30px;
        }

        .footer {
            text-align: center;
            margin-top: 50px;
            font-size: 14px;
            color: #95a5a6;
        }

        .logo {
            display: block;
            max-width: 150px;
            margin: 0 auto 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ asset('img/ozeztrc.png') }}" alt="Logo" class="logo">

        <h1>Manual de Usuario</h1>
        <p>Bienvenido al manual de usuario. Aquí encontrarás instrucciones básicas para utilizar el sistema.</p>

        <div class="section">
            <h2>1. Introducción</h2>
            <p>Este sistema ha sido diseñado para facilitar la gestión de productos, órdenes y configuraciones administrativas. A continuación, aprenderás cómo utilizar sus funciones principales.</p>
        </div>

        <div class="section">
            <h2>2. Inicio de Sesión</h2>
            <p>Sigue estos pasos para acceder al sistema:</p>
            <ul>
                <li>Visita la página principal del sistema.</li>
                <li>Introduce tu nombre de usuario y contraseña.</li>
                <li>Haz clic en el botón <strong>"Iniciar Sesión"</strong>.</li>
                <li>Si olvidaste tu contraseña, selecciona la opción <strong>"Recuperar Contraseña"</strong>.</li>
            </ul>
        </div>

        <div class="section">
            <h2>3. Gestión de Productos</h2>
            <p>En esta sección podrás crear, editar y eliminar productos. Sigue estos pasos:</p>
            <ul>
                <li>Dirígete al menú <strong>"Productos"</strong>.</li>
                <li>Para agregar un nuevo producto, selecciona <strong>"Crear Producto"</strong>.</li>
                <li>Completa el formulario con la información del producto y guarda los cambios.</li>
                <li>Para editar un producto existente, selecciona el producto y haz clic en <strong>"Editar"</strong>.</li>
            </ul>
        </div>

        <div class="section">
            <h2>4. Generación de Reportes</h2>
            <p>Para generar reportes de ventas y productos:</p>
            <ul>
                <li>Accede al menú <strong>"Reportes"</strong>.</li>
                <li>Selecciona el tipo de reporte que deseas generar (Ventas, Productos, Clientes).</li>
                <li>Define el rango de fechas y otros filtros.</li>
                <li>Haz clic en <strong>"Generar Reporte"</strong>.</li>
            </ul>
        </div>

        <div class="section">
            <h2>5. Configuración</h2>
            <p>Personaliza el sistema según tus necesidades:</p>
            <ul>
                <li>Accede al menú <strong>"Configuración"</strong>.</li>
                <li>Actualiza la información de la empresa, usuarios o ajustes generales.</li>
                <li>Guarda los cambios para aplicarlos inmediatamente.</li>
            </ul>
        </div>

        <div class="footer">
            <p>Manual de Usuario - Sistema OzeztRC © {{ now()->year }}</p>
        </div>
    </div>
</body>
</html>
