@props(['navCentres' => collect(), 'navTreatments' => collect()])
@php
    $siteSettings = \App\Models\Setting::current();
    $socialLinks = collect([
        'facebook' => $siteSettings->facebook_url,
        'instagram' => $siteSettings->instagram_url,
        'youtube' => $siteSettings->youtube_url,
        'linkedin' => $siteSettings->linkedin_url,
        'x' => $siteSettings->x_url,
    ])->filter();
    $privacyUrl = $siteSettings->privacy_policy_url ?: (\Illuminate\Support\Facades\Route::has('cms.show') ? route('cms.show', 'privacy-policy') : '#');
    $termsUrl = $siteSettings->terms_url ?: (\Illuminate\Support\Facades\Route::has('cms.show') ? route('cms.show', 'terms-and-conditions') : '#');
    $refundUrl = $siteSettings->refund_policy_url ?: (\Illuminate\Support\Facades\Route::has('cms.show') ? route('cms.show', 'refund-policy') : '#');
@endphp

<footer class="relative bg-gradient-to-br from-navy-600 to-navy-700 text-navy-100 overflow-hidden">
    <div class="absolute -top-24 -right-24 w-80 h-80 bg-teal-500/10 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-24 -left-24 w-72 h-72 bg-teal-500/10 rounded-full blur-3xl"></div>

    <div class="relative mx-auto max-w-7xl px-6 py-10 lg:py-14 grid grid-cols-1 lg:grid-cols-6 gap-2 lg:gap-10 divide-y divide-white/10 lg:divide-y-0">
        <div class="lg:col-span-2 pb-6 lg:pb-0">
            <div class="flex items-center gap-2 mb-3">
                <span class="font-heading font-extrabold text-xl text-white">Dr Hans'</span>
                <span class="text-[10px] tracking-widest text-teal-300 font-semibold uppercase">Centre for ENT</span>
            </div>
            <p class="text-sm text-navy-200 max-w-xs mb-4">Delivering advanced ENT, Hearing and Vertigo care with compassion, expertise and world-class technology.</p>
            @if ($socialLinks->count())
                <div class="flex items-center gap-3">
                    @foreach ($socialLinks as $social => $url)
                        <a href="{{ $url }}" target="_blank" rel="noopener" class="w-9 h-9 rounded-full bg-white/10 hover:bg-teal-500 flex items-center justify-center transition-colors duration-200" aria-label="{{ $social === 'x' ? 'X (Twitter)' : ucfirst($social) }}">
                            <x-social-icon :name="$social" class="w-4 h-4 text-white" />
                        </a>
                    @endforeach
                </div>
            @endif
        </div>

        <div x-data="{ open: false }" class="py-5 lg:py-0">
            <button type="button" @click="open = !open" class="w-full flex items-center justify-between gap-2 lg:pointer-events-none">
                <h3 class="font-heading font-semibold text-white">Quick Links</h3>
                <span class="lg:hidden text-lg leading-none text-teal-300 w-5 text-center" x-text="open ? '−' : '+'"></span>
            </button>
            <ul x-show="open" class="lg:!block lg:!h-auto space-y-2 text-sm text-navy-200 mt-3">
                <li><a href="{{ route('home') }}" class="hover:text-teal-300 transition-colors">Home</a></li>
                <li><a href="{{ route('about.index') }}" class="hover:text-teal-300 transition-colors">About Us</a></li>
                <li><a href="{{ route('centres.index') }}" class="hover:text-teal-300 transition-colors">Our Centres</a></li>
                <li><a href="{{ route('treatments.index') }}" class="hover:text-teal-300 transition-colors">Speciality Service</a></li>
                <li><a href="{{ route('specialists.index') }}" class="hover:text-teal-300 transition-colors">Specialists</a></li>
                <li><a href="{{ route('specialists.audiologists') }}" class="hover:text-teal-300 transition-colors">Know Your Audiologist</a></li>
                <li><a href="{{ route('conditions.index') }}" class="hover:text-teal-300 transition-colors">Conditions Treated</a></li>
                <li><a href="{{ route('gallery.index') }}" class="hover:text-teal-300 transition-colors">Photo Gallery</a></li>
                <li><a href="{{ route('gallery.videos') }}" class="hover:text-teal-300 transition-colors">Video Gallery</a></li>
                <li><a href="{{ route('careers.index') }}" class="hover:text-teal-300 transition-colors">Careers</a></li>
                <li><a href="{{ route('contact.index') }}" class="hover:text-teal-300 transition-colors">Contact Us</a></li>
            </ul>
        </div>

        <div x-data="{ open: false }" class="py-5 lg:py-0">
            <button type="button" @click="open = !open" class="w-full flex items-center justify-between gap-2 lg:pointer-events-none">
                <h3 class="font-heading font-semibold text-white">Conditions Treated</h3>
                <span class="lg:hidden text-lg leading-none text-teal-300 w-5 text-center" x-text="open ? '−' : '+'"></span>
            </button>
            <ul x-show="open" class="lg:!block lg:!h-auto space-y-2 text-sm text-navy-200 mt-3">
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
                    <li><a href="{{ route('conditions.index') }}" class="hover:text-teal-300 transition-colors">{{ $condition }}</a></li>
                @endforeach
            </ul>
        </div>

        <div x-data="{ open: false }" class="py-5 lg:py-0">
            <button type="button" @click="open = !open" class="w-full flex items-center justify-between gap-2 lg:pointer-events-none">
                <h3 class="font-heading font-semibold text-white">Procedures / Services</h3>
                <span class="lg:hidden text-lg leading-none text-teal-300 w-5 text-center" x-text="open ? '−' : '+'"></span>
            </button>
            <ul x-show="open" class="lg:!block lg:!h-auto space-y-2 text-sm text-navy-200 mt-3">
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
                    <li><a href="{{ route('treatments.index') }}" class="hover:text-teal-300 transition-colors">{{ $procedure }}</a></li>
                @endforeach
            </ul>
        </div>

        <div x-data="{ open: false }" class="py-5 lg:py-0">
            <button type="button" @click="open = !open" class="w-full flex items-center justify-between gap-2 lg:pointer-events-none">
                <h3 class="font-heading font-semibold text-white">Our Centres</h3>
                <span class="lg:hidden text-lg leading-none text-teal-300 w-5 text-center" x-text="open ? '−' : '+'"></span>
            </button>
            <div x-show="open" class="lg:!block lg:!h-auto mt-3">
                <ul class="space-y-2 text-sm text-navy-200 mb-4">
                    @foreach ($navCentres as $centre)
                        <li><a href="{{ route('centres.index') }}#{{ $centre->slug }}" class="hover:text-teal-300 transition-colors">{{ $centre->name }}</a></li>
                    @endforeach
                </ul>
                <h3 class="font-heading font-semibold text-white mb-3">Contact Us</h3>
                <ul class="space-y-2 text-sm text-navy-200">
                    <li><a href="{{ $siteSettings->phoneUrl() }}" class="flex items-center gap-2 hover:text-teal-300 transition-colors"><x-app-icon name="phone" class="w-4 h-4 shrink-0" /> {{ $siteSettings->phone }}</a></li>
                    <li><a href="mailto:{{ $siteSettings->email }}" class="flex items-center gap-2 hover:text-teal-300 transition-colors"><x-app-icon name="mail" class="w-4 h-4 shrink-0" /> {{ $siteSettings->email }}</a></li>
                    <li class="flex items-start gap-2"><x-app-icon name="clock" class="w-4 h-4 shrink-0 mt-0.5" /> Mon - Sat: 9 AM - 7 PM<br>Sunday: 10 AM - 2 PM</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="relative border-t border-white/10">
        <div class="mx-auto max-w-7xl px-6 py-5 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-navy-300">
            <p>&copy; {{ now()->year }} Dr Hans' Centre for ENT. All Rights Reserved.</p>
            <div class="flex flex-wrap items-center justify-center gap-4">
                <a href="{{ $privacyUrl }}" class="hover:text-teal-300 transition-colors">Privacy Policy</a>
                <a href="{{ $termsUrl }}" class="hover:text-teal-300 transition-colors">Terms &amp; Conditions</a>
                <a href="{{ $refundUrl }}" class="hover:text-teal-300 transition-colors">Refund Policy</a>
                <span class="text-navy-500">&middot;</span>
                <a href="https://www.vdpl.co.in" target="_blank" rel="noopener" class="hover:text-teal-300 transition-colors">Built by VDPL</a>
            </div>
        </div>
    </div>
</footer>
