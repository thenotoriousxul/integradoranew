@extends('layouts.auth')

@section('content')
<div class="container">
    <h2>{{ __('Nueva contraseña') }}</h2>
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ request()->route('token') }}">
        
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

        <button type="submit" class="btn btn-primary">{{ __('Restablecer contraseña') }}</button>
    </form>
</div>
@endsection
