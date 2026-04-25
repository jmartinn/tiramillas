@extends('layouts.app')

@section('titulo', 'Inicio')

@section('content')
    <div class="space-y-4">
        <h1 class="text-3xl font-semibold">Bienvenida a Tira Millas</h1>
        <p class="text-gray-600">
            Plataforma colaborativa para descubrir y compartir rutas y puntos de interés del turismo rural y cultural de España.
        </p>
        @auth
            <p class="text-sm text-gray-500">Has iniciado sesión como {{ Auth::user()->email }}.</p>
        @endauth
    </div>
@endsection
