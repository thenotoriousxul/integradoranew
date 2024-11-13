@extends('layouts.auth')

@section('content')
    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #ffffff; 
            font-family: 'Bebas Neue', sans-serif;
            color: #000000;
            text-align: center;
        }
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        h1 {
            font-size: 3em;
            margin: 10px 0;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #000000;
            color: white;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            font-size: 1.8em;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #333333;
        }
        
        .animation {
            width: 60vw;
            height: 60vh;
            max-width: 300px;
            max-height: 300px;
        }
        p {
            font-size: 2em;
            margin: 8px 0;
        }
    </style>

    <div class="container">
        <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
        <dotlottie-player 
            src="https://lottie.host/74f92a91-9af6-42da-bbcb-0715995d2399/tMf1Cdg1GJ.json" 
            background="transparent" 
            speed="1" 
            loop 
            autoplay 
            class="animation">
        </dotlottie-player>

        <h1>Acceso denegado</h1>
        <p>No tienes permiso para acceder a esta página.</p>
        <a href="{{ url('/') }}" class="btn">Volver al inicio</a>
    </div>
@endsection
