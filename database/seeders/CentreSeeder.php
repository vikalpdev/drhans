<?php

namespace Database\Seeders;

use App\Models\Centre;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CentreSeeder extends Seeder
{
    public function run(): void
    {
        $centres = [
            [
                'name' => 'Delhi (Greater Kailash)',
                'city' => 'Delhi',
                'address' => 'E-48, Greater Kailash Part - 1, New Delhi - 110048',
                'phone' => '+91 11 4162 1234',
                'lat' => 28.5494,
                'lng' => 77.2425,
                'facilities' => ['Consultation', 'Hearing Care', 'Endoscopy', 'Audiology'],
            ],
            [
                'name' => 'Gurgaon',
                'city' => 'Gurgaon',
                'address' => 'Unit No. 103, First Floor, Artemis Hospital, Sector 51, Gurgaon',
                'phone' => '+91 124 423 4567',
                'lat' => 28.4211,
                'lng' => 77.0453,
                'facilities' => ['Consultation', 'Hearing Care', 'Endoscopy', 'Audiology'],
            ],
            [
                'name' => 'Noida',
                'city' => 'Noida',
                'address' => 'A-112, Sector 44, Near Clifton Hospital, Noida - 201303',
                'phone' => '+91 120 456 7890',
                'lat' => 28.5723,
                'lng' => 77.3910,
                'facilities' => ['Consultation', 'Hearing Care', 'Endoscopy', 'Audiology'],
            ],
            [
                'name' => 'Faridabad',
                'city' => 'Faridabad',
                'address' => 'SCF-31, First Floor, Sector 16A, Faridabad - 121002',
                'phone' => '+91 129 412 3456',
                'lat' => 28.4089,
                'lng' => 77.3178,
                'facilities' => ['Consultation', 'Hearing Care', 'Endoscopy', 'Audiology'],
            ],
            [
                'name' => 'Ghaziabad',
                'city' => 'Ghaziabad',
                'address' => 'C-45, Nehru Nagar, Sector 3, Ghaziabad - 201001',
                'phone' => '+91 120 789 1234',
                'lat' => 28.6692,
                'lng' => 77.4538,
                'facilities' => ['Consultation', 'Hearing Care', 'Endoscopy', 'Audiology'],
            ],
            [
                'name' => 'Lucknow',
                'city' => 'Lucknow',
                'address' => 'F-12, Vipin Khand, Gomti Nagar, Lucknow - 226010',
                'phone' => '+91 522 456 7890',
                'lat' => 26.8467,
                'lng' => 80.9462,
                'facilities' => ['Consultation', 'Hearing Care', 'Endoscopy', 'Audiology'],
            ],
        ];

        foreach ($centres as $index => $centre) {
            Centre::create([
                ...$centre,
                'slug' => Str::slug($centre['name']),
                'order' => $index,
            ]);
        }
    }
}
