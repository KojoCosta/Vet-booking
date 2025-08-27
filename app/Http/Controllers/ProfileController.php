<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Show the profile edit form
    public function edit()
    {
        return view('profile.edit');
    }

    // Persist profile changes
    public function update(Request $request)
    {
        $data = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.auth()->id(),
        ]);

        auth()->user()->update($data);

        return redirect()->route('dashboard')
                         ->with('status', 'Profile updated successfully.');
    }
}