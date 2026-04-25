@extends('layouts.app')

@section('titulo', 'Rutas')

@section('content')
    <div class="page-header">
        <div>
            <p class="page-eyebrow">Explora</p>
            <h1>Rutas</h1>
        </div>
        @auth
            <div class="actions">
                <a href="{{ route('rutas.create') }}" class="btn btn-primary">Crear ruta</a>
            </div>
        @endauth
    </div>

    <form method="GET" action="{{ route('rutas.index') }}" class="filters">
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
                @foreach (['naturaleza', 'cultura', 'gastronomia', 'patrimonio'] as $cat)
                    <option value="{{ $cat }}" @selected($filtros['categoria'] === $cat)>
                        {{ ucfirst($cat) }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    @if ($rutas->isEmpty())
        <p class="text-muted">Aún no hay rutas que coincidan con los filtros.</p>
    @else
        <div class="featured-grid">
            @foreach ($rutas as $ruta)
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
                            <span class="text-muted">{{ $ruta->region->nombre }}</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        {{ $rutas->links() }}
    @endif
@endsection
