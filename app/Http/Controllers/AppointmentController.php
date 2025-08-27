<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppointmentController extends Controller
{

    public function index(Request $request)
    {
        // 3. Get optional search query
        $search = $request->input('q');

        // 4. Determine sort column & direction, with defaults
        $sort      = $request->input('sort', 'id');
        $direction = $request->input('direction', 'asc');

        // 5. Build the query with conditional filtering
        $appointments = Appointment::when($search, function($query, $search) {
                return $query->where('pet_id', 'like', "%{$search}%")
                             ->orWhere('scheduled_at',  'like', "%{$search}%")
                             ->orWhere('vet_id',  'like', "%{$search}%");
            })
            ->orderBy($sort, $direction)          // 6. Apply sorting
            ->paginate(10)                        // 7. Paginate 10 per page
            ->withQueryString();                  // 8. Preserve q, sort, direction in links

        // 9. Pass data & search term into the view
        return view('appointments.index', compact('appointments', 'search', 'sort', 'direction'));
    }

    /**
     * Display a detailed view of a single owner.
     */
   public function create()
    {
        return view('aoointments.create');
    }

    public function store(StoreAppointmentRequest $request)
    {
        Owner::create($request->validated());
        return redirect()->route('aoointments.index')
                         ->with('success', 'Owner created successfully.');
    }

    public function show(Owner $owner)
    {
        return view('aoointments.show', compact('owner'));
    }

    public function edit(Owner $owner)
    {
        return view('aoointments.edit', compact('owner'));
    }

    public function update(UpdateOwnerRequest $request, Owner $owner)
    {
        $owner->update($request->validated());
        return redirect()->route('aoointments.index')
                         ->with('success', 'Owner updated successfully.');
    }

    public function destroy(Owner $owner)
    {
        $owner->delete();
        return redirect()->route('aoointments.index')
                         ->with('success', 'Owner deleted successfully.');
    }

    public function export(Request $request)
    {
        // Reuse index query logic if needed, or export all
        return Excel::download(new OwnersExport($request->all()), 'aoointments.csv');
    }
    public function __construct()
    {
        $this->authorizeResource(Appointment::class, 'appointment');
    }

    public function react()
    {
        // You can fetch pending appointments here
        $appointments = Appointment::where('status', 'pending')->get();

        return view('dashboard.admin.appointments.react', compact('appointments'));
    }

    // index(), show(Appointment $appointment), create(), store(), edit(Appointment $appointment), update(Request $request, Appointment $appointment), destroy(Appointment $appointment)
}
