@extends('layouts.app')

@section('content')
<style>
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

    #nosotros {
        background-color: #000;
        color: white;
        padding: 60px 20px;
        text-align: center;
    }
    #nosotros .overlay {
        max-width: 100%;
        margin: auto;
        padding: 20px;
    }
    #nosotros h2 {
        font-size: 3rem;
        margin-bottom: 15px;
    }
    #nosotros p {
        font-size: 1.8rem;
        line-height: 1.8;
        text-align: justify;
    }
    #nosotros .logo {
        width: 100px;
        margin-top: 15px;
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
    }

    .animacion .logo-container {
        display: inline-block;
        animation: scrollLogos 25s linear infinite;
        white-space: nowrap;
    }

    .animacion img {
        height: 60px;
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
    }
    .personalizacion img {
        width: 30%;
        border-radius: 8px;
    }
    .personalizacion-content {
        padding: 0 20px;
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
</style>

<link rel="preload" href="{{ asset('img/byn.jpeg') }}" as="image">

<div class="container-fluid p-0">
    <div class="position-relative text-center text-white bg-cover bg-center" style="background-image: url('{{ asset('img/byn.jpeg') }}'); height: 600px; background-size: cover; background-position: center;">
        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column align-items-center justify-content-center" style="background: rgba(0, 0, 0, 0.5);">
            <h1 class="display-4">Bienvenido a OZEZ</h1>
            <p class="lead">Explora nuestra colección de playeras personalizables y exclusivas.</p>
        </div>
    </div>

    <div class="animacion">
        <div class="logo-container">
            REBAJAS
        </div>
    </div>

    <div class="container-fluid mt-4">
        <div class="row g-4 product-gallery">
            <div class="col-md-3">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('img/first.jpeg') }}" class="card-img-top" alt="Playera 1 - Estilo único">
                    <div class="card-body text-center">
                        <p class="card-text">¡Resalta tu estilo con nuestras playeras exclusivas!</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('img/second.jpeg') }}" class="card-img-top" alt="Playera 2 - Diseño original">
                    <div class="card-body text-center">
                        <p class="card-text">Combina autenticidad y comodidad con cada diseño.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('img/third.jpeg') }}" class="card-img-top" alt="Playera 3 - Inspiración en cada detalle">
                    <div class="card-body text-center">
                        <p class="card-text">Encuentra la inspiración en cada detalle de nuestras playeras.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('img/fourth.jpeg') }}" class="card-img-top" alt="Playera 4 - Marca la diferencia">
                    <div class="card-body text-center">
                        <p class="card-text">¡Elige el modelo que habla de ti y marca la diferencia!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="animacion">
        <div class="logo-container">
            @for ($i = 0; $i < 50; $i++)
                <img src="{{ asset('img/ozeztrc.png') }}" alt="OZEZ Logo">
            @endfor
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
            @for ($i = 0; $i < 50; $i++)
                <img src="{{ asset('img/ozeztrc.png') }}" alt="OZEZ Logo">
            @endfor
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
</div>
@endsection
