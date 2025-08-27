<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PetController as AdminPetController;
use App\Http\Controllers\Admin\AppointmentController as AdminAppointmentController ;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Owner\OwnerDashboardController;
use App\Http\Controllers\Owner\PetController as OwnerPetController;
use App\Http\Controllers\Owner\AppointmentController as OwnerAppointmentController;
use App\Http\Controllers\Owner\OwnerProfileController;
use App\Http\Controllers\Veterinarian\ProfileController;
use App\Models\Veterinarian;
use App\Models\Appointment;
use App\Models\User;
use App\Http\Livewire\Vet\AppointmentList;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
    // Welcome page for guests
    Route::get('/', function () {
    if (auth()->check()) {
        return match (auth()->user()->role) {
            'admin'        => redirect()->route('admin.dashboard'),
            'owner'        => redirect()->route('owner.dashboard'),
            'veterinarian' => redirect()->route('veterinarian.dashboard'),
            default        => redirect()->route('welcome'),
        };
    }

    return view('welcome');
})->name('welcome');

    // Login form
    Route::get('/login', [LoginController::class, 'showLoginForm'])
        ->middleware('guest')
        ->name('login');

    // Login submission
    Route::post('/login', [LoginController::class, 'login'])
        ->middleware('guest')
        ->name('login.submit');

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])
        ->middleware('auth')
        ->name('logout');
/*
|--------------------------------------------------------------------------
| Admin Dashboard Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('dashboard/admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::resource('users', UserController::class);
        Route::resource('pets', AdminPetController::class);
        Route::get('pets/export', [AdminPetController::class, 'export'])->name('pets.export');

        Route::resource('appointments', AdminAppointmentController::class)->except(['show']);
        Route::get('appointments/export', [AdminAppointmentController::class, 'export'])->name('appointments.export');
        Route::get('appointments/react', [AdminAppointmentController::class, 'react'])->name('appointments.react');
        
        Route::patch('/admin/appointments/{appointment}/status', [AdminAppointmentController::class, 'updateStatus'])
        ->name('admin.appointments.updateStatus');
        Route::get('/admin/appointments/react', [AdminAppointmentController::class, 'reactView'])
        ->name('admin.appointments.react');
    });

/*
|--------------------------------------------------------------------------
| Owner Dashboard Route
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:owner'])
    ->prefix('dashboard/owner')
    ->name('owner.')
    ->group(function () {
        Route::get('/', [OwnerDashboardController::class, 'index'])->name('dashboard');
        Route::resource('pets', OwnerPetController::class)->except(['show']);
        Route::get('appointments/create', [OwnerAppointmentController::class, 'create'])->name('appointments.create');
        Route::post('appointments', [OwnerAppointmentController::class, 'store'])->name('appointments.store');
        Route::get('/appointments', [OwnerAppointmentController::class, 'index'])->name('appointments.index');
        Route::get('/appointments/create', [OwnerAppointmentController::class, 'create'])->name('appointments.create');

        Route::get('/profile', [OwnerProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [OwnerProfileController::class, 'update'])->name('profile.update');

        Route::get('/pets', [OwnerPetController::class, 'index'])->name('pets.index');
        Route::get('/pets/create', [OwnerPetController::class, 'create'])->name('pets.create');
        Route::post('/pets', [OwnerPetController::class, 'store'])->name('pets.store');
        Route::get('/pets/{pet}/edit', [OwnerPetController::class, 'edit'])->name('pets.edit');
        Route::put('/pets/{pet}', [OwnerPetController::class, 'update'])->name('pets.update');
        Route::delete('/pets/{pet}', [OwnerPetController::class, 'destroy'])->name('pets.destroy');



    });

/*
|--------------------------------------------------------------------------
| Vet Dashboard Route
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:veterinarian'])->prefix('dashboard/veterinarian')->name('veterinarian.')->group(function () {
    
    // 🏠 Main Dashboard View
    Route::get('/', function () {
            $vet = Veterinarian::where('user_id', auth()->id())->firstOrFail();
            $appointmentCount = Appointment::where('vet_id', $vet->id)->count();

            $statusCounts = Appointment::where('vet_id', $vet->id)
            ->selectRaw("status, COUNT(*) as count")
            ->groupBy('status')
            ->pluck('count', 'status');

            return view('dashboard.veterinarian.index', [
                    'vet' => $vet,
                    'appointmentCount' => $appointmentCount,
                    'statusCounts' => $statusCounts,
                ]);
            })->name('dashboard');

    // 📅 Appointments Index View
    Route::view('/appointments', 'dashboard.veterinarian.appointments.index')->name('appointments.index');

    // 🧑‍⚕️ Profile View
    Route::view('/profile/edit', 'dashboard.veterinarian.profile.edit')->name('profile.edit');

    // 📝 Profile Update Action
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware(['role:admin,veterinarian'])->group(function () {
    Route::get('/shared-dashboard', function () {
        return view('dashboard.shared.index');
    });
});