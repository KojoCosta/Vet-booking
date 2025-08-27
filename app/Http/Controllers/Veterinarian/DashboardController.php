<?php

namespace App\Http\Controllers\Veterinarian;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.veterinarian.index');
    }
}
