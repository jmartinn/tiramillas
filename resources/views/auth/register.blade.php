@extends('layouts.app')

@section('titulo', 'Crear cuenta')

@section('content')
    <div class="mx-auto max-w-md">
        <h1 class="mb-6 text-2xl font-semibold">Crear cuenta</h1>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="mb-1 block text-sm font-medium">Nombre</label>
                <input
                    id="name"
                    name="name"
                    type="text"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    class="w-full rounded border border-gray-300 px-3 py-2"
                >
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="mb-1 block text-sm font-medium">Correo electrónico</label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email') }}"
                    required
                    class="w-full rounded border border-gray-300 px-3 py-2"
                >
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="mb-1 block text-sm font-medium">Contraseña</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    required
                    minlength="8"
                    class="w-full rounded border border-gray-300 px-3 py-2"
                >
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="mb-1 block text-sm font-medium">Confirmar contraseña</label>
                <input
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    required
                    minlength="8"
                    class="w-full rounded border border-gray-300 px-3 py-2"
                >
            </div>

            <button type="submit" class="w-full rounded bg-gray-900 px-4 py-2 text-white hover:bg-gray-700">
                Crear cuenta
            </button>

            <p class="text-center text-sm text-gray-600">
                ¿Ya tienes cuenta?
                <a href="{{ route('login') }}" class="text-gray-900 underline">Inicia sesión</a>
            </p>
        </form>
    </div>
@endsection
