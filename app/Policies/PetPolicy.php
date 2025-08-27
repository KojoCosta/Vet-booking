<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Pet;
use Illuminate\Auth\Access\HandlesAuthorization;

class PetPolicy
{
    use HandlesAuthorization;

    /**
     * Allow admins to view all pets.
     */
    public function viewAny(User $user)
    {
        return $user->hasRole('admin');
    }

    /**
     * Allow owners to view their own pets, and admins to view all.
     */
    public function view(User $user, Pet $pet)
    {
        return $user->id === $pet->owner->user_id || $user->hasRole('admin');
    }

    /**
     * Allow owners to create pets for themselves.
     */
    public function create(User $user)
    {
        return $user->hasRole('owner');
    }

    /**
     * Allow owners to update their own pets.
     */
    public function update(User $user, Pet $pet)
    {
        return $user->id === $pet->owner->user_id;
    }

    /**
     * Allow owners to delete their own pets.
     */
    public function delete(User $user, Pet $pet)
    {
        return $user->id === $pet->owner->user_id;
    }

    /**
     * Allow admins to export pet data.
     */
    public function export(User $user)
    {
        return $user->hasRole('admin');
    }
}