@csrf

<div class="form-group">
    <label for="titulo">Título</label>
    <input id="titulo" name="titulo" type="text" required value="{{ old('titulo', $ruta->titulo ?? '') }}">
    @error('titulo') <p class="error-message">{{ $message }}</p> @enderror
</div>

<div class="form-group">
    <label for="region_id">Región</label>
    <select id="region_id" name="region_id" required>
        <option value="">Selecciona una región</option>
        @foreach ($regiones as $region)
            <option value="{{ $region->id }}" @selected(old('region_id', $ruta->region_id ?? null) == $region->id)>
                {{ $region->nombre }}
            </option>
        @endforeach
    </select>
    @error('region_id') <p class="error-message">{{ $message }}</p> @enderror
</div>

<div class="form-group">
    <label for="categoria">Categoría</label>
    <select id="categoria" name="categoria" required>
        @foreach (['naturaleza', 'cultura', 'gastronomia', 'patrimonio'] as $cat)
            <option value="{{ $cat }}" @selected(old('categoria', $ruta->categoria ?? '') === $cat)>
                {{ ucfirst($cat) }}
            </option>
        @endforeach
    </select>
    @error('categoria') <p class="error-message">{{ $message }}</p> @enderror
</div>

<div class="form-group">
    <label for="dificultad">Dificultad</label>
    <select id="dificultad" name="dificultad" required>
        @foreach (['facil', 'moderada', 'exigente'] as $d)
            <option value="{{ $d }}" @selected(old('dificultad', $ruta->dificultad ?? '') === $d)>
                {{ ucfirst($d) }}
            </option>
        @endforeach
    </select>
    @error('dificultad') <p class="error-message">{{ $message }}</p> @enderror
</div>

<div class="form-group">
    <label for="descripcion">Descripción corta (máx. 500 caracteres)</label>
    <textarea id="descripcion" name="descripcion" rows="2" required maxlength="500">{{ old('descripcion', $ruta->descripcion ?? '') }}</textarea>
    @error('descripcion') <p class="error-message">{{ $message }}</p> @enderror
</div>

<div class="form-group">
    <label for="descripcion_larga">Descripción larga</label>
    <textarea id="descripcion_larga" name="descripcion_larga" rows="8" required>{{ old('descripcion_larga', $ruta->descripcion_larga ?? '') }}</textarea>
    @error('descripcion_larga') <p class="error-message">{{ $message }}</p> @enderror
</div>

<div class="form-row">
    <div class="form-group">
        <label for="distancia_km">Distancia (km)</label>
        <input id="distancia_km" name="distancia_km" type="number" step="0.1" min="0.1" required value="{{ old('distancia_km', $ruta->distancia_km ?? '') }}">
        @error('distancia_km') <p class="error-message">{{ $message }}</p> @enderror
    </div>

    <div class="form-group">
        <label for="duracion_min">Duración (minutos)</label>
        <input id="duracion_min" name="duracion_min" type="number" min="5" required value="{{ old('duracion_min', $ruta->duracion_min ?? '') }}">
        @error('duracion_min') <p class="error-message">{{ $message }}</p> @enderror
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="lat_inicio">Latitud de inicio</label>
        <input id="lat_inicio" name="lat_inicio" type="number" step="0.0000001" required value="{{ old('lat_inicio', $ruta->lat_inicio ?? '') }}">
        @error('lat_inicio') <p class="error-message">{{ $message }}</p> @enderror
    </div>

    <div class="form-group">
        <label for="lng_inicio">Longitud de inicio</label>
        <input id="lng_inicio" name="lng_inicio" type="number" step="0.0000001" required value="{{ old('lng_inicio', $ruta->lng_inicio ?? '') }}">
        @error('lng_inicio') <p class="error-message">{{ $message }}</p> @enderror
    </div>
</div>

<div class="form-group">
    <label for="punto_inicio">Punto de inicio</label>
    <input id="punto_inicio" name="punto_inicio" type="text" required value="{{ old('punto_inicio', $ruta->punto_inicio ?? '') }}">
    @error('punto_inicio') <p class="error-message">{{ $message }}</p> @enderror
</div>

<div class="form-group">
    <label for="punto_fin">Punto final</label>
    <input id="punto_fin" name="punto_fin" type="text" required value="{{ old('punto_fin', $ruta->punto_fin ?? '') }}">
    @error('punto_fin') <p class="error-message">{{ $message }}</p> @enderror
</div>

<div class="form-group">
    <label for="mejor_epoca">Mejor época (opcional)</label>
    <input id="mejor_epoca" name="mejor_epoca" type="text" value="{{ old('mejor_epoca', $ruta->mejor_epoca ?? '') }}">
    @error('mejor_epoca') <p class="error-message">{{ $message }}</p> @enderror
</div>

<div class="form-group">
    <label>
        <input type="hidden" name="destacada" value="0">
        <input type="checkbox" name="destacada" value="1" @checked(old('destacada', $ruta->destacada ?? false))>
        Destacar esta ruta
    </label>
</div>

<div class="form-group">
    <label for="imagen">Imagen (opcional, máx. 2 MB)</label>
    <input id="imagen" name="imagen" type="file" accept="image/*">
    @error('imagen') <p class="error-message">{{ $message }}</p> @enderror
</div>
