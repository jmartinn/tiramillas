<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['user_id', 'ruta_id', 'puntuacion', 'cuerpo'])]
class Review extends Model
{
    protected function casts(): array
    {
        return [
            'puntuacion' => 'integer',
        ];
    }

    public function autor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ruta(): BelongsTo
    {
        return $this->belongsTo(Ruta::class);
    }
}
