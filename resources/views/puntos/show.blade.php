@extends('layouts.app')

@section('titulo', $punto->titulo)

@section('hero')
    <section class="detail-hero">
        <div class="detail-hero-inner">
            <nav class="breadcrumbs">
                <a href="{{ url('/') }}">Inicio</a>
                <x-icon name="chevron-right" class="icon icon-sm" />
                <a href="{{ route('puntos.index') }}">Puntos</a>
                <x-icon name="chevron-right" class="icon icon-sm" />
                <span class="current">{{ $punto->titulo }}</span>
            </nav>

            <div class="tags">
                <span class="tag tag-primary">{{ ucfirst($punto->categoria) }}</span>
            </div>

            <h1>{{ $punto->titulo }}</h1>

            <div class="stats">
                <span class="stat">
                    <x-icon name="map-pin" class="icon icon-sm" />
                    {{ $punto->region->nombre }}
                </span>
            </div>

            <div class="actions">
                @auth
                    @php $esFavorito = $punto->favoritadoPor()->whereKey(auth()->id())->exists(); @endphp
                    <form method="POST" action="{{ route('favoritos.punto', $punto) }}">
                        @csrf
                        <button type="submit" class="btn btn-secondary">
                            {{ $esFavorito ? '★ Quitar de favoritos' : '☆ Añadir a favoritos' }}
                        </button>
                    </form>
                @endauth
                @can('update', $punto)
                    <a href="{{ route('puntos.edit', $punto) }}" class="btn btn-secondary">Editar</a>
                    <form method="POST" action="{{ route('puntos.destroy', $punto) }}" onsubmit="return confirm('¿Seguro que quieres eliminar este punto?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-secondary">Eliminar</button>
                    </form>
                @endcan
            </div>
        </div>
    </section>
@endsection

@section('content')
    <div class="container detail-page">
        <div class="detail-grid">
            <article class="detail-main">
                @if ($punto->imagen_path)
                    <img src="{{ Storage::url($punto->imagen_path) }}" alt="{{ $punto->titulo }}" class="entity-image">
                @endif

                <section>
                    <h2>Descripción</h2>
                    <div class="prose">{!! nl2br(e($punto->descripcion)) !!}</div>
                </section>
            </article>

            <aside class="detail-aside">
                <div class="info-card">
                    <h3>Ubicación</h3>
                    <dl class="data-list">
                        <dt>Región</dt>
                        <dd>{{ $punto->region->nombre }}</dd>
                        <dt>Coordenadas</dt>
                        <dd>{{ $punto->lat }}, {{ $punto->lng }}</dd>
                    </dl>
                </div>

                <div class="info-card">
                    <h3>Creado por</h3>
                    <p>{{ $punto->autor->name }}</p>
                </div>
            </aside>
        </div>
    </div>
@endsection
