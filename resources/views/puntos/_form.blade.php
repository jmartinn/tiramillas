@csrf

<div class="form-group">
    <label for="titulo">Título</label>
    <input id="titulo" name="titulo" type="text" required value="{{ old('titulo', $punto->titulo ?? '') }}">
    @error('titulo') <p class="error-message">{{ $message }}</p> @enderror
</div>

<div class="form-group">
    <label for="region_id">Región</label>
    <select id="region_id" name="region_id" required>
        <option value="">Selecciona una región</option>
        @foreach ($regiones as $region)
            <option value="{{ $region->id }}" @selected(old('region_id', $punto->region_id ?? null) == $region->id)>
                {{ $region->nombre }}
            </option>
        @endforeach
    </select>
    @error('region_id') <p class="error-message">{{ $message }}</p> @enderror
</div>

<div class="form-group">
    <label for="categoria">Categoría</label>
    <select id="categoria" name="categoria" required>
        @foreach (['monumento', 'mirador', 'museo', 'gastronomia', 'naturaleza', 'otro'] as $cat)
            <option value="{{ $cat }}" @selected(old('categoria', $punto->categoria ?? '') === $cat)>
                {{ ucfirst($cat) }}
            </option>
        @endforeach
    </select>
    @error('categoria') <p class="error-message">{{ $message }}</p> @enderror
</div>

<div class="form-group">
    <label for="descripcion">Descripción</label>
    <textarea id="descripcion" name="descripcion" rows="6" required maxlength="2000">{{ old('descripcion', $punto->descripcion ?? '') }}</textarea>
    @error('descripcion') <p class="error-message">{{ $message }}</p> @enderror
</div>

<div class="form-row">
    <div class="form-group">
        <label for="lat">Latitud</label>
        <input id="lat" name="lat" type="number" step="0.0000001" required value="{{ old('lat', $punto->lat ?? '') }}">
        @error('lat') <p class="error-message">{{ $message }}</p> @enderror
    </div>

    <div class="form-group">
        <label for="lng">Longitud</label>
        <input id="lng" name="lng" type="number" step="0.0000001" required value="{{ old('lng', $punto->lng ?? '') }}">
        @error('lng') <p class="error-message">{{ $message }}</p> @enderror
    </div>
</div>

<x-map-selector lat-field="lat" lng-field="lng" />

<div class="form-group">
    <label for="imagen">Imagen (opcional, máx. 2 MB)</label>
    <input id="imagen" name="imagen" type="file" accept="image/*">
    @error('imagen') <p class="error-message">{{ $message }}</p> @enderror
</div>
