<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $locations = Location::where('user_id', $user->id)
            ->with('forecasts')
            ->latest()
            ->take(3)
            ->get();

        return Inertia::render('Weather/WeatherDashboard', [
            'locations' => $locations
        ]);
    }
}