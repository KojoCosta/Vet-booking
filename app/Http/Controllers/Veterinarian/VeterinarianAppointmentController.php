<?php

namespace App\Http\Controllers\Veterinarian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class VeterinarianAppointmentController extends Controller
{
    public function index(Request $request)
    {
        $appointments = Appointment::with(['pet.owner.user'])
            ->where('veterinarian_id', auth()->id())
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->when($request->date, fn($q) => $q->whereDate('scheduled_at', $request->date))
            ->orderBy('scheduled_at')
            ->paginate(10);

        if ($request->ajax()) {
            return view('dashboard.veterinarian.partials.appointments-table', compact('appointments'))->render();
        }

        return view('dashboard.veterinarian.index', compact('appointments'));
    }
}