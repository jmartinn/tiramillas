@extends('layouts.app')

@section('titulo', $punto->titulo)

@section('content')
    <article class="entity-detail">
        <header class="page-header">
            <div>
                <h1>{{ $punto->titulo }}</h1>
                <p class="text-muted">
                    {{ $punto->region->nombre }} · {{ ucfirst($punto->categoria) }}
                </p>
            </div>
            @can('update', $punto)
                <div class="actions">
                    <a href="{{ route('puntos.edit', $punto) }}" class="btn btn-secondary">Editar</a>
                    <form method="POST" action="{{ route('puntos.destroy', $punto) }}" onsubmit="return confirm('¿Seguro que quieres eliminar este punto?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-secondary">Eliminar</button>
                    </form>
                </div>
            @endcan
        </header>

        @auth
            @php $esFavorito = $punto->favoritadoPor()->whereKey(auth()->id())->exists(); @endphp
            <form method="POST" action="{{ route('favoritos.punto', $punto) }}" class="favorito-form">
                @csrf
                <button type="submit" class="btn btn-secondary">
                    {{ $esFavorito ? '★ Quitar de favoritos' : '☆ Añadir a favoritos' }}
                </button>
            </form>
        @endauth

        @if ($punto->imagen_path)
            <img src="{{ Storage::url($punto->imagen_path) }}" alt="{{ $punto->titulo }}" class="entity-image">
        @endif

        <section class="entity-section">
            <h2>Descripción</h2>
            <div class="prose">{!! nl2br(e($punto->descripcion)) !!}</div>
        </section>

        <section class="entity-section">
            <h2>Ubicación</h2>
            <dl class="data-list">
                <dt>Coordenadas</dt><dd>{{ $punto->lat }}, {{ $punto->lng }}</dd>
                <dt>Región</dt><dd>{{ $punto->region->nombre }}</dd>
            </dl>
        </section>

        <section class="entity-section">
            <h2>Creado por</h2>
            <p>{{ $punto->autor->name }}</p>
        </section>
    </article>
@endsection
