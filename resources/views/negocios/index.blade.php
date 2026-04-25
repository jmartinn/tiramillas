@extends('layouts.app')

@section('titulo', 'Negocios')

@section('content')
    <div class="page-header">
        <div>
            <p class="page-eyebrow">Apoya lo local</p>
            <h1>Negocios locales</h1>
        </div>
        <div class="actions">
            <a href="{{ route('negocios.sumate') }}" class="btn btn-secondary">¿Tienes un negocio?</a>
            @auth
                <a href="{{ route('negocios.create') }}" class="btn btn-primary">Crear negocio</a>
            @endauth
        </div>
    </div>

    <form method="GET" action="{{ route('negocios.index') }}" class="filters">
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
                @foreach (['alojamiento', 'restaurante', 'artesania', 'experiencia', 'transporte', 'otro'] as $cat)
                    <option value="{{ $cat }}" @selected($filtros['categoria'] === $cat)>
                        {{ ucfirst($cat) }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    @if ($negocios->isEmpty())
        <p class="text-muted">Aún no hay negocios que coincidan con los filtros.</p>
    @else
        <div class="featured-grid">
            @foreach ($negocios as $negocio)
                <a href="{{ route('negocios.show', $negocio) }}" class="featured-card">
                    <div class="featured-card-image">
                        @if ($negocio->imagen_path)
                            <img src="{{ Storage::url($negocio->imagen_path) }}" alt="{{ $negocio->nombre }}">
                        @else
                            <x-icon name="map-pin" class="icon icon-xl" />
                        @endif
                        <div class="featured-card-tags">
                            <span class="tag tag-primary">{{ ucfirst($negocio->categoria) }}</span>
                            @if ($negocio->verificado)
                                <span class="tag">Verificado</span>
                            @endif
                        </div>
                    </div>
                    <div class="featured-card-body">
                        <h3>{{ $negocio->nombre }}</h3>
                        <p>{{ Str::limit($negocio->descripcion, 140) }}</p>
                        <div class="featured-card-stats">
                            <span class="text-muted">{{ $negocio->region->nombre }}</span>
                            <span class="text-muted">Plan {{ ucfirst($negocio->plan) }}</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        {{ $negocios->links() }}
    @endif
@endsection
