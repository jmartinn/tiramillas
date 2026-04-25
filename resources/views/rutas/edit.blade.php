@extends('layouts.app')

@section('titulo', 'Editar ruta')

@section('content')
    <div class="form-wrapper">
        <p class="page-eyebrow">Editar</p>
        <h1>{{ $ruta->titulo }}</h1>

        <form method="POST" action="{{ route('rutas.update', $ruta) }}" enctype="multipart/form-data" class="entity-form">
            @method('PATCH')
            @include('rutas._form')
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
            <a href="{{ route('rutas.show', $ruta) }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
