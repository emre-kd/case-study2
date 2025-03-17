<?php

namespace Tests\Feature;

use App\Models\Location;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LocationControllerTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function it_can_create_a_new_location()
    {
        $locationData = [
            'name' => 'Test Location',
            'latitude' => 40.7128,
            'longitude' => -74.0060,
            'color' => '#FF5733',
        ];

        $response = $this->postJson(route('locations.store'), $locationData);

        $response->assertStatus(201);
        $response->assertJson([
            'message' => 'Location successfully created!',
            'data' => $locationData,
        ]);

        $this->assertDatabaseHas('locations', $locationData);
    }



}
