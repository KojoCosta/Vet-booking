<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pet;

class PetController extends Controller
{
    /**
     * Display a list of the owner's pets, optionally filtered by species.
     */
    public function index(Request $request)
    {
        $owner = Auth::user()->owner;
        $species = $request->query('species');

        $pets = $owner->pets()
            ->when($species, fn($query) => $query->where('species', $species))
            ->orderBy('name')
            ->get();

        $speciesList = $owner->pets()
            ->select('species')
            ->distinct()
            ->orderBy('species')
            ->pluck('species');

        return view('dashboard.owner.pets.index', compact('pets', 'speciesList', 'species'));
    }

    /**
     * Show the form to create a new pet.
     */
    public function create()
    {
        return view('dashboard.owner.pets.create');
    }

    /**
     * Store a newly created pet in the database.
     */
    public function store(Request $request)
    {
        $owner = Auth::user()->owner;

        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'species'   => 'required|string|max:50',
            'breed'     => 'nullable|string|max:100',
            'birthdate' => 'nullable|date|before:today',
            'sex'       => 'required|in:male,female',
        ]);

        $owner->pets()->create($validated);

        return redirect()->route('owner.pets.index')->with('success', 'Pet added successfully.');
    }

    /**
     * Show the form to edit an existing pet.
     */
    public function edit(Pet $pet)
    {
        $this->authorize('update', $pet);

        return view('dashboard.owner.pets.edit', compact('pet'));
    }

    /**
     * Update the specified pet in the database.
     */
    public function update(Request $request, Pet $pet)
    {
        $this->authorize('update', $pet);

        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'species'   => 'required|string|max:50',
            'breed'     => 'nullable|string|max:100',
            'birthdate' => 'nullable|date|before:today',
            'sex'       => 'required|in:male,female',
        ]);

        $pet->update($validated);

        return redirect()->route('owner.pets.index')->with('success', 'Pet updated successfully.');
    }

    /**
     * Delete the specified pet from the database.
     */
    public function destroy(Pet $pet)
    {
        $this->authorize('delete', $pet);

        $pet->delete();

        return redirect()->route('owner.pets.index')->with('success', 'Pet deleted successfully.');
    }
}