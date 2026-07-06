<?php

namespace Database\Seeders;

use App\Models\Treatment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TreatmentSeeder extends Seeder
{
    public function run(): void
    {
        $treatments = [
            [
                'name' => 'Hearing Care',
                'icon' => 'ear',
                'summary' => 'Comprehensive hearing evaluation, hearing aids, audiology services and hearing rehabilitation.',
            ],
            [
                'name' => 'Cochlear Implant',
                'icon' => 'ear-implant',
                'summary' => 'Advanced cochlear implant solutions for children and adults to restore the joy of hearing.',
                'overview' => 'Advanced cochlear implant solutions for all age groups. Our expert team combines surgical excellence with comprehensive rehabilitation for life-changing outcomes.',
                'process_steps' => [
                    ['title' => 'Hearing Evaluation', 'description' => 'Detailed assessment & diagnostics to determine suitability.'],
                    ['title' => 'Counselling & Planning', 'description' => 'Personalized guidance and implant selection for best outcomes.'],
                    ['title' => 'Surgery', 'description' => 'Minimally invasive implant surgery using advanced techniques.'],
                    ['title' => 'Activation', 'description' => 'Device programming and activation for optimal hearing.'],
                    ['title' => 'Rehabilitation', 'description' => 'Speech & listening therapy for language development.'],
                    ['title' => 'Long-term Follow-up', 'description' => 'Continuous care and support for lifelong hearing wellness.'],
                ],
                'who_benefits' => ['Severe to Profound Hearing Loss in Children', 'Severe to Profound Hearing Loss in Adults', 'Sudden Hearing Loss (As advised by specialist)', 'Hearing loss not helped by hearing aids'],
                'why_choose_us' => ['Pioneer in Cochlear Implant Surgery', 'World-class Infrastructure', 'Multidisciplinary Expert Team', 'Personalized Care', 'Proven Outcomes'],
            ],
            [
                'name' => 'Vertigo & Balance Disorders',
                'icon' => 'vertigo',
                'summary' => 'Diagnosis and treatment of dizziness, vertigo and balance disorders with advanced care.',
            ],
            [
                'name' => 'Nasal & Sinus Care',
                'icon' => 'wind',
                'summary' => 'Endoscopic sinus surgery, allergy care, nasal polyps and chronic sinusitis treatment.',
            ],
            [
                'name' => 'Voice & Swallow Disorders',
                'icon' => 'voice',
                'summary' => 'Expert care for voice disorders, throat problems and swallowing difficulties.',
            ],
            [
                'name' => 'Pediatric ENT',
                'icon' => 'pediatric',
                'summary' => 'Specialised ENT care for children including ear infections, tonsils, adenoids and more.',
            ],
            [
                'name' => 'Sleep Apnea Treatment',
                'icon' => 'sleep',
                'summary' => 'Diagnosis and advanced treatment options for snoring and sleep apnea.',
            ],
            [
                'name' => 'Diagnostic Services',
                'icon' => 'diagnostic',
                'summary' => 'State-of-the-art diagnostics including endoscopy, audiometry, CT scan and more.',
            ],
        ];

        $content = include __DIR__ . '/data/treatment_content.php';

        foreach ($treatments as $index => $treatment) {
            $slug = Str::slug($treatment['name']);

            Treatment::create([
                ...$treatment,
                ...($content[$slug] ?? []),
                'slug' => $slug,
                'order' => $index,
            ]);
        }
    }
}
