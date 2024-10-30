<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationRequest;
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

        $location = new Location();
        $location->city = $request->input('city');
        $location->state = $request->input('state');
        $location->units = $request->input('units');
        $location->user_id = $user->id;
        $location->save();

        return response()->json($location, 201);
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $location = Location::find($id);

        if (!$location || $location->user_id != $user->id) {
            return response()->json(['error' => 'Location not Found'], 404);
        }

        // Todo: implement the delete policy later


        if (Gate::denies('delete-location', $user)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $location->delete();
        return response()->json(null, 204);
    }    
}