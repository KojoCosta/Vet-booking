<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class OwnerDashboardController extends Controller
{
    public function index()
    {
        $ownerId = Auth::user()->owner->id ?? null;

        $appointments = Appointment::with(['pet', 'veterinarian.user'])
            ->whereHas('pet.owner', fn ($q) => $q->where('id', $ownerId))
            ->orderBy('scheduled_at', 'asc')
            ->take(5)
            ->get();

        return view('dashboard.owner.index', compact('appointments'));
    }
}