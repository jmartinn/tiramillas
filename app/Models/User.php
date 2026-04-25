<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
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

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function rutasFavoritas(): MorphToMany
    {
        return $this->morphedByMany(Ruta::class, 'favoritable', 'favoritos')
            ->using(Favorito::class);
    }

    public function puntosFavoritos(): MorphToMany
    {
        return $this->morphedByMany(Punto::class, 'favoritable', 'favoritos')
            ->using(Favorito::class);
    }

    public function negociosFavoritos(): MorphToMany
    {
        return $this->morphedByMany(Negocio::class, 'favoritable', 'favoritos')
            ->using(Favorito::class);
    }
}
