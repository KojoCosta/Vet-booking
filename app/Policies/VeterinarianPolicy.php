<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Veterinarian;

class VeterinarianPolicy
{

    public function viewAny(User $user)
    {
        return $user->hasRole('admin');
    }

    public function view(User $user, Veterinarian $veterinarian)
    {
        return $user->id === $veterinarian->user_id || $user->hasRole('admin');
    }

    public function create(User $user)
    {
        return $user->hasRole('staff');
    }

    public function update(User $user, Veterinarian $veterinarian)
    {
        return $user->id === $veterinarian->user_id;
    }

    public function delete(User $user, Veterinarian $veterinarian)
    {
        return $user->hasRole('admin');
    }

    public function export(User $user)
    {
        return $user->hasRole('admin');
    }
}
