@extends('layouts.auth')

@section('content')
<style>
    .contenedor{
    display:flex;
    justify-content:center;
    }

    img{
    width:150px;
    height:150px;
    }

    h2{
    font-family: 'Bebas Neue', sans-serif;
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

    label{
        font-family: 'Inter', sans-serif;
    }

</style>

<div class="contenedor">
    <a><img src="{{asset('img/ozeztrc.png')}}"></a>
</div>
<div class="container">
    <h2>{{ __('Nueva contraseña') }}</h2>
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ request()->route('token') }}">
        <br>
        <div class="mb-3">
            <label for="email">{{ __('Correo electrónico') }}</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password">{{ __('Nueva contraseña') }}</label>
            <input type="password" name="password" id="password" class="form-control" required>
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation">{{ __('Confirmar contraseña') }}</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>

        <button type="submit">{{ __('Restablecer contraseña') }}</button>
    </form>
</div>
@endsection
