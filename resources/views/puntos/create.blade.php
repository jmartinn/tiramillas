@extends('layouts.app')

@section('titulo', 'Crear punto')

@section('content')
    <div class="form-wrapper">
        <p class="page-eyebrow">Nuevo</p>
        <h1>Crear punto de interés</h1>

        <form method="POST" action="{{ route('puntos.store') }}" enctype="multipart/form-data" class="entity-form">
            @include('puntos._form')
            <button type="submit" class="btn btn-primary">Crear punto</button>
            <a href="{{ route('puntos.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
