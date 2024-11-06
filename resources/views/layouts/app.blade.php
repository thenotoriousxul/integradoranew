<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts Bebas Neue -->
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
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
        .footer {
            background-color: #ffffff;
            color: #000000;
            padding: 40px 0;
            font-size: 1rem;
        }
        .footer h5 {
            font-size: 1.2rem;
        }
        .footer p, .footer a {
            color: #000000;
        }
        .footer a:hover {
            color: #007bff;
            text-decoration: underline;
        }
        .footer .text-center {
            background-color: #f8f9fa;
            color: #6c757d;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .centered-nav {
                position: static;
                transform: none;
                margin-top: 10px;
            }
            .navbar-nav-center {
                flex-direction: column;
                align-items: center;
                gap: 1rem;
            }
        }
    </style>
</head>
<body class="m-0 p-0">
    <div id="app" class="m-0 p-0">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container position-relative">
                <!-- Logo alineado a la izquierda -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    OZEZ
                </a>

                <!-- Toggle button for mobile view -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Centered Navigation Links -->
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

                <!-- Right Side of Navbar -->
                <div class="col-auto ms-auto">
                    <ul class="navbar-nav">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                                </li>
                            @endif
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

        <!-- Main Content -->
        <main class="m-0 p-0">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="footer text-center text-lg-start">
            <div class="container p-4">
                <div class="row">
                    <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                        <h5 class="text-uppercase">OZEZ</h5>
                        <p>Moda auténtica y responsable. Encuentra tu estilo en nuestra colección exclusiva.</p>
                    </div>

                    <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                        <h5 class="text-uppercase">Enlaces</h5>
                        <ul class="list-unstyled mb-0">
                            <li><a href="{{ url('/') }}" class="text-dark">Inicio</a></li>
                            <li><a href="{{ route('productos') }}" class="text-dark">Catálogo</a></li>
                            <li><a href="{{ route('logout') }}" class="text-dark">Personalización</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="text-center p-3">
                © {{ date('Y') }} OZEZ - Todos los derechos reservados.
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
