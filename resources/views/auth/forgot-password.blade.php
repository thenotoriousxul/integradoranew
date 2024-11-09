@extends('layouts.auth')

@section('content')
<div class="container">
    <h2>{{ __('Restablecer contraseña') }}</h2>
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="mb-3">
            <label for="email">{{ __('Correo electrónico') }}</label>
            <input type="email" name="email" id="email" class="form-control" required>
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">{{ __('Enviar enlace de restablecimiento') }}</button>
    </form>
</div>
@endsection
