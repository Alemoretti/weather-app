<?php

namespace App\Services;

use App\Models\Location;
use App\Models\Forecast;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\LocationRequest;
use App\DTOs\LocationDTO;
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

        $locationData = new LocationDTO($request);
        $result = $this->weatherService->getWeatherData(
            $locationData->city, 
            $locationData->state, 
            $locationData->units, 
            $user->id
        );

        if (isset($result['error'])) {
            return response()->json([
                'error' => $result['error'],
            ], $result['status']);
        }

        $location = new Location();
        $location->name = $locationData->name;
        $location->user_id = $user->id;
        $location->save();

        foreach ($result['forecast'] as $date => $forecastData) {
            $forecast = new Forecast();
            $forecast->location_id = $location->id;
            $forecast->date = $date;
            $forecast->min_temp = $forecastData['min_temp'];
            $forecast->max_temp = $forecastData['max_temp'];
            $forecast->weather = $forecastData['weather'];
            $forecast->weather_icon = $forecastData['weather_icon'];
            $forecast->save();
        }

        return response()->json($location->load('forecasts'), 201);
    }
}