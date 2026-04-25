<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('titulo', 'Tira Millas') · Tira Millas</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=dm-sans:400,500,600,700|playfair-display:500,600,700" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header class="site-header">
        <div class="header-inner">
            <a href="{{ url('/') }}" class="brand">
                <span class="brand-mark"><x-icon name="map-pin" class="icon" /></span>
                <span class="brand-text">Tira Millas</span>
            </a>

            <nav class="nav-links">
                <a href="{{ route('rutas.index') }}" @if(request()->routeIs('rutas.*')) class="active" @endif>Rutas</a>
                <a href="{{ route('puntos.index') }}" @if(request()->routeIs('puntos.*')) class="active" @endif>Puntos de interés</a>
                <a href="{{ route('negocios.index') }}" @if(request()->routeIs('negocios.*')) class="active" @endif>Negocios</a>
            </nav>

            <div class="nav-actions">
                @auth
                    <span class="greeting">Hola, {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-secondary">Cerrar sesión</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-secondary">Iniciar sesión</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Unirse</a>
                @endauth
            </div>
        </div>
    </header>

    <main>
        @if (session('estado'))
            <div class="container" style="padding-top: var(--space-4);">
                <div class="alert alert-success">{{ session('estado') }}</div>
            </div>
        @endif

        @hasSection('hero')
            @yield('hero')
            @yield('content')
        @else
            <div class="main">
                @yield('content')
            </div>
        @endif
    </main>

    <footer class="site-footer">
        <div class="site-footer-inner">
            <div class="footer-grid">
                <div class="footer-brand-block">
                    <a href="{{ url('/') }}" class="brand">
                        <span class="brand-mark"><x-icon name="map-pin" class="icon" /></span>
                        <span class="brand-text">Tira Millas</span>
                    </a>
                    <p>
                        La comunidad de viajeros que descubre, preserva y comparte
                        los tesoros ocultos de la España interior.
                    </p>
                    <div class="social-links">
                        <a href="#" class="social-link" aria-label="Instagram"><x-icon name="instagram" /></a>
                        <a href="#" class="social-link" aria-label="Twitter"><x-icon name="twitter" /></a>
                        <a href="#" class="social-link" aria-label="Facebook"><x-icon name="facebook" /></a>
                        <a href="#" class="social-link" aria-label="Youtube"><x-icon name="youtube" /></a>
                    </div>
                </div>

                <div class="footer-section">
                    <h4>Plataforma</h4>
                    <ul>
                        <li><a href="{{ route('rutas.index') }}">Explorar rutas</a></li>
                        <li><a href="{{ route('puntos.index') }}">Puntos de interés</a></li>
                        <li><a href="{{ route('negocios.index') }}">Negocios</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h4>Comunidad</h4>
                    <ul>
                        <li><a href="{{ route('register') }}">Únete</a></li>
                        <li><a href="{{ route('login') }}">Iniciar sesión</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h4>Negocios</h4>
                    <ul>
                        <li><a href="{{ route('negocios.sumate') }}">Súmate</a></li>
                        <li><a href="{{ route('negocios.index') }}">Directorio</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <span>Hecho con <span style="color: var(--accent);">♥</span> para España</span>
                <div class="footer-bottom-links">
                    <a href="#">Términos</a>
                    <a href="#">Privacidad</a>
                    <a href="#">Cookies</a>
                </div>
                <span>© {{ date('Y') }} Tira Millas</span>
            </div>
        </div>
    </footer>
</body>
</html>
