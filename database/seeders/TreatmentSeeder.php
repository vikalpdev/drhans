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
                'name' => 'Cochlear & Hearing Implant Centre',
                'icon' => 'ear-implant',
                'meta_title' => "Cochlear & Hearing Implant Centre in Delhi",
                'meta_description' => "Explore advanced cochlear implant surgery, hearing implant solutions, hearing evaluation, rehabilitation, and speech therapy at Dr Hans' Centre for ENT in Delhi.",
                'summary' => 'Advanced cochlear implant surgery, hearing implants, bone conduction devices, hearing evaluation and speech therapy for children and adults.',
                'overview' => "Comprehensive hearing implant care for children and adults, from detailed hearing assessments to advanced implant procedures, rehabilitation and speech therapy.",
                'process_steps' => [
                    ['title' => 'Hearing Evaluation', 'description' => 'Detailed assessment & diagnostics to determine suitability.'],
                    ['title' => 'Counselling & Planning', 'description' => 'Personalized guidance and implant selection for best outcomes.'],
                    ['title' => 'Surgery', 'description' => 'Minimally invasive implant surgery using advanced techniques.'],
                    ['title' => 'Activation', 'description' => 'Device programming and activation for optimal hearing.'],
                    ['title' => 'Rehabilitation', 'description' => 'Speech & listening therapy for language development.'],
                    ['title' => 'Long-term Follow-up', 'description' => 'Continuous care and support for lifelong hearing wellness.'],
                ],
                'who_benefits' => ['Severe to Profound Hearing Loss in Children', 'Severe to Profound Hearing Loss in Adults', 'Conductive, Mixed or Single-Sided Hearing Loss', 'Hearing Loss Not Helped by Conventional Hearing Aids'],
                'why_choose_us' => ['Experienced ENT Specialists & Audiologists', 'Personalized, Evidence-Based Treatment Plans', 'Advanced Diagnostic Facilities Under One Roof', 'Complete Care From Assessment to Rehabilitation'],
            ],
            [
                'name' => 'Hearing Loss Centre',
                'icon' => 'ear',
                'summary' => 'Comprehensive hearing evaluation, hearing aids, audiology services and hearing rehabilitation.',
            ],
            [
                'name' => 'Allergy Diagnosis & Immunotherapy',
                'icon' => 'shield',
                'summary' => 'Comprehensive allergy testing, diagnosis and immunotherapy for long-term relief from allergic ENT conditions.',
            ],
            [
                'name' => 'Nose & Sinus Centre',
                'icon' => 'wind',
                'summary' => 'Endoscopic sinus surgery, allergy care, nasal polyps and chronic sinusitis treatment.',
            ],
            [
                'name' => 'Ear Surgery Centre',
                'icon' => 'ear',
                'summary' => 'Advanced surgical treatment for ear infections, eardrum perforations, mastoid disease and related ear conditions.',
            ],
            [
                'name' => 'Throat & Voice Centre',
                'icon' => 'voice',
                'summary' => 'Expert care for voice disorders, throat problems and swallowing difficulties.',
            ],
            [
                'name' => 'Vertigo & Balance Centre',
                'icon' => 'vertigo',
                'summary' => 'Diagnosis and treatment of dizziness, vertigo and balance disorders with advanced care.',
            ],
            [
                'name' => 'Tinnitus Clinic',
                'icon' => 'ear',
                'summary' => 'Specialised evaluation and management for tinnitus (ringing in the ears) and related hearing concerns.',
            ],
            [
                'name' => 'Paediatric ENT Centre',
                'icon' => 'pediatric',
                'summary' => 'Specialised ENT care for children including ear infections, tonsils, adenoids and more.',
            ],
            [
                'name' => 'Advanced Diagnostics & Technology',
                'icon' => 'diagnostic',
                'summary' => 'State-of-the-art diagnostics including endoscopy, audiometry, CT scan and more.',
            ],
            [
                'name' => 'Hyperbaric Oxygen Therapy (HBOT)',
                'icon' => 'cog',
                'summary' => 'Advanced hyperbaric oxygen therapy to support healing and recovery for select ENT and hearing conditions.',
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
