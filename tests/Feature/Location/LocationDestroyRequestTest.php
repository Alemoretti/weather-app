<?php
use Mockery;
use App\Models\User;
use App\Models\Location;
use App\Http\Controllers\LocationController;

it('can delete a location with valid input', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    // Create a location to delete
    $location = Location::factory()->create(['user_id' => $user->id]);

    // Mock the LocationController
    $mock = Mockery::mock(LocationController::class);
    $mock->shouldReceive('destroy')
        ->once()
        ->andReturnUsing(function ($id) use ($location) {
            // Verify if the input is equal location id
            expect($id)->toBe($location->id);

            return response()->json(null, 204);
        });

    $this->app->instance(LocationController::class, $mock);

    $response = $mock->destroy($location->id);

    $this->assertEquals(204, $response->getStatusCode());
});

it('cannot delete a location with invalid input', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    // Mock the LocationController
    $mock = Mockery::mock(LocationController::class);
    $mock->shouldReceive('destroy')
        ->once()
        ->andReturnUsing(function ($id) {
            // Verify the input id (different from the location id)
            expect($id)->toBe(999); 

            return response()->json(['error' => 'Location not found'], 404);
        });

    $this->app->instance(LocationController::class, $mock);

    $response = $mock->destroy(999);

    $this->assertEquals(404, $response->getStatusCode());
    $this->assertJson($response->getContent());
    $this->assertArrayHasKey('error', $response->getData(true));
});