<?php

namespace App\Policies;

use App\Models\Ruta;
use App\Models\User;

class RutaPolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, Ruta $ruta): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Ruta $ruta): bool
    {
        return $user->id === $ruta->user_id;
    }

    public function delete(User $user, Ruta $ruta): bool
    {
        return $user->id === $ruta->user_id;
    }
}
