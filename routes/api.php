<?php

use App\Http\Controllers\LocationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

Route::middleware('auth:sanctum',)->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::resource('locations', LocationController::class)->only([
        'index', 'store', 'destroy'
    ]);
});