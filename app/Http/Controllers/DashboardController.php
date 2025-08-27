<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $role = auth()->user()->role;

        return view("dashboard.{$role}.index");

        $userCount        = User::count();
        $petCount         = Pet::count();
        $appointmentCount = Appointment::count();
        $reactionCount    = AppointmentReaction::pending()->count();

        // Chart data: appointments per month (last 6)
        $months = now()->subMonths(5)->monthsUntil(now());
        $apptData = Appointment::selectRaw('MONTH(created_at) as m, count(*) as total')
            ->where('created_at', '>=', now()->subMonths(5))
            ->groupBy('m')
            ->pluck('total', 'm');

        $appointmentChart = collect($months)->map(fn($m) => $apptData->get($m, 0));

        // User growth per month
        $signupData = User::selectRaw('MONTH(created_at) as m, count(*) as total')
            ->where('created_at', '>=', now()->subMonths(5))
            ->groupBy('m')
            ->pluck('total', 'm');
        $userChart = collect($months)->map(fn($m) => $signupData->get($m, 0));

        return view('admin.dashboard.index', compact(
        'userCount', 'petCount', 'appointmentCount', 'reactionCount',
        'months', 'appointmentChart', 'userChart'
        ));

    }

    // called by route('dashboard.admin')
    public function admin()
    {
        // you can also check role here, or trust your RoleMiddleware
        return view('dashboard.admin.index');
    }

    // make sure your route names match these method names
    public function veterinarian()
    {
        return view('dashboard.veterinarian.index');
    }

    public function owner()
    {
        return view('dashboard.owner.index');
    }
}