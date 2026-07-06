<?php

namespace Database\Seeders;

use App\Models\Centre;
use App\Models\Specialist;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SpecialistSeeder extends Seeder
{
    public function run(): void
    {
        $delhi = Centre::where('slug', 'delhi-greater-kailash')->first();
        $gurgaon = Centre::where('slug', 'gurgaon')->first();
        $noida = Centre::where('slug', 'noida')->first();
        $faridabad = Centre::where('slug', 'faridabad')->first();

        $surgeons = [
            [
                'name' => 'Dr. J. M. Hans',
                'type' => 'ent_surgeon',
                'designation' => 'Mentor & Visionary Chairman',
                'qualifications' => 'MS (ENT), DLO, FRCS (Edin), FACS (USA)',
                'is_chairman' => true,
                'is_founder' => true,
                'experience_years' => 35,
                'procedures_count' => 3500,
                'bio' => "Dr. J. M. Hans is the Mentor and Visionary Chairman of Dr Hans' Centre for ENT, and one of India's most respected names in ENT and Cochlear Implant Surgery. With over 35 years of clinical experience and more than 3,500 successful cochlear implant procedures to his name, he has restored hearing and transformed lives across generations of patients.\n\nHonoured with the Padma Shri by the Government of India, Dr. Hans has pioneered advanced techniques in cochlear implantation, hearing preservation surgery, and complex ENT reconstruction. His work has been recognised nationally and internationally, and he continues to mentor young surgeons entering the field.\n\nWhat sets Dr. Hans apart is his belief that medicine is as much about compassion as it is about technical skill. He has built Dr Hans' Centre for ENT on the principle that every patient deserves not just treatment, but genuine care, clarity and confidence throughout their journey.\n\nToday, Dr. Hans continues to see patients across all our centres, guiding both the clinical direction of the practice and the next generation of ENT specialists who share his vision of patient-first care.",
                'expertise' => ['Cochlear Implant Surgery (Adults & Children)', 'Hearing Loss Evaluation & Management', 'Endoscopic Ear Surgery', 'Vertigo & Balance Disorders', 'Advanced Skull Base Surgery', 'Pediatric ENT & Airway Disorders'],
                'interests' => ['Cochlear Implantation in Complex Cases', 'Hearing Preservation Surgeries', 'Minimally Invasive ENT Procedures', 'Innovation in Hearing Restoration', 'Training & Mentorship in ENT Surgery'],
                'education' => [
                    ['degree' => 'FRCS (Edin)', 'institution' => 'Royal College of Surgeons, Edinburgh'],
                    ['degree' => 'FACS (USA)', 'institution' => 'Fellow, American College of Surgeons'],
                    ['degree' => 'MS (ENT)', 'institution' => 'Postgraduate Institute of Medical Education & Research (PGIMER)'],
                    ['degree' => 'DLO', 'institution' => 'Diploma in Otorhinolaryngology'],
                ],
                'experience_timeline' => [
                    ['role' => 'Mentor & Visionary Chairman', 'place' => "Dr Hans' Centre for ENT", 'period' => 'Present'],
                    ['role' => 'Senior Consultant ENT Surgeon', 'place' => 'Various Leading Hospitals', 'period' => '1995 - Present'],
                    ['role' => 'ENT Surgeon', 'place' => 'Government Medical College & Hospital', 'period' => '1985 - 1995'],
                ],
                'quote' => 'Our goal is not just to treat conditions, but to help our patients live better, hear better and communicate better.',
                'centres' => [$delhi, $gurgaon, $noida, $faridabad],
            ],
            [
                'name' => 'Dr. Vivek Gupta',
                'type' => 'ent_surgeon',
                'designation' => 'Senior ENT Surgeon',
                'qualifications' => 'MS (ENT)',
                'experience_years' => 12,
                'bio' => "Dr. Vivek Gupta is a Senior ENT Surgeon at Dr Hans' Centre for ENT, with over 12 years of dedicated experience in treating complex ear, nose and throat conditions. He completed his MS in ENT and has since built a reputation for his precise, minimally invasive approach to sinus and endoscopic surgery.\n\nDr. Gupta specialises in endoscopic sinus surgery, chronic sinusitis management, and nasal polyp removal, helping hundreds of patients breathe easier and reclaim their quality of life. His technique combines advanced endoscopic visualisation with a gentle, patient-first approach that minimises recovery time and discomfort.\n\nBeyond surgery, Dr. Gupta believes strongly in patient education. He takes time to explain every diagnosis and treatment option in clear, simple terms, ensuring patients feel confident and informed before any procedure.\n\nDr. Gupta is available for consultations at our Delhi (Greater Kailash) and Gurgaon centres, where he continues to combine clinical excellence with genuine care for every patient.",
                'expertise' => ['Sinus & Endoscopic Surgery', 'Chronic Sinusitis Management', 'Nasal Polyp Removal', 'Deviated Septum Correction', 'Allergic Rhinitis Treatment'],
                'interests' => ['Minimally Invasive Sinus Surgery', 'Balloon Sinuplasty', 'Functional Endoscopic Sinus Surgery (FESS)'],
                'education' => [
                    ['degree' => 'MS (ENT)', 'institution' => 'Maulana Azad Medical College, New Delhi'],
                    ['degree' => 'Fellowship in Endoscopic Sinus Surgery', 'institution' => 'All India Institute of Medical Sciences (AIIMS)'],
                ],
                'experience_timeline' => [
                    ['role' => 'Senior ENT Surgeon', 'place' => "Dr Hans' Centre for ENT", 'period' => '2018 - Present'],
                    ['role' => 'ENT Surgeon', 'place' => 'Fortis Hospital', 'period' => '2013 - 2018'],
                ],
                'quote' => 'My aim is to help every patient breathe, hear and live better through precise, minimally invasive care.',
                'centres' => [$delhi, $gurgaon],
            ],
            [
                'name' => 'Dr. Ruchi Bansal',
                'type' => 'ent_surgeon',
                'designation' => 'ENT & Skull Base Surgeon',
                'qualifications' => 'MS (ENT)',
                'experience_years' => 10,
                'bio' => "Dr. Ruchi Bansal is an ENT and Skull Base Surgeon at Dr Hans' Centre for ENT, bringing over 10 years of specialised experience in ear surgery and otology. She completed her MS in ENT and has developed particular expertise in treating complex ear disorders, including chronic ear infections, hearing loss, and skull base pathologies.\n\nHer surgical practice focuses on delicate, precision-driven procedures such as tympanoplasty, mastoidectomy, and cochlear implant surgery, always prioritising the best possible hearing outcomes for her patients.\n\nPatients often describe Dr. Bansal as warm, patient and thorough — she takes the time to listen to every concern and ensures each treatment plan is tailored to the individual, not just the diagnosis.\n\nShe currently practices at our Delhi and Noida centres, where she continues to help patients of all ages regain their hearing and their confidence.",
                'expertise' => ['Ear Surgery & Otology', 'Tympanoplasty', 'Mastoidectomy', 'Cochlear Implant Surgery', 'Chronic Ear Infection Management'],
                'interests' => ['Skull Base Surgery', 'Hearing Preservation Techniques', 'Complex Ear Reconstruction'],
                'education' => [
                    ['degree' => 'MS (ENT)', 'institution' => 'Lady Hardinge Medical College, New Delhi'],
                    ['degree' => 'Fellowship in Otology & Skull Base Surgery', 'institution' => 'Christian Medical College, Vellore'],
                ],
                'experience_timeline' => [
                    ['role' => 'ENT & Skull Base Surgeon', 'place' => "Dr Hans' Centre for ENT", 'period' => '2020 - Present'],
                    ['role' => 'Senior Registrar, ENT', 'place' => 'Safdarjung Hospital', 'period' => '2015 - 2020'],
                ],
                'quote' => "Every ear tells a story — my job is to listen carefully and restore what matters most, a patient's hearing.",
                'centres' => [$delhi, $noida],
            ],
            [
                'name' => 'Dr. Abhishek Jain',
                'type' => 'ent_surgeon',
                'designation' => 'ENT Surgeon',
                'qualifications' => 'MS (ENT)',
                'experience_years' => 10,
                'bio' => "Dr. Abhishek Jain is an ENT Surgeon at Dr Hans' Centre for ENT with over 10 years of experience, specialising in voice disorders and laryngology. He completed his MS in ENT and has focused his practice on helping patients who struggle with hoarseness, vocal cord nodules, chronic throat conditions, and other voice-related challenges.\n\nUsing advanced laryngoscopic techniques, Dr. Jain provides accurate diagnosis and effective, minimally invasive treatment for a wide range of throat and voice conditions. His patients include professionals who rely on their voice daily, as well as anyone experiencing persistent throat discomfort.\n\nDr. Jain believes voice health is often overlooked until it becomes a serious issue, and he is passionate about early diagnosis and preventive care, working closely with speech therapists at the centre for comprehensive, long-term solutions.\n\nHe is available for consultations at our Gurgaon and Faridabad centres.",
                'expertise' => ['Voice Disorders & Laryngology', 'Vocal Cord Nodule Treatment', 'Chronic Hoarseness Management', 'Laryngoscopic Evaluation'],
                'interests' => ['Professional Voice Care', 'Minimally Invasive Laryngeal Surgery', 'Voice Rehabilitation'],
                'education' => [
                    ['degree' => 'MS (ENT)', 'institution' => "King George's Medical University, Lucknow"],
                    ['degree' => 'Fellowship in Laryngology & Voice Disorders', 'institution' => 'PGIMER, Chandigarh'],
                ],
                'experience_timeline' => [
                    ['role' => 'ENT Surgeon', 'place' => "Dr Hans' Centre for ENT", 'period' => '2019 - Present'],
                    ['role' => 'ENT Surgeon', 'place' => 'Max Super Speciality Hospital', 'period' => '2014 - 2019'],
                ],
                'quote' => 'A clear, confident voice can change how a person shows up in the world — helping patients find that again is deeply rewarding.',
                'centres' => [$gurgaon, $faridabad],
            ],
            [
                'name' => 'Dr. Neha Khurana',
                'type' => 'ent_surgeon',
                'designation' => 'ENT Surgeon',
                'qualifications' => 'MS (ENT)',
                'experience_years' => 8,
                'bio' => "Dr. Neha Khurana is an ENT Surgeon at Dr Hans' Centre for ENT, with 8 years of focused experience in pediatric ENT and airway care. She completed her MS in ENT and has dedicated much of her career to treating children with ear infections, tonsil and adenoid problems, and airway disorders.\n\nDr. Khurana understands that treating children requires a different approach — one built on patience, reassurance and a gentle touch. She takes extra care to make young patients and their parents feel comfortable throughout every visit.\n\nHer clinical focus includes tonsillectomy, adenoidectomy, grommet insertion for glue ear, and management of recurrent childhood ear infections, working closely with pediatricians and speech therapists for well-rounded, coordinated care.\n\nDr. Khurana practices at our Noida and Faridabad centres, where she has become a trusted name among parents seeking expert pediatric ENT care.",
                'expertise' => ['Pediatric ENT & Airway', 'Tonsillectomy & Adenoidectomy', 'Grommet Insertion for Glue Ear', 'Childhood Ear Infection Management'],
                'interests' => ['Pediatric Airway Disorders', 'Coordinated Care with Pediatricians', 'Early Hearing Intervention in Children'],
                'education' => [
                    ['degree' => 'MS (ENT)', 'institution' => 'University College of Medical Sciences, Delhi'],
                    ['degree' => 'Fellowship in Pediatric Otolaryngology', 'institution' => 'Sir Ganga Ram Hospital'],
                ],
                'experience_timeline' => [
                    ['role' => 'ENT Surgeon', 'place' => "Dr Hans' Centre for ENT", 'period' => '2021 - Present'],
                    ['role' => 'ENT Surgeon', 'place' => 'Apollo Hospitals', 'period' => '2017 - 2021'],
                ],
                'quote' => 'Children need patience as much as precision — I try to make every young patient feel safe before I even begin treatment.',
                'centres' => [$noida, $faridabad],
            ],
        ];

        $allied = [
            [
                'name' => 'Ms. Anjali Mehta',
                'type' => 'allied',
                'designation' => 'Audiologist',
                'qualifications' => 'M.Sc. (Audiology & Speech-Language Pathology)',
                'experience_years' => 8,
                'bio' => "Ms. Anjali Mehta is an Audiologist at Dr Hans' Centre for ENT with over 8 years of experience in hearing evaluation and hearing aid fitting. She specialises in comprehensive hearing assessments for patients of all ages, from newborns to seniors, using advanced diagnostic equipment to pinpoint the exact nature and degree of hearing loss.\n\nBeyond diagnosis, Ms. Mehta plays a key role in helping patients select and adjust to the right hearing aids for their lifestyle and level of hearing loss, following up closely to fine-tune devices for the best possible outcome.\n\nMs. Mehta is passionate about raising awareness around hearing health, especially the importance of early detection in children and timely intervention in adults. Her calm, reassuring manner puts patients at ease during what can often feel like an overwhelming process.\n\nShe is based at our Delhi (Greater Kailash) centre.",
                'expertise' => ['Hearing Evaluation & Hearing Aids', 'Comprehensive Audiometric Testing', 'Hearing Aid Fitting & Fine-tuning', 'Pediatric Hearing Screening'],
                'interests' => ['Early Hearing Loss Detection', 'Advanced Hearing Aid Technology', 'Patient Counselling & Support'],
                'education' => [
                    ['degree' => 'M.Sc. (Audiology)', 'institution' => 'Ali Yavar Jung National Institute of Speech & Hearing Disabilities'],
                    ['degree' => 'B.Sc. (Speech & Hearing)', 'institution' => 'University of Delhi'],
                ],
                'experience_timeline' => [
                    ['role' => 'Audiologist', 'place' => "Dr Hans' Centre for ENT", 'period' => '2020 - Present'],
                    ['role' => 'Audiologist', 'place' => 'Fortis Hospital', 'period' => '2016 - 2020'],
                ],
                'quote' => 'The moment a patient hears clearly again, often for the first time in years, is why I do this work.',
                'centres' => [$delhi],
            ],
            [
                'name' => 'Ms. Priya Sharma',
                'type' => 'allied',
                'designation' => 'Speech Language Pathologist',
                'qualifications' => 'M.ASLP (Speech-Language Pathology)',
                'experience_years' => 7,
                'bio' => "Ms. Priya Sharma is a Speech Language Pathologist at Dr Hans' Centre for ENT, with 7 years of experience helping patients regain and improve their communication abilities. She specialises in speech therapy and rehabilitation for individuals recovering from surgery, hearing loss, or developmental speech delays.\n\nHer work spans a wide range of patients, from children with speech and language delays to adults recovering their voice and communication skills after cochlear implant surgery or throat procedures. Ms. Sharma designs individualised therapy plans that combine proven clinical techniques with patience and encouragement.\n\nShe works closely with the centre's ENT surgeons and audiologists to provide coordinated, end-to-end rehabilitation, ensuring patients regain not just function, but the confidence to communicate freely again.\n\nMs. Sharma practices at our Gurgaon centre, where she is known for her warmth and dedication to every patient's progress.",
                'expertise' => ['Speech Therapy & Rehabilitation', 'Post-Surgical Voice Rehabilitation', 'Language Delay Therapy', 'Cochlear Implant Speech Mapping'],
                'interests' => ['Pediatric Speech Development', 'Communication Rehabilitation', 'Multidisciplinary Care Coordination'],
                'education' => [
                    ['degree' => 'M.ASLP', 'institution' => 'All India Institute of Speech & Hearing (AIISH), Mysore'],
                    ['degree' => 'B.ASLP', 'institution' => 'Ali Yavar Jung National Institute of Speech & Hearing Disabilities'],
                ],
                'experience_timeline' => [
                    ['role' => 'Speech Language Pathologist', 'place' => "Dr Hans' Centre for ENT", 'period' => '2021 - Present'],
                    ['role' => 'Speech Therapist', 'place' => 'Sir Ganga Ram Hospital', 'period' => '2017 - 2021'],
                ],
                'quote' => 'Communication is connection — helping someone find their voice again is one of the most meaningful parts of my work.',
                'centres' => [$gurgaon],
            ],
            [
                'name' => 'Mr. Rohit Verma',
                'type' => 'allied',
                'designation' => 'Clinical Audiologist',
                'qualifications' => 'M.Sc. (Audiology)',
                'experience_years' => 6,
                'bio' => "Mr. Rohit Verma is a Clinical Audiologist at Dr Hans' Centre for ENT with 6 years of experience specialising in tinnitus management and balance assessment. He conducts detailed diagnostic testing to identify the underlying causes of ringing in the ears, dizziness, and balance disorders.\n\nHis approach combines advanced audiological testing with practical, evidence-based management strategies, helping patients understand their condition and find real relief from symptoms that can otherwise be distressing and disruptive to daily life.\n\nMr. Verma is particularly attentive to patients experiencing tinnitus, taking time to explain the condition thoroughly and offer coping strategies alongside clinical treatment, believing clear communication is just as important as clinical accuracy.\n\nHe is available for consultations at our Noida centre.",
                'expertise' => ['Tinnitus & Balance Assessment', 'Vestibular Function Testing', 'Tinnitus Management Programs', 'Diagnostic Audiology'],
                'interests' => ['Tinnitus Retraining Therapy', 'Balance Disorder Evaluation', 'Patient Education on Hearing Health'],
                'education' => [
                    ['degree' => 'M.Sc. (Audiology)', 'institution' => 'Ali Yavar Jung National Institute of Speech & Hearing Disabilities'],
                    ['degree' => 'B.Sc. (Speech & Hearing)', 'institution' => 'Jamia Millia Islamia'],
                ],
                'experience_timeline' => [
                    ['role' => 'Clinical Audiologist', 'place' => "Dr Hans' Centre for ENT", 'period' => '2022 - Present'],
                    ['role' => 'Audiologist', 'place' => 'Max Super Speciality Hospital', 'period' => '2018 - 2022'],
                ],
                'quote' => 'Tinnitus can feel isolating — my role is to help patients understand it and take back control of their daily life.',
                'centres' => [$noida],
            ],
            [
                'name' => 'Ms. Shreya Nair',
                'type' => 'allied',
                'designation' => 'Vestibular Therapist',
                'qualifications' => 'MPT (Neurology), Certified Vestibular Rehabilitation Therapist',
                'experience_years' => 5,
                'bio' => "Ms. Shreya Nair is a Vestibular Therapist at Dr Hans' Centre for ENT, with 5 years of experience helping patients overcome vertigo and balance disorders. She specialises in vestibular rehabilitation therapy, a specialised form of physical therapy designed to reduce dizziness and improve stability.\n\nHer treatment programs are tailored to each patient's specific balance issues, often combining targeted exercises with education about triggers and coping techniques. Many of her patients arrive after years of struggling with unexplained dizziness.\n\nShe works closely with the centre's ENT surgeons to ensure a coordinated approach for patients with complex vertigo and balance conditions, bridging the gap between diagnosis and long-term recovery.\n\nMs. Nair practices at our Faridabad centre.",
                'expertise' => ['Vertigo & Balance Rehabilitation', 'Vestibular Rehabilitation Therapy', 'Balance Training Exercises', 'Fall Risk Assessment'],
                'interests' => ['Chronic Dizziness Management', 'Coordinated Vertigo Care', 'Patient-specific Rehabilitation Programs'],
                'education' => [
                    ['degree' => 'MPT (Neurology)', 'institution' => 'Jamia Hamdard University'],
                    ['degree' => 'Certified Vestibular Rehabilitation Therapist', 'institution' => 'American Institute of Balance'],
                ],
                'experience_timeline' => [
                    ['role' => 'Vestibular Therapist', 'place' => "Dr Hans' Centre for ENT", 'period' => '2023 - Present'],
                    ['role' => 'Physiotherapist', 'place' => 'Apollo Hospitals', 'period' => '2019 - 2023'],
                ],
                'quote' => 'Balance disorders can be frightening — I focus on giving patients practical tools to feel steady and confident again.',
                'centres' => [$faridabad],
            ],
        ];

        $order = 0;
        foreach ([...$surgeons, ...$allied] as $data) {
            $centres = $data['centres'];
            unset($data['centres']);

            $specialist = Specialist::create([
                ...$data,
                'slug' => Str::slug($data['name']),
                'order' => $order++,
            ]);

            $specialist->centres()->attach(collect($centres)->filter()->pluck('id'));
        }
    }
}
