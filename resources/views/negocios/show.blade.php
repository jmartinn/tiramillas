@extends('layouts.app')

@section('titulo', $negocio->nombre)

@section('hero')
    <section class="detail-hero">
        <div class="detail-hero-inner">
            <nav class="breadcrumbs">
                <a href="{{ url('/') }}">Inicio</a>
                <x-icon name="chevron-right" class="icon icon-sm" />
                <a href="{{ route('negocios.index') }}">Negocios</a>
                <x-icon name="chevron-right" class="icon icon-sm" />
                <span class="current">{{ $negocio->nombre }}</span>
            </nav>

            <div class="tags">
                <span class="tag tag-primary">{{ ucfirst($negocio->categoria) }}</span>
                @if ($negocio->verificado)
                    <span class="tag">Verificado</span>
                @endif
            </div>

            <h1>{{ $negocio->nombre }}</h1>

            <div class="stats">
                <span class="stat">
                    <x-icon name="map-pin" class="icon icon-sm" />
                    {{ $negocio->region->nombre }}
                </span>
                <span class="stat">Plan {{ ucfirst($negocio->plan) }}</span>
            </div>

            <div class="actions">
                @auth
                    @php $esFavorito = $negocio->favoritadoPor()->whereKey(auth()->id())->exists(); @endphp
                    <form method="POST" action="{{ route('favoritos.negocio', $negocio) }}">
                        @csrf
                        <button type="submit" class="btn btn-secondary">
                            {{ $esFavorito ? '★ Quitar de favoritos' : '☆ Añadir a favoritos' }}
                        </button>
                    </form>
                @endauth
                @can('update', $negocio)
                    <a href="{{ route('negocios.edit', $negocio) }}" class="btn btn-secondary">Editar</a>
                    <form method="POST" action="{{ route('negocios.destroy', $negocio) }}" onsubmit="return confirm('¿Seguro que quieres eliminar este negocio?');">
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
                @if ($negocio->imagen_path)
                    <img src="{{ Storage::url($negocio->imagen_path) }}" alt="{{ $negocio->nombre }}" class="entity-image">
                @endif

                <section>
                    <h2>Sobre el negocio</h2>
                    <div class="prose">{!! nl2br(e($negocio->descripcion)) !!}</div>
                </section>
            </article>

            <aside class="detail-aside">
                <div class="info-card">
                    <h3>Contacto</h3>
                    <dl class="data-list">
                        <dt>Dirección</dt>
                        <dd>{{ $negocio->direccion }}</dd>
                        @if ($negocio->telefono)
                            <dt>Teléfono</dt>
                            <dd>{{ $negocio->telefono }}</dd>
                        @endif
                        @if ($negocio->email)
                            <dt>Correo</dt>
                            <dd><a href="mailto:{{ $negocio->email }}" style="text-decoration: underline;">{{ $negocio->email }}</a></dd>
                        @endif
                        @if ($negocio->sitio_web)
                            <dt>Sitio web</dt>
                            <dd><a href="{{ $negocio->sitio_web }}" target="_blank" rel="noopener" style="text-decoration: underline;">{{ $negocio->sitio_web }}</a></dd>
                        @endif
                        <dt>Coordenadas</dt>
                        <dd>{{ $negocio->lat }}, {{ $negocio->lng }}</dd>
                    </dl>
                </div>

                <div class="info-card">
                    <h3>Gestionado por</h3>
                    <p>{{ $negocio->dueno->name }}</p>
                </div>
            </aside>
        </div>
    </div>
@endsection
