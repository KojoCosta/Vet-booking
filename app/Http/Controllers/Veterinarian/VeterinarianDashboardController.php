<?php

namespace App\Http\Controllers\Veterinarian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class VeterinarianDashboardController extends Controller
{
    public function index(Request $request)
    {
        return view('dashboard.veterinarian.index');
        
        $vet = Auth::user()->veterinarian;

        $appointments = Appointment::with(['pet.owner.user'])
            ->where('vet_id', $vet->id)
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->when($request->date, fn($q) => $q->whereDate('scheduled_at', $request->date))
            ->orderBy('scheduled_at')
            ->paginate(10);

        return view('dashboard.veterinarian.index', compact('appointments'));
    }
}