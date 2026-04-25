@extends('layouts.app')

@section('titulo', 'Mapa interactivo')

@push('head')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="">
@endpush

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
@endpush

@section('content')
    <div class="page-header">
        <div>
            <p class="page-eyebrow">Explora</p>
            <h1>Mapa interactivo</h1>
            <p>Rutas, puntos de interés y negocios locales por toda España.</p>
        </div>
    </div>

    <div class="mapa-leyenda">
        <span class="leyenda-item"><span class="leyenda-punto" style="background: #2d5016;"></span> Rutas</span>
        <span class="leyenda-item"><span class="leyenda-punto" style="background: #c97b3e;"></span> Puntos de interés</span>
        <span class="leyenda-item"><span class="leyenda-punto" style="background: #3d6b3a;"></span> Negocios</span>
    </div>

    <div id="mapa-principal" data-endpoint="{{ route('mapa.datos') }}"></div>
@endsection
