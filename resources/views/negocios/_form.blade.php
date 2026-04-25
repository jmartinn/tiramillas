@csrf

<div class="form-group">
    <label for="nombre">Nombre del negocio</label>
    <input id="nombre" name="nombre" type="text" required value="{{ old('nombre', $negocio->nombre ?? '') }}">
    @error('nombre') <p class="error-message">{{ $message }}</p> @enderror
</div>

<div class="form-group">
    <label for="region_id">Región</label>
    <select id="region_id" name="region_id" required>
        <option value="">Selecciona una región</option>
        @foreach ($regiones as $region)
            <option value="{{ $region->id }}" @selected(old('region_id', $negocio->region_id ?? null) == $region->id)>
                {{ $region->nombre }}
            </option>
        @endforeach
    </select>
    @error('region_id') <p class="error-message">{{ $message }}</p> @enderror
</div>

<div class="form-group">
    <label for="categoria">Categoría</label>
    <select id="categoria" name="categoria" required>
        @foreach (['alojamiento', 'restaurante', 'artesania', 'experiencia', 'transporte', 'otro'] as $cat)
            <option value="{{ $cat }}" @selected(old('categoria', $negocio->categoria ?? '') === $cat)>
                {{ ucfirst($cat) }}
            </option>
        @endforeach
    </select>
    @error('categoria') <p class="error-message">{{ $message }}</p> @enderror
</div>

<div class="form-group">
    <label for="descripcion">Descripción</label>
    <textarea id="descripcion" name="descripcion" rows="6" required maxlength="2000">{{ old('descripcion', $negocio->descripcion ?? '') }}</textarea>
    @error('descripcion') <p class="error-message">{{ $message }}</p> @enderror
</div>

<div class="form-group">
    <label for="direccion">Dirección</label>
    <input id="direccion" name="direccion" type="text" required value="{{ old('direccion', $negocio->direccion ?? '') }}">
    @error('direccion') <p class="error-message">{{ $message }}</p> @enderror
</div>

<div class="form-row">
    <div class="form-group">
        <label for="lat">Latitud</label>
        <input id="lat" name="lat" type="number" step="0.0000001" required value="{{ old('lat', $negocio->lat ?? '') }}">
        @error('lat') <p class="error-message">{{ $message }}</p> @enderror
    </div>

    <div class="form-group">
        <label for="lng">Longitud</label>
        <input id="lng" name="lng" type="number" step="0.0000001" required value="{{ old('lng', $negocio->lng ?? '') }}">
        @error('lng') <p class="error-message">{{ $message }}</p> @enderror
    </div>
</div>

<div class="form-group">
    <label for="telefono">Teléfono (opcional)</label>
    <input id="telefono" name="telefono" type="tel" value="{{ old('telefono', $negocio->telefono ?? '') }}">
    @error('telefono') <p class="error-message">{{ $message }}</p> @enderror
</div>

<div class="form-group">
    <label for="email">Correo electrónico (opcional)</label>
    <input id="email" name="email" type="email" value="{{ old('email', $negocio->email ?? '') }}">
    @error('email') <p class="error-message">{{ $message }}</p> @enderror
</div>

<div class="form-group">
    <label for="sitio_web">Sitio web (opcional)</label>
    <input id="sitio_web" name="sitio_web" type="url" placeholder="https://..." value="{{ old('sitio_web', $negocio->sitio_web ?? '') }}">
    @error('sitio_web') <p class="error-message">{{ $message }}</p> @enderror
</div>

<div class="form-group">
    <label for="plan">Plan</label>
    <select id="plan" name="plan" required>
        @foreach (['basico', 'pro', 'premium'] as $p)
            <option value="{{ $p }}" @selected(old('plan', $negocio->plan ?? 'basico') === $p)>
                {{ ucfirst($p) }}
            </option>
        @endforeach
    </select>
    @error('plan') <p class="error-message">{{ $message }}</p> @enderror
</div>

<div class="form-group">
    <label for="imagen">Imagen (opcional, máx. 2 MB)</label>
    <input id="imagen" name="imagen" type="file" accept="image/*">
    @error('imagen') <p class="error-message">{{ $message }}</p> @enderror
</div>
