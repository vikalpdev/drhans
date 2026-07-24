<x-layouts.app title="Our Centres" description="Find a Dr Hans' Centre for ENT location near you. Advanced ENT, hearing and vertigo care across multiple centres with expert specialists and modern facilities.">
    <x-hero
        title="Our Centres"
        subtitle="Advanced ENT care is now closer to you. Visit any of our centres for expert consultation, diagnosis and treatment."
        :breadcrumbs="['Our Centres' => null]"
    >
        <x-slot:stats>
            <span class="flex items-start gap-1.5"><x-app-icon name="location" class="w-4 h-4 text-teal-500 shrink-0 mt-0.5" /> <strong class="text-navy-600">{{ $centres->count() }}</strong> Centres Across India</span>
            <span class="flex items-start gap-1.5"><x-app-icon name="user-group" class="w-4 h-4 text-teal-500 shrink-0 mt-0.5" /> <strong class="text-navy-600">50,000+</strong> Patients Treated</span>
        </x-slot:stats>
    </x-hero>

    <section x-data="{ city: 'all' }" class="relative bg-gradient-to-br from-navy-600 to-navy-700 py-16 overflow-hidden">
        <div class="absolute -top-24 -right-24 w-80 h-80 bg-teal-500/15 rounded-full blur-3xl hidden sm:block"></div>
        <div class="absolute -bottom-24 -left-24 w-72 h-72 bg-teal-500/10 rounded-full blur-3xl hidden sm:block"></div>

        <div class="relative mx-auto max-w-7xl px-6">
        <div class="flex flex-nowrap sm:flex-wrap gap-2.5 mb-8 bg-white/10 rounded-2xl p-2 w-full sm:w-fit overflow-x-auto sm:overflow-visible [&::-webkit-scrollbar]:hidden" style="scrollbar-width: none;">
            <button
                @click="city = 'all'"
                :class="city === 'all' ? 'bg-gradient-to-r from-teal-500 to-teal-600 text-white shadow-md shadow-teal-500/25' : 'bg-white text-navy-600 shadow-sm hover:text-teal-600'"
                class="shrink-0 inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-sm font-heading font-medium transition-colors duration-200"
            >
                <x-app-icon name="building" class="w-3.5 h-3.5" /> All Cities
            </button>
            @foreach ($centres->pluck('city')->unique() as $city)
                <button
                    @click="city = '{{ $city }}'"
                    :class="city === '{{ $city }}' ? 'bg-gradient-to-r from-teal-500 to-teal-600 text-white shadow-md shadow-teal-500/25' : 'bg-white text-navy-600 shadow-sm hover:text-teal-600'"
                    class="shrink-0 inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-sm font-heading font-medium transition-colors duration-200"
                >
                    <x-app-icon name="location" class="w-3.5 h-3.5" /> {{ $city }}
                </button>
            @endforeach
        </div>

        <div class="space-y-6">
        @foreach ($centres as $centre)
            <div x-show="city === 'all' || city === '{{ $centre->city }}'" x-transition.opacity id="{{ $centre->slug }}" class="group bg-white rounded-2xl shadow-lg shadow-navy-900/20 hover:shadow-xl transition-all duration-300 overflow-hidden grid md:grid-cols-[280px_1fr_240px] scroll-mt-32">
                <div class="aspect-[4/3] md:aspect-auto">
                    <x-media-image :model="$centre" collection="image" conversion="card" :alt="$centre->name" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                </div>

                <div class="p-6 flex flex-col justify-center">
                    <h3 class="font-heading font-bold text-lg text-navy-600 flex items-center gap-2">
                        <x-app-icon name="location" class="w-5 h-5 text-teal-500 shrink-0" />
                        <a href="{{ route('centres.show', $centre) }}" class="hover:text-teal-600 transition-colors">{{ $centre->name }}</a>
                    </h3>
                    <p class="text-sm text-navy-500 mt-2">{{ $centre->address }}</p>
                    <div class="flex flex-wrap gap-x-5 gap-y-2 mt-3">
                        <p class="text-xs font-semibold text-teal-600 flex items-center gap-1.5">
                            <x-app-icon name="clock" class="w-3.5 h-3.5 shrink-0" /> {{ $centre->opd_weekday }} &middot; {{ $centre->opd_sunday }}
                        </p>
                        <a href="tel:{{ $centre->phone }}" class="text-xs text-navy-500 hover:text-teal-600 flex items-center gap-1.5">
                            <x-app-icon name="phone" class="w-3.5 h-3.5 shrink-0" /> {{ $centre->phone }}
                        </a>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:flex-wrap gap-3 mt-4">
                        <a href="{{ route('appointment.create', ['centre' => $centre->slug]) }}" class="inline-flex w-full sm:w-fit items-center justify-center gap-2 bg-gradient-to-r from-navy-600 to-navy-700 hover:from-navy-700 hover:to-navy-800 text-white font-heading font-semibold text-sm px-5 py-2.5 rounded-full shadow-md shadow-navy-600/20 hover:shadow-lg transition-all duration-200">
                            <x-app-icon name="calendar" class="w-4 h-4" /> Book Appointment
                        </a>
                        <a href="{{ $centre->directionsUrl() }}" target="_blank" rel="noopener" class="inline-flex w-full sm:w-fit items-center justify-center gap-2 border-2 border-navy-200 text-navy-700 hover:border-teal-500 hover:text-teal-600 font-heading font-semibold text-sm px-5 py-2.5 rounded-full transition-colors duration-200">
                            <x-app-icon name="location" class="w-4 h-4" /> Get Directions
                        </a>
                        <a href="{{ route('centres.show', $centre) }}" class="group/link inline-flex w-full sm:w-fit items-center justify-center sm:justify-start gap-1 text-teal-600 hover:text-teal-700 font-heading font-semibold text-sm px-2 py-2.5">
                            View Details <x-app-icon name="chevron-right" class="w-4 h-4 transition-transform duration-200 group-hover/link:translate-x-1" />
                        </a>
                    </div>
                </div>

                @if (!empty($centre->facilities))
                    <div class="flex flex-col justify-center bg-mint-50 p-6 md:border-l border-t md:border-t-0 border-navy-100">
                        <p class="text-xs font-semibold text-teal-700 tracking-wide uppercase mb-3">Facilities Available</p>
                        <ul class="grid grid-cols-2 md:flex md:flex-col gap-x-4 gap-y-2">
                            @foreach ($centre->facilities as $facility)
                                <li class="flex items-center gap-2 text-sm text-navy-600">
                                    <x-app-icon name="check-circle" class="w-4 h-4 text-teal-500 shrink-0" /> {{ $facility }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        @endforeach
        </div>
        </div>
    </section>

    <section class="relative bg-mint-50 py-14 overflow-hidden">
        <div class="absolute -top-20 -right-20 w-72 h-72 bg-teal-200/20 rounded-full blur-3xl hidden sm:block"></div>

        <div class="relative mx-auto max-w-7xl px-6 grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @foreach ([
                ['location', 'Multiple Locations', 'Conveniently located across NCR'],
                ['user-group', 'Expert Care', 'Same expert team, every centre'],
                ['building', 'Advanced Facilities', 'Modern infrastructure and technology'],
                ['check-circle', 'Patient Convenience', 'Easy appointments and ample parking'],
            ] as [$icon, $title, $desc])
                <div class="group bg-white rounded-2xl p-5 text-center shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="w-12 h-12 rounded-xl bg-mint-100 group-hover:bg-teal-500 flex items-center justify-center mx-auto mb-3 transition-colors duration-300">
                        <x-app-icon :name="$icon" class="w-6 h-6 text-teal-500 group-hover:text-white transition-colors duration-300" />
                    </div>
                    <p class="font-heading font-semibold text-navy-600 text-sm">{{ $title }}</p>
                    <p class="text-xs text-navy-500 mt-1">{{ $desc }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <x-cta-banner
        title="Can't find a centre near you?"
        subtitle="Our care team will help you find the nearest centre."
    />
</x-layouts.app>
