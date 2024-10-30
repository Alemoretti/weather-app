<?php

namespace App\Http\Controllers;

use App\Services\WeatherService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class WeatherController extends Controller
{
    protected $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function addLocationForecast(Request $request)
    {
        $user = Auth::user();

        if (Gate::denies('create-location', $user)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        $city = $request->input('city');
        $state = $request->input('state');
        $units = $request->input('units');

        $result = $this->weatherService->getWeatherData($city, $state, $units, $user->id);

        if (isset($result['error'])) {
            return response()->json([
                'error' => $result['error'],
            ], $result['status']);
        }

        return response()->json($result);
    }
}