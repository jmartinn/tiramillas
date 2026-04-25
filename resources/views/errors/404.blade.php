@extends('layouts.app')

@section('titulo', 'Página no encontrada')

@section('content')
    <div class="error-page">
        <p class="error-code">404</p>
        <h1>Página no encontrada</h1>
        <p>
            La página que buscas no existe o ha sido movida.
            Quizás te interese explorar nuestras rutas o el mapa interactivo.
        </p>
        <div class="error-actions">
            <a href="{{ url('/') }}" class="btn btn-primary">Volver al inicio</a>
            <a href="{{ route('rutas.index') }}" class="btn btn-secondary">Explorar rutas</a>
        </div>
    </div>
@endsection
