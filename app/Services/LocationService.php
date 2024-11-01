<?php

namespace App\Services;

use App\Models\Location;
use App\Models\Forecast;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\LocationRequest;
use App\DTOs\LocationDTO;
use App\DTOs\ForecastDTO;
use App\Services\WeatherService;

class LocationService
{
    protected $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function storeLocation(LocationRequest $request)
    {
        $user = Auth::user();

        if (Gate::denies('store-location', $user)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $locationDTO = new LocationDTO($request, $user->id);
        
        // Try to get weather data
        $result = $this->weatherService->getWeatherData(
            $locationDTO->city, 
            $locationDTO->state, 
            $locationDTO->units, 
            $user->id
        );

        // Check for errors from the weather service
        if (isset($result['error'])) {
            return response()->json([
                'error' => $result['error'],
            ], $result['status']);
        }
        // Create location
        $location = new Location((array) $locationDTO);
        $location->save();

        // Create forecasts
        foreach ($result['forecast'] as $date => $forecastData) {
            $forecastDTO = new ForecastDTO($location->id, $date, $forecastData);
            $forecast = new Forecast((array) $forecastDTO);
            $forecast->save();
        }

        return response()->json($location->load('forecasts'), 201);
    }
}
