<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\RedirectResponse;

class AuthenticatedSessionController extends Controller
{
    public function __construct()
    {
        // Guests may only access create/store; logout requires an authenticated session
        $this->middleware('guest')->except('destroy');
    }

    // Show the login form
    public function create()
    {
        return view('welcome');
    }

    // Process the login
    public function store(Request $request): RedirectResponse
    {
        // Validate login input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt login
        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'email' => 'Invalid credentials.',
            ]);
        }

        // Regenerate session
        $request->session()->regenerate();

        // Redirect based on role
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            return redirect()->route('dashboard.admin.index');
        } elseif ($user->hasRole('veterinarian')) {
            return redirect()->route('dashboard.vet.index');
        } elseif ($user->hasRole('owner')) {
            return redirect()->route('dashboard.owner.index');
        }

        return redirect()->route('welcome');
    }

    // Log the user out
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}