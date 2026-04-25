<?php

namespace App\Policies;

use App\Models\Punto;
use App\Models\User;

class PuntoPolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, Punto $punto): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Punto $punto): bool
    {
        return $user->id === $punto->user_id;
    }

    public function delete(User $user, Punto $punto): bool
    {
        return $user->id === $punto->user_id;
    }
}
