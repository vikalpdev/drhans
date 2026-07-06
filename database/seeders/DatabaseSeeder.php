<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CentreSeeder::class,
            SpecialistSeeder::class,
            TreatmentSeeder::class,
            ConditionTreatedSeeder::class,
            JobOpeningSeeder::class,
            GalleryItemSeeder::class,
            TestimonialVideoSeeder::class,
        ]);
    }
}
