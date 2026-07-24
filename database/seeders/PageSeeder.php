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
            ]
        ]);

        Page::updateOrCreate(['slug' => 'chairman'], [
            'name' => 'Chairman\'s Desk',
            'content' => [
                'hero_title' => 'From the Chairman\'s Desk',
                'hero_subtitle' => 'For over three decades, my mission has been simple yet profound - to restore the gift of hearing, balance and communication, and to bring hope back to the lives of thousands of patients and their families.',

                'journey_title' => 'A Journey of Purpose',
                'beliefs_title' => 'My Beliefs',
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
