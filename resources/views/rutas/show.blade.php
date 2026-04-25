@extends('layouts.app')

@section('titulo', $ruta->titulo)

@section('hero')
    <section class="detail-hero">
        <div class="detail-hero-inner">
            <nav class="breadcrumbs">
                <a href="{{ url('/') }}">Inicio</a>
                <x-icon name="chevron-right" class="icon icon-sm" />
                <a href="{{ route('rutas.index') }}">Rutas</a>
                <x-icon name="chevron-right" class="icon icon-sm" />
                <span class="current">{{ $ruta->titulo }}</span>
            </nav>

            <div class="tags">
                <span class="tag tag-primary">{{ ucfirst($ruta->categoria) }}</span>
                <span class="tag">{{ ucfirst($ruta->dificultad) }}</span>
                @if ($ruta->destacada)
                    <span class="tag">Destacada</span>
                @endif
            </div>

            <h1>{{ $ruta->titulo }}</h1>
            <p>{{ $ruta->descripcion }}</p>

            <div class="stats">
                <span class="stat">
                    <x-icon name="map-pin" class="icon icon-sm" />
                    {{ $ruta->region->nombre }}
                </span>
                <span class="stat">
                    <x-icon name="clock" class="icon icon-sm" />
                    {{ $ruta->duracion_min }} min
                </span>
                <span class="stat">
                    <x-icon name="route" class="icon icon-sm" />
                    {{ $ruta->distancia_km }} km
                </span>
                @if ($ruta->reviews->count())
                    <span class="stat">
                        <x-icon name="star" class="icon icon-sm" style="fill: currentColor;" />
                        {{ number_format($ruta->reviews->avg('puntuacion'), 1) }} ({{ $ruta->reviews->count() }})
                    </span>
                @endif
            </div>

            <div class="actions">
                @auth
                    @php $esFavorita = $ruta->favoritadaPor()->whereKey(auth()->id())->exists(); @endphp
                    <form method="POST" action="{{ route('favoritos.ruta', $ruta) }}">
                        @csrf
                        <button type="submit" class="btn btn-secondary">
                            {{ $esFavorita ? '★ Quitar de favoritos' : '☆ Añadir a favoritos' }}
                        </button>
                    </form>
                @endauth
                @can('update', $ruta)
                    <a href="{{ route('rutas.edit', $ruta) }}" class="btn btn-secondary">Editar</a>
                    <form method="POST" action="{{ route('rutas.destroy', $ruta) }}" onsubmit="return confirm('¿Seguro que quieres eliminar esta ruta?');">
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
                @if ($ruta->imagen_path)
                    <img src="{{ Storage::url($ruta->imagen_path) }}" alt="{{ $ruta->titulo }}" class="entity-image">
                @endif

                <section>
                    <h2>Sobre esta ruta</h2>
                    <div class="prose">{!! nl2br(e($ruta->descripcion_larga)) !!}</div>
                </section>
            </article>

            <aside class="detail-aside">
                <div class="info-card">
                    <h3>Información práctica</h3>
                    <dl class="data-list">
                        <dt>Punto de inicio</dt>
                        <dd>{{ $ruta->punto_inicio }}</dd>
                        <dt>Punto final</dt>
                        <dd>{{ $ruta->punto_fin }}</dd>
                        @if ($ruta->mejor_epoca)
                            <dt>Mejor época</dt>
                            <dd>{{ $ruta->mejor_epoca }}</dd>
                        @endif
                        <dt>Coordenadas inicio</dt>
                        <dd>{{ $ruta->lat_inicio }}, {{ $ruta->lng_inicio }}</dd>
                    </dl>
                </div>

                <div class="info-card">
                    <h3>Creada por</h3>
                    <p>{{ $ruta->autor->name }}</p>
                </div>
            </aside>
        </div>

        @php
            $reviews = $ruta->reviews;
            $promedio = $reviews->avg('puntuacion');
            $miReview = auth()->check() ? $reviews->firstWhere('user_id', auth()->id()) : null;
        @endphp

        <section class="entity-section reviews" style="margin-top: var(--space-10);">
            <h2>
                Reseñas
                @if ($reviews->count())
                    <small class="text-muted">
                        · {{ number_format($promedio, 1) }} de 5 ({{ $reviews->count() }})
                    </small>
                @endif
            </h2>

            @auth
                @if (! $miReview)
                    <form method="POST" action="{{ route('reviews.store', $ruta) }}" class="review-form">
                        @csrf
                        <div class="form-group">
                            <label for="puntuacion">Puntuación (1-5)</label>
                            <input id="puntuacion" name="puntuacion" type="number" min="1" max="5" required value="{{ old('puntuacion', 5) }}">
                            @error('puntuacion') <p class="error-message">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label for="cuerpo">Tu opinión</label>
                            <textarea id="cuerpo" name="cuerpo" rows="4" required minlength="10" maxlength="2000">{{ old('cuerpo') }}</textarea>
                            @error('cuerpo') <p class="error-message">{{ $message }}</p> @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Publicar reseña</button>
                    </form>
                @endif
            @else
                <p class="text-muted">
                    <a href="{{ route('login') }}" style="text-decoration: underline;">Inicia sesión</a> para dejar una reseña.
                </p>
            @endauth

            @if ($reviews->isEmpty())
                <p class="text-muted">Aún no hay reseñas para esta ruta.</p>
            @else
                <ul class="review-list">
                    @foreach ($reviews as $review)
                        <li class="review">
                            <div class="review-meta">
                                <strong>{{ $review->autor->name }}</strong>
                                <span class="text-muted">· {{ $review->puntuacion }} / 5 · {{ $review->created_at->diffForHumans() }}</span>
                            </div>
                            <p>{{ $review->cuerpo }}</p>
                            @can('delete', $review)
                                <form method="POST" action="{{ route('reviews.destroy', $review) }}" onsubmit="return confirm('¿Eliminar tu reseña?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-secondary">Eliminar</button>
                                </form>
                            @endcan
                        </li>
                    @endforeach
                </ul>
            @endif
        </section>
    </div>
@endsection
