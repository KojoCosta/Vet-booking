<?php

namespace App\Http\Controllers;

class AdminCalendarController extends Controller
{
    public function __invoke()
    {
        // return your admin calendar view or data
        return view('admin.calendar.index');
    }
}