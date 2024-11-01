<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationRequest;
use App\Models\Location;
use App\Services\LocationService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class LocationController extends Controller
{
    protected $locationService;

    public function __construct(LocationService $locationService)
    {
        $this->locationService = $locationService;
    }

    public function index()
    {
        $user = Auth::user();
        $locations = Location::with('forecasts')->where('user_id', $user->id)->get();
        return response()->json($locations);
    }

    public function store(LocationRequest $request)
    {
        return $this->locationService->storeLocation($request);
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