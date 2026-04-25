@extends('layouts.app')

@section('titulo', 'Rutas')

@section('content')
    <div class="page-header">
        <h1>Rutas</h1>
        @auth
            <a href="{{ route('rutas.create') }}" class="btn btn-primary">Crear ruta</a>
        @endauth
    </div>

    <form method="GET" action="{{ route('rutas.index') }}" class="filters">
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
                @foreach (['naturaleza', 'cultura', 'gastronomia', 'patrimonio'] as $cat)
                    <option value="{{ $cat }}" @selected($filtros['categoria'] === $cat)>
                        {{ ucfirst($cat) }}
                    </option>
                @endforeach
            </select>
        </label>
    </form>

    @if ($rutas->isEmpty())
        <p class="text-muted">Aún no hay rutas que coincidan con los filtros.</p>
    @else
        <ul class="card-list">
            @foreach ($rutas as $ruta)
                <li class="card">
                    <a href="{{ route('rutas.show', $ruta) }}">
                        <h3>{{ $ruta->titulo }}</h3>
                        <p class="card-meta">
                            {{ $ruta->region->nombre }} · {{ ucfirst($ruta->categoria) }} · {{ ucfirst($ruta->dificultad) }}
                        </p>
                        <p>{{ $ruta->descripcion }}</p>
                    </a>
                </li>
            @endforeach
        </ul>

        {{ $rutas->links() }}
    @endif
@endsection
