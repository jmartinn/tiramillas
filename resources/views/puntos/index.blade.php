@extends('layouts.app')

@section('titulo', 'Puntos de interés')

@section('content')
    <div class="page-header">
        <div>
            <p class="page-eyebrow">Descubre</p>
            <h1>Puntos de interés</h1>
        </div>
        @auth
            <div class="actions">
                <a href="{{ route('puntos.create') }}" class="btn btn-primary">Crear punto</a>
            </div>
        @endauth
    </div>

    <form method="GET" action="{{ route('puntos.index') }}" class="filters">
        <div class="filter-chip">
            <label for="filter-region">Región</label>
            <select id="filter-region" name="region" onchange="this.form.submit()">
                <option value="">Todas</option>
                @foreach ($regiones as $region)
                    <option value="{{ $region->slug }}" @selected($filtros['region'] === $region->slug)>
                        {{ $region->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="filter-chip">
            <label for="filter-categoria">Categoría</label>
            <select id="filter-categoria" name="categoria" onchange="this.form.submit()">
                <option value="">Todas</option>
                @foreach (['monumento', 'mirador', 'museo', 'gastronomia', 'naturaleza', 'otro'] as $cat)
                    <option value="{{ $cat }}" @selected($filtros['categoria'] === $cat)>
                        {{ ucfirst($cat) }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    @if ($puntos->isEmpty())
        <p class="text-muted">Aún no hay puntos que coincidan con los filtros.</p>
    @else
        <div class="featured-grid">
            @foreach ($puntos as $punto)
                <a href="{{ route('puntos.show', $punto) }}" class="featured-card">
                    <div class="featured-card-image">
                        @if ($punto->imagen_path)
                            <img src="{{ Storage::url($punto->imagen_path) }}" alt="{{ $punto->titulo }}">
                        @else
                            <x-icon name="map-pin" class="icon icon-xl" />
                        @endif
                        <div class="featured-card-tags">
                            <span class="tag tag-primary">{{ ucfirst($punto->categoria) }}</span>
                        </div>
                    </div>
                    <div class="featured-card-body">
                        <h3>{{ $punto->titulo }}</h3>
                        <p>{{ Str::limit($punto->descripcion, 140) }}</p>
                        <div class="featured-card-stats">
                            <span class="text-muted">{{ $punto->region->nombre }}</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        {{ $puntos->links() }}
    @endif
@endsection
