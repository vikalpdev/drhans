<?php

namespace Database\Factories;

use App\Models\Specialist;
use App\Models\SpecialistType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Specialist>
 */
class SpecialistFactory extends Factory
{
    public function definition(): array
    {
        $name = 'Dr. ' . fake()->unique()->lastName();

        return [
            'name' => $name,
            'slug' => \Illuminate\Support\Str::slug($name),
            'type_id' => SpecialistType::where('slug', 'ent-surgeon')->value('id'),
            'designation' => 'ENT Surgeon',
            'qualifications' => 'MS (ENT)',
            'experience_years' => fake()->numberBetween(5, 30),
        ];
    }
}
