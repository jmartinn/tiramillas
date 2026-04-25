@extends('layouts.app')

@section('titulo', 'Descubre la España interior')

@section('hero')
    <section class="hero">
        <div class="hero-inner">
            <div>
                <span class="hero-pill">
                    <span class="dot"></span>
                    Turismo sostenible y participativo
                </span>

                <h1>
                    Descubre la <span class="highlight">España</span> que no conoces
                </h1>

                <p class="hero-lede">
                    Una comunidad de viajeros que descubren, crean y comparten rutas
                    por el interior de España, apoyando economías locales y preservando
                    el patrimonio cultural.
                </p>

                <div class="hero-cta">
                    <a href="{{ route('rutas.index') }}" class="btn btn-primary btn-large">
                        Explorar rutas
                        <x-icon name="arrow-right" />
                    </a>
                    <a href="{{ route('negocios.sumate') }}" class="btn btn-secondary btn-large">
                        Súmate como negocio
                    </a>
                </div>

                <div class="hero-stats">
                    <div class="hero-stat">
                        <span class="hero-stat-icon"><x-icon name="users" /></span>
                        <div>
                            <div class="hero-stat-value">{{ $stats['usuarios'] }}</div>
                            <div class="hero-stat-label">Exploradores</div>
                        </div>
                    </div>
                    <div class="hero-stat">
                        <span class="hero-stat-icon"><x-icon name="route" /></span>
                        <div>
                            <div class="hero-stat-value">{{ $stats['rutas'] }}</div>
                            <div class="hero-stat-label">Rutas creadas</div>
                        </div>
                    </div>
                    <div class="hero-stat">
                        <span class="hero-stat-icon"><x-icon name="map-pin" /></span>
                        <div>
                            <div class="hero-stat-value">{{ $stats['puntos'] }}</div>
                            <div class="hero-stat-label">Puntos de interés</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="hero-visual">
                <div class="hero-visual-circle">
                    <div class="hero-visual-content">
                        <span class="icon-wrapper"><x-icon name="compass" class="icon icon-xl" /></span>
                        <h3>Tira Millas</h3>
                        <p class="text-muted">Turismo con propósito</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <section class="section section-secondary">
        <div class="section-inner">
            <div class="section-header split">
                <div>
                    <p class="page-eyebrow">Explora</p>
                    <h2>Rutas destacadas por la comunidad</h2>
                    <p>
                        Descubre itinerarios creados y validados por viajeros como tú,
                        con experiencias auténticas y sostenibles.
                    </p>
                </div>
                <a href="{{ route('rutas.index') }}" class="btn btn-secondary">
                    Ver todas las rutas
                    <x-icon name="chevron-right" class="icon icon-sm" />
                </a>
            </div>

            @if ($rutasDestacadas->isEmpty())
                <p class="text-muted">Aún no hay rutas publicadas. ¡Sé el primero en crear una!</p>
            @else
                <div class="featured-grid">
                    @foreach ($rutasDestacadas as $ruta)
                        <a href="{{ route('rutas.show', $ruta) }}" class="featured-card">
                            <div class="featured-card-image">
                                @if ($ruta->imagen_path)
                                    <img src="{{ Storage::url($ruta->imagen_path) }}" alt="{{ $ruta->titulo }}">
                                @else
                                    <x-icon name="map-pin" class="icon icon-xl" />
                                @endif
                                <div class="featured-card-tags">
                                    <span class="tag tag-primary">{{ ucfirst($ruta->categoria) }}</span>
                                    @if ($ruta->destacada)
                                        <span class="tag">Destacada</span>
                                    @endif
                                </div>
                            </div>
                            <div class="featured-card-body">
                                <h3>{{ $ruta->titulo }}</h3>
                                <p>{{ $ruta->descripcion }}</p>
                                <div class="featured-card-stats">
                                    <div class="stat-group">
                                        <span class="stat">
                                            <x-icon name="clock" class="icon icon-sm" />
                                            {{ $ruta->duracion_min }} min
                                        </span>
                                        <span class="stat">
                                            <x-icon name="route" class="icon icon-sm" />
                                            {{ $ruta->distancia_km }} km
                                        </span>
                                    </div>
                                    <span class="featured-card-rating">
                                        <x-icon name="star" class="icon icon-sm" style="fill: currentColor;" />
                                        {{ number_format($ruta->reviews->avg('puntuacion') ?? 0, 1) }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <section class="cta">
        <div class="cta-card">
            <h2>Empieza tu próxima aventura hoy</h2>
            <p>
                Únete a los exploradores que ya están descubriendo la España auténtica.
                Crea tu cuenta gratis y comienza a planificar rutas únicas.
            </p>
            <div class="hero-cta">
                @guest
                    <a href="{{ route('register') }}" class="btn btn-primary btn-large">
                        Crear cuenta gratis
                        <x-icon name="arrow-right" />
                    </a>
                @endguest
                <a href="{{ route('rutas.index') }}" class="btn btn-secondary btn-large" style="background-color: color-mix(in oklch, white 10%, transparent); color: white; border-color: color-mix(in oklch, white 30%, transparent);">
                    Explorar sin registro
                </a>
            </div>
        </div>
    </section>
@endsection
