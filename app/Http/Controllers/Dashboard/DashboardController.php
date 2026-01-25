<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function operational(Request $request)
    {
        return view('dashboard.operational');
    }

    public function financial()
    {
        return view('dashboard.financial');
    }
}
