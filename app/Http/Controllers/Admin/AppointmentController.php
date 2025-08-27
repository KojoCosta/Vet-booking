<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Models\User;
use App\Models\Pet;
use App\Models\Appointment;
use App\Models\Veterinarian;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Appointment::with(['pet.owner.user', 'veterinarian.user']);

        if ($request->filled('vet_id')) {
            $query->where('vet_id', $request->vet_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date')) {
            $query->whereDate('scheduled_at', $request->date);
        }

        $appointments = $query->orderBy('scheduled_at', 'asc')->paginate(20);
        $vets = Veterinarian::with('user')->get();

        return view('dashboard.admin.appointments.react', compact('appointments', 'vets'));
    }

        public function create()
        {
            $pets = Pet::with('owner.user')->get();
            $vets = Veterinarian::with('user')->get();

            return view('dashboard.admin.appointments.create', compact('pets', 'vets'));
        }

        public function store(Request $request)
        {
            $data = $request->validate([
                'pet_id'       => 'required|exists:pets,id',
                'vet_id'       => 'required|exists:veterinarians,id',
                'scheduled_at' => 'required|date|after:now',
                'status'       => 'required|in:pending,completed,canceled',
                'notes'        => 'nullable|string|max:1000',
            ]);

            Appointment::create($data);

            return redirect()->route('admin.appointments.index')
                ->with('success', 'Appointment scheduled successfully.');
        }

    public function export()
    {
        $appointments = Appointment::with(['pet.owner.user', 'veterinarian.user'])->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="appointments.csv"',
        ];

        $callback = function () use ($appointments) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Pet', 'Owner', 'Veterinarian', 'Scheduled At', 'Status']);

            foreach ($appointments as $appt) {
                fputcsv($handle, [
                    $appt->pet->name,
                    $appt->pet->owner->user->name ?? '—',
                    $appt->veterinarian->user->name ?? '—',
                    $appt->scheduled_at,
                    ucfirst($appt->status),
                ]);
            }

            fclose($handle);
        };

        return new StreamedResponse($callback, 200, $headers);
    }

    public function show($id)
    {
        $appointment = Appointment::with(['pet.owner.user', 'veterinarian.user'])->findOrFail($id);

        return view('dashboard.admin.appointments.show', compact('appointment'));
    }
    
    public function react()
    {
        return view('dashboard.admin.appointments.react');
    }

   public function updateStatus(Request $request, Appointment $appointment)
    {
        $request->validate([
            'status' => ['required', 'in:pending,completed,canceled'],
        ]);

        $appointment->update(['status' => $request->status]);

        return response()->json(['message' => 'Status updated successfully.']);
    }

   public function reactView(Request $request)
    {
        // Load filtered appointments
        $appointments = Appointment::with(['pet.owner.user', 'veterinarian.user'])
            ->when($request->vet_id, fn($q) => $q->where('vet_id', $request->vet_id))
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->when($request->date, fn($q) => $q->whereDate('scheduled_at', $request->date))
            ->orderByDesc('scheduled_at')
            ->paginate(10);

        // Load all veterinarians for the filter dropdown
        $vets = Veterinarian::with('user')->get();

        // Pass both variables to the Blade view
        return view('dashboard.admin.appointments.react', compact('appointments', 'vets'));
    }
}