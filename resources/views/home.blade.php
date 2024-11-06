@extends('layouts.app')

@section('content')
<style>
    /* Elimina el margen superior entre el navbar y la imagen de fondo */
    body, main {
        margin-top: 0;
        padding-top: 0;
    }

    /* Efecto hover para las imágenes de la galería */
    .card-img-top {
        transition: transform 0.3s ease;
    }

    .card:hover .card-img-top {
        transform: scale(1.05);
    }
</style>

<div class="container-fluid p-0">
    <div class="position-relative text-center text-white bg-cover bg-center" style="background-image: url('{{ asset('img/byn.jpeg') }}'); height: 600px; background-size: cover; background-position: center;">
        <div class="position-absolute top-50 start-50 translate-middle" style="background: rgba(0, 0, 0, 0.5); padding: 20px; border-radius: 8px;">
            <h1 class="display-4">Bienvenido a OZEZ</h1>
            <p class="lead">Explora nuestra colección de playeras personalizables y exclusivas.</p>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="https://png.pngtree.com/png-vector/20220120/ourmid/pngtree-black-t-shirt-template-png-image_4293336.png" class="card-img-top" alt="Playera 1">
                    <div class="card-body">
                        <h5 class="card-title">Playera Básica</h5>
                        <p class="card-text">Precio: $20.00</p>
                        <a href="{{ route('producto.detalle') }}" class="btn btn-primary w-100">Ver detalles</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="https://png.pngtree.com/png-vector/20220120/ourmid/pngtree-black-t-shirt-template-png-image_4293336.png" class="card-img-top" alt="Playera 2">
                    <div class="card-body">
                        <h5 class="card-title">Playera Premium</h5>
                        <p class="card-text">Precio: $35.00</p>
                        <a href="{{ route('producto.detalle') }}" class="btn btn-primary w-100">Ver detalles</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="https://png.pngtree.com/png-vector/20220120/ourmid/pngtree-black-t-shirt-template-png-image_4293336.png" class="card-img-top" alt="Playera 3">
                    <div class="card-body">
                        <h5 class="card-title">Playera Personalizada</h5>
                        <p class="card-text">Precio: $50.00</p>
                        <a href="{{ route('producto.detalle') }}" class="btn btn-primary w-100">Ver detalles</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="https://png.pngtree.com/png-vector/20220120/ourmid/pngtree-black-t-shirt-template-png-image_4293336.png" class="card-img-top" alt="Playera 4">
                    <div class="card-body">
                        <h5 class="card-title">Playera Edición Limitada</h5>
                        <p class="card-text">Precio: $75.00</p>
                        <a href="{{ route('producto.detalle') }}" class="btn btn-primary w-100">Ver detalles</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Galería de Modelos -->
    <div class="container mt-5">
        <div class="row product-gallery">
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('img/first.jpeg') }}" class="card-img-top" alt="Playera 1 - Estilo único">
                    <div class="card-body text-center">
                        <p class="card-text">¡Resalta tu estilo con nuestras playeras exclusivas!</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('img/second.jpeg') }}" class="card-img-top" alt="Playera 2 - Diseño original">
                    <div class="card-body text-center">
                        <p class="card-text">Combina autenticidad y comodidad con cada diseño.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('img/third.jpeg') }}" class="card-img-top" alt="Playera 3 - Inspiración en cada detalle">
                    <div class="card-body text-center">
                        <p class="card-text">Encuentra la inspiración en cada detalle de nuestras playeras.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('img/fourth.jpeg') }}" class="card-img-top" alt="Playera 4 - Marca la diferencia">
                    <div class="card-body text-center">
                        <p class="card-text">¡Elige el modelo que habla de ti y marca la diferencia!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
