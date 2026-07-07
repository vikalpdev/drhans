<x-layouts.app title="About Us">
    <x-hero
        :title="$page->content['hero_title'] ?? 'Dr Hans\' Centre for ENT'"
        :subtitle="$page->content['hero_subtitle'] ?? 'A legacy of trust. A commitment to excellence. Dr Hans\' Centre for ENT is a multi-speciality ENT, Hearing and Vertigo care network founded by Padma Shri awardee Dr. J. M. Hans, a pioneer in Cochlear Implant Surgery with 35+ years of experience and 3500+ successful procedures.'"
        :breadcrumbs="['About Us' => null]"
        :image-model="$founder"
        image-collection="photo"
    >
        <x-slot:actions>
            <a href="{{ route('centres.index') }}" class="group inline-flex items-center gap-2 bg-gradient-to-r from-navy-600 to-navy-700 hover:from-navy-700 hover:to-navy-800 text-white font-heading font-semibold px-5 py-2.5 rounded-full text-sm shadow-md shadow-navy-600/20 hover:shadow-lg transition-all duration-200">
                <x-app-icon name="location" class="w-4 h-4 transition-transform duration-200 group-hover:scale-110" /> Our Centres
            </a>
            <a href="{{ route('about.chairman') }}" class="inline-flex items-center gap-2 border-2 border-navy-200 text-navy-700 hover:border-teal-500 hover:text-teal-600 font-heading font-semibold px-5 py-2.5 rounded-full text-sm transition-colors duration-200">
                <x-app-icon name="user" class="w-4 h-4" /> Chairman's Desk
            </a>
        </x-slot:actions>
    </x-hero>

    {{-- Mission, Vision, Values --}}
    <section class="mx-auto max-w-7xl px-6 py-16">
        <div class="text-center mb-10">
            <p class="inline-block text-teal-700 font-semibold text-xs tracking-widest uppercase bg-mint-100 px-3 py-1 rounded-full">Who We Are</p>
            <h2 class="font-heading font-bold text-2xl lg:text-3xl text-navy-600 mt-3">Our Mission, Vision &amp; Values</h2>
        </div>
        <div class="grid lg:grid-cols-3 gap-6">
            <div class="group bg-white rounded-2xl border border-navy-100 hover:border-teal-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 p-6">
                <div class="w-12 h-12 rounded-xl bg-mint-100 group-hover:bg-teal-500 flex items-center justify-center mb-4 transition-colors duration-300">
                    <x-app-icon name="target" class="w-6 h-6 text-teal-500 group-hover:text-white transition-colors duration-300" />
                </div>
                <h3 class="font-heading font-semibold text-navy-600">Our Mission</h3>
                <p class="text-sm text-navy-500 mt-2">{{ $page->content['mission_description'] ?? 'To deliver advanced ENT care through precise diagnosis, innovative treatments, and a patient-first approach.' }}</p>
            </div>
            <div class="group bg-white rounded-2xl border border-navy-100 hover:border-teal-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 p-6">
                <div class="w-12 h-12 rounded-xl bg-mint-100 group-hover:bg-teal-500 flex items-center justify-center mb-4 transition-colors duration-300">
                    <x-app-icon name="eye" class="w-6 h-6 text-teal-500 group-hover:text-white transition-colors duration-300" />
                </div>
                <h3 class="font-heading font-semibold text-navy-600">Our Vision</h3>
                <p class="text-sm text-navy-500 mt-2">{{ $page->content['vision_description'] ?? 'To ensure every patient experiences clarity, confidence and long-term well-being through care that evolves with them.' }}</p>
            </div>
            <div class="group bg-white rounded-2xl border border-navy-100 hover:border-teal-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 p-6">
                <div class="w-12 h-12 rounded-xl bg-mint-100 group-hover:bg-teal-500 flex items-center justify-center mb-4 transition-colors duration-300">
                    <x-app-icon name="heart" class="w-6 h-6 text-teal-500 group-hover:text-white transition-colors duration-300" />
                </div>
                <h3 class="font-heading font-semibold text-navy-600">Our Values</h3>
                <ul class="text-sm text-navy-500 mt-2 grid grid-cols-2 gap-x-4 gap-y-1.5">
                    @foreach (['Precision in Care', 'Trust & Transparency', 'Patient-first Approach', 'Clinical Excellence', 'Innovation That Evolves', 'Continuity of Care'] as $value)
                        <li class="flex items-center gap-1.5"><x-app-icon name="check" class="w-3.5 h-3.5 text-teal-500 shrink-0" /> {{ $value }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    {{-- Why choose us --}}
    <section class="relative bg-gradient-to-br from-navy-600 to-navy-700 py-16 overflow-hidden">
        <div class="absolute -top-24 -right-24 w-80 h-80 bg-teal-500/15 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-72 h-72 bg-teal-500/10 rounded-full blur-3xl"></div>

        <div class="relative mx-auto max-w-7xl px-6 grid lg:grid-cols-2 gap-10 items-center">
            <div>
                <p class="inline-block text-teal-300 font-semibold text-xs tracking-widest uppercase bg-white/10 px-3 py-1 rounded-full">Why Choose Us</p>
                <h2 class="font-heading font-bold text-2xl text-white mt-2 mb-2">Why Choose Dr Hans' Centre for ENT?</h2>
                <p class="text-sm text-navy-100 mb-6">{{ $page->content['why_choose_description'] ?? 'We combine world-class expertise with compassion and advanced technology to deliver the best outcomes for our patients.' }}</p>
                <div class="space-y-1.5">
                    @foreach ([
                        ['user-group', 'Expertise You Can Trust', 'Led by highly experienced ENT surgeons, audiologists and rehabilitation specialists.'],
                        ['building', 'Advanced Technology', 'State-of-the-art infrastructure and global standard treatment protocols.'],
                        ['heart', 'Comprehensive Care', 'Complete range of ENT, Hearing and Vertigo care under one roof.'],
                        ['shield', 'Patient-Centric Approach', 'Personalised treatment plans with focus on long-term results and rehabilitation.'],
                    ] as [$icon, $title, $desc])
                        <div class="group flex items-start gap-3 p-3 rounded-xl hover:bg-white/10 transition-colors duration-200" data-reveal style="--reveal-delay: {{ $loop->index * 0.06 }}s">
                            <div class="w-10 h-10 rounded-xl bg-white/10 group-hover:bg-teal-500 flex items-center justify-center shrink-0 transition-colors duration-200">
                                <x-app-icon :name="$icon" class="w-5 h-5 text-teal-300 group-hover:text-white transition-colors duration-200" />
                            </div>
                            <div>
                                <p class="font-heading font-semibold text-white text-sm">{{ $title }}</p>
                                <p class="text-sm text-navy-200">{{ $desc }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mt-8" data-reveal>
                    @foreach ([['3500+', 'Cochlear Implants Performed'], ['35+', 'Years of Clinical Excellence'], ['6', 'Centres Across India'], ['50K+', 'Patients Treated Successfully']] as [$stat, $label])
                        <div class="bg-white/10 backdrop-blur-sm text-white rounded-xl p-3 text-center">
                            <p class="font-heading font-bold text-teal-300">{{ $stat }}</p>
                            <p class="text-[10px] mt-1 leading-tight text-navy-100">{{ $label }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="relative rounded-2xl overflow-hidden aspect-[4/3] bg-gradient-to-br from-navy-500 to-teal-600 ring-1 ring-white/20 flex flex-col items-center justify-center gap-5 p-8 shadow-xl shadow-navy-900/30">
                <div class="absolute inset-0 opacity-20">
                    <div class="absolute -top-10 -left-10 w-48 h-48 rounded-full border-[20px] border-white/40"></div>
                    <div class="absolute -bottom-14 -right-14 w-64 h-64 rounded-full border-[24px] border-white/30"></div>
                </div>
                <div class="relative w-16 h-16 rounded-full bg-white shadow-lg flex items-center justify-center">
                    <x-app-icon name="building" class="w-8 h-8 text-teal-500" />
                </div>
                <div class="relative text-center">
                    <p class="font-heading font-bold text-white text-lg">A Legacy of Trust Since Day One</p>
                    <p class="text-teal-100 text-sm mt-1">ENT, Hearing &amp; Vertigo care under one roof.</p>
                </div>
                <div class="relative flex gap-3">
                    @foreach (['ear', 'wind', 'voice', 'vertigo'] as $icon)
                        <div class="w-10 h-10 rounded-xl bg-white/15 backdrop-blur-sm flex items-center justify-center">
                            <x-app-icon :name="$icon" class="w-5 h-5 text-white" />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Founder --}}
    @if ($founder)
        <section class="mx-auto max-w-7xl px-6 py-16 grid lg:grid-cols-[280px_1fr_280px] gap-8 items-start">
            <div class="rounded-2xl overflow-hidden aspect-square">
                <x-media-image :model="$founder" collection="photo" conversion="card" :alt="$founder->name" class="w-full h-full object-cover" />
            </div>
            <div>
                <p class="inline-block text-teal-700 font-semibold text-xs tracking-widest uppercase bg-mint-100 px-3 py-1 rounded-full">Our Founder</p>
                <h2 class="font-heading font-bold text-2xl text-navy-600 mt-2">{{ $founder->name }}</h2>
                <div class="mt-3 space-y-3">
                    @foreach (array_slice(explode("\n\n", $founder->bio), 0, 2) as $paragraph)
                        <p class="text-sm text-navy-500 leading-relaxed">{{ $paragraph }}</p>
                    @endforeach
                </div>
                <ul class="mt-4 space-y-2 text-sm text-navy-600">
                    @foreach ($founder->expertise ?? [] as $item)
                        <li class="flex items-center gap-2"><x-app-icon name="check-circle" class="w-4 h-4 text-teal-500 shrink-0" /> {{ $item }}</li>
                    @endforeach
                </ul>
                <a href="{{ route('specialists.show', $founder) }}" class="group mt-5 inline-flex items-center gap-1 text-teal-500 hover:text-teal-600 font-heading font-semibold text-sm transition-colors">
                    View Full Profile <x-app-icon name="chevron-right" class="w-4 h-4 transition-transform duration-200 group-hover:translate-x-1" />
                </a>
            </div>
            @if ($founder->quote)
                <blockquote class="bg-gradient-to-br from-navy-600 to-navy-700 rounded-2xl p-7 text-white text-sm italic">
                    <x-app-icon name="quote" class="w-8 h-8 text-teal-300 mb-4 opacity-60" />
                    &ldquo;{{ $founder->quote }}&rdquo;
                    <footer class="mt-4 font-heading font-semibold not-italic text-teal-300">&mdash; {{ $founder->name }}</footer>
                </blockquote>
            @endif
        </section>
    @endif

    {{-- Impact --}}
    <section class="bg-mint-50 py-10">
        <div class="mx-auto max-w-7xl px-6 grid grid-cols-2 lg:grid-cols-5 gap-6 text-center">
            @foreach ([['3500+', 3500, '+', 'Cochlear Implants'], ['50,000+', 50000, '+', 'Patients Treated'], ['9', 9, '', 'Expert Specialists'], ['100+', 100, '+', 'Advanced Equipment'], ['6', 6, '', 'Centres Across India']] as [$stat, $number, $suffix, $label])
                <div class="{{ $loop->last ? 'col-span-2 lg:col-span-1' : '' }}">
                    <p class="font-heading font-bold text-2xl text-navy-600" x-data="countUp({{ $number }}, '{{ $suffix }}')" x-text="display">{{ $stat }}</p>
                    <p class="text-xs text-navy-500 mt-1">{{ $label }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <x-cta-banner
        title="We're here to help you hear better, live better."
        subtitle="Book an appointment or visit our nearest centre today."
    />
</x-layouts.app>
