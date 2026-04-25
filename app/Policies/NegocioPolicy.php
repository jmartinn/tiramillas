<?php

namespace App\Policies;

use App\Models\Negocio;
use App\Models\User;

class NegocioPolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, Negocio $negocio): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Negocio $negocio): bool
    {
        return $user->id === $negocio->user_id;
    }

    public function delete(User $user, Negocio $negocio): bool
    {
        return $user->id === $negocio->user_id;
    }
}
