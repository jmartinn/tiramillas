@extends('layouts.app')

@section('titulo', 'Negocios')

@section('content')
    <div class="page-header">
        <h1>Negocios locales</h1>
        <div class="actions">
            <a href="{{ route('negocios.sumate') }}" class="btn btn-secondary">¿Tienes un negocio?</a>
            @auth
                <a href="{{ route('negocios.create') }}" class="btn btn-primary">Crear negocio</a>
            @endauth
        </div>
    </div>

    <form method="GET" action="{{ route('negocios.index') }}" class="filters">
        <label>
            Región
            <select name="region" onchange="this.form.submit()">
                <option value="">Todas</option>
                @foreach ($regiones as $region)
                    <option value="{{ $region->slug }}" @selected($filtros['region'] === $region->slug)>
                        {{ $region->nombre }}
                    </option>
                @endforeach
            </select>
        </label>
        <label>
            Categoría
            <select name="categoria" onchange="this.form.submit()">
                <option value="">Todas</option>
                @foreach (['alojamiento', 'restaurante', 'artesania', 'experiencia', 'transporte', 'otro'] as $cat)
                    <option value="{{ $cat }}" @selected($filtros['categoria'] === $cat)>
                        {{ ucfirst($cat) }}
                    </option>
                @endforeach
            </select>
        </label>
    </form>

    @if ($negocios->isEmpty())
        <p class="text-muted">Aún no hay negocios que coincidan con los filtros.</p>
    @else
        <ul class="card-list">
            @foreach ($negocios as $negocio)
                <li class="card">
                    <a href="{{ route('negocios.show', $negocio) }}">
                        <h3>{{ $negocio->nombre }}</h3>
                        <p class="card-meta">
                            {{ $negocio->region->nombre }} · {{ ucfirst($negocio->categoria) }}
                            @if ($negocio->verificado) · Verificado @endif
                        </p>
                        <p>{{ Str::limit($negocio->descripcion, 120) }}</p>
                    </a>
                </li>
            @endforeach
        </ul>

        {{ $negocios->links() }}
    @endif
@endsection
