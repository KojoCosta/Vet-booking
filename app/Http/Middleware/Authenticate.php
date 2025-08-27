<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
   protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            $user = auth()->user();

            if ($user) {
                return match ($user->role) {
                    'admin'        => route('admin.index'),
                    'owner'        => route('owner.dashboard'),
                    'veterinarian' => route('vet.dashboard'),
                    default        => route('home'),
                };
            }

            return route('login');
        }
    }
}
