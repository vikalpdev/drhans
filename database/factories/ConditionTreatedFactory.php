<?php

namespace Database\Factories;

use App\Models\ConditionTreated;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ConditionTreated>
 */
class ConditionTreatedFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->unique()->words(2, true);

        return [
            'name' => ucfirst($name),
            'slug' => \Illuminate\Support\Str::slug($name),
            'category' => fake()->randomElement(array_keys(ConditionTreated::CATEGORIES)),
            'summary' => fake()->sentence(),
        ];
    }
}
