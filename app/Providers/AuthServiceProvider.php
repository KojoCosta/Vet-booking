<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
// Model classes
use App\Models\Owner;
use App\Models\Pet;
use App\Models\Veterinarian;
use App\Models\Appointment;

// Policy classes
use App\Policies\OwnerPolicy;
use App\Policies\PetPolicy;
use App\Policies\VeterinarianPolicy;
use App\Policies\AppointmentPolicy;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * Map Eloquent models to their policies.
     *
     * Laravel uses this to determine which policy to invoke
     * when you call Gate::allows() or $this->authorize().
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Owner::class         => OwnerPolicy::class,
        Pet::class           => PetPolicy::class,
        Veterinarian::class  => VeterinarianPolicy::class,
        Appointment::class   => AppointmentPolicy::class,

        \App\Models\Pet::class => \App\Policies\PetPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

            Gate::define('manage-users', function($user){
            return $user->role === 'admin';
        });

        Gate::define('viewVetAppointments', fn($user) => $user->isAdmin());

        /*Gate::before(function ($user, $ability) {
            return $user->is_admin ? true : null;
        });
        Gate::resource('pet', PetPolicy::class);
        Gate::resource('appointment', AppointmentPolicy::class);*/
    }
}
