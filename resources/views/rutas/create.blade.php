@extends('layouts.app')

@section('titulo', 'Crear ruta')

@section('content')
    <div class="form-wrapper">
        <p class="page-eyebrow">Nueva</p>
        <h1>Crear ruta</h1>

        <form method="POST" action="{{ route('rutas.store') }}" enctype="multipart/form-data" class="entity-form">
            @include('rutas._form')
            <button type="submit" class="btn btn-primary">Crear ruta</button>
            <a href="{{ route('rutas.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
