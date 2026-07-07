@props(['navCentres' => collect(), 'navTreatments' => collect()])

<footer class="bg-navy-600 text-navy-100">
    <div class="mx-auto max-w-7xl px-6 py-14 grid grid-cols-2 lg:grid-cols-6 gap-10">
        <div class="col-span-2">
            <div class="flex items-center gap-2 mb-3">
                <span class="font-heading font-extrabold text-xl text-white">Dr Hans'</span>
                <span class="text-[10px] tracking-widest text-teal-300 font-semibold uppercase">Centre for ENT</span>
            </div>
            <p class="text-sm text-navy-200 max-w-xs mb-4">Delivering advanced ENT, Hearing and Vertigo care with compassion, expertise and world-class technology.</p>
            <div class="flex items-center gap-3">
                @foreach (['facebook', 'instagram', 'youtube', 'linkedin'] as $social)
                    <a href="#" class="w-9 h-9 rounded-full bg-white/10 hover:bg-teal-500 flex items-center justify-center transition-colors" aria-label="{{ ucfirst($social) }}">
                        <span class="text-xs uppercase">{{ substr($social, 0, 2) }}</span>
                    </a>
                @endforeach
            </div>
        </div>

        <div>
            <h3 class="font-heading font-semibold text-white mb-3">Quick Links</h3>
            <ul class="space-y-2 text-sm text-navy-200">
                <li><a href="{{ route('home') }}" class="hover:text-teal-300">Home</a></li>
                <li><a href="{{ route('about.index') }}" class="hover:text-teal-300">About Us</a></li>
                <li><a href="{{ route('centres.index') }}" class="hover:text-teal-300">Our Centres</a></li>
                <li><a href="{{ route('treatments.index') }}" class="hover:text-teal-300">Speciality Service</a></li>
                <li><a href="{{ route('specialists.index') }}" class="hover:text-teal-300">Specialists</a></li>
                <li><a href="{{ route('conditions.index') }}" class="hover:text-teal-300">Conditions Treated</a></li>
                <li><a href="{{ route('gallery.index') }}" class="hover:text-teal-300">Photo Gallery</a></li>
                <li><a href="{{ route('gallery.videos') }}" class="hover:text-teal-300">Video Gallery</a></li>
                <li><a href="{{ route('careers.index') }}" class="hover:text-teal-300">Careers</a></li>
                <li><a href="{{ route('contact.index') }}" class="hover:text-teal-300">Contact Us</a></li>
            </ul>
        </div>

        <div>
            <h3 class="font-heading font-semibold text-white mb-3">Conditions Treated</h3>
            <ul class="space-y-2 text-sm text-navy-200">
                @foreach ([
                    'Head & Neck',
                    'Children (Paediatric) ENT',
                    'Tinnitus (Ringing Ears)',
                    'Dizziness & Vertigo (Neuro-otology)',
                    'Voice & Throat (Laryngology)',
                    'Nose & Sinus (Rhinology)',
                    'Speech Disorders (Speech Problems)',
                    'Ear (Otology)',
                ] as $condition)
                    <li><a href="{{ route('conditions.index') }}" class="hover:text-teal-300">{{ $condition }}</a></li>
                @endforeach
            </ul>
        </div>

        <div>
            <h3 class="font-heading font-semibold text-white mb-3">Procedures / Services</h3>
            <ul class="space-y-2 text-sm text-navy-200">
                @foreach ([
                    'Cochlear and Hearing Implant',
                    'Diagnosis & Treatment of Hearing Loss',
                    'Allergy Diagnosis & Immunotherapy',
                    'Throat & Larynx Surgery',
                    'Ear Surgery',
                    'Ringing Ears',
                    'Nose & Sinus Surgery',
                    'Dizziness & Vertigo',
                    'CBCT Facilities',
                    'Hyperbaric Oxygen Therapy (HBOT)',
                    'Children Paediatric Ear, Nose, Throat',
                ] as $procedure)
                    <li><a href="{{ route('treatments.index') }}" class="hover:text-teal-300">{{ $procedure }}</a></li>
                @endforeach
            </ul>
        </div>

        <div>
            <h3 class="font-heading font-semibold text-white mb-3">Our Centres</h3>
            <ul class="space-y-2 text-sm text-navy-200 mb-4">
                @foreach ($navCentres as $centre)
                    <li><a href="{{ route('centres.index') }}#{{ $centre->slug }}" class="hover:text-teal-300">{{ $centre->name }}</a></li>
                @endforeach
            </ul>
            <h3 class="font-heading font-semibold text-white mb-3">Contact Us</h3>
            <ul class="space-y-2 text-sm text-navy-200">
                <li class="flex items-center gap-2"><x-app-icon name="phone" class="w-4 h-4 shrink-0" /> +91-98117 03926</li>
                <li class="flex items-center gap-2"><x-app-icon name="mail" class="w-4 h-4 shrink-0" /> info@drhansent.com</li>
                <li class="flex items-start gap-2"><x-app-icon name="clock" class="w-4 h-4 shrink-0 mt-0.5" /> Mon - Sat: 9 AM - 7 PM<br>Sunday: 10 AM - 2 PM</li>
            </ul>
        </div>
    </div>

    <div class="border-t border-white/10">
        <div class="mx-auto max-w-7xl px-6 py-5 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-navy-300">
            <p>&copy; {{ now()->year }} Dr Hans' Centre for ENT. All Rights Reserved.</p>
            <div class="flex items-center gap-4">
                <a href="#" class="hover:text-teal-300">Privacy Policy</a>
                <a href="#" class="hover:text-teal-300">Terms &amp; Conditions</a>
                <a href="#" class="hover:text-teal-300">Refund Policy</a>
            </div>
        </div>
    </div>
</footer>
