<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| These routes are loaded by the RouteServiceProvider within the "api"
| middleware group. They are designed for authenticated access via Sanctum.
|
*/

// 🔐 Authenticated user info
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// 📅 All appointments (public or protected as needed)
Route::get('/appointments', function () {
    return Appointment::with(['pet', 'veterinarian.user'])
        ->orderBy('scheduled_at', 'asc')
        ->get()
        ->map(function ($appt) {
            return [
                'id'           => $appt->id,
                'pet_name'     => $appt->pet->name ?? 'Unknown',
                'vet_name'     => $appt->veterinarian->user->name ?? '—',
                'scheduled_at' => $appt->scheduled_at->format('Y-m-d H:i'),
                'status'       => ucfirst($appt->status),
            ];
        });
});

// 🐾 Owner's pets
Route::middleware('auth:sanctum')->get('/owner/pets', function () {
    $owner = Auth::user()->owner;

    if (!$owner) {
        return response()->json(['error' => 'Owner not found'], 403);
    }

    return $owner->pets->map(fn($pet) => [
        'id'   => $pet->id,
        'name' => $pet->name,
        'type' => $pet->type,
        'age'  => $pet->age,
    ]);
});

// 🔔 Owner's upcoming appointment notifications
Route::middleware('auth:sanctum')->get('/owner/notifications', function () {
    $owner = Auth::user()->owner;

    if (!$owner) {
        return response()->json(['error' => 'Owner not found'], 403);
    }

    $appointments = $owner->appointments()
        ->where('status', 'upcoming')
        ->where('scheduled_at', '>', now())
        ->orderBy('scheduled_at')
        ->take(5)
        ->with('pet')
        ->get();

    return $appointments->map(fn($appt) => [
        'id'   => $appt->id,
        'time' => $appt->scheduled_at->format('M d, H:i'),
        'pet'  => $appt->pet->name ?? 'Unknown',
    ]);
});