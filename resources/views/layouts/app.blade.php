<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        .navbar-brand, .nav-link {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.4rem;
            color: black !important;
        }
        .nav-link:hover {
            color: blue !important;
        }
        .navbar-nav-center {
            display: flex;
            gap: 2rem;
        }
        .centered-nav {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }

        footer {
            background-color: white;
            padding: 40px 0 20px;
            color: #000;
            overflow: hidden;
            border-top: 2px solid black;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            padding: 0 20px;
        }

        .footer-column {
            flex: 1;
            min-width: 200px;
            margin-bottom: 20px;
        }

        .footer-column h3 {
            font-size: 26px; 
            margin-bottom: 15px;
            color: #000;
            letter-spacing: 1px;
        }

        .footer-column a {
            display: block;
            color: #000;
            text-decoration: none;
            margin-bottom: 8px;
            font-size: 16px; 
            transition: color 0.3s;
        }

        .footer-column a:hover {
            color: #000;
        }

        .footer-bottom {
            margin-top: 20px;
            text-align: center;
            font-size: 14px; 
            color: #000;
        }

        .social-icons {
            display: flex;
        }

        .social-icons a {
            color: #000; 
            margin: 0 10px;
            font-size: 28px; 
            transition: color 0.3s;
        }

        .social-icons a:hover {
            color: #000;
        }

        .footer-column p {
            font-size: 14px;
            color: #000; 
        }
    </style>
</head>
<body class="m-0 p-0">
    <div id="app" class="m-0 p-0">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container position-relative">
                <a class="navbar-brand" href="{{ url('/') }}">
                    OZEZ
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse centered-nav" id="navbarNav">
                    <ul class="navbar-nav navbar-nav-center mx-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('productos') }}">Catálogo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}">Personalización</a>
                        </li>
                    </ul>
                </div>

                <div class="col-auto ms-auto">
                    <ul class="navbar-nav">
                        @guest
                            <li class="nav-item dropdown">
                                <a id="guestDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ __('Cuenta') }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="guestDropdown">
                                    <a class="dropdown-item" href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a>
                                    @if (Route::has('register'))
                                        <a class="dropdown-item" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                                    @endif
                                </div>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}">
                                        {{ __('Mis Pedidos') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="m-0 p-0">
            @yield('content')
        </main>

        <footer>
            <div class="footer-content">
                <div id="contacto" class="footer-column">
                    <h3>Contacto</h3>
                    <a href="#">Email</a>
                    <a href="#">Teléfono</a>
                    <p>¡Estamos aquí para ayudarte!</p>
                </div>
                <div class="footer-column">
                    <h3>Síguenos</h3>
                    <div class="social-icons">
                        <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" aria-label="Twitter"><i class="bi bi-twitter"></i></a>
                        <a href="#" aria-label="WhatsApp"><i class="bi bi-whatsapp"></i></a>
                    </div>
                    <p>¡Conéctate con nosotros en redes!</p> 
                </div>
                <div class="footer-column">
                    <h3>Playeras</h3>
                    <p>¡Viste con estilo y comodidad!</p> 
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} OZEZ. Todos los derechos reservados.</p>
            </div> 
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
