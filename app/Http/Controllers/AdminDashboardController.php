<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pet;
use App\Models\Appointment;
use App\Models\AppointmentReaction;
use Carbon\CarbonPeriod;

class AdminDashboardController extends Controller
{
    public function index()
    {
        //return view('dashboard.admin.index');
    
        // 1) Counts
        $userCount        = User::count();
        $petCount         = Pet::count();
        $appointmentCount = Appointment::count();
        $reactionCount    = AppointmentReaction::where('status', 'pending')->count();

        // 2) Last 6 month labels
        $period = CarbonPeriod::create(
            now()->subMonths(5)->startOfMonth(),
            '1 month',
            now()->startOfMonth()
        );
        $months = collect($period)->map(fn($d) => $d->format('M'));
        $monthLabels  = $months;  // alias

        // 3) Appointments per month
        $apptRaw = Appointment::selectRaw('MONTH(created_at) m, count(*) total')
            ->whereBetween('created_at', [
                now()->subMonths(5)->startOfMonth(), now()
            ])->groupBy('m')->pluck('total','m');
        $appointmentChart = $months->map(
            fn($label, $i) => $apptRaw->get(
                now()->subMonths(5 - $i)->month, 0
            )
        );

        // 4) Sign-ups per month
        $userRaw = User::selectRaw('MONTH(created_at) m, count(*) total')
            ->whereBetween('created_at', [
                now()->subMonths(5)->startOfMonth(), now()
            ])->groupBy('m')->pluck('total','m');
        $userChart = $months->map(
            fn($label, $i) => $userRaw->get(
                now()->subMonths(5 - $i)->month, 0
            )
        );

        // 5) Return view with *all* variables
        return view('dashboard.admin.index', compact(
            'userCount',
            'petCount',
            'appointmentCount',
            'reactionCount',
            'monthLabels',
            'appointmentChart',
            'userChart'
        ));
    }

}
