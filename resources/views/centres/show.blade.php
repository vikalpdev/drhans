<x-layouts.app :title="$centre->meta_title ?? $centre->name" :description="$centre->meta_description ?? null">
    <section class="relative bg-gradient-to-br from-mint-50 via-mint-50 to-white border-b border-navy-100 overflow-hidden">
        <div class="absolute -top-20 -right-20 w-72 h-72 bg-teal-200/20 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-navy-200/10 rounded-full blur-3xl"></div>

        <div class="relative mx-auto max-w-7xl px-6 py-10 lg:py-14">
            <nav class="text-sm text-navy-500 mb-6 flex items-center gap-1">
                <a href="{{ route('home') }}" class="hover:text-teal-500">Home</a>
                <x-app-icon name="chevron-right" class="w-3.5 h-3.5" />
                <a href="{{ route('centres.index') }}" class="hover:text-teal-500">Our Centres</a>
                <x-app-icon name="chevron-right" class="w-3.5 h-3.5" />
                <span class="text-navy-700">{{ $centre->name }}</span>
            </nav>

            <div class="grid lg:grid-cols-[1fr_420px] gap-8">
                <div class="rounded-2xl overflow-hidden aspect-video shadow-xl">
                    <x-media-image :model="$centre" collection="image" conversion="hero" :alt="$centre->name" icon="building" eager class="w-full h-full object-cover" />
                </div>

                <div class="bg-white rounded-2xl shadow-lg shadow-navy-900/10 p-6 flex flex-col">
                    <h1 class="font-heading font-extrabold text-2xl text-navy-600 flex items-center gap-2">
                        <x-app-icon name="location" class="w-5 h-5 text-teal-500 shrink-0" /> {{ $centre->name }}
                    </h1>
                    <p class="text-sm text-navy-500 mt-2">{{ $centre->address }}</p>

                    <div class="space-y-2.5 mt-5">
                        <p class="text-xs font-semibold text-teal-700 flex items-center gap-2">
                            <x-app-icon name="clock" class="w-4 h-4 shrink-0" /> {{ $centre->opd_weekday }} &middot; {{ $centre->opd_sunday }}
                        </p>
                        <a href="tel:{{ $centre->phone }}" class="text-sm text-navy-600 hover:text-teal-600 flex items-center gap-2">
                            <x-app-icon name="phone" class="w-4 h-4 shrink-0 text-teal-500" /> {{ $centre->phone }}
                        </a>
                        @if ($centre->phone_general_enquiry)
                            <a href="tel:{{ $centre->phone_general_enquiry }}" class="text-sm text-navy-500 hover:text-teal-600 flex items-center gap-2 pl-6">
                                General Enquiry: {{ $centre->phone_general_enquiry }}
                            </a>
                        @endif
                        @if ($centre->phone_appointment)
                            <a href="tel:{{ $centre->phone_appointment }}" class="text-sm text-navy-500 hover:text-teal-600 flex items-center gap-2 pl-6">
                                Appointments: {{ $centre->phone_appointment }}
                            </a>
                        @endif
                    </div>

                    <div class="flex flex-wrap gap-3 mt-6">
                        <a href="{{ route('appointment.create', ['centre' => $centre->slug]) }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-navy-600 to-navy-700 hover:from-navy-700 hover:to-navy-800 text-white font-heading font-semibold text-sm px-5 py-2.5 rounded-full shadow-md shadow-navy-600/20 hover:shadow-lg transition-all duration-200">
                            <x-app-icon name="calendar" class="w-4 h-4" /> Book Appointment
                        </a>
                        <a href="https://www.google.com/maps/dir/?api=1&destination={{ $centre->lat }},{{ $centre->lng }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 border-2 border-navy-200 text-navy-700 hover:border-teal-500 hover:text-teal-600 font-heading font-semibold text-sm px-5 py-2.5 rounded-full transition-colors duration-200">
                            <x-app-icon name="location" class="w-4 h-4" /> Get Directions
                        </a>
                    </div>

                    @if ($centre->practo_url || $centre->justdial_url)
                        <div class="flex flex-wrap gap-3 mt-3">
                            @if ($centre->practo_url)
                                <a href="{{ $centre->practo_url }}" target="_blank" rel="noopener" class="text-xs font-semibold text-teal-600 hover:text-teal-700">Review on Practo</a>
                            @endif
                            @if ($centre->justdial_url)
                                <a href="{{ $centre->justdial_url }}" target="_blank" rel="noopener" class="text-xs font-semibold text-teal-600 hover:text-teal-700">Review on Justdial</a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    @if (!empty($centre->facilities))
        <section class="mx-auto max-w-7xl px-6 py-14">
            <h2 class="font-heading font-bold text-xl text-navy-600 mb-5">Facilities Available</h2>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach ($centre->facilities as $facility)
                    <div class="flex items-center gap-3 bg-mint-50 rounded-xl p-4">
                        <x-app-icon name="check-circle" class="w-5 h-5 text-teal-500 shrink-0" />
                        <span class="text-sm text-navy-600">{{ $facility }}</span>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    @if ($centre->virtualTourEmbedUrl())
        <section class="mx-auto max-w-7xl px-6 py-14">
            <div class="grid lg:grid-cols-2 gap-8 items-center">
                <div>
                    <p class="inline-block text-teal-700 font-semibold text-xs tracking-widest uppercase bg-mint-100 px-3 py-1 rounded-full mb-3">Explore Our Centre</p>
                    <h2 class="font-heading font-bold text-2xl text-navy-600 mb-3">Take a Virtual Tour of {{ $centre->name }}</h2>
                    <p class="text-sm text-navy-500 leading-relaxed max-w-md">Get a closer look at our facilities, consultation rooms and advanced diagnostic equipment before your visit.</p>
                </div>
                <div class="aspect-video rounded-2xl overflow-hidden shadow-xl bg-black">
                    <iframe src="{{ $centre->virtualTourEmbedUrl() }}" class="w-full h-full" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen loading="lazy"></iframe>
                </div>
            </div>
        </section>
    @endif

    @if ($specialists->count())
        <section class="bg-mint-50 py-14">
            <div class="mx-auto max-w-7xl px-6">
                <h2 class="font-heading font-bold text-xl text-navy-600 mb-5">Specialists at This Centre</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                    @foreach ($specialists as $specialist)
                        <x-card.specialist :specialist="$specialist" :show-qualification="false" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if ($centre->galleryItems->count())
        <section class="mx-auto max-w-7xl px-6 py-14">
            <h2 class="font-heading font-bold text-xl text-navy-600 mb-5">Glimpses of {{ $centre->name }}</h2>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach ($centre->galleryItems->take(8) as $item)
                    <div class="group relative rounded-xl overflow-hidden aspect-[4/3]">
                        <x-media-image :model="$item" collection="image" conversion="thumb" :alt="$item->title" class="w-full h-full object-cover" />
                        @if ($item->title)
                            <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-navy-900/80 to-transparent p-2.5">
                                <span class="text-white text-xs font-medium">{{ $item->title }}</span>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
            @if ($centre->galleryItems->count() > 8)
                <a href="{{ route('gallery.index') }}" class="group/link mt-5 inline-flex items-center gap-1 text-teal-600 hover:text-teal-700 font-heading font-semibold text-sm">
                    View Full Photo Gallery <x-app-icon name="chevron-right" class="w-4 h-4 transition-transform duration-200 group-hover/link:translate-x-1" />
                </a>
            @endif
        </section>
    @endif

    <x-cta-banner
        title="Ready to Visit {{ $centre->name }}?"
        subtitle="Book an appointment today and experience expert ENT care."
    />
</x-layouts.app>
