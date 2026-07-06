<?php

namespace Database\Seeders;

use App\Models\TestimonialVideo;
use Illuminate\Database\Seeder;

class TestimonialVideoSeeder extends Seeder
{
    public function run(): void
    {
        $videos = [
            ['patient_name' => "Rekha's Journey", 'title' => 'Cochlear Implant Success', 'video_url' => 'https://www.youtube.com/watch?v=placeholder-cochlear'],
            ['patient_name' => "Rajiv's Recovery", 'title' => 'Vertigo Treatment', 'video_url' => 'https://www.youtube.com/watch?v=placeholder-vertigo'],
            ['patient_name' => "Aarav's New Beginning", 'title' => 'Pediatric Hearing Care', 'video_url' => 'https://www.youtube.com/watch?v=placeholder-pediatric'],
            ['patient_name' => "Sunita's Story", 'title' => 'Hearing Aid Fitting Experience', 'video_url' => 'https://www.youtube.com/watch?v=placeholder-hearing-aid'],
            ['patient_name' => "Mohan's Relief", 'title' => 'Sinus Surgery Recovery', 'video_url' => 'https://www.youtube.com/watch?v=placeholder-sinus'],
            ['patient_name' => 'Centre Tour', 'title' => 'Inside Our Delhi Centre', 'video_url' => 'https://www.youtube.com/watch?v=placeholder-tour'],
        ];

        foreach ($videos as $index => $video) {
            TestimonialVideo::create([...$video, 'order' => $index]);
        }
    }
}
