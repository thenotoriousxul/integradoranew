@extends('layouts.app')

@section('content')
<style>
    * {
        box-sizing: border-box;
    }

    html, body {
        overflow-x: hidden;
        margin: 0;
        padding: 0;
        width: 100%;
    }

    .container-fluid {
        padding: 0;
        width: 100%; 
    }

    body, main {
        margin-top: 0;
        padding-top: 0;
        font-family: 'Bebas Neue', sans-serif;
    }

    .card-img-top {
        transition: transform 0.3s ease;
    }

    .card:hover .card-img-top {
        transform: scale(1.05);
    }

    .display-4 {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 5.5rem;
        color: white;
        overflow: hidden;
        white-space: nowrap;
        width: 100%;
        animation: typing 4s steps(40, end), fade-out 0s step-end 4s;
    }

    .lead {
        font-size: 1.8rem;
    }

    @keyframes typing {
        from { width: 0; }
        to { width: 100%; }
    }

    @keyframes fade-out {
        from { border-right: 4px solid white; }
        to { border-right: none; }
    }

    .card-title {
        font-size: 1.25rem;
    }

    .card-text {
        font-size: 1.1rem;
    }

    .lanzamiento {
        position: relative;
        background-image: url('{{ asset('img/lanzamiento.jpeg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-align: center;
        width: 100%;
    }

    .lanzamiento h2 {
        font-size: 4rem;
        margin-bottom: 10px;
    }

    .lanzamiento p {
        font-size: 3rem;
    }

    .lanzamiento .btn {
        font-size: 1.5rem;
        padding: 10px 20px;
        margin-top: 20px;
        background-color: white;
        border: none;
        color: black;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .lanzamiento .btn:hover {
        background-color: #f1f1f1;
        color: #333;
    }

    .animacion {
        background-color: black;
        overflow: hidden;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
    }

    .animacion .logo-container {
        display: inline-block;
        animation: scrollLogos 25s linear infinite;
        white-space: nowrap;
        padding: 0;
    }

    .animacion span {
        font-size: 1.5rem;
        color: white;
        margin-right: 15px;
        vertical-align: middle;
    }

    @keyframes scrollLogos {
        0% { transform: translateX(100%); }
        100% { transform: translateX(-100%); }
    }

    .personalizacion {
        display: flex;
        align-items: center;
        padding: 60px 20px;
        background-color: #000;
        width: 100%;
        flex-wrap: wrap; 
    }

    .personalizacion img {
        width: 30%;
        max-width: 100%;
        border-radius: 8px;
        height: auto;
        margin-bottom: 20px; 
    }

    .personalizacion-content {
        padding: 0 20px;
        flex: 1;
    }

    .personalizacion-content h2 {
        font-size: 4rem;
        color: white;
        margin-bottom: 20px;
    }

    .personalizacion-content p {
        font-size: 2rem;
        line-height: 1.6;
        color: white;
        margin-bottom: 20px;
    }

    .personalizacion-content .btn {
        font-size: 1.5rem;
        padding: 10px 20px;
        background-color: white;
        color: black;
        border: none;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .personalizacion-content .btn:hover {
        background-color: #333;
    }

    @media (max-width: 576px) {
        .display-4 {
            font-size: 2.5rem;
        }

        .lead {
            font-size: 1.2rem;
        }

        .lanzamiento h2,
        .personalizacion-content h2 {
            font-size: 2.5rem;
        }

        .lanzamiento p,
        .personalizacion-content p {
            font-size: 1.5rem;
        }

        .lanzamiento .btn,
        .personalizacion-content .btn {
            font-size: 1rem;
            padding: 8px 15px;
        }

        .personalizacion {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .personalizacion img {
            width: 100%; 
            margin-bottom: 20px;
        }
    }

    @media (min-width: 576px) and (max-width: 768px) {
        .display-4 {
            font-size: 4rem;
        }

        .lead {
            font-size: 1.5rem;
        }

        .lanzamiento h2,
        .personalizacion-content h2 {
            font-size: 3rem;
        }

        .lanzamiento p,
        .personalizacion-content p {
            font-size: 1.8rem;
        }

        .lanzamiento .btn,
        .personalizacion-content .btn {
            font-size: 1.2rem;
            padding: 10px 20px;
        }

        .personalizacion img {
            width: 50%;
        }
    }

    @media (min-width: 768px) and (max-width: 992px) {
        .display-4 {
            font-size: 4.5rem;
        }

        .lead {
            font-size: 1.6rem;
        }

        .lanzamiento h2,
        .personalizacion-content h2 {
            font-size: 3.5rem;
        }

        .lanzamiento p,
        .personalizacion-content p {
            font-size: 2rem;
        }
    }

    @media (min-width: 992px) {
        .display-4 {
            font-size: 5.5rem;
        }

        .lead {
            font-size: 1.8rem;
        }

        .lanzamiento h2,
        .personalizacion-content h2 {
            font-size: 4rem;
        }

        .lanzamiento p,
        .personalizacion-content p {
            font-size: 3rem;
        }
    }
</style>



<div class="container-fluid p-0">
    <div class="position-relative text-center text-white bg-cover bg-center" style="background-image: url('{{ asset('img/byn.jpeg') }}'); height: 600px; background-size: cover; background-position: center;">
        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column align-items-center justify-content-center" style="background: rgba(0, 0, 0, 0.5);">
            <h1 class="display-4">Bienvenido a OZEZ</h1>
            <p class="lead">Explora nuestra colección de playeras personalizables y exclusivas.</p>
        </div>
    </div>

    <div class="animacion">
        <div class="logo-container">
            <span>Innovación en Cada Puntada</span>
            <span>Diseños que Definen tu Estilo</span>
            <span>OZEZ: Lleva tu Estilo al Siguiente Nivel</span>
            <span>Autenticidad y Creatividad en Cada Playera</span>
            <span>Explora la Diferencia con OZEZ</span>
            <span>Calidad y Personalización en un Solo Lugar</span>
            <span>Viste tu Estilo, Viste OZEZ</span>
        </div>
    </div>

    <div class="catalogo py-5 text-center">
        <div class="container">
            <h2 class="display-5 font-weight-bold">Explora Nuestro Catálogo</h2>
            <p class="lead mb-4">Descubre nuestra amplia variedad de playeras únicas, diseñadas para adaptarse a cada estilo. Ya sea que busques algo moderno, clásico o completamente personalizado, OZEZ tiene algo para ti.</p>
            <a href="{{route('mostrar.productos')}}" class="btn btn-dark" style="font-size: 2rem; padding: 15px 30px;">Ir al Catálogo</a>
        </div>
    </div>

    <div class="animacion">
        <div class="logo-container">
            <span>Personalización al Máximo</span>
            <span>Estilo Único para Cada Personalidad</span>
            <span>Explora Nuevas Posibilidades con OZEZ</span>
            <span>Calidad y Estilo en un Solo Lugar</span>
            <span>Viste la Diferencia</span>
            <span>Innovación en Cada Puntada</span>
        </div>
    </div>

    <div id="product-gallery" class="container-fluid mt-5 mb-5">
        <div class="text-center mb-4">
            <h2 class="display-5 font-weight-bold">Productos Destacados</h2>
            <p class="lead">Explora nuestras prendas más populares y seleccionadas por nuestros clientes como sus favoritas.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="card h-100 shadow-sm">
                    <a href="{{ route('producto.detalle') }}">
                        <img src="{{ asset('img/first.jpeg') }}" class="card-img-top" alt="Playera 1 - Estilo único">
                    </a>
                    <div class="card-body text-center">
                        <p class="card-text">¡Resalta tu estilo con nuestras playeras exclusivas!</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card h-100 shadow-sm">
                    <a href="{{ route('producto.detalle') }}">
                        <img src="{{ asset('img/second.jpeg') }}" class="card-img-top" alt="Playera 2 - Diseño original">
                    </a>
                    <div class="card-body text-center">
                        <p class="card-text">Combina autenticidad y comodidad con cada diseño.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card h-100 shadow-sm">
                    <a href="{{ route('producto.detalle') }}">
                        <img src="{{ asset('img/third.jpeg') }}" class="card-img-top" alt="Playera 3 - Inspiración en cada detalle">
                    </a>
                    <div class="card-body text-center">
                        <p class="card-text">Encuentra la inspiración en cada detalle de nuestras playeras.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card h-100 shadow-sm">
                    <a href="{{ route('producto.detalle') }}">
                        <img src="{{ asset('img/fourth.jpeg') }}" class="card-img-top" alt="Playera 4 - Marca la diferencia">
                    </a>
                    <div class="card-body text-center">
                        <p class="card-text">¡Elige el modelo que habla de ti y marca la diferencia!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="animacion">
        <div class="logo-container">
            <span>Exprésate con OZEZ</span>
            <span>Diseño Exclusivo, Estilo Único</span>
            <span>Vive tu Moda con OZEZ</span>
            <span>Edición Limitada para Personalidades Únicas</span>
            <span>Calidad y Estilo en Cada Costura</span>
            <span>Hazlo Personal, Hazlo OZEZ</span>
        </div>
    </div>

    <div class="lanzamiento">
        <div>
            <h2>Nuevo Lanzamiento: Edición Especial Día de Muertos</h2>
            <p>¡Descubre nuestra exclusiva playera en honor al Día de Muertos! <br>Disponible solo por tiempo limitado.</p>
            <a href="#" class="btn">Consíguelo aquí</a>
        </div>
    </div>

    <div class="animacion">
        <div class="logo-container">
            <span>OZEZ: Viste la Diferencia</span>
            <span>Crea tu Estilo, Crea con OZEZ</span>
            <span>Elegancia y Comodidad en Cada Diseño</span>
            <span>Tu Playera, Tu Historia</span>
        </div>
    </div>

    <div class="personalizacion">
        <img src="{{ asset('img/hombre.jpeg') }}" alt="Personalización de playeras">
        <div class="personalizacion-content">
            <h2>Haz Tuya Cada Playera</h2>
            <p>Con nuestra opción de personalización, puedes darle tu toque especial a cada prenda. Cambia colores o logos, y crea un estilo que realmente hable de ti.</p>
            <a href="#" class="btn">Personalizar Ahora</a>
        </div>
    </div>

    <div class="animacion">
        <div class="logo-container">
            <span>Estilo Único, Calidad Garantizada</span>
            <span>Personaliza y Marca la Diferencia</span>
            <span>OZEZ: Donde el Estilo se Encuentra con la Creatividad</span>
            <span>Calidad en Cada Puntada, Comodidad en Cada Estilo</span>
            <span>Moda que Se Adapta a Ti</span>
            <span>Expresa Tu Esencia con OZEZ</span>
        </div>
    </div>
</div>
@endsection
