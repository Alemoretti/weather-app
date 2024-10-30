<?php

use App\Http\Controllers\WeatherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

Route::middleware('auth:sanctum',)->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::put('/locations/create', [WeatherController::class, 'addLocationForecast']);
});