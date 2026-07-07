<?php

namespace Database\Seeders;

use App\Models\ConditionTreated;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ConditionTreatedSeeder extends Seeder
{
    public function run(): void
    {
        $conditions = [
            // Ear (Otology)
            [
                'name' => 'Hearing Loss',
                'category' => 'ear',
                'icon' => 'ear-implant',
                'summary' => 'Accurate diagnosis and personalised treatment options to help you hear better and live better.',
                'overview' => 'Hearing loss is the partial or total inability to hear. It may be temporary or permanent and can occur in one or both ears. It can be caused by ageing, exposure to loud noise, infections, genetics or certain medical conditions.',
                'symptoms' => ['Difficulty hearing people while talking', 'Ringing or buzzing in the ears (tinnitus)', 'Asking others to repeat frequently', 'Turning up the volume higher than usual', 'Difficulty hearing in noisy places'],
                'causes' => ['Ageing (presbycusis)', 'Exposure to loud noise', 'Ear infections or fluid', 'Earwax blockage', 'Head injury', 'Genetic factors', 'Certain medications and medical conditions'],
                'treatment_options' => ['Medications for infections or underlying conditions', 'Earwax removal and minor procedures', 'Hearing aids and assistive devices', 'Cochlear implant for severe hearing loss', 'Auditory rehabilitation and speech therapy'],
                'when_to_see_doctor' => ['Sudden hearing loss', 'Persistent ear pain or discharge', "Tinnitus that doesn't go away", 'Difficulty hearing in daily conversations'],
            ],
            [
                'name' => 'Ear Infection',
                'category' => 'ear',
                'icon' => 'ear',
                'summary' => 'Diagnosis and treatment for acute and chronic ear infections in children and adults.',
            ],
            [
                'name' => 'Ear Pain',
                'category' => 'ear',
                'icon' => 'ear',
                'summary' => 'Evaluation and relief for ear pain caused by infection, pressure changes or other conditions.',
            ],
            [
                'name' => 'Ear Wax',
                'category' => 'ear',
                'icon' => 'ear',
                'summary' => 'Safe, in-clinic earwax removal and management of blockage or impaction.',
            ],
            [
                'name' => 'Otosclerosis',
                'category' => 'ear',
                'icon' => 'ear',
                'summary' => 'Diagnosis and surgical treatment for otosclerosis-related hearing loss.',
            ],

            // Nose & Sinus
            [
                'name' => 'Sinusitis',
                'category' => 'nose_sinus',
                'icon' => 'nose',
                'summary' => 'Diagnosis and treatment for acute and chronic sinus infections.',
            ],
            [
                'name' => 'DNS',
                'category' => 'nose_sinus',
                'icon' => 'nose',
                'summary' => 'Evaluation and surgical correction for a deviated nasal septum (DNS).',
            ],
            [
                'name' => 'Nasal Polyps',
                'category' => 'nose_sinus',
                'icon' => 'nose',
                'summary' => 'Medical and surgical management of nasal polyps affecting breathing and smell.',
            ],
            [
                'name' => 'Allergic Rhinitis',
                'category' => 'nose_sinus',
                'icon' => 'wind',
                'summary' => 'Diagnosis and management of nasal allergies, sneezing and congestion.',
            ],

            // Voice & Throat
            [
                'name' => 'Tonsillitis',
                'category' => 'throat',
                'icon' => 'voice',
                'summary' => 'Diagnosis and treatment for tonsil infections, including tonsillectomy when needed.',
            ],
            [
                'name' => 'Hoarseness',
                'category' => 'throat',
                'icon' => 'voice',
                'summary' => 'Evaluation and treatment for persistent hoarseness and voice changes.',
            ],
            [
                'name' => 'Laryngitis',
                'category' => 'throat',
                'icon' => 'voice',
                'summary' => 'Diagnosis and treatment for laryngitis and other voice box infections.',
            ],
            [
                'name' => 'Sleep Apnoea',
                'category' => 'throat',
                'icon' => 'sleep',
                'summary' => 'Diagnosis and advanced treatment options for snoring and obstructive sleep apnoea.',
                'overview' => 'Sleep-related ENT conditions occur when the airway is partially or fully blocked during sleep, leading to disrupted breathing, snoring and poor sleep quality. Left untreated, they can affect long-term health and daily energy levels.',
                'symptoms' => ['Loud, chronic snoring', 'Pauses in breathing during sleep', 'Waking up gasping or choking', 'Excessive daytime tiredness', 'Morning headaches or dry mouth'],
                'causes' => ['Obstructive sleep apnoea', 'Enlarged tonsils or adenoids', 'Deviated nasal septum or nasal blockage', 'Excess tissue in the throat', 'Obesity affecting the airway', 'Jaw or airway structural differences', 'Nasal congestion from allergies'],
                'treatment_options' => ['Sleep study and diagnostic evaluation', 'CPAP therapy for sleep apnoea', 'Surgical correction of nasal or airway blockages', 'Tonsillectomy or adenoidectomy where indicated', 'Lifestyle and positional therapy guidance'],
                'when_to_see_doctor' => ['Loud snoring with breathing pauses', 'Excessive daytime sleepiness', 'Waking up gasping for air', "Snoring affecting a partner's or family's sleep"],
            ],

            // Standalone categories
            [
                'name' => 'Vertigo & Balance',
                'category' => 'vertigo_balance',
                'icon' => 'vertigo',
                'summary' => 'Diagnosis and treatment of dizziness, vertigo and balance disorders with advanced care.',
            ],
            [
                'name' => 'Tinnitus',
                'category' => 'tinnitus',
                'icon' => 'ear',
                'summary' => 'Evaluation and management of tinnitus (ringing or buzzing in the ears).',
            ],
            [
                'name' => 'Paediatric ENT',
                'category' => 'pediatric',
                'icon' => 'pediatric',
                'summary' => 'Ear infections, adenoids, tonsils, speech delay and congenital conditions.',
                'overview' => 'Children are especially prone to ear, nose and throat conditions due to their developing airways and immune systems. Our pediatric ENT care focuses on gentle, age-appropriate diagnosis and treatment for young patients.',
                'symptoms' => ['Frequent ear infections', 'Snoring or mouth breathing', 'Enlarged tonsils or adenoids', 'Delayed speech or frequent colds', 'Difficulty feeding or swallowing in infants'],
                'causes' => ['Narrow or underdeveloped airways', 'Recurrent colds and infections', 'Allergies affecting ears, nose or throat', 'Enlarged tonsils and adenoids', 'Fluid build-up behind the eardrum', 'Family history of ENT conditions', 'Exposure to secondhand smoke or irritants'],
                'treatment_options' => ['Age-appropriate ear infection treatment', 'Grommet insertion for persistent fluid build-up', 'Tonsillectomy or adenoidectomy when necessary', 'Hearing and speech evaluation', 'Ongoing growth and development monitoring'],
                'when_to_see_doctor' => ['Frequent, recurring ear infections', 'Loud snoring or pauses in breathing during sleep', 'Delayed speech development', 'Persistent nasal blockage or mouth breathing'],
            ],
            [
                'name' => 'Speech Disorders',
                'category' => 'speech_disorders',
                'icon' => 'voice',
                'summary' => 'Speech and language therapy for children and adults with speech and communication difficulties.',
            ],
            [
                'name' => 'Head & Neck',
                'category' => 'head_neck',
                'icon' => 'user',
                'summary' => 'Thyroid, salivary gland disorders, neck lumps and more.',
                'overview' => 'Head and neck conditions involve structures such as the salivary glands, thyroid, lymph nodes and neck tissues connected to the ENT system. Early evaluation is important, as symptoms can sometimes indicate more serious underlying conditions.',
                'symptoms' => ['A lump or swelling in the neck', 'Persistent neck pain or stiffness', 'Swelling of the salivary glands', 'Unexplained voice or swallowing changes', 'Enlarged lymph nodes'],
                'causes' => ['Infections of the lymph nodes or glands', 'Salivary gland stones or blockages', 'Thyroid gland enlargement', 'Cysts or benign growths', 'Injury or trauma to the neck', 'Chronic inflammation', 'Growths requiring further evaluation'],
                'treatment_options' => ['Diagnostic imaging and biopsy where needed', 'Medication for infections or inflammation', 'Minimally invasive gland or cyst removal', 'Coordinated care with specialists as required', 'Regular monitoring for benign conditions'],
                'when_to_see_doctor' => ["A lump that doesn't resolve within a few weeks", 'Rapid swelling in the neck', 'Unexplained weight loss with neck symptoms', 'Persistent hoarseness or difficulty swallowing'],
            ],
        ];

        foreach ($conditions as $index => $condition) {
            ConditionTreated::create([
                ...$condition,
                'slug' => Str::slug($condition['name']),
                'order' => $index,
            ]);
        }
    }
}
