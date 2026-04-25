@extends('layouts.app')

@section('titulo', 'Puntos de interés')

@section('content')
    <div class="page-header">
        <h1>Puntos de interés</h1>
        @auth
            <a href="{{ route('puntos.create') }}" class="btn btn-primary">Crear punto</a>
        @endauth
    </div>

    <form method="GET" action="{{ route('puntos.index') }}" class="filters">
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
                @foreach (['monumento', 'mirador', 'museo', 'gastronomia', 'naturaleza', 'otro'] as $cat)
                    <option value="{{ $cat }}" @selected($filtros['categoria'] === $cat)>
                        {{ ucfirst($cat) }}
                    </option>
                @endforeach
            </select>
        </label>
    </form>

    @if ($puntos->isEmpty())
        <p class="text-muted">Aún no hay puntos que coincidan con los filtros.</p>
    @else
        <ul class="card-list">
            @foreach ($puntos as $punto)
                <li class="card">
                    <a href="{{ route('puntos.show', $punto) }}">
                        <h3>{{ $punto->titulo }}</h3>
                        <p class="card-meta">
                            {{ $punto->region->nombre }} · {{ ucfirst($punto->categoria) }}
                        </p>
                        <p>{{ Str::limit($punto->descripcion, 120) }}</p>
                    </a>
                </li>
            @endforeach
        </ul>

        {{ $puntos->links() }}
    @endif
@endsection
