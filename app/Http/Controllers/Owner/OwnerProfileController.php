<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OwnerProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $owner = $user->owner;

        return view('dashboard.owner.profile.edit', compact('user', 'owner'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $owner = $user->owner;

        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $user->update(['name' => $validated['name']]);
        $owner->update([
            'phone'   => $validated['phone'],
            'address' => $validated['address'],
        ]);

        return redirect()->route('owner.profile.edit')->with('success', 'Profile updated successfully.');
    }
}