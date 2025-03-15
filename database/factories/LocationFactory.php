<?php

namespace Database\Factories;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocationFactory extends Factory
{
    protected $model = Location::class;

    public function definition()
    {
        return [
            'name' => $this->faker->city, // Use a random city name for the location
            'latitude' => $this->faker->latitude, // Random latitude
            'longitude' => $this->faker->longitude, // Random longitude
            'color' => $this->faker->hexColor, // Random hexadecimal color
        ];
    }
}
