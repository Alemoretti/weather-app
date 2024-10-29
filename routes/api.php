<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/weather/add', function (Request $request) {
    $city = $request->input('city');
    $state = $request->input('state');
    $apiUrl = env('WEATHER_API_URL');
    
    $response = Http::get($apiUrl, [
        'q' => $city . ',' . $state,
        'units' => $request->input('units'),
        'APPID' => env('WEATHER_API_KEY'), 
    ]);
    
    if ($response->successful()) {
        $weatherData = $response->json();
        $forecast = [];
        $currentDate = null;
        $dayCount = 0;

        foreach ($weatherData['list'] as $entry) {
            $date = substr($entry['dt_txt'], 0, 10);
            $tempKelvin = $entry['main']['temp'];
            if ($currentDate !== $date) {
                $currentDate = $date;
                $dayCount++;
            }

            if ($dayCount > 3) {
                break;
            }

            if (!isset($forecast[$currentDate])) {
                $forecast[$currentDate] = [
                    'min_temp' => $tempKelvin,
                    'max_temp' => $tempKelvin,
                    'weather' => $entry['weather'][0]['main'],
                    'weather_icon' => env('WEATHER_API_ICONS_URL') . $entry['weather'][0]['icon'] . '.png'
                ];
            }

            if ($tempKelvin < $forecast[$currentDate]['min_temp']) {
                $forecast[$currentDate]['min_temp'] = $tempKelvin;
            }

            if ($tempKelvin > $forecast[$currentDate]['max_temp']) {
                $forecast[$currentDate]['max_temp'] = $tempKelvin;
            }
        }        

        foreach ($forecast as $date => $data) {
            $forecast[$date]['min_temp'] = round($data['min_temp']) . '°C';
            $forecast[$date]['max_temp'] = round($data['max_temp']) . '°C';
        }

        return response()->json([
            'city' => $city,
            'state' => $state,
            'forecast' => $forecast,
        ]);
    } else {
        return response()->json([
            'error' => $response->reason(),
        ], $response->status());
    }
});