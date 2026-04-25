<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphPivot;

class Favorito extends MorphPivot
{
    protected $table = 'favoritos';

    public $timestamps = false;

    const CREATED_AT = 'created_at';

    const UPDATED_AT = null;
}
