<x-layouts.app title="Our Specialists">
    <x-hero
        title="Our Specialists"
        subtitle="Our team of experienced ENT surgeons, audiologists, speech therapists and support specialists work together to deliver the best outcomes for our patients."
        :breadcrumbs="['Specialists' => null]"
    >
        <x-slot:stats>
            @foreach ([
                ['user-group', '9', 'Expert Specialists'],
                ['location', '6', 'Centres Across India'],
                ['heart', '50,000+', 'Patients Treated'],
                ['ear-implant', '3500+', 'Cochlear Implants'],
            ] as [$icon, $stat, $label])
                <span class="flex items-center gap-1.5">
                    <x-app-icon :name="$icon" class="w-4 h-4 text-teal-500 shrink-0" />
                    <strong class="text-navy-600">{{ $stat }}</strong> {{ $label }}
                </span>
            @endforeach
        </x-slot:stats>
    </x-hero>

    <section x-data="{ centre: 'all' }" class="mx-auto max-w-7xl px-6 py-16">
        <div class="flex flex-wrap gap-2.5 mb-10 bg-mint-50 border border-navy-100 rounded-full p-2">
            <button
                @click="centre = 'all'"
                :class="centre === 'all' ? 'bg-gradient-to-r from-navy-600 to-navy-700 text-white shadow-md shadow-navy-600/25' : 'bg-white text-navy-600 shadow-sm hover:text-teal-600'"
                class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-sm font-heading font-medium transition-colors duration-200"
            >
                <x-app-icon name="building" class="w-3.5 h-3.5" /> All Centres
            </button>
            @foreach ($centres as $c)
                <button
                    @click="centre = '{{ $c->slug }}'"
                    :class="centre === '{{ $c->slug }}' ? 'bg-gradient-to-r from-navy-600 to-navy-700 text-white shadow-md shadow-navy-600/25' : 'bg-white text-navy-600 shadow-sm hover:text-teal-600'"
                    class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-sm font-heading font-medium transition-colors duration-200"
                >
                    <x-app-icon name="location" class="w-3.5 h-3.5" /> {{ $c->name }}
                </button>
            @endforeach
        </div>

        <div class="flex items-center gap-3 mb-6">
            <h2 class="font-heading font-bold text-xl text-navy-600">ENT Surgeons</h2>
            <span class="text-xs font-semibold text-teal-600 bg-mint-100 px-2.5 py-1 rounded-full">{{ $surgeons->count() }}</span>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-14">
            @foreach ($surgeons as $specialist)
                <div x-show="centre === 'all' || {{ collect($specialist->centres)->pluck('slug')->map(fn ($s) => "centre === '$s'")->implode(' || ') ?: 'false' }}" x-transition.opacity>
                    <x-card.specialist :specialist="$specialist" :show-qualification="false" />
                </div>
            @endforeach
        </div>
    </section>

    <section class="relative bg-gradient-to-br from-navy-600 to-navy-700 py-16 overflow-hidden">
        <div class="absolute -top-24 -right-24 w-80 h-80 bg-teal-500/15 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-72 h-72 bg-teal-500/10 rounded-full blur-3xl"></div>

        <div class="relative mx-auto max-w-7xl px-6 grid lg:grid-cols-2 gap-10 items-center">
            <div>
                <p class="inline-block text-teal-300 font-semibold text-xs tracking-widest uppercase bg-white/10 px-3 py-1 rounded-full">Why Our Specialists</p>
                <h3 class="font-heading font-bold text-2xl text-white mt-2 mb-5">Expertise You Can Trust</h3>
                <ul class="space-y-1.5">
                    @foreach ([
                        ['award', 'Highly experienced & renowned specialists'],
                        ['user-group', 'Multidisciplinary approach for accurate diagnosis'],
                        ['building', 'Advanced technology & world-class infrastructure'],
                        ['heart', 'Personalised treatment & long-term care'],
                    ] as [$icon, $item])
                        <li class="group flex items-center gap-3 p-3 rounded-xl hover:bg-white/10 transition-colors duration-200" data-reveal style="--reveal-delay: {{ $loop->index * 0.06 }}s">
                            <div class="w-9 h-9 rounded-lg bg-white/10 group-hover:bg-teal-500 flex items-center justify-center shrink-0 transition-colors duration-200">
                                <x-app-icon :name="$icon" class="w-4 h-4 text-teal-300 group-hover:text-white transition-colors duration-200" />
                            </div>
                            <span class="text-sm text-navy-100 font-medium">{{ $item }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="bg-white rounded-2xl shadow-xl shadow-navy-900/20 p-8" data-reveal>
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-teal-500 to-teal-600 flex items-center justify-center mb-5">
                    <x-app-icon name="phone" class="w-7 h-7 text-white" />
                </div>
                <h3 class="font-heading font-bold text-navy-600 text-xl mb-2">Need help choosing the right specialist?</h3>
                <p class="text-sm text-navy-500 mb-5">Our care team is here to help you find the right doctor for your condition.</p>
                <a href="{{ \App\Models\Setting::current()->phoneUrl() }}" class="group inline-flex items-center gap-2 bg-gradient-to-r from-navy-600 to-navy-700 hover:from-navy-700 hover:to-navy-800 text-white font-heading font-semibold px-5 py-2.5 rounded-full text-sm shadow-md shadow-navy-600/20 hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200">
                    <x-app-icon name="phone" class="w-4 h-4 transition-transform duration-200 group-hover:scale-110" /> Talk to Our Care Team
                </a>
            </div>
        </div>
    </section>

    <x-cta-banner />
</x-layouts.app>
