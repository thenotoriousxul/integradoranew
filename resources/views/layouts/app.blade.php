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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="preload" as="image" href="{{ asset('img/byn.jpeg') }}">

    <style>
        #loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #000000;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            transition: opacity 0.5s ease;
        }
        
        #loading-screen img {
            width: 100px;
            height: 100px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .navbar {
            position: relative;
            z-index: 1000;
        }

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
            justify-content: center;
            align-items: center;
            gap: 2rem;
            width: 100%;
        }

        .dropdown-menu {
            background-color: white;
            z-index: 1050;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 0;
            border-radius: 5px;
        }

        .dropdown-menu .dropdown-item {
            padding: 0.75rem 1.25rem;
            text-align: center;
            margin: 0;
        }

        .total-cart {
            font-size: 1rem;
            color: #000;
            font-weight: bold;
            margin-left: 5px;
        }

        /* Centrar verticalmente los elementos en la barra de navegación */
        .navbar .navbar-nav .nav-item, .navbar .navbar-nav .nav-link, .navbar .navbar-brand {
            display: flex;
            align-items: center;
        }

        /* Espaciado y centrado para opciones de menú en pantallas pequeñas */
        @media (max-width: 768px) {
            .navbar-collapse {
                justify-content: center;
            }
            .navbar-nav {
                flex-direction: column;
                align-items: center;
            }
            .navbar-nav.ms-auto {
                justify-content: center;
                width: 100%;
            }
            .navbar-nav .nav-item {
                margin-bottom: 0;
            }
            .navbar-nav .nav-item.dropdown,
            .navbar-nav .nav-item.position-relative {
                margin-bottom: 10px; /* Separación entre Cuenta y Carrito */
            }
        }

        /* Separación entre "Cuenta" y el carrito en pantallas grandes */
        .navbar-nav .nav-item.position-relative {
            margin-left: 15px;
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
    <div id="loading-screen">
        <img src="{{ asset('img/ozeztrc.png') }}" alt="OZEZ Logo">
    </div>

    <div id="app" class="m-0 p-0">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container position-relative">
                <a class="navbar-brand" href="{{ url('/') }}">OZEZ</a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav navbar-nav-center">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('mostrar.productos') }}">Catálogo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('personalizacion') }}">Personalización</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('rebajas') }}">Rebajas</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ms-auto">
                        <!-- Usuario -->
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
                                    <a class="dropdown-item" href="{{ route('dash.menu') }}">{{ __('ir al panel administrador') }}</a>
                                </div>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    @if (Auth::user()->hasRole('cliente'))
                                        <a class="dropdown-item" href="{{ route('pedidos') }}">{{ __('Mis Pedidos') }}</a>
                                    @endif
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

                        <!-- Carrito -->
                        <li class="nav-item position-relative">
                            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#cartModal">
                                <i class="fas fa-shopping-cart"></i>
                                <span class="total-cart">${{ number_format($totalMonto ?? 0, 2) }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="m-0 p-0">
            @yield('content')
        </main>

        <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cartModalLabel">Productos en el carrito</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group">
                            @forelse ($productosCarrito ?? [] as $producto)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $producto->nombre }}
                                    <span>${{ number_format($producto->precio, 2) }}</span>
                                </li>
                            @empty
                                <li class="list-group-item">El carrito está vacío.</li>
                            @endforelse
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <a href="{{ route('carrito.mostrar') }}" class="btn btn-primary">Ver Carrito</a>
                    </div>
                </div>
            </div>
        </div>

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
                        <a href="https://www.facebook.com/profile.php?id=61555644123310" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="https://www.instagram.com/ozez.trc?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                        <a href="https://wa.me/528718974991?text=Hola,%20quiero%20saber%20más%20sobre%20sus%20servicios" aria-label="WhatsApp"><i class="bi bi-whatsapp"></i></a>
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
    
    <script>
        window.addEventListener('load', function() {
            const loadingScreen = document.getElementById('loading-screen');
            loadingScreen.style.opacity = '0';
            setTimeout(() => {
                loadingScreen.style.display = 'none';
            }, 500); 
        });
    </script>
</body>
</html>
