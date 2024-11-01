<?php

namespace App\DTOs;

use Illuminate\Contracts\Support\Arrayable;

class ForecastDTO
{
    public int $location_id;
    public string $date;
    public string $min_temp;
    public string $max_temp;
    public string $weather;
    public string $weather_icon;

    public function __construct(int $location_id, string $date, array $forecastData)
    {
        $this->location_id = $location_id;
        $this->date = $date;
        $this->min_temp = $forecastData['min_temp'] ?? '';
        $this->max_temp = $forecastData['max_temp'] ?? '';
        $this->weather = $forecastData['weather'] ?? '';
        $this->weather_icon = $forecastData['weather_icon'] ?? '';
    }
}