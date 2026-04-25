@props(['latField', 'lngField'])

@push('head')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="">
@endpush

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
@endpush

<div class="form-group">
    <label>Ubicación en el mapa</label>
    <p class="text-muted" style="margin-bottom: var(--space-2);">
        Haz clic en el mapa para fijar las coordenadas. También puedes escribirlas a mano arriba.
    </p>
    <div class="map-selector"
        data-mapa-selector
        data-lat-field="#{{ $latField }}"
        data-lng-field="#{{ $lngField }}">
    </div>
</div>
