<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocationFactory extends Factory
{
    protected $model = Location::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->city . ', ' . $this->faker->state,
        ];
    }
}