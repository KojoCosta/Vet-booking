<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Veterinarian;
use Illuminate\Support\Facades\Auth;
use App\Models\Pet;

class AppointmentController extends Controller
{

    public function index(Request $request)
    {
        $owner = Auth::user()->owner;

        $query = $owner->appointments()->with(['pet', 'veterinarian.user']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by date range
        if ($request->filled('from')) {
            $query->whereDate('scheduled_at', '>=', $request->from);
        }

        if ($request->filled('to')) {
            $query->whereDate('scheduled_at', '<=', $request->to);
        }

        // Filter by pet
        if ($request->filled('pet_id')) {
            $query->where('pet_id', $request->pet_id);
        }

        $appointments = $query->orderByDesc('scheduled_at')->paginate(10);

        $pets = $owner->pets()->pluck('name', 'id'); // For dropdown

        return view('dashboard.owner.appointments.index', compact('appointments', 'pets'));
    }

    public function create()
    {
        $owner = Auth::user()->owner;

        $pets = $owner->pets()->pluck('name', 'id');
        $vets = Veterinarian::with('user')->get();

        return view('dashboard.owner.appointments.create', compact('pets', 'vets'));
    }


    public function store(Request $request)
    {
        $owner = Auth::user()->owner;

        $request->validate([
            'pet_id' => ['required', 'exists:pets,id'],
            'vet_id' => ['required', 'exists:veterinarians,id'],
            'scheduled_at' => ['required', 'date', 'after:now'],
            'notes' => ['nullable', 'string'],
        ]);

        // Ensure pet belongs to owner
        if (!$owner->pets()->where('id', $request->pet_id)->exists()) {
            abort(403, 'Unauthorized pet selection.');
        }

        Appointment::create([
            'pet_id' => $request->pet_id,
            'vet_id' => $request->vet_id,
            'scheduled_at' => $request->scheduled_at,
            'status' => 'pending',
            'notes' => $request->notes,
        ]);

        return redirect()->route('owner.appointments.index')->with('success', 'Appointment created successfully.');
    }
}