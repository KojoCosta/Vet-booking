<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Owner;

class OwnerPolicy
{
    public function viewAny(User $user)
    {
        return $user->hasRole('admin');
    }

    public function view(User $user, Owner $owner)
    {
        return $user->id === $owner->user_id || $user->hasRole('admin');
    }

    public function update(User $user, Owner $owner)
    {
        return $user->id === $owner->user_id;
    }

    public function delete(User $user, Owner $owner)
    {
        return $user->hasRole('admin');
    }

    public function export(User $user)
    {
        return $user->hasRole('admin');
    }
}