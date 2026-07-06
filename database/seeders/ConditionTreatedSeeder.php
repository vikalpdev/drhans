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
            [
                'name' => 'Ear Conditions',
                'category' => 'ear',
                'icon' => 'ear',
                'summary' => 'Infections, pain, discharge, earwax, perforation, tinnitus and more.',
                'overview' => 'Ear conditions cover a wide range of issues affecting the outer, middle or inner ear, from infections and wax build-up to structural problems. Left untreated, many ear conditions can affect hearing and balance, making early diagnosis and treatment important.',
                'symptoms' => ['Ear pain or discomfort', 'Fluid or discharge from the ear', 'A feeling of fullness or blockage', 'Reduced or muffled hearing', 'Itching inside the ear canal'],
                'causes' => ['Bacterial or viral infections', 'Excessive earwax build-up', 'Water trapped in the ear canal', 'Allergies affecting the middle ear', 'Perforated or damaged eardrum', 'Foreign objects in the ear', 'Changes in air pressure'],
                'treatment_options' => ['Antibiotic or antifungal ear drops', 'Safe, in-clinic earwax removal', 'Treatment for underlying infections', 'Eardrum repair procedures where needed', 'Guidance on ear care and prevention'],
                'when_to_see_doctor' => ['Severe or worsening ear pain', 'Discharge or bleeding from the ear', 'Sudden change in hearing', 'Fever along with ear symptoms'],
            ],
            [
                'name' => 'Hearing Loss',
                'category' => 'hearing_balance',
                'icon' => 'ear-implant',
                'summary' => 'Accurate diagnosis and personalised treatment options to help you hear better and live better.',
                'overview' => 'Hearing loss is the partial or total inability to hear. It may be temporary or permanent and can occur in one or both ears. It can be caused by ageing, exposure to loud noise, infections, genetics or certain medical conditions.',
                'symptoms' => ['Difficulty hearing people while talking', 'Ringing or buzzing in the ears (tinnitus)', 'Asking others to repeat frequently', 'Turning up the volume higher than usual', 'Difficulty hearing in noisy places'],
                'causes' => ['Ageing (presbycusis)', 'Exposure to loud noise', 'Ear infections or fluid', 'Earwax blockage', 'Head injury', 'Genetic factors', 'Certain medications and medical conditions'],
                'treatment_options' => ['Medications for infections or underlying conditions', 'Earwax removal and minor procedures', 'Hearing aids and assistive devices', 'Cochlear implant for severe hearing loss', 'Auditory rehabilitation and speech therapy'],
                'when_to_see_doctor' => ['Sudden hearing loss', 'Persistent ear pain or discharge', "Tinnitus that doesn't go away", 'Difficulty hearing in daily conversations'],
            ],
            [
                'name' => 'Nose & Sinus Conditions',
                'category' => 'nose_sinus',
                'icon' => 'nose',
                'summary' => 'Sinusitis, nasal blockage, deviated septum, polyps, allergies and more.',
                'overview' => 'Nose and sinus conditions affect the nasal passages and the air-filled cavities around them, often leading to blocked breathing, congestion and recurring infections. They range from allergies and sinusitis to structural issues like a deviated septum.',
                'symptoms' => ['Blocked or stuffy nose', 'Facial pain or pressure around the eyes and cheeks', 'Thick nasal discharge', 'Reduced sense of smell', 'Frequent sneezing or a runny nose'],
                'causes' => ['Chronic or acute sinusitis', 'Seasonal or year-round allergies', 'Deviated nasal septum', 'Nasal polyps', 'Common cold or viral infections', 'Exposure to dust, smoke or pollutants', 'Structural narrowing of the nasal passage'],
                'treatment_options' => ['Nasal sprays and decongestants', 'Allergy management and immunotherapy', 'Endoscopic sinus surgery for chronic cases', 'Septoplasty for a deviated septum', 'Balloon sinuplasty for recurring sinusitis'],
                'when_to_see_doctor' => ['Sinus symptoms lasting more than 10 days', 'Severe facial pain or swelling', 'Nasal blockage on one side only', 'Frequent nosebleeds'],
            ],
            [
                'name' => 'Throat Conditions',
                'category' => 'throat',
                'icon' => 'voice',
                'summary' => 'Sore throat, tonsillitis, voice problems, swallowing difficulties and more.',
                'overview' => 'Throat conditions affect the voice box, vocal cords and swallowing passage, and can range from minor infections to chronic voice and swallowing disorders. Timely evaluation helps protect the voice and prevent complications.',
                'symptoms' => ['Sore or scratchy throat', 'Hoarseness or voice changes', 'Difficulty or pain while swallowing', 'A persistent lump-in-throat sensation', 'Frequent throat clearing'],
                'causes' => ['Viral or bacterial throat infections', 'Tonsillitis or adenoiditis', 'Acid reflux (GERD)', 'Vocal cord strain or nodules', 'Excessive smoking or voice overuse', 'Allergies affecting the throat', 'Chronic postnasal drip'],
                'treatment_options' => ['Medication for infections or reflux', 'Voice therapy and vocal rest', 'Tonsillectomy or adenoidectomy when needed', 'Laryngoscopic evaluation and treatment', 'Lifestyle and dietary guidance'],
                'when_to_see_doctor' => ['Hoarseness lasting more than two weeks', 'Difficulty breathing or swallowing', 'Throat pain with high fever', 'Blood in saliva or phlegm'],
            ],
            [
                'name' => 'Head & Neck Conditions',
                'category' => 'head_neck',
                'icon' => 'user',
                'summary' => 'Thyroid, salivary gland disorders, neck lumps and more.',
                'overview' => 'Head and neck conditions involve structures such as the salivary glands, thyroid, lymph nodes and neck tissues connected to the ENT system. Early evaluation is important, as symptoms can sometimes indicate more serious underlying conditions.',
                'symptoms' => ['A lump or swelling in the neck', 'Persistent neck pain or stiffness', 'Swelling of the salivary glands', 'Unexplained voice or swallowing changes', 'Enlarged lymph nodes'],
                'causes' => ['Infections of the lymph nodes or glands', 'Salivary gland stones or blockages', 'Thyroid gland enlargement', 'Cysts or benign growths', 'Injury or trauma to the neck', 'Chronic inflammation', 'Growths requiring further evaluation'],
                'treatment_options' => ['Diagnostic imaging and biopsy where needed', 'Medication for infections or inflammation', 'Minimally invasive gland or cyst removal', 'Coordinated care with specialists as required', 'Regular monitoring for benign conditions'],
                'when_to_see_doctor' => ["A lump that doesn't resolve within a few weeks", 'Rapid swelling in the neck', 'Unexplained weight loss with neck symptoms', 'Persistent hoarseness or difficulty swallowing'],
            ],
            [
                'name' => 'Pediatric ENT Conditions',
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
                'name' => 'Sleep Related Conditions',
                'category' => 'sleep',
                'icon' => 'sleep',
                'summary' => 'Snoring, sleep apnea, tonsillar hypertrophy and more.',
                'overview' => 'Sleep-related ENT conditions occur when the airway is partially or fully blocked during sleep, leading to disrupted breathing, snoring and poor sleep quality. Left untreated, they can affect long-term health and daily energy levels.',
                'symptoms' => ['Loud, chronic snoring', 'Pauses in breathing during sleep', 'Waking up gasping or choking', 'Excessive daytime tiredness', 'Morning headaches or dry mouth'],
                'causes' => ['Obstructive sleep apnoea', 'Enlarged tonsils or adenoids', 'Deviated nasal septum or nasal blockage', 'Excess tissue in the throat', 'Obesity affecting the airway', 'Jaw or airway structural differences', 'Nasal congestion from allergies'],
                'treatment_options' => ['Sleep study and diagnostic evaluation', 'CPAP therapy for sleep apnoea', 'Surgical correction of nasal or airway blockages', 'Tonsillectomy or adenoidectomy where indicated', 'Lifestyle and positional therapy guidance'],
                'when_to_see_doctor' => ['Loud snoring with breathing pauses', 'Excessive daytime sleepiness', 'Waking up gasping for air', "Snoring affecting a partner's or family's sleep"],
            ],
            [
                'name' => 'Allergy & Immunology',
                'category' => 'allergy',
                'icon' => 'shield',
                'summary' => 'Nasal allergies, sneezing, asthma related ENT issues and more.',
                'overview' => 'Allergic conditions occur when the immune system reacts to substances like dust, pollen or pet dander, often affecting the ears, nose and throat. Identifying triggers and managing the immune response can significantly improve quality of life.',
                'symptoms' => ['Sneezing and a runny or blocked nose', 'Itchy, watery eyes', 'Itchy throat or ears', 'Postnasal drip', 'Recurring sinus congestion'],
                'causes' => ['Seasonal pollen and outdoor allergens', 'Dust mites and indoor allergens', 'Pet dander', 'Mould exposure', 'Certain foods or medications', 'Air pollution and irritants', 'Family history of allergies'],
                'treatment_options' => ['Allergy testing to identify triggers', 'Antihistamines and nasal sprays', 'Immunotherapy (allergy shots or drops)', 'Environmental and lifestyle modifications', 'Management of related sinus or ear symptoms'],
                'when_to_see_doctor' => ['Allergy symptoms affecting daily life', 'Symptoms not improving with over-the-counter medication', 'Allergies triggering sinus or ear infections', 'Interest in long-term immunotherapy options'],
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
