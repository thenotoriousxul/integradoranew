@extends('layouts.auth')

@section('content')
<style>
    body{
        font-family: 'Bebas Neue', sans-serif;
    }

    label{
        font-family: 'Inter', sans-serif;

    }

    img{
        height: 150px;
        width: 150px;
    }

    button{
        background-color: black;
        color: white;
        font-family: 'Inter', sans-serif;
        width: 350px;
        height: 50px;
        margin-top: 30px;
        border-radius: 20px;
        font-weight: bold;
    }

    .contenedor{
        display: flex;
        justify-content: center;
    }
</style>
<div class="contenedor">
<a href="/"><img src="{{asset('img/ozeztrc.png')}}"></a>
</div>
<div class="container">
    <h2>{{ __('Restablecer contraseña') }}</h2>
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="mb-3">
            <br>
            <label for="email">{{ __('Correo electrónico') }}</label>
            <input type="email" name="email" id="email" class="form-control" required>
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit">{{ __('Enviar enlace de restablecimiento') }}</button>
    </form>
</div>
@endsection
