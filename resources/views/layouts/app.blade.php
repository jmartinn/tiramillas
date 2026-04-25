<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('titulo', 'Tira Millas') · Tira Millas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header class="site-header">
        <nav>
            <a href="{{ url('/') }}" class="brand">Tira Millas</a>
            <div class="nav-links">
                <a href="{{ route('rutas.index') }}">Rutas</a>
                <a href="{{ route('puntos.index') }}">Puntos</a>
            </div>
            <div class="nav-actions">
                @auth
                    <span class="greeting">Hola, {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">Cerrar sesión</button>
                    </form>
                @else
                    <a href="{{ route('login') }}">Iniciar sesión</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Registrarse</a>
                @endauth
            </div>
        </nav>
    </header>

    <main class="container main">
        @if (session('estado'))
            <div class="alert alert-success">{{ session('estado') }}</div>
        @endif

        @yield('content')
    </main>
</body>
</html>
