<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('titulo', 'Tira Millas') · Tira Millas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-50 text-gray-900">
    <header class="border-b border-gray-200 bg-white">
        <nav class="mx-auto flex max-w-5xl items-center justify-between px-6 py-4">
            <a href="{{ url('/') }}" class="text-lg font-semibold">Tira Millas</a>
            <div class="flex items-center gap-4 text-sm">
                @auth
                    <span class="text-gray-600">Hola, {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="rounded bg-gray-900 px-3 py-1.5 text-white hover:bg-gray-700">
                            Cerrar sesión
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="hover:text-gray-700">Iniciar sesión</a>
                    <a href="{{ route('register') }}" class="rounded bg-gray-900 px-3 py-1.5 text-white hover:bg-gray-700">
                        Registrarse
                    </a>
                @endauth
            </div>
        </nav>
    </header>

    <main class="mx-auto max-w-5xl px-6 py-10">
        @if (session('estado'))
            <div class="mb-6 rounded border border-green-200 bg-green-50 p-3 text-sm text-green-800">
                {{ session('estado') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
