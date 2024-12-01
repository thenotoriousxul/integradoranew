<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Dashboard' }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous"
    />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }

        body {
            min-height: 100vh;
            background-color: #fff;
        }

        .contenedor {
            display: flex;
            min-height: 100vh;
        }

        .contenido {
            flex-grow: 1;
            padding: 20px;
        }

        #sidebar {
            width: 400px;
            transition: transform 0.3s ease-in-out;
        }

        @media (max-width: 768px) {
            #sidebar {
                position: fixed;
                top: 0;
                right: 0;
                height: 100%;
                transform: translateX(100%);
            }
        }

        #sidebar.active {
            transform: translateX(0);
        }

        .hamburger {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            cursor: pointer;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }

        @media (min-width: 769px) {
            .hamburger {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="hamburger" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </div>

    <div class="contenedor">
        <main class="contenido">
            @yield('content')
        </main>
        
        @include('cliente.layouts.sidebar')
    </div>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"
    ></script>
    <script src="{{ asset('js/sidebaruser.js') }}" defer></script>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap JS (con Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>



