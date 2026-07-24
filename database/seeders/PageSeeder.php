<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        Page::updateOrCreate(['slug' => 'home'], [
            'name' => 'Home',
            'content' => [
                'hero_title_prefix' => 'Precision Care for',
                'hero_animated_words' => ['Hearing Loss', 'Vertigo', 'Sinus Problems', 'Every Ear'],
                'hero_description' => 'Led by Padma Shri awardee Dr. J. M. Hans and a team of ENT specialists delivering world-class hearing, vertigo, sinus, and cochlear implant care.',
                
                'why_choose_title' => 'Excellence in Every Patient Experience',
                'why_choose_description' => "Dr Hans' Centre for ENT is a multi-speciality ENT, Hearing and Vertigo care network founded by Padma Shri awardee Dr. J. M. Hans, one of India's most respected cochlear implant surgeons.\n\nWhat began as a single clinic with a simple promise — honest, world-class ENT care for every family — has grown into 6 centres trusted by over 50,000 patients. From advanced diagnostics and endoscopic surgery to hearing implants and long-term rehabilitation, we bring every stage of ear, nose and throat care under one roof.",
                
                'tech_title' => 'World-class Technology for Better Outcomes',
            ]
        ]);

        Page::updateOrCreate(['slug' => 'about'], [
            'name' => 'About Us',
            'content' => [
                'hero_title' => "Dr Hans' Centre for ENT",
                'hero_subtitle' => "A legacy of trust. A commitment to excellence. Dr Hans' Centre for ENT is a multi-speciality ENT, Hearing and Vertigo care network founded by Padma Shri awardee Dr. J. M. Hans, a pioneer in Cochlear Implant Surgery with 35+ years of experience and 3500+ successful procedures.",
                
                'mission_description' => 'To deliver advanced ENT care through precise diagnosis, innovative treatments, and a patient-first approach.',
                'vision_description' => 'To ensure every patient experiences clarity, confidence and long-term well-being through care that evolves with them.',
                
                'why_choose_description' => 'We combine world-class expertise with compassion and advanced technology to deliver the best outcomes for our patients.',

                'our_values' => ['Precision in Care', 'Trust & Transparency', 'Patient-first Approach', 'Clinical Excellence', 'Innovation That Evolves', 'Continuity of Care'],

                'why_choose_cards' => [
                    ['icon' => 'user-group', 'title' => 'Expertise You Can Trust', 'description' => 'Led by highly experienced ENT surgeons, audiologists and rehabilitation specialists.'],
                    ['icon' => 'building', 'title' => 'Advanced Technology', 'description' => 'State-of-the-art infrastructure and global standard treatment protocols.'],
                    ['icon' => 'heart', 'title' => 'Comprehensive Care', 'description' => 'Complete range of ENT, Hearing and Vertigo care under one roof.'],
                    ['icon' => 'shield', 'title' => 'Patient-Centric Approach', 'description' => 'Personalised treatment plans with focus on long-term results and rehabilitation.'],
                ],

                'why_choose_stats' => [
                    ['stat' => '3500+', 'label' => 'Cochlear Implants Performed'],
                    ['stat' => '35+', 'label' => 'Years of Clinical Excellence'],
                    ['stat' => '6', 'label' => 'Centres Across India'],
                    ['stat' => '50K+', 'label' => 'Patients Treated Successfully'],
                ],

                'impact_stats' => [
                    ['stat' => '3500+', 'number' => 3500, 'suffix' => '+', 'label' => 'Cochlear Implants'],
                    ['stat' => '50,000+', 'number' => 50000, 'suffix' => '+', 'label' => 'Patients Treated'],
                    ['stat' => '9', 'number' => 9, 'suffix' => '', 'label' => 'Expert Specialists'],
                    ['stat' => '100+', 'number' => 100, 'suffix' => '+', 'label' => 'Advanced Equipment'],
                    ['stat' => '6', 'number' => 6, 'suffix' => '', 'label' => 'Centres Across India'],
                ],

                'cta_title' => "We're here to help you hear better, live better.",
                'cta_subtitle' => 'Book an appointment or visit our nearest centre today.',
            ]
        ]);

        Page::updateOrCreate(['slug' => 'chairman'], [
            'name' => 'Chairman\'s Desk',
            'content' => [
                'hero_title' => 'From the Chairman\'s Desk',
                'hero_subtitle' => 'For over three decades, my mission has been simple yet profound - to restore the gift of hearing, balance and communication, and to bring hope back to the lives of thousands of patients and their families.',

                'journey_title' => 'A Journey of Purpose',

                'beliefs_title' => 'My Beliefs',
                'beliefs' => ['Patients first, always', 'Ethical practice and transparency', 'Innovation with compassion', 'Building a team that learns and grows together', 'Creating centres that are accessible, advanced and trusted'],

                'milestones_eyebrow' => 'Recognition',
                'milestones_title' => 'Milestones & Achievements',
                'milestones' => [
                    ['icon' => 'award', 'title' => 'Padma Shri Awardee', 'description' => 'Honoured by the Government of India for outstanding contribution to medicine.'],
                    ['icon' => 'ear-implant', 'title' => 'Pioneer in Cochlear Implant Surgery', 'description' => 'Performed 3500+ successful cochlear implant procedures.'],
                    ['icon' => 'clock', 'title' => '35+ Years of Experience', 'description' => 'Dedicated to clinical excellence, research and innovation.'],
                    ['icon' => 'user-group', 'title' => 'Global Recognition', 'description' => 'Author of numerous research papers and invited faculty at national & international conferences.'],
                ],

                'impact_stats' => [
                    ['stat' => '3500+', 'number' => 3500, 'suffix' => '+', 'label' => 'Cochlear Implants Performed'],
                    ['stat' => '35+', 'number' => 35, 'suffix' => '+', 'label' => 'Years of Clinical Excellence'],
                    ['stat' => '50,000+', 'number' => 50000, 'suffix' => '+', 'label' => 'Patients Treated Successfully'],
                    ['stat' => '6', 'number' => 6, 'suffix' => '', 'label' => 'Centres Across India'],
                    ['stat' => '100+', 'number' => 100, 'suffix' => '+', 'label' => 'Advanced Equipment & Technologies'],
                ],

                'cta_title' => "We're here to help you hear better, live better.",
                'cta_subtitle' => 'Book an appointment or visit our nearest centre today.',
            ]
        ]);

        Page::updateOrCreate(['slug' => 'contact'], [
            'name' => 'Contact Us',
            'content' => [
                'hero_title' => 'Contact Us',
                'hero_subtitle' => "We're here to help you with all your ENT, Hearing and Vertigo care needs. Reach out to us or visit our nearest centre.",

                'form_heading' => 'Send Us a Message',
                'form_subtitle' => 'Fill out the form below and our team will get back to you shortly.',
                'subjects' => ['General Enquiry', 'Appointment Query', 'Feedback', 'Careers'],

                'urgent_box_title' => 'Need Immediate Assistance?',
                'urgent_box_description' => 'For urgent ENT care or emergency appointments, please call us directly.',

                'why_us_title' => "We're Here for You",
                'why_us_list' => ['Expert ENT Specialists', 'Advanced Technology', 'Personalised Care', 'Multiple Centres for Your Convenience'],
                'office_hours' => 'Mon - Sat: 9 AM - 7 PM · Sun: 10 AM - 2 PM',

                'centres_eyebrow' => 'Visit Us',
                'centres_title' => 'Our Centres',
            ]
        ]);

        Page::updateOrCreate(['slug' => 'careers'], [
            'name' => 'Careers',
            'content' => [
                'hero_title' => 'Build Your Career With Us',
                'hero_subtitle' => "Join Dr Hans' Centre for ENT and be part of a team that's passionate about delivering exceptional care and making a real difference in people's lives.",
                'hero_stats' => ['Patient First Approach', 'Growth & Learning Opportunities', 'Supportive & Inclusive Work Culture'],

                'stats_strip' => [
                    ['stat' => '100+', 'label' => 'Team Members'],
                    ['stat' => '6', 'label' => 'Centres Across India'],
                    ['stat' => '20+', 'label' => 'Specialities'],
                    ['stat' => 'Endless', 'label' => 'Opportunities'],
                ],

                'resume_box_title' => "Don't See a Role for You?",
                'resume_box_description' => "We're always looking for talented individuals. Share your resume with us.",

                'why_work_with_us' => ['Meaningful work that impacts lives', 'Continuous learning & development', 'Modern facilities & technology', 'Collaborative & friendly environment', 'Work-life balance'],

                'culture_eyebrow' => "Life at Dr Hans'",
                'culture_title' => 'Our Culture. Our Commitment.',
                'culture_cards' => [
                    ['icon' => 'shield', 'title' => 'Integrity & Respect', 'description' => 'We treat every patient and team member with honesty and respect.'],
                    ['icon' => 'award', 'title' => 'Excellence', 'description' => 'We strive for excellence in everything we do.'],
                    ['icon' => 'user-group', 'title' => 'Teamwork', 'description' => 'We believe great outcomes come from working together.'],
                    ['icon' => 'heart', 'title' => 'Empathy', 'description' => 'We care deeply for our patients and each other.'],
                ],

                'cta_title' => 'Ready to make a difference?',
                'cta_subtitle' => 'Join a team that helps people hear better and live better, every day.',
            ]
        ]);
    }
}
