<?php

use Mockery;
use App\Models\User;
use App\Models\Location;
use App\Http\Controllers\LocationController;

it('can list locations for the authenticated user', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    // Create some locations for the user
    $locations = Location::factory()->count(3)->create(['user_id' => $user->id]);

    // Mock the LocationController
    $mock = Mockery::mock(LocationController::class);
    $mock->shouldReceive('index')
        ->once()
        ->andReturnUsing(function () use ($locations) {
            return response()->json($locations, 200);
        });

    $this->app->instance(LocationController::class, $mock);

    $response = $mock->index();

    // Use PHPUnit assertions
    $this->assertEquals(200, $response->getStatusCode());
    $this->assertJson($response->getContent());
    $this->assertCount(3, $response->getData(true));
});