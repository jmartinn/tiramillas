@extends('layouts.app')

@section('titulo', 'Iniciar sesión')

@section('content')
    <div class="mx-auto max-w-md">
        <h1 class="mb-6 text-2xl font-semibold">Iniciar sesión</h1>

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="mb-1 block text-sm font-medium">Correo electrónico</label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
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
                    class="w-full rounded border border-gray-300 px-3 py-2"
                >
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full rounded bg-gray-900 px-4 py-2 text-white hover:bg-gray-700">
                Entrar
            </button>

            <p class="text-center text-sm text-gray-600">
                ¿Aún no tienes cuenta?
                <a href="{{ route('register') }}" class="text-gray-900 underline">Regístrate</a>
            </p>
        </form>
    </div>
@endsection
