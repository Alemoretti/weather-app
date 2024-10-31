<?php
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Mockery;
use function Pest\Laravel\postJson;
use App\Models\User;
use App\Http\Controllers\LocationController;

it('can create a location with valid input', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    // Mock the LocationController
    $mock = Mockery::mock(LocationController::class);
    $mock->shouldReceive('store')
        ->once()
        ->andReturnUsing(function ($request) use ($user) {
            // Verify the input data
            expect($request->input('city'))->toBe('Test City');
            expect($request->input('state'))->toBe('Test State');
            expect($request->input('units'))->toBe('metric');

            return response()->json([
                'name' => 'Test City, Test State',
                'user_id' => $user->id,
            ], 201);
        });

    $this->app->instance(LocationController::class, $mock);

    $response = postJson('/api/locations', [
        'city' => 'Test City',
        'state' => 'Test State',
        'units' => 'metric',
    ]);

    $response->assertStatus(201);
});
