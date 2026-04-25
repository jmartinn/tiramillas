@extends('layouts.app')

@section('titulo', $negocio->nombre)

@section('content')
    <article class="entity-detail">
        <header class="page-header">
            <div>
                <h1>{{ $negocio->nombre }}</h1>
                <p class="text-muted">
                    {{ $negocio->region->nombre }} · {{ ucfirst($negocio->categoria) }}
                    @if ($negocio->verificado) · Verificado @endif
                </p>
            </div>
            @can('update', $negocio)
                <div class="actions">
                    <a href="{{ route('negocios.edit', $negocio) }}" class="btn btn-secondary">Editar</a>
                    <form method="POST" action="{{ route('negocios.destroy', $negocio) }}" onsubmit="return confirm('¿Seguro que quieres eliminar este negocio?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-secondary">Eliminar</button>
                    </form>
                </div>
            @endcan
        </header>

        @auth
            @php $esFavorito = $negocio->favoritadoPor()->whereKey(auth()->id())->exists(); @endphp
            <form method="POST" action="{{ route('favoritos.negocio', $negocio) }}" class="favorito-form">
                @csrf
                <button type="submit" class="btn btn-secondary">
                    {{ $esFavorito ? '★ Quitar de favoritos' : '☆ Añadir a favoritos' }}
                </button>
            </form>
        @endauth

        @if ($negocio->imagen_path)
            <img src="{{ Storage::url($negocio->imagen_path) }}" alt="{{ $negocio->nombre }}" class="entity-image">
        @endif

        <section class="entity-section">
            <h2>Sobre el negocio</h2>
            <div class="prose">{!! nl2br(e($negocio->descripcion)) !!}</div>
        </section>

        <section class="entity-section">
            <h2>Contacto</h2>
            <dl class="data-list">
                <dt>Dirección</dt><dd>{{ $negocio->direccion }}</dd>
                @if ($negocio->telefono)
                    <dt>Teléfono</dt><dd>{{ $negocio->telefono }}</dd>
                @endif
                @if ($negocio->email)
                    <dt>Correo</dt><dd><a href="mailto:{{ $negocio->email }}">{{ $negocio->email }}</a></dd>
                @endif
                @if ($negocio->sitio_web)
                    <dt>Sitio web</dt><dd><a href="{{ $negocio->sitio_web }}" target="_blank" rel="noopener">{{ $negocio->sitio_web }}</a></dd>
                @endif
                <dt>Coordenadas</dt><dd>{{ $negocio->lat }}, {{ $negocio->lng }}</dd>
            </dl>
        </section>

        <section class="entity-section">
            <h2>Gestionado por</h2>
            <p>{{ $negocio->dueno->name }} · Plan {{ ucfirst($negocio->plan) }}</p>
        </section>
    </article>
@endsection
