@extends('layouts.app')

@section('titulo', 'Editar punto')

@section('content')
    <div class="form-wrapper">
        <h1>Editar punto</h1>

        <form method="POST" action="{{ route('puntos.update', $punto) }}" enctype="multipart/form-data" class="entity-form">
            @method('PATCH')
            @include('puntos._form')
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
            <a href="{{ route('puntos.show', $punto) }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
