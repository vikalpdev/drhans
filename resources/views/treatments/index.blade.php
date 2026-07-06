<x-layouts.app title="Treatments">
    <x-hero
        title="Comprehensive ENT Care for Every Age"
        subtitle="From advanced diagnostics to world-class treatments and rehabilitation, we offer complete ENT care under one roof."
        :breadcrumbs="['Treatments' => null]"
    >
        <x-slot:stats>
            @foreach ([
                ['user-group', 'Expert Specialists'],
                ['cog', 'Advanced Technology'],
                ['heart', 'Patient-first Approach'],
                ['check-circle', 'End-to-End Care'],
            ] as [$icon, $s])
                <span class="flex items-center gap-1.5"><x-app-icon :name="$icon" class="w-4 h-4 text-teal-500" /> {{ $s }}</span>
            @endforeach
        </x-slot:stats>
    </x-hero>

    <section class="relative bg-gradient-to-br from-navy-600 to-navy-700 py-16 overflow-hidden">
        <div class="absolute -top-24 -right-24 w-80 h-80 bg-teal-500/15 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-72 h-72 bg-teal-500/10 rounded-full blur-3xl"></div>

        <div class="relative mx-auto max-w-7xl px-6">
            <div class="text-center mb-10" data-reveal>
                <p class="inline-block text-teal-300 font-semibold text-xs tracking-widest uppercase bg-white/10 px-3 py-1 rounded-full">Our Services</p>
                <h2 class="font-heading font-bold text-2xl lg:text-3xl text-white mt-3">Explore Our ENT Specialities</h2>
                <p class="text-sm text-navy-100 mt-2 max-w-xl mx-auto">Every treatment is backed by advanced technology and a multidisciplinary team focused on long-term outcomes.</p>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($treatments as $treatment)
                    <div data-reveal style="--reveal-delay: {{ ($loop->index % 4) * 0.05 }}s">
                        <x-card.treatment :treatment="$treatment" />
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="relative bg-mint-50 py-16 overflow-hidden">
        <div class="absolute -top-20 -left-20 w-72 h-72 bg-teal-200/25 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -right-24 w-72 h-72 bg-navy-200/15 rounded-full blur-3xl"></div>

        <div class="relative mx-auto max-w-7xl px-6 grid lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-lg p-8 flex flex-col sm:flex-row items-start sm:items-center gap-6">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-teal-500 to-teal-600 flex items-center justify-center shrink-0">
                    <x-app-icon name="calendar" class="w-7 h-7 text-white" />
                </div>
                <div>
                    <p class="text-xs font-semibold text-teal-600 uppercase tracking-wide">Not sure which treatment is right for you?</p>
                    <h3 class="font-heading font-bold text-navy-600 text-xl mt-1">Book a Consultation</h3>
                    <p class="text-sm text-navy-500 mt-1">Our specialists will guide you with the best treatment plan for your condition.</p>
                    <div class="flex flex-wrap gap-3 mt-4">
                        <a href="{{ route('appointment.create') }}" class="group inline-flex items-center gap-2 bg-gradient-to-r from-navy-600 to-navy-700 hover:from-navy-700 hover:to-navy-800 text-white font-heading font-semibold px-5 py-2.5 rounded-full text-sm shadow-md shadow-navy-600/20 hover:shadow-lg transition-all duration-200">
                            <x-app-icon name="calendar" class="w-4 h-4 transition-transform duration-200 group-hover:scale-110" /> Book Appointment
                        </a>
                        <a href="{{ route('centres.index') }}" class="group inline-flex items-center gap-2 border-2 border-navy-200 text-navy-700 hover:border-teal-500 hover:text-teal-600 font-heading font-semibold px-5 py-2.5 rounded-full text-sm transition-colors duration-200">
                            <x-app-icon name="location" class="w-4 h-4" /> Find a Centre
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-navy-600 rounded-2xl p-8 flex flex-col justify-center text-white">
                <x-app-icon name="whatsapp" class="w-8 h-8 text-teal-300 mb-3" />
                <h3 class="font-heading font-bold text-lg">Prefer to Talk First?</h3>
                <p class="text-sm text-navy-200 mt-1 mb-4">Chat with our care team on WhatsApp for quick guidance.</p>
                <a href="https://wa.me/919876543210" target="_blank" class="group inline-flex w-fit items-center gap-2 bg-white hover:bg-teal-50 text-teal-700 font-heading font-semibold px-5 py-2.5 rounded-full text-sm shadow-md transition-all duration-200">
                    <x-app-icon name="whatsapp" class="w-4 h-4 transition-transform duration-200 group-hover:scale-110" /> Chat With Us
                </a>
            </div>
        </div>
    </section>
</x-layouts.app>
