<?php

namespace App\Policies;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AppointmentPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function viewAny(User $user)
    {
        return $user->hasRole('admin');
    }

    public function view(User $user, Appointment $owner)
    {
        return $user->id === $owner->user_id || $user->hasRole('admin');
    }

    public function create(User $user)
    {
        return $user->hasRole('staff');
    }

    public function update(User $user, Appointment $owner)
    {
        return $user->id === $owner->user_id;
    }

    public function delete(User $user, Appointment $owner)
    {
        return $user->hasRole('admin');
    }

    public function export(User $user)
    {
        return $user->hasRole('admin');
    }
}
