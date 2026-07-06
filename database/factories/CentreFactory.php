<?php

namespace Database\Factories;

use App\Models\Centre;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Centre>
 */
class CentreFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->unique()->city();

        return [
            'name' => $name,
            'slug' => \Illuminate\Support\Str::slug($name),
            'city' => $name,
            'address' => fake()->address(),
            'phone' => fake()->phoneNumber(),
        ];
    }
}
