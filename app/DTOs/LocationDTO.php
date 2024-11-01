<?php

namespace App\DTOs;

use App\Http\Requests\LocationRequest;

class LocationDTO
{
    public string $city;
    public string $state;
    public string $units;
    public string $name;

    public function __construct(LocationRequest $request)
    {
        $this->city = $request->input('city') ?? '';
        $this->state = $request->input('state') ?? '';
        $this->units = $request->input('units') ?? 'metric';
        $this->name = trim($this->city . ($this->city && $this->state ? ', ' : '') . $this->state);
    }
}