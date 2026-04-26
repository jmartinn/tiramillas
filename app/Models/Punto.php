<?php

namespace App\Models;

use Database\Factories\PuntoFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Punto extends Model
{
    /** @use HasFactory<PuntoFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id', 'region_id', 'titulo', 'slug', 'descripcion',
        'categoria', 'lat', 'lng', 'imagen_path',
    ];

    protected function casts(): array
    {
        return [
            'lat' => 'float',
            'lng' => 'float',
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

    public function rutas(): BelongsToMany
    {
        return $this->belongsToMany(Ruta::class, 'ruta_punto')
            ->withPivot(['orden', 'descripcion_paso']);
    }

    public function favoritadoPor(): MorphToMany
    {
        return $this->morphToMany(User::class, 'favoritable', 'favoritos')
            ->using(Favorito::class);
    }
}
