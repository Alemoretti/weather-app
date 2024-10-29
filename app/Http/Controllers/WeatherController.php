<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WeatherService;

class WeatherController extends Controller
{
    protected $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function addLocationForecast(Request $request)
    {
        $city = $request->input('city');
        $state = $request->input('state');
        $units = $request->input('units');

        $result = $this->weatherService->getWeatherData($city, $state, $units);

        if (isset($result['error'])) {
            return response()->json([
                'error' => $result['error'],
            ], $result['status']);
        }

        return response()->json($result);
    }
}