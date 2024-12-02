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




    .promo-banner {
        position: relative;
        width: 100%;
        height: 300px;
        overflow: hidden;
        background: linear-gradient(to bottom right, #8e9f4b, #23212c, #a7a7a7);
    }

    .background {
        position: absolute;
        inset: 0;
    }

    .blur-circle {
        position: absolute;
        border-radius: 50%;
        filter: blur(100px);
        opacity: 0.3;
        animation: pulse 4s infinite alternate;
    }

    .circle1 {
        top: 33%;
        left: 25%;
        width: 400px;
        height: 400px;
        background-color: rgba(0, 89, 255, 0.7);
    }

    .circle2 {
        top: 50%;
        right: 33%;
        width: 300px;
        height: 300px;
        background-color: rgba(192, 180, 142, 0.897);
        animation-delay: 2s;
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        100% { transform: scale(1.1); }
    }

    .content {
        position: relative;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 20px;
        color: #6b774f;
    }

    .subtitle {
        font-size: 18px;
        font-weight: 500;
        margin-bottom: 10px;
    }

    .title {
        font-size: 48px;
        font-weight: bold;
        margin: 0 0 20px;
    }

    .cta-button {
        background-color: white;
        color: black;
        border: none;
        padding: 10px 30px;
        font-size: 16px;
        border-radius: 25px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .cta-button:hover {
        background-color: rgba(255, 255, 255, 0.9);
    }

    .details {
        margin-top: 15px;
        font-size: 15px;
    }

    .details p {
        margin: 5px 0;
    }

    .disclaimer {
        font-size: 12px;
        margin-top: 15px;
    }

    @media (max-width: 768px) {
        .title {
            font-size: 36px;
        }
    }
   
    #product-gallery {
    background-color: black;
    padding: 2rem 0;
}

#product-gallery .card {
    background-color: black;
    border: none;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

#product-gallery .card:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 20px rgba(255, 255, 255, 0.2);
}

#product-gallery .card-img-top {
    object-fit: cover;
    height: 300px;
    width: 100%;
    border-radius: 8px;
}

#product-gallery .card-text {
    font-size: 1.1rem;
    color: white;
}

#product-gallery h2, 
#product-gallery p.lead {
    color: white;
}

@media (max-width: 768px) {
    #product-gallery .card-img-top {
        height: 250px;
    }
}

@media (max-width: 576px) {
    #product-gallery .card-img-top {
        height: 200px;
    }
}



</style>



<div class="container-fluid p-0">
    <div class="position-relative text-center text-white bg-cover bg-center" style="background-image: url('{{ asset('img/playera.jpeg') }}'); height: 600px; background-size: cover; background-position: center;">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.5);"></div>
        
        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column align-items-center justify-content-center">
            <h1 class="display-4">Bienvenido a OZEZ</h1>
            <p class="lead">Explora nuestra colección de playeras personalizables y exclusivas.</p>
        </div>
    </div>


    {{-- <div class="animacion">
        <div class="logo-container">
            <span>Innovación en Cada Puntada</span>
            <span>Diseños que Definen tu Estilo</span>
            <span>OZEZ: Lleva tu Estilo al Siguiente Nivel</span>
            <span>Autenticidad y Creatividad en Cada Playera</span>
            <span>Explora la Diferencia con OZEZ</span>
            <span>Calidad y Personalización en un Solo Lugar</span>
            <span>Viste tu Estilo, Viste OZEZ</span>
        </div>
    </div> --}}

    {{-- <div class="catalogo py-5 text-center">
        <div class="container">
            <h2 class="display-5 font-weight-bold">Explora Nuestro Catálogo</h2>
            <p class="lead mb-4">Descubre nuestra amplia variedad de playeras únicas, diseñadas para adaptarse a cada estilo. Ya sea que busques algo moderno, clásico o completamente personalizado, OZEZ tiene algo para ti.</p>
            <a href="{{route('mostrar.productos')}}" class="btn btn-dark" style="font-size: 2rem; padding: 15px 30px;">Ir al Catálogo</a>
        </div>
    </div> --}}

    <div class="promo-banner">
        <div class="background">
            <div class="blur-circle circle1"></div>
            <div class="blur-circle circle2"></div>
        </div>
        <div class="content">
            <p class="subtitle">Más artículos añadidos</p>
            <h2 class="title">Promociones hasta -50%</h2>
            <a href="{{route('mostrar.productos')}}">
            <button class="cta-button">Ir al catalogo</button>
            </a>
            <div class="details">
                <p>En artículos seleccionados</p>
                <p>En tiendas y online</p>
            </div>
            <p class="disclaimer">No acumulable a otras promociones. Válido hasta el 05/01.</p>
        </div>
    </div>

    {{-- <div class="animacion">
        <div class="logo-container">
            <span>Personalización al Máximo</span>
            <span>Estilo Único para Cada Personalidad</span>
            <span>Explora Nuevas Posibilidades con OZEZ</span>
            <span>Calidad y Estilo en un Solo Lugar</span>
            <span>Viste la Diferencia</span>
            <span>Innovación en Cada Puntada</span>
        </div>
    </div> --}}

    <div id="product-gallery" class="container-fluid " style="background-color: black; padding: 2rem 0;">
        <div class="text-center mb-4">
            <h2 class="display-5 font-weight-bold" style="color: white;">Productos Destacados</h2>
            <p class="lead" style="color: white;">Explora nuestras prendas más populares y seleccionadas por nuestros clientes como sus favoritas.</p>
        </div>
        <div class="row g-4">
            <!-- Producto 1 -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100 shadow-sm" style="background-color: black; border: none;">
                    <a href="#">
                        <img src="{{ asset('img/first.jpeg') }}" class="card-img-top" alt="Producto 1">
                    </a>
                    <div class="card-body text-center">
                        <p class="card-text" style="color: white;">¡Resalta tu estilo con nuestras playeras exclusivas!</p>
                    </div>
                </div>
            </div>
            <!-- Producto 2 -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100 shadow-sm" style="background-color: black; border: none;">
                    <a href="#">
                        <img src="{{ asset('img/second.jpeg') }}" class="card-img-top" alt="Producto 2">
                    </a>
                    <div class="card-body text-center">
                        <p class="card-text" style="color: white;">Combina autenticidad y comodidad con cada diseño.</p>
                    </div>
                </div>
            </div>
            <!-- Producto 3 -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100 shadow-sm" style="background-color: black; border: none;">
                    <a href="#">
                        <img src="{{ asset('img/third.jpeg') }}" class="card-img-top" alt="Producto 3">
                    </a>
                    <div class="card-body text-center">
                        <p class="card-text" style="color: white;">Encuentra la inspiración en cada detalle de nuestras playeras.</p>
                    </div>
                </div>
            </div>
            <!-- Producto 4 -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100 shadow-sm" style="background-color: black; border: none;">
                    <a href="#">
                        <img src="{{ asset('img/fourth.jpeg') }}" class="card-img-top" alt="Producto 4">
                    </a>
                    <div class="card-body text-center">
                        <p class="card-text" style="color: white;">¡Elige el modelo que habla de ti y marca la diferencia!</p>
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
