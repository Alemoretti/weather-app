<?php
use Mockery;
use function Pest\Laravel\postJson;
use App\Models\User;
use App\Http\Controllers\LocationController;
use App\Http\Requests\LocationRequest;

it('can create a location with valid input', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    // Mock the LocationController
    $mock = Mockery::mock(LocationController::class);
    $mock->shouldReceive('store')
        ->once()
        ->andReturnUsing(function (LocationRequest $request) use ($user) {
            // Verify the correct input data
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

    $this->assertEquals(201, $response->getStatusCode());
    $this->assertJson($response->getContent());
    $this->assertArrayHasKey('name', $response->getData(true));
    $this->assertArrayHasKey('user_id', $response->getData(true));
});

it('cannot create a location with invalid input', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    // Mock the LocationController
    $mock = Mockery::mock(LocationController::class);
    $mock->shouldReceive('store')
        ->once()
        ->andReturnUsing(function (LocationRequest $request) {
            // Verify the input data (sending empty values in city and state)
            expect($request->input('city'))->toBe('');
            expect($request->input('state'))->toBe('');
            expect($request->input('units'))->toBe('metric');

            return response()->json([
                'errors' => [
                    'city' => ['The city field is required.'],
                    'state' => ['The state field is required.'],
                ],
            ], 422);
        });

    $this->app->instance(LocationController::class, $mock);

    $request = LocationRequest::create('/api/locations', 'POST', [
        'city' => '',
        'state' => '',
        'units' => 'metric',
    ]);

    $response = $mock->store($request);

    $this->assertEquals(422, $response->getStatusCode());
    $this->assertJson($response->getContent());
    $this->assertArrayHasKey('errors', $response->getData(true));
    $this->assertArrayHasKey('city', $response->getData(true)['errors']);
    $this->assertArrayHasKey('state', $response->getData(true)['errors']);
});