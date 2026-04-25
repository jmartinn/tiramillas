<?php

namespace App\Models;

use Database\Factories\NegocioFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

#[Fillable([
    'user_id', 'region_id', 'nombre', 'slug', 'descripcion', 'categoria',
    'direccion', 'lat', 'lng', 'telefono', 'email', 'sitio_web',
    'plan', 'verificado', 'imagen_path',
])]
class Negocio extends Model
{
    /** @use HasFactory<NegocioFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'verificado' => 'boolean',
            'lat' => 'float',
            'lng' => 'float',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function dueno(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function favoritadoPor(): MorphToMany
    {
        return $this->morphToMany(User::class, 'favoritable', 'favoritos')
            ->using(Favorito::class);
    }
}
