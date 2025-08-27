<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PetController extends Controller
{
    public function index(Request $request)
    {
        // Get optional search query
        $search = $request->input('q');

        // Determine sort column & direction, with defaults
        $sort      = $request->input('sort', 'id');
        $direction = $request->input('direction', 'asc');

        // Build query on Pet model (was Pet)
        $pets = Pet::when($search, function($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                             ->orWhere('species',      'like', "%{$search}%");
            })
            ->orderBy($sort, $direction)          // 6. Apply sorting
            ->paginate(10)                        // 7. Paginate 10 per page
            ->withQueryString();                  // 8. Preserve q, sort, direction in links

        // Pass data to the view (was pets.index)
        return view('pets.index', [
            'pets'      => $pets,
            'search'    => $search,
            'sort'      => $sort,
            'direction' => $direction,
        ]);
    }

    public function create()
    {
        return view('pets.create');
    }

    public function store(StorePetRequest $request)
    {
        Pet::create($request->validated());
        return redirect()->route('pets.index')
                         ->with('success', 'Pet created successfully.');
    }

    public function show(Pet $owner)
    {
        return view('pets.show', compact('owner'));
    }

    public function edit(Pet $owner)
    {
        return view('pets.edit', compact('owner'));
    }

    public function update(UpdateOwnerRequest $request, Pet $owner)
    {
        $owner->update($request->validated());
        return redirect()->route('pets.index')
                         ->with('success', 'Pet updated successfully.');
    }

    public function destroy(Pet $owner)
    {
        $owner->delete();
        return redirect()->route('pets.index')
                         ->with('success', 'Pet deleted successfully.');
    }

    public function export(Request $request)
    {
        // Reuse index query logic if needed, or export all
        return Excel::download(new PetsExport($request->all()), 'pets.csv');
    }

    public function __construct()
    {
        $this->authorizeResource(Pet::class, 'pet');
    }


    // index(), create(), store(), show(Pet $pet), edit(Pet $pet), update(Request $request, Pet $pet), destroy(Pet $pet)
}
