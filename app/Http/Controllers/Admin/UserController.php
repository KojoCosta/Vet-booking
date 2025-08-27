<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Events\UserCreated;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Owner;
use App\Models\Veterinarian;

class UserController extends Controller
{
    /**
     * Display a listing of the users, with optional search/role filters.
     */
    public function index(Request $request)
    {
        $query = User::with(['owner', 'veterinarian'])
                     ->orderByDesc('created_at');

        if ($request->filled('search')) {
            $query->where(fn($q) =>
                $q->where('name', 'like', '%'.$request->search.'%')
                  ->orWhere('email', 'like', '%'.$request->search.'%')
            );
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->paginate(15)->withQueryString();
        $roles = User::distinct()->pluck('role')->toArray();

        return view('dashboard.admin.users.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        $roles = User::distinct()->pluck('role')->toArray();
        return view('dashboard.admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created user (and owner/veterinarian record if needed).
     */
    
    public function store(StoreUserRequest $request)
    {
        // 1) validated() already applies all rules
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        // 2) Create the user and capture the instance
        $user = User::create($data);

        // 3) If role is "owner", create an Owner profile
        if ($data['role'] === 'owner') {
            Owner::create([
                'user_id'       => $user->id,
                'phone'   => $data['owner_phone'],
                'address' => $data['owner_address'],
            ]);
        }

        // 4) If role is "veterinarian", create a Vet profile
        if ($data['role'] === 'veterinarian') {
            Veterinarian::create([
                'user_id'         => $user->id,
                'name'        => $data['vet_name'],
                'phone'       => $data['vet_phone'],
                'license_number'  => $data['license_number'],
                'specialization'  => $data['specialization'],
            ]);
        }

        // 5) Redirect exactly as before
        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Member created successfully');
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        $roles = User::distinct()->pluck('role')->toArray();
        return view('dashboard.admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified user (and sync owner/veterinarian records).
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();

        DB::transaction(function() use ($data, $user) {
            // Update core user fields
            $user->update([
                'name'     => $data['name'],
                'email'    => $data['email'],
                'role'     => $data['role'],
                'password' => $data['password']
                    ? Hash::make($data['password'])
                    : $user->password,
            ]);

            // Synchronize related table based on role
            if ($data['role'] === 'owner') {
                $user->owner()->updateOrCreate(
                    [], // match by user_id automatically
                    [
                        'phone'   => $data['owner_phone'],
                        'address' => $data['owner_address'],
                    ]
                );
                $user->veterinarian()->delete();
            }
            elseif ($data['role'] === 'veterinarian') {
                $user->veterinarian()->updateOrCreate(
                    [],
                    [
                        'vet_name'       => $data['vet_name'],
                        'phone'          => $data['vet_phone'],
                        'license_number' => $data['license_number'],
                        'specialization' => $data['specialization'],
                    ]
                );
                $user->owner()->delete();
            }
            else {
                // role == admin
                $user->owner()->delete();
                $user->veterinarian()->delete();
            }
        });

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified user and any related owner/veterinarian record.
     */
    public function destroy(User $user)
    {
        DB::transaction(function() use ($user) {
            $user->owner()->delete();
            $user->veterinarian()->delete();
            $user->delete();
        });

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }
}