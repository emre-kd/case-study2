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



    /** @test */
    public function it_can_get_route_between_two_locations()
    {
        $location1 = Location::factory()->create();
        $location2 = Location::factory()->create();

        $response = $this->getJson(route('route.between.locations', [$location1->id, $location2->id]));

        $response->assertStatus(200);
        $response->assertJson([
            'from' => [
                'id' => $location1->id,
                'name' => $location1->name,
                'latitude' => $location1->latitude,
                'longitude' => $location1->longitude
            ],
            'to' => [
                'id' => $location2->id,
                'name' => $location2->name,
                'latitude' => $location2->latitude,
                'longitude' => $location2->longitude
            ],
            'distance_km' => $this->haversineDistance($location1->latitude, $location1->longitude, $location2->latitude, $location2->longitude),
        ]);
    }

    private function haversineDistance($lat1, $lng1, $lat2, $lng2)
    {
        $earthRadius = 6371;

        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLng / 2) * sin($dLng / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }
}
