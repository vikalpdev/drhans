<x-layouts.app :title="$page->content['meta_title'] ?? 'Home'" :description="$page->content['meta_description'] ?? null">
    {{-- Hero --}}
    <section class="relative bg-gradient-to-b from-mint-50 to-white overflow-hidden">
        <div class="absolute -top-24 -right-24 w-80 h-80 bg-teal-200/25 rounded-full blur-3xl"></div>
        <div class="absolute top-40 -left-28 w-72 h-72 bg-navy-200/15 rounded-full blur-3xl"></div>

        <div class="relative mx-auto max-w-7xl px-6 pt-10 lg:pt-14 pb-4 lg:pb-6 grid lg:grid-cols-2 gap-10 items-center">
            <div>
                <p class="text-teal-700 font-semibold text-xs tracking-widest uppercase">{{ $page->content['hero_eyebrow'] ?? "India's Advanced ENT & Hearing Care Network" }}</p>
                <h1 class="mt-3 font-heading font-extrabold text-4xl lg:text-5xl text-navy-600 leading-tight">
                    {{ $page->content['hero_title_prefix'] ?? 'Precision Care for' }}
                    <span class="inline-grid align-bottom text-left" x-data="rotateWords({{ count($page->content['hero_animated_words'] ?? ['Hearing Loss', 'Vertigo', 'Sinus Problems', 'Every Ear']) }})">
                        @foreach ($page->content['hero_animated_words'] ?? ['Hearing Loss', 'Vertigo', 'Sinus Problems', 'Every Ear'] as $i => $word)
                            <span class="col-start-1 row-start-1 text-teal-500 whitespace-nowrap transition-opacity duration-500" :class="active === {{ $i }} ? 'opacity-100' : 'opacity-0'" @if ($i > 0) aria-hidden="true" @endif>{{ $word }}</span>
                        @endforeach
                    </span>
                </h1>
                <p class="mt-4 text-navy-600 max-w-lg">
                    {{ $page->content['hero_description'] ?? 'Led by Padma Shri awardee Dr. J. M. Hans and a team of ENT specialists delivering world-class hearing, vertigo, sinus, and cochlear implant care.' }}
                </p>
                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="{{ route('appointment.create') }}" class="group inline-flex items-center gap-2 bg-gradient-to-r from-navy-600 to-navy-700 hover:from-navy-700 hover:to-navy-800 text-white font-heading font-semibold px-6 py-3 rounded-full shadow-md shadow-navy-600/20 hover:shadow-lg hover:shadow-navy-600/30 hover:-translate-y-0.5 active:translate-y-0 active:shadow-sm transition-all duration-200">
                        <x-app-icon name="calendar" class="w-4 h-4 transition-transform duration-200 group-hover:scale-110" /> Book Appointment
                    </a>
                    <a href="{{ route('centres.index') }}" class="group inline-flex items-center gap-2 border-2 border-navy-200 text-navy-700 hover:border-teal-500 hover:text-teal-600 hover:bg-teal-50 font-heading font-semibold px-6 py-3 rounded-full hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200">
                        <x-app-icon name="location" class="w-4 h-4 transition-transform duration-200 group-hover:scale-110" /> Find a Centre
                    </a>
                </div>
            </div>

            <div class="relative">
                <div class="rounded-3xl overflow-hidden aspect-[4/3] shadow-xl">
                    @php
                        $hasPageHero = $page->getFirstMedia('hero_image');
                        $hasFounderPhoto = $founder && $founder->getFirstMedia('photo');
                    @endphp
                    @if ($hasPageHero)
                        <x-media-image :model="$page" collection="hero_image" conversion="hero" alt="ENT consultation" eager class="w-full h-full object-cover" />
                    @elseif ($hasFounderPhoto)
                        <x-media-image :model="$founder" collection="photo" conversion="hero" alt="ENT consultation" eager class="w-full h-full object-cover" />
                    @else
                        <div class="relative w-full h-full bg-gradient-to-br from-navy-500 to-teal-600 flex flex-col items-center justify-center gap-5 p-8">
                            <div class="absolute inset-0 opacity-20">
                                <div class="absolute -top-10 -left-10 w-48 h-48 rounded-full border-[20px] border-white/40"></div>
                                <div class="absolute -bottom-14 -right-14 w-64 h-64 rounded-full border-[24px] border-white/30"></div>
                            </div>
                            <div class="relative w-20 h-20 rounded-full bg-white shadow-lg flex items-center justify-center">
                                <x-app-icon name="building" class="w-10 h-10 text-teal-500" />
                            </div>
                            <div class="relative text-center">
                                <p class="font-heading font-bold text-white text-xl">A Legacy of Trust Since Day One</p>
                                <p class="text-teal-100 text-sm mt-1">ENT, Hearing &amp; Vertigo care under one roof.</p>
                            </div>
                            <div class="relative flex gap-3">
                                @foreach (['ear', 'wind', 'voice', 'vertigo'] as $icon)
                                    <div class="w-11 h-11 rounded-xl bg-white/15 backdrop-blur-sm flex items-center justify-center">
                                        <x-app-icon :name="$icon" class="w-5 h-5 text-white" />
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                <div class="hidden lg:flex flex-col gap-3 absolute -right-4 top-6">
                    @foreach ($page->content['hero_badges'] ?? [['icon' => 'calendar', 'title' => 'Available Today', 'subtitle' => 'Book Consultation'], ['icon' => 'ear', 'title' => 'Hearing Test', 'subtitle' => 'Quick & Accurate'], ['icon' => 'location', 'title' => 'Find Nearby Centre', 'subtitle' => '6 Locations']] as $badge)
                        <div class="bg-white rounded-xl shadow-lg px-4 py-3 flex items-center gap-3 w-56">
                            <x-app-icon :name="$badge['icon']" class="w-5 h-5 text-teal-500 shrink-0" />
                            <div class="text-xs leading-tight">
                                <p class="font-semibold text-teal-600">{{ $badge['title'] }}</p>
                                <p class="text-navy-600">{{ $badge['subtitle'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Stats band --}}
        <div class="mx-auto max-w-7xl px-6 pb-6 lg:pb-8">
            <div class="bg-white rounded-2xl shadow-lg border border-navy-100 py-6 px-4 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-y-6" data-reveal>
                @foreach ($page->content['stats'] ?? [
                    ['icon' => 'ear-implant', 'stat' => '3500+', 'number' => 3500, 'suffix' => '+', 'label' => 'Cochlear Implants Performed'],
                    ['icon' => 'award', 'stat' => '35+', 'number' => 35, 'suffix' => '+', 'label' => 'Years of Clinical Excellence'],
                    ['icon' => 'location', 'stat' => '6', 'number' => 6, 'suffix' => '', 'label' => 'Centres Across India'],
                    ['icon' => 'cog', 'stat' => 'Advanced', 'number' => null, 'suffix' => '', 'label' => 'Technology & Infrastructure'],
                    ['icon' => 'heart', 'stat' => 'Patient First', 'number' => null, 'suffix' => '', 'label' => 'Compassionate Care Every Step'],
                ] as $s)
                    @php
                        if ($s['label'] === 'Centres Across India') {
                            $s['stat'] = (string) $centres->count();
                            $s['number'] = $centres->count();
                            $s['suffix'] = '';
                        }
                    @endphp
                    <div class="flex flex-col items-center text-center gap-1.5 px-4 {{ !$loop->first ? 'lg:border-l lg:border-navy-100' : '' }} {{ $loop->last ? 'col-span-2 sm:col-span-1' : '' }}">
                        <x-app-icon :name="$s['icon']" class="w-6 h-6 text-teal-500" />
                        @if (($s['number'] ?? null) !== null)
                            <p class="font-heading font-bold text-navy-600" x-data="countUp({{ $s['number'] }}, '{{ $s['suffix'] }}')" x-text="display">{{ $s['stat'] }}</p>
                        @else
                            <p class="font-heading font-bold text-navy-600">{{ $s['stat'] }}</p>
                        @endif
                        <p class="text-xs text-navy-500 leading-tight">{{ $s['label'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <x-quick-appointment :centres="$centres" :specialists="$specialists" />

    {{-- Centres carousel --}}
    <section
        class="bg-white py-16"
        x-data="{
            autoplayId: null,
            scrollTrack(dir) {
                const track = this.$refs.centresTrack;
                const card = track.querySelector(':scope > div');
                const amount = card ? card.offsetWidth + 24 : 320;
                const maxScroll = track.scrollWidth - track.clientWidth;

                if (dir > 0 && track.scrollLeft >= maxScroll - 10) {
                    track.scrollTo({ left: 0, behavior: 'smooth' });
                } else if (dir < 0 && track.scrollLeft <= 10) {
                    track.scrollTo({ left: maxScroll, behavior: 'smooth' });
                } else {
                    track.scrollBy({ left: dir * amount, behavior: 'smooth' });
                }
            },
            startAutoplay() {
                this.autoplayId = setInterval(() => this.scrollTrack(1), 4000);
            },
            stopAutoplay() {
                clearInterval(this.autoplayId);
            },
        }"
        x-init="startAutoplay()"
        @mouseenter="stopAutoplay()"
        @mouseleave="startAutoplay()"
        @touchstart.passive="stopAutoplay()"
        @touchend.passive="setTimeout(() => startAutoplay(), 800)"
    >
        <div class="mx-auto max-w-7xl px-6">
            <div class="flex items-end justify-between mb-6" data-reveal>
                <div>
                    <p class="inline-block text-teal-700 font-semibold text-xs tracking-widest uppercase bg-mint-100 px-3 py-1 rounded-full">{{ $page->content['centres_eyebrow'] ?? 'Our Centres' }}</p>
                    <h2 class="font-heading font-bold text-2xl lg:text-3xl text-navy-600 mt-3">{{ $page->content['centres_title'] ?? 'Care Available Across Multiple Locations' }}</h2>
                </div>
                <div class="hidden sm:flex items-center gap-4">
                    <a href="{{ route('centres.index') }}" class="group inline-flex items-center gap-1 text-teal-500 hover:text-teal-600 font-heading font-semibold text-sm whitespace-nowrap transition-colors">
                        View All Centres <x-app-icon name="chevron-right" class="w-4 h-4 transition-transform duration-200 group-hover:translate-x-1" />
                    </a>
                    <div class="flex items-center gap-2">
                        <button type="button" @click="scrollTrack(-1)" aria-label="Previous centres" class="w-9 h-9 rounded-full border border-navy-200 flex items-center justify-center text-navy-500 hover:bg-teal-500 hover:text-white hover:border-teal-500 transition-colors">
                            <x-app-icon name="chevron-right" class="w-4 h-4 rotate-180" />
                        </button>
                        <button type="button" @click="scrollTrack(1)" aria-label="Next centres" class="w-9 h-9 rounded-full border border-navy-200 flex items-center justify-center text-navy-500 hover:bg-teal-500 hover:text-white hover:border-teal-500 transition-colors">
                            <x-app-icon name="chevron-right" class="w-4 h-4" />
                        </button>
                    </div>
                </div>
            </div>

            <div x-ref="centresTrack" class="flex gap-6 overflow-x-auto snap-x snap-mandatory scroll-smooth pb-2 [&::-webkit-scrollbar]:hidden" style="scrollbar-width: none;">
                @foreach ($centres as $centre)
                    <div class="snap-start shrink-0 w-[85%] sm:w-[calc(50%-12px)] lg:w-[calc(25%-18px)]">
                        <x-card.centre :centre="$centre" />
                    </div>
                @endforeach
            </div>

            <div class="sm:hidden text-center mt-5">
                <a href="{{ route('centres.index') }}" class="inline-flex items-center gap-2 border-2 border-teal-500 text-teal-700 font-heading font-semibold px-6 py-2.5 rounded-full text-sm">
                    View All Centres <x-app-icon name="chevron-right" class="w-4 h-4" />
                </a>
            </div>
        </div>
    </section>

    {{-- Specialties grid --}}
    <section class="bg-mint-50 py-16">
        <div class="mx-auto max-w-7xl px-6">
            <div class="text-center mb-10" data-reveal>
                <p class="inline-block text-teal-700 font-semibold text-xs tracking-widest uppercase bg-white px-3 py-1 rounded-full shadow-sm">{{ $page->content['specialties_eyebrow'] ?? 'Our Specialities' }}</p>
                <h2 class="font-heading font-bold text-2xl lg:text-3xl text-navy-600 mt-3">{{ $page->content['specialties_title'] ?? 'Comprehensive ENT & Hearing Care' }}</h2>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @foreach ($treatments as $treatment)
                    <a href="{{ route('treatments.show', $treatment) }}" data-reveal style="--reveal-delay: {{ $loop->index * 0.05 }}s" class="group relative bg-white rounded-2xl p-5 flex flex-col border border-transparent hover:border-teal-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                        <x-app-icon :name="$treatment->icon ?? 'heart'" class="absolute -right-4 -top-4 w-24 h-24 text-mint-100 group-hover:text-mint-200 transition-colors duration-300" />
                        <div class="relative w-12 h-12 rounded-xl bg-mint-100 group-hover:bg-teal-500 flex items-center justify-center shrink-0 transition-colors duration-300">
                            <x-app-icon :name="$treatment->icon ?? 'heart'" class="w-6 h-6 text-teal-500 group-hover:text-white group-hover:scale-110 transition-all duration-300" />
                        </div>
                        <h3 class="relative font-heading font-semibold text-navy-600 group-hover:text-teal-600 text-sm mt-4 transition-colors duration-300">{{ $treatment->name }}</h3>
                        <p class="relative text-xs text-navy-500 mt-1.5 line-clamp-2">{{ $treatment->summary }}</p>
                        <span class="relative mt-auto pt-3 inline-flex items-center gap-1 text-xs font-semibold text-teal-500 group-hover:text-teal-600">
                            Learn more <x-app-icon name="arrow-right" class="w-3.5 h-3.5 transition-transform duration-200 group-hover:translate-x-1" />
                        </span>
                    </a>
                @endforeach
            </div>
            <div class="text-center mt-8">
                <a href="{{ route('treatments.index') }}" class="group inline-flex items-center gap-2 border-2 border-teal-500 text-teal-700 hover:bg-teal-500 hover:text-white font-heading font-semibold px-6 py-2.5 rounded-full text-sm hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200">
                    Explore All <x-app-icon name="chevron-right" class="w-4 h-4 transition-transform duration-200 group-hover:translate-x-1" />
                </a>
            </div>
        </div>
    </section>

    {{-- Why choose us + technology --}}
    <section class="relative bg-gradient-to-br from-navy-600 to-navy-700 py-16 overflow-hidden">
        <div class="absolute -top-24 -right-24 w-80 h-80 bg-teal-500/15 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-72 h-72 bg-teal-500/10 rounded-full blur-3xl"></div>

        <div class="relative mx-auto max-w-7xl px-6 grid lg:grid-cols-2 gap-12 items-start">
            <div>
                <div data-reveal>
                    <p class="inline-block text-teal-300 font-semibold text-xs tracking-widest uppercase bg-white/10 px-3 py-1 rounded-full">{{ $page->content['why_choose_eyebrow'] ?? 'Why Choose Us' }}</p>
                    <h2 class="font-heading font-bold text-2xl lg:text-3xl text-white mt-2">{{ $page->content['why_choose_title'] ?? 'Excellence in Every Patient Experience' }}</h2>
                    <p class="text-sm text-navy-100 leading-relaxed mt-4">
                        {!! nl2br(e($page->content['why_choose_description'] ?? 'Dr Hans\' Centre for ENT is a multi-speciality ENT, Hearing and Vertigo care network founded by Padma Shri awardee Dr. J. M. Hans, one of India\'s most respected cochlear implant surgeons. What began as a single clinic with a simple promise — honest, world-class ENT care for every family — has grown into 6 centres trusted by over 50,000 patients. From advanced diagnostics and endoscopic surgery to hearing implants and long-term rehabilitation, we bring every stage of ear, nose and throat care under one roof.')) !!}
                    </p>
                </div>
                <ul class="space-y-1.5 mt-6">
                    @foreach ($page->content['why_choose_cards'] ?? [
                        ['icon' => 'award', 'title' => 'Padma Shri Expertise', 'description' => 'Led by Padma Shri awardee Dr. J. M. Hans'],
                        ['icon' => 'heart', 'title' => 'Patient-first Approach', 'description' => 'Personalized care with compassion'],
                        ['icon' => 'shield', 'title' => 'International Standards', 'description' => 'Global protocols for safety & outcomes'],
                        ['icon' => 'check-circle', 'title' => 'Long-term Rehabilitation', 'description' => 'Complete care beyond treatment'],
                    ] as $card)
                        <li class="group flex items-start gap-3 p-3 rounded-xl hover:bg-white/10 transition-colors duration-200" data-reveal style="--reveal-delay: {{ $loop->index * 0.06 }}s">
                            <div class="w-10 h-10 rounded-xl bg-white/10 group-hover:bg-teal-500 flex items-center justify-center shrink-0 transition-colors duration-200">
                                <x-app-icon :name="$card['icon']" class="w-5 h-5 text-teal-300 group-hover:text-white group-hover:scale-110 transition-all duration-200" />
                            </div>
                            <div>
                                <p class="font-heading font-semibold text-white text-sm">{{ $card['title'] }}</p>
                                <p class="text-sm text-navy-200">{{ $card['description'] }}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="flex flex-wrap items-center gap-4 mt-6 pl-3" data-reveal>
                    <a href="{{ route('about.index') }}" class="group inline-flex items-center gap-2 bg-white hover:bg-mint-50 text-navy-700 font-heading font-semibold px-5 py-2.5 rounded-full text-sm shadow-md transition-colors duration-200">
                        More About Us <x-app-icon name="chevron-right" class="w-4 h-4 transition-transform duration-200 group-hover:translate-x-1" />
                    </a>
                    @if ($founder)
                        <p class="text-xs text-navy-200">
                            <span class="font-heading font-semibold text-white">{{ $founder->name }}</span> &middot; Founder &amp; Chairman
                        </p>
                    @endif
                </div>
            </div>

            <div>
                <p class="inline-block text-teal-300 font-semibold text-xs tracking-widest uppercase bg-white/10 px-3 py-1 rounded-full">{{ $page->content['tech_eyebrow'] ?? 'Advanced Technology' }}</p>
                <h2 class="font-heading font-bold text-2xl text-white mt-2 mb-5">{{ $page->content['tech_title'] ?? 'World-class Technology for Better Outcomes' }}</h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                    @foreach ($page->content['tech_items'] ?? [
                        ['image' => 'endoscopic-surgery', 'name' => 'Endoscopic ENT Surgery'],
                        ['image' => 'hearing-diagnostics', 'name' => 'Advanced Hearing Diagnostics'],
                        ['image' => 'cochlear-implant', 'name' => 'Cochlear Implant Technology'],
                        ['image' => 'balance-vertigo', 'name' => 'Balance & Vertigo Testing'],
                        ['image' => 'ai-audiology', 'name' => 'AI-assisted Audiology'],
                        ['image' => '3d-imaging', 'name' => '3D Imaging & Navigation'],
                    ] as $tech)
                        <div class="group rounded-2xl overflow-hidden bg-white shadow-lg shadow-navy-900/20 hover:shadow-xl hover:-translate-y-1 transition-all duration-300" data-reveal style="--reveal-delay: {{ $loop->index * 0.05 }}s">
                            <div class="aspect-square overflow-hidden">
                                <img src="{{ asset('images/technology/' . $tech['image'] . '.svg') }}" alt="{{ $tech['name'] }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            </div>
                            <p class="text-[11px] font-semibold text-navy-600 text-center px-1.5 py-2 leading-tight">{{ $tech['name'] }}</p>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-5">
                    <a href="{{ route('treatments.index') }}" class="group inline-flex items-center gap-1 text-teal-300 hover:text-teal-200 font-heading font-semibold text-sm transition-colors">
                        View All Technologies <x-app-icon name="chevron-right" class="w-4 h-4 transition-transform duration-200 group-hover:translate-x-1" />
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Specialists carousel --}}
    <section
        class="relative bg-mint-50 py-16 overflow-hidden"
        x-data="{
            autoplayId: null,
            scrollProgress: 8,
            updateProgress() {
                const track = this.$refs.specialistsTrack;
                const maxScroll = track.scrollWidth - track.clientWidth;
                this.scrollProgress = maxScroll > 0 ? Math.max((track.scrollLeft / maxScroll) * 100, 8) : 100;
            },
            scrollTrack(dir) {
                const track = this.$refs.specialistsTrack;
                const card = track.querySelector(':scope > div');
                const amount = card ? card.offsetWidth + 20 : 260;
                const maxScroll = track.scrollWidth - track.clientWidth;

                if (dir > 0 && track.scrollLeft >= maxScroll - 10) {
                    track.scrollTo({ left: 0, behavior: 'smooth' });
                } else if (dir < 0 && track.scrollLeft <= 10) {
                    track.scrollTo({ left: maxScroll, behavior: 'smooth' });
                } else {
                    track.scrollBy({ left: dir * amount, behavior: 'smooth' });
                }
            },
            startAutoplay() {
                this.stopAutoplay();
                this.autoplayId = setInterval(() => this.scrollTrack(1), 3500);
            },
            stopAutoplay() {
                clearInterval(this.autoplayId);
            },
        }"
        x-init="startAutoplay()"
        @mouseenter="stopAutoplay()"
        @mouseleave="startAutoplay()"
        @touchstart.passive="stopAutoplay()"
        @touchend.passive="setTimeout(() => startAutoplay(), 800)"
    >
        <div class="absolute -top-24 -right-24 w-72 h-72 bg-teal-200/30 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-72 h-72 bg-navy-200/20 rounded-full blur-3xl"></div>

        <div class="relative mx-auto max-w-7xl px-6">
            <div class="flex items-end justify-between mb-6" data-reveal>
                <div>
                    <p class="inline-block text-teal-700 font-semibold text-xs tracking-widest uppercase bg-white px-3 py-1 rounded-full shadow-sm">{{ $page->content['specialists_eyebrow'] ?? 'Meet Our Specialists' }}</p>
                    <h2 class="font-heading font-bold text-2xl lg:text-3xl text-navy-600 mt-3">{{ $page->content['specialists_title'] ?? 'Expert Doctors. Compassionate Care.' }}</h2>
                </div>
                <div class="hidden sm:flex items-center gap-4">
                    <a href="{{ route('specialists.index') }}" class="group inline-flex items-center gap-1 text-teal-500 hover:text-teal-600 font-heading font-semibold text-sm whitespace-nowrap transition-colors">
                        View All Specialists <x-app-icon name="chevron-right" class="w-4 h-4 transition-transform duration-200 group-hover:translate-x-1" />
                    </a>
                    <div class="flex items-center gap-2">
                        <button type="button" @click="scrollTrack(-1)" aria-label="Previous specialists" class="w-10 h-10 rounded-full bg-white shadow-sm border border-navy-100 flex items-center justify-center text-navy-500 hover:bg-teal-500 hover:text-white hover:border-teal-500 transition-all duration-200">
                            <x-app-icon name="chevron-right" class="w-4 h-4 rotate-180" />
                        </button>
                        <button type="button" @click="scrollTrack(1)" aria-label="Next specialists" class="w-10 h-10 rounded-full bg-white shadow-sm border border-navy-100 flex items-center justify-center text-navy-500 hover:bg-teal-500 hover:text-white hover:border-teal-500 transition-all duration-200">
                            <x-app-icon name="chevron-right" class="w-4 h-4" />
                        </button>
                    </div>
                </div>
            </div>

            <div x-ref="specialistsTrack" @scroll.passive="updateProgress()" class="flex gap-5 overflow-x-auto snap-x snap-mandatory scroll-smooth pb-2 [&::-webkit-scrollbar]:hidden" style="scrollbar-width: none;">
                @foreach ($specialists as $specialist)
                    <div class="snap-start shrink-0 w-[75%] sm:w-[calc(50%-10px)] lg:w-[calc(25%-15px)]">
                        <x-card.specialist :specialist="$specialist" :show-qualification="false" />
                    </div>
                @endforeach
            </div>

            <div class="mt-6 h-1 max-w-xs mx-auto bg-navy-100 rounded-full overflow-hidden">
                <div class="h-full bg-gradient-to-r from-teal-500 to-teal-600 rounded-full transition-all duration-150 ease-out" :style="`width: ${scrollProgress}%`"></div>
            </div>

            <div class="sm:hidden text-center mt-6">
                <a href="{{ route('specialists.index') }}" class="inline-flex items-center gap-2 border-2 border-teal-500 text-teal-700 font-heading font-semibold px-6 py-2.5 rounded-full text-sm">
                    View All Specialists <x-app-icon name="chevron-right" class="w-4 h-4" />
                </a>
            </div>
        </div>
    </section>

    {{-- Testimonials --}}
    @if ($testimonials->count())
        <section class="bg-white py-16" x-data="{ activeVideo: null }" @keydown.escape.window="activeVideo = null">
            <div class="mx-auto max-w-7xl px-6">
                <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-4 mb-8" data-reveal>
                    <div>
                        <p class="inline-block text-teal-700 font-semibold text-xs tracking-widest uppercase bg-mint-100 px-3 py-1 rounded-full">{{ $page->content['testimonials_eyebrow'] ?? 'Patient Success Stories' }}</p>
                        <h2 class="font-heading font-bold text-2xl lg:text-3xl text-navy-600 mt-3">{{ $page->content['testimonials_title'] ?? 'Real Stories. Real Transformations.' }}</h2>
                    </div>
                    <a href="{{ route('gallery.videos') }}" class="group inline-flex items-center gap-2 border-2 border-navy-200 text-navy-700 hover:border-teal-500 hover:text-teal-600 font-heading font-semibold px-5 py-2.5 rounded-full text-sm w-fit hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200">
                        <x-app-icon name="play" class="w-4 h-4 transition-transform duration-200 group-hover:scale-110" /> Watch More Stories
                    </a>
                </div>
                <div class="grid sm:grid-cols-3 gap-6">
                    @foreach ($testimonials->take(3) as $video)
                        <button @click="activeVideo = @js($video->embedUrl())" class="group text-left rounded-2xl overflow-hidden bg-white border border-navy-100 hover:border-teal-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300" data-reveal style="--reveal-delay: {{ $loop->index * 0.07 }}s">
                            <div class="aspect-video relative flex items-center justify-center overflow-hidden bg-gradient-to-br from-navy-600 to-teal-600">
                                <x-app-icon name="play" class="absolute w-14 h-14 text-white/20" />
                                @if ($video->thumbnailUrl())
                                    <img src="{{ $video->thumbnailUrl() }}" alt="{{ $video->title }}" loading="lazy" onerror="this.remove()" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                @endif
                                <div class="absolute inset-0 bg-navy-900/0 group-hover:bg-navy-900/20 transition-colors duration-300"></div>
                                <div class="relative w-14 h-14 rounded-full bg-white/90 group-hover:bg-teal-500 flex items-center justify-center shadow-lg group-hover:scale-110 transition-all duration-300">
                                    <x-app-icon name="play" class="w-5 h-5 text-navy-600 group-hover:text-white transition-colors duration-300 translate-x-0.5" />
                                </div>
                            </div>
                            <div class="p-4">
                                <p class="text-navy-600 font-heading font-semibold text-sm">{{ $video->title }}</p>
                                <p class="text-navy-500 text-xs mt-1">{{ $video->patient_name }}</p>
                            </div>
                        </button>
                    @endforeach
                </div>
            </div>

            <template x-if="activeVideo">
                <div class="fixed inset-0 z-[100] flex items-center justify-center p-4" x-transition.opacity>
                    <div class="absolute inset-0 bg-navy-900/80" @click="activeVideo = null"></div>
                    <div class="relative w-full max-w-3xl">
                        <button @click="activeVideo = null" aria-label="Close video" class="absolute -top-11 right-0 w-9 h-9 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center text-white transition-colors">
                            <x-app-icon name="close" class="w-5 h-5" />
                        </button>
                        <div class="aspect-video rounded-2xl overflow-hidden shadow-2xl bg-black">
                            <iframe :src="activeVideo" class="w-full h-full" frameborder="0" allow="autoplay; encrypted-media; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </template>
        </section>
    @endif

    <x-cta-banner
        :title="$page->content['cta_title'] ?? 'Need Immediate ENT Assistance?'"
        :subtitle="$page->content['cta_subtitle'] ?? 'Our team is here to help you. Get expert care, right when you need it.'"
    />
</x-layouts.app>
