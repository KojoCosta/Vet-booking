<?php

namespace App\Http\Controllers\Veterinarian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VeterinarianNotificationController extends Controller
{
    public function index()
    {
        $notifications = Auth::user()
            ->notifications() // or ->notifications if using Laravel's built-in
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('dashboard.veterinarian.notifications', compact('notifications'));
    }

}
