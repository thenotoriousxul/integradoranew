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
        font-size: 3.5rem;
    }

    .lead {
        font-size: 1.5rem;
    }

    .card-title {
        font-size: 1.25rem;
    }

    .card-text {
        font-size: 1.1rem;
    }

    /* Estilo para la sección "Sobre Nosotros" */
    #nosotros {
        background-color: #000;
        color: white;
        padding: 60px 0;
        text-align: center;
    }
    #nosotros .overlay {
        max-width: 800px;
        margin: auto;
        padding: 40px;
    }
    #nosotros h2 {
        font-size: 2.5rem;
        margin-bottom: 20px;
    }
    #nosotros p {
        font-size: 1.6rem;
        line-height: 1.8;
    }
    #nosotros .logo {
        width: 120px;
        margin-top: 20px;
    }

    /* Estilo para la sección de lanzamiento */
    .lanzamiento {
        position: relative;
        background-image: url('{{ asset('img/lanzamiento.jpeg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 100vh; /* Ocupa todo el alto de la ventana */
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-align: center;
        margin-top: 0;
        width: 100%;
    }
    .lanzamiento h2 {
        font-size: 2.5rem;
        margin-bottom: 10px;
    }
    .lanzamiento p {
        font-size: 1.5rem;
    }
</style>

<div class="container-fluid p-0">
    <div class="position-relative text-center text-white bg-cover bg-center" style="background-image: url('{{ asset('img/byn.jpeg') }}'); height: 600px; background-size: cover; background-position: center;">
        <div class="position-absolute top-50 start-50 translate-middle" style="background: rgba(0, 0, 0, 0.5); padding: 20px; border-radius: 8px;">
            <h1 class="display-4">Bienvenido a OZEZ</h1>
            <p class="lead">Explora nuestra colección de playeras personalizables y exclusivas.</p>
        </div>
    </div>

    <!-- Sección de Lanzamiento -->
    <div class="lanzamiento">
        <div>
            <h2>Nuevo Lanzamiento: Edición Especial Día de Muertos</h2>
            <p>¡Descubre nuestra exclusiva playera en honor al Día de Muertos! <br>
            Disponible solo por tiempo limitado.</p>
        </div>
    </div>

    <!-- Galería de Modelos -->
    <div class="container-fluid mt-5">
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

    <div id="nosotros" class="container-fluid mt-5">
        <div class="overlay">
            <h2>Sobre Nosotros</h2>
            <p>Raymundo y Domingo, dos amigos apasionados por la moda, soñaban con crear su propia marca. <br> En una tarde soleada, decidieron dar el salto y fundaron Ozez. Con pocos ahorros, diseñaron camisetas. <br> Después de varias noches de trabajo, lograron lanzar su primera colección. La respuesta fue abrumadora. La comunidad apoyó su visión. <br> Ahora, Ozez representa un estilo auténtico y responsable. Cada prenda cuenta una historia de amistad y pasión por la moda.</p>
            <img class="logo" src="{{ asset('img/ozeztrc.png') }}" alt="Logo de Ozez">
        </div>
    </div>
</div>
@endsection
