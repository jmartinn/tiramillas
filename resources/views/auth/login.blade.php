@extends('layouts.app')

@section('titulo', 'Iniciar sesión')

@section('content')
    <div class="auth-form-wrapper">
        <h1>Iniciar sesión</h1>

        <form class="auth-form" method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input id="password" name="password" type="password" required>
                @error('password')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary btn-block">Entrar</button>

            <p class="form-footer">
                ¿Aún no tienes cuenta?
                <a href="{{ route('register') }}">Regístrate</a>
            </p>
        </form>
    </div>
@endsection
