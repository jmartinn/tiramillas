@extends('layouts.app')

@section('titulo', $ruta->titulo)

@section('content')
    <article class="entity-detail">
        <header class="page-header">
            <div>
                <h1>{{ $ruta->titulo }}</h1>
                <p class="text-muted">
                    {{ $ruta->region->nombre }} · {{ ucfirst($ruta->categoria) }} · {{ ucfirst($ruta->dificultad) }}
                </p>
            </div>
            @can('update', $ruta)
                <div class="actions">
                    <a href="{{ route('rutas.edit', $ruta) }}" class="btn btn-secondary">Editar</a>
                    <form method="POST" action="{{ route('rutas.destroy', $ruta) }}" onsubmit="return confirm('¿Seguro que quieres eliminar esta ruta?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-secondary">Eliminar</button>
                    </form>
                </div>
            @endcan
        </header>

        @if ($ruta->imagen_path)
            <img src="{{ Storage::url($ruta->imagen_path) }}" alt="{{ $ruta->titulo }}" class="entity-image">
        @endif

        <section class="entity-section">
            <h2>Sobre esta ruta</h2>
            <p>{{ $ruta->descripcion }}</p>
            <div class="prose">{!! nl2br(e($ruta->descripcion_larga)) !!}</div>
        </section>

        <section class="entity-section">
            <h2>Datos prácticos</h2>
            <dl class="data-list">
                <dt>Distancia</dt><dd>{{ $ruta->distancia_km }} km</dd>
                <dt>Duración</dt><dd>{{ $ruta->duracion_min }} min</dd>
                <dt>Punto de inicio</dt><dd>{{ $ruta->punto_inicio }}</dd>
                <dt>Punto final</dt><dd>{{ $ruta->punto_fin }}</dd>
                @if ($ruta->mejor_epoca)
                    <dt>Mejor época</dt><dd>{{ $ruta->mejor_epoca }}</dd>
                @endif
                <dt>Coordenadas inicio</dt><dd>{{ $ruta->lat_inicio }}, {{ $ruta->lng_inicio }}</dd>
            </dl>
        </section>

        <section class="entity-section">
            <h2>Creada por</h2>
            <p>{{ $ruta->autor->name }}</p>
        </section>
    </article>
@endsection
