@extends('layouts.app')

@section('titulo', 'Crear cuenta')

@section('content')
    <div class="auth-form-wrapper">
        <p class="page-eyebrow">Únete a la comunidad</p>
        <h1>Crear cuenta</h1>

        <form class="auth-form" method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label for="name">Nombre</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required>
                @error('email')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input id="password" name="password" type="password" required minlength="8">
                @error('password')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmar contraseña</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required minlength="8">
            </div>

            <button type="submit" class="btn btn-primary btn-block">Crear cuenta</button>

            <p class="form-footer">
                ¿Ya tienes cuenta?
                <a href="{{ route('login') }}">Inicia sesión</a>
            </p>
        </form>
    </div>
@endsection
