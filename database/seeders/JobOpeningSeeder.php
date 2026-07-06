<?php

namespace Database\Seeders;

use App\Models\JobOpening;
use Illuminate\Database\Seeder;

class JobOpeningSeeder extends Seeder
{
    public function run(): void
    {
        $jobs = [
            ['title' => 'ENT Surgeon', 'department' => 'medical', 'location' => 'Delhi NCR', 'description' => 'We are looking for an experienced ENT Surgeon with excellent clinical skills and patient care dedication.'],
            ['title' => 'Audiologist', 'department' => 'audiology', 'location' => 'Noida', 'description' => 'Join our audiology team to help patients with hearing care and advanced diagnostic services.'],
            ['title' => 'Staff Nurse', 'department' => 'nursing', 'location' => 'Gurgaon', 'description' => 'We are seeking compassionate and skilled nurses to provide exceptional patient care.'],
            ['title' => 'Front Office Executive', 'department' => 'administration', 'location' => 'Faridabad', 'description' => 'Be the face of our centre and ensure a seamless experience for our patients.'],
        ];

        foreach ($jobs as $job) {
            JobOpening::create([...$job, 'type' => 'Full Time', 'is_active' => true]);
        }
    }
}
