<?php
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use function Pest\Laravel\postJson;
use Mockery;
use App\Models\User;

uses(RefreshDatabase::class, WithFaker::class)->beforeEach(function () {
    // Mock the weather service
    $mock = Mockery::mock('overload:App\Services\WeatherService');
    $mock->shouldReceive('getWeatherData')
        ->andReturn([
            'city' => 'Test City',
            'state' => 'Test State',
            'forecast' => [
                '2024-10-30' => [
                    'min_temp' => '10°C',
                    'max_temp' => '20°C',
                    'weather' => 'Sunny',
                    'weather_icon' => 'sunny.png',
                ],
            ],
        ]);
})->in('Feature');

it('can create a location with valid input', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = postJson('/api/locations', [
        'city' => 'Test City',
        'state' => 'Test State',
        'units' => 'metric',
    ]);

    $response->assertStatus(201)
        ->assertJson([
            'name' => 'Test City, Test State',
            'user_id' => $user->id,
        ]);
});

it('cannot create a location with invalid input', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = postJson('/api/locations', [
        'city' => '',
        'state' => '',
        'units' => 'metric',
    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['city', 'state']);
});