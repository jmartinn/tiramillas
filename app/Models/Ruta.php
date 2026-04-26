<?php

namespace App\Models;

use Database\Factories\RutaFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Ruta extends Model
{
    /** @use HasFactory<RutaFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id', 'region_id', 'titulo', 'slug', 'descripcion', 'descripcion_larga',
        'categoria', 'dificultad', 'distancia_km', 'duracion_min',
        'lat_inicio', 'lng_inicio', 'punto_inicio', 'punto_fin', 'mejor_epoca',
        'destacada', 'imagen_path',
    ];

    protected function casts(): array
    {
        return [
            'destacada' => 'boolean',
            'lat_inicio' => 'float',
            'lng_inicio' => 'float',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function autor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function puntos(): BelongsToMany
    {
        return $this->belongsToMany(Punto::class, 'ruta_punto')
            ->withPivot(['orden', 'descripcion_paso'])
            ->orderBy('ruta_punto.orden');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function favoritadaPor(): MorphToMany
    {
        return $this->morphToMany(User::class, 'favoritable', 'favoritos')
            ->using(Favorito::class);
    }
}
