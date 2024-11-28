@extends('cliente.layouts.dashboard')

@section('content')

<style>

        .main-container {
            padding: 2rem;
            min-width: 900px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            text-decoration: none;
            color: #000;
        }

        .form-section {
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 1.25rem;
            margin-bottom: 1.5rem;
            font-weight: 500;
        }

        .gender-options {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .form-row {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .form-group {
            flex: 1;
        }

        .phone-group {
            display: flex;
            gap: 0.5rem;
        }

        .prefix {
            width: 80px;
        }

        p
        {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #e2e2e2;
            border-radius: 4px;
            background-color: #f6f6f6  
        }

        input[type="text"],
        input[type="tel"],
        input[type="date"] {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #e2e2e2;
            border-radius: 4px;
            background-color: #f6f6f6;
        }
        .logout-button {
            display: block;
            width: 100%;
            padding: 1rem;
            background-color: #000;
            color: #fff;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            margin-top: 2rem;
            text-decoration: none;
        
        }

        .logout-button:hover {
            background-color: #333;
        }
</style>

<div class="main-container">
    <header class="header">
        <a href="#" class="logo">OZEZ</a>
    </header>
 
 
        <section class="form-section">
            <h2 class="section-title">Datos personales</h2>
            

            <div class="form-row">
                <div class="form-group">
                    <p>{{ $usuario->persona->nombre ?? 'Nombre no disponible' }}</p>
                </div>
                <div class="form-group">
                    <p>{{$usuario->persona->apellido_paterno}} {{$usuario->persona->apellido_materno}} </p>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                   <p>{{$usuario->persona->genero}}</p>
                </div>
                <div class="form-group phone-group">
                    <p>{{$usuario->persona->numero_telefonico}}</p>
                </div>
            </div>
        </section>
        <form>
        <section class="form-section">
            <h2 class="section-title">Dirección</h2>
            
            <div class="form-row">
                <div class="form-group">
                    <input type="text" value="{{$usuario->persona->direccion->calle}}">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <input type="text" value="{{$usuario->persona->direccion->colonia}}">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <input type="text" value="{{$usuario->persona->direccion->codigo_postal}}">
                </div>
                <div class="form-group">
                    <input type="text" placeholder="Municipio *" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <input type="text" value="{{$usuario->persona->direccion->numero_ext}}">
                </div>
                <div class="form-group">
                    <input type="text" value="{{$usuario->persona->direccion->numero_int}}">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <input type="text" value="{{$usuario->persona->direccion->estado}}">
                </div>
                <div class="form-group">
                    <input type="text" value="{{$usuario->persona->direccion->pais}}">
                </div>
            </div>
        </section>

        <input type="submit" class="logout-button">
    </form>
</div>
@endsection
