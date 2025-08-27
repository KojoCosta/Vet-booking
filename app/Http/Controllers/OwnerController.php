<?php

namespace App\Http\Controllers;

use App\Models\Owner;          // 1. Import the Owner model
use Illuminate\Http\Request;   // 2. Import Request for filtering/pagination
use App\Http\Requests\StoreOwnerRequest;
use App\Http\Requests\UpdateOwnerRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OwnerExport;


class OwnerController extends Controller
{
    /**
     * Display a paginated, filterable, sortable list of owners.
     */
    public function index(Request $request)
    {
        // 3. Get optional search query
        $search = $request->input('q');

        // 4. Determine sort column & direction, with defaults
        $sort      = $request->input('sort', 'id');
        $direction = $request->input('direction', 'asc');

        // 5. Build the query with conditional filtering
        $owners = Owner::when($search, function($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                             ->orWhere('email', 'like', "%{$search}%");
            })
            ->orderBy($sort, $direction)          // 6. Apply sorting
            ->paginate(15)                        // 7. Paginate 10 per page
            ->withQueryString();                  // 8. Preserve q, sort, direction in links

        // 9. Pass data & search term into the view
        return view('owners.index', compact('owners', 'search', 'sort', 'direction'));
    }

    /**
     * Display a detailed view of a single owner.
     */
   public function create()
    {
        return view('owners.create');
    }

    public function store(StoreOwnerRequest $request)
    {
        Owner::create($request->validated());
        return redirect()->route('owners.index')
                         ->with('success', 'Owner created successfully.');
    }

    public function show(Owner $owner)
    {
        return view('owners.show', compact('owner'));
    }

    public function edit(Owner $owner)
    {
        return view('owners.edit', compact('owner'));
    }

    public function update(UpdateOwnerRequest $request, Owner $owner)
    {
        $owner->update($request->validated());
        return redirect()->route('owners.index')
                         ->with('success', 'Owner updated successfully.');
    }

    public function destroy(Owner $owner)
    {
        $owner->delete();
        return redirect()->route('owners.index')
                         ->with('success', 'Owner deleted successfully.');
    }

    public function export(Request $request)
    {
        // Reuse index query logic if needed, or export all
        return Excel::download(new OwnersExport($request->all()), 'owners.csv');
    }
}