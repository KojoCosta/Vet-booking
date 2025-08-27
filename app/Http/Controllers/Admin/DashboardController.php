<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pet;
use App\Models\Appointment;
use App\Models\AppointmentReaction;
use Carbon\CarbonPeriod;

class DashboardController extends Controller
{
    public function index()
    {
        // 1) Basic stats
        $userCount        = User::count();
        $petCount         = Pet::count();
        $appointmentCount = Appointment::count();
        $reactionCount    = AppointmentReaction::whereHas('appointment', function($q){
            $q->where('status', 'pending');
        })->count();

        // 2) Build a 6-month period (including current month)
        $period = CarbonPeriod::create(
            now()->subMonths(5)->startOfMonth(),
            '1 month',
            now()->startOfMonth()
        );
        $months = collect($period);

        // 3) Pre-format our labels: ['Apr','May',…]
        $monthLabels = $months
            ->map(fn($dt) => $dt->format('M'))
            ->toArray();

        // 4) Appointments per month
        $apptRaw = Appointment::selectRaw('MONTH(created_at) m, COUNT(*) total')
            ->whereBetween('created_at', [
                now()->subMonths(5)->startOfMonth(),
                now()
            ])
            ->groupBy('m')
            ->pluck('total','m');

        $appointmentChart = $months
            ->map(fn($dt) => $apptRaw->get($dt->month, 0))
            ->toArray();

        // 5) User signups per month
        $userRaw = User::selectRaw('MONTH(created_at) m, COUNT(*) total')
            ->whereBetween('created_at', [
                now()->subMonths(5)->startOfMonth(),
                now()
            ])
            ->groupBy('m')
            ->pluck('total','m');

        $userChart = $months
            ->map(fn($dt) => $userRaw->get($dt->month, 0))
            ->toArray();

        // 6) Send everything to the view
        return view('dashboard.admin.index', [
            'userCount'        => $userCount,
            'petCount'         => $petCount,
            'appointmentCount' => $appointmentCount,
            'reactionCount'    => $reactionCount,
            'monthLabels'      => $monthLabels,
            'appointmentChart' => $appointmentChart,
            'userChart'        => $userChart,
        ]);
    }
}