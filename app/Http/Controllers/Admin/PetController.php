<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PetController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $query = Pet::with(['owner.user', 'appointments']);

        // Role-based filtering
        if ($user->role === 'owner' && $user->owner) {
            $query->where('owner_id', $user->owner->id);
        }

        elseif ($user->role === 'veterinarian' && $user->veterinarian) {
            $vetId = $user->veterinarian->id;

            $query->whereHas('appointments', function ($q) use ($vetId) {
                $q->where('veterinarian_id', $vetId);
            });
        }

         // 🟣 Species filter (after role filtering)
        if (request('species')) {
            $query->where('species', request('species'));
        }

        // Admins see all pets
        $pets = $query->latest()->paginate(10);

        return view('dashboard.admin.pets.index', compact('pets'));
    }

    public function create() {
        return view('dashboard.admin.pets.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:255',
            'species'   => 'required|string|max:50',
            'breed'     => 'nullable|string|max:100',
            'birthdate' => 'required|date',
            'sex'       => 'required|in:male,female',
        ]);

        $data['owner_id'] = auth()->user()->owner->id;

        Pet::create($data);

        return redirect()->route('admin.pets.index')
            ->with('success', 'Pet added successfully.');
    }

    public function export()
    {
        $pets = Pet::with('owner.user')->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="pets.csv"',
        ];

        $callback = function () use ($pets) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Name', 'Species', 'Breed', 'Sex', 'Birthdate', 'Owner']);

            foreach ($pets as $pet) {
                fputcsv($handle, [
                    $pet->name,
                    $pet->species,
                    $pet->breed,
                    ucfirst($pet->sex),
                    $pet->birthdate,
                    $pet->owner->user->name ?? '—',
                ]);
            }

            fclose($handle);
        };

        return new StreamedResponse($callback, 200, $headers);
    }
}