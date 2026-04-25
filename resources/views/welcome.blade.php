@extends('layouts.app')

@section('titulo', 'Inicio')

@section('content')
    <div class="stack">
        <h1>Bienvenida a Tira Millas</h1>
        <p>
            Plataforma colaborativa para descubrir y compartir rutas y puntos de interés
            del turismo rural y cultural de España.
        </p>
        @auth
            <p class="text-muted">Has iniciado sesión como {{ Auth::user()->email }}.</p>
        @endauth
    </div>
@endsection
