<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['nombre', 'slug', 'codigo_iso'])]
class Region extends Model
{
    protected $table = 'regiones';

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function rutas(): HasMany
    {
        return $this->hasMany(Ruta::class);
    }

    public function puntos(): HasMany
    {
        return $this->hasMany(Punto::class);
    }

    public function negocios(): HasMany
    {
        return $this->hasMany(Negocio::class);
    }
}
