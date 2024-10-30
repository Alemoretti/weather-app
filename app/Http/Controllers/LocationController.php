<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationRequest;
use App\Models\Forecast;
use App\Models\Location;
use App\Services\WeatherService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class LocationController extends Controller
{
    protected $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function index()
    {
        $user = Auth::user();
        $locations = Location::where('user_id', $user->id)->get();
        return response()->json($locations);
    }

    public function store(LocationRequest $request)
    {
        $user = Auth::user();

        if (Gate::denies('store-location', $user)) {
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

        $name = trim($city . ($city && $state ? ', ' : '') . $state);

        $location = new Location();
        $location->name = $name;
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

    public function destroy($id)
    {
        $user = Auth::user();
        $location = Location::find($id);

        if (!$location || $location->user_id != $user->id) {
            return response()->json(['error' => 'Location not Found'], 404);
        }

        if (Gate::denies('delete-location', $location)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $location->delete();
        return response()->json(null, 204);
    }    
}