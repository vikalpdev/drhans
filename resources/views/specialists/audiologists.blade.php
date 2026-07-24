<x-layouts.app title="Our Team of Audiologists" description="Meet the audiologists at Dr Hans' Centre for ENT, specialists in hearing assessment, cochlear implant rehabilitation and hearing aid fitting.">
    <x-hero
        title="Know Your Audiologist"
        subtitle="Meet our team of experienced audiologists dedicated to helping you hear better, backed by advanced diagnostics and personalised hearing care."
        :breadcrumbs="['Specialists' => route('specialists.index'), 'Audiologists' => null]"
    >
        <x-slot:stats>
            <span class="flex items-start gap-1.5"><x-app-icon name="ear" class="w-4 h-4 text-teal-500 shrink-0 mt-0.5" /> Expert Audiologists</span>
            <span class="flex items-start gap-1.5"><x-app-icon name="location" class="w-4 h-4 text-teal-500 shrink-0 mt-0.5" /> Multiple Centres</span>
        </x-slot:stats>
    </x-hero>

    <section x-data="{ centre: 'all' }" class="mx-auto max-w-7xl px-6 py-16">
        <div class="flex flex-nowrap sm:flex-wrap gap-2.5 mb-10 bg-mint-50 border border-navy-100 rounded-2xl p-2 w-full sm:w-fit overflow-x-auto sm:overflow-visible [&::-webkit-scrollbar]:hidden" style="scrollbar-width: none;">
            <button
                @click="centre = 'all'"
                :class="centre === 'all' ? 'bg-gradient-to-r from-navy-600 to-navy-700 text-white shadow-md shadow-navy-600/25' : 'bg-white text-navy-600 shadow-sm hover:text-teal-600'"
                class="shrink-0 inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-sm font-heading font-medium transition-colors duration-200"
            >
                <x-app-icon name="building" class="w-3.5 h-3.5" /> All Centres
            </button>
            @foreach ($centres as $c)
                <button
                    @click="centre = '{{ $c->slug }}'"
                    :class="centre === '{{ $c->slug }}' ? 'bg-gradient-to-r from-navy-600 to-navy-700 text-white shadow-md shadow-navy-600/25' : 'bg-white text-navy-600 shadow-sm hover:text-teal-600'"
                    class="shrink-0 inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-sm font-heading font-medium transition-colors duration-200"
                >
                    <x-app-icon name="location" class="w-3.5 h-3.5" /> {{ $c->name }}
                </button>
            @endforeach
        </div>

        @if ($audiologists->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @foreach ($audiologists as $specialist)
                    <div x-show="centre === 'all' || {{ collect($specialist->centres)->pluck('slug')->map(fn ($s) => "centre === '$s'")->implode(' || ') ?: 'false' }}" x-transition.opacity class="h-full">
                        <x-card.audiologist :specialist="$specialist" />
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-16 border-2 border-dashed border-navy-100 rounded-2xl">
                <x-app-icon name="ear" class="w-12 h-12 text-navy-200 mx-auto mb-3" />
                <p class="text-navy-500">Our audiologist team details are being updated. Please check back soon.</p>
            </div>
        @endif
    </section>

    <x-cta-banner
        title="Need a Hearing Assessment?"
        subtitle="Book a consultation with one of our expert audiologists today."
    />
</x-layouts.app>
