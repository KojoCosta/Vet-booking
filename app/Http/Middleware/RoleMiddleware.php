<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @param  mixed                    ...$roles  One or more roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        //$user = Auth::user();
        $user = auth()->user();

        if (!$user || !in_array($user->role, $roles)) {
            abort(403);
        }


        // 1. Must be authenticated
        if (! $user) {
            abort(401, 'You must be logged in.');
        }

        // 2. Check if user role matches any of the allowed roles
        if (! in_array($user->role, $roles)) {
            abort(403, 'Unauthorized: insufficient permissions.');
        }

        // 3. All good—proceed
        return $next($request);
    }
}