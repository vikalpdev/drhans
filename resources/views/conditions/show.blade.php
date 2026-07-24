<x-layouts.app :title="$condition->meta_title ?? $condition->name" :description="$condition->meta_description">
    <x-hero
        :title="$condition->name"
        :subtitle="$condition->summary"
        :breadcrumbs="['Conditions Treated' => route('conditions.index'), $condition->name => null]"
        :image-model="$condition"
        image-collection="hero_image"
    >
        <x-slot:stats>
            <span class="flex items-start gap-1.5"><x-app-icon name="user-group" class="w-4 h-4 text-teal-500 shrink-0 mt-0.5" /> Expert ENT Specialists</span>
            <span class="flex items-start gap-1.5"><x-app-icon name="diagnostic" class="w-4 h-4 text-teal-500 shrink-0 mt-0.5" /> Advanced Diagnostic Tools</span>
            <span class="flex items-start gap-1.5"><x-app-icon name="shield" class="w-4 h-4 text-teal-500 shrink-0 mt-0.5" /> Personalised Treatment Plans</span>
        </x-slot:stats>
    </x-hero>

    <section class="mx-auto max-w-7xl px-6 py-16">
        <div class="grid lg:grid-cols-[1fr_340px] gap-10" x-data="{ openSection: 'symptoms' }">
            <div class="space-y-8">
                @if ($condition->overview)
                    <div id="overview" class="bg-white rounded-2xl border border-navy-100 p-7 lg:p-8 scroll-mt-28">
                        <p class="inline-block text-teal-700 font-semibold text-xs tracking-widest uppercase bg-mint-100 px-3 py-1 rounded-full mb-2">Overview</p>
                        <h2 class="font-heading font-bold text-lg text-navy-600 mb-2">Understanding {{ $condition->name }}</h2>
                        <div class="space-y-3 [&>p]:text-sm [&>p]:text-navy-600 [&>p]:leading-relaxed [&_ul]:list-disc [&_ul]:pl-5 [&_ol]:list-decimal [&_ol]:pl-5 [&_strong]:font-semibold">
                            {!! $condition->overview !!}
                        </div>
                    </div>
                @endif

                @if (!empty($condition->symptoms) || !empty($condition->causes) || !empty($condition->diagnosis) || !empty($condition->treatment_options))
                    <div class="space-y-3">
                        @if (!empty($condition->symptoms))
                            <div id="symptoms" class="bg-white rounded-2xl border transition-colors duration-200 scroll-mt-28" :class="openSection === 'symptoms' ? 'border-teal-200 shadow-md' : 'border-navy-100'">
                                <button type="button" @click="openSection = (openSection === 'symptoms' ? null : 'symptoms')" class="w-full flex items-center justify-between gap-4 text-left p-6 lg:p-7">
                                    <span class="flex items-center gap-3">
                                        <span class="w-11 h-11 rounded-xl bg-gradient-to-br from-mint-50 to-teal-50 ring-1 ring-teal-100 flex items-center justify-center shrink-0">
                                            <x-app-icon name="eye" class="w-5 h-5 text-teal-600" />
                                        </span>
                                        <span class="font-heading font-bold text-base text-navy-600">Common Symptoms</span>
                                    </span>
                                    <span class="w-8 h-8 rounded-full flex items-center justify-center shrink-0 transition-colors duration-200" :class="openSection === 'symptoms' ? 'bg-teal-500 text-white' : 'bg-mint-100 text-teal-600'">
                                        <x-app-icon name="chevron-down" class="w-4 h-4 transition-transform duration-200" x-bind:class="openSection === 'symptoms' && 'rotate-180'" />
                                    </span>
                                </button>
                                <div x-show="openSection === 'symptoms'" x-cloak x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0">
                                    <div class="px-6 lg:px-7 pb-6 lg:pb-7">
                                        <ul class="grid sm:grid-cols-2 gap-y-0.5 gap-x-4">
                                            @foreach ($condition->symptoms as $item)
                                                <li class="flex items-start gap-2.5 text-sm text-navy-600 rounded-lg px-2 py-1.5 -mx-2 hover:bg-mint-50/60 transition-colors duration-200">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-teal-500 shrink-0 mt-2"></span>
                                                    {{ $item }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (!empty($condition->causes))
                            <div id="causes" class="bg-white rounded-2xl border transition-colors duration-200 scroll-mt-28" :class="openSection === 'causes' ? 'border-teal-200 shadow-md' : 'border-navy-100'">
                                <button type="button" @click="openSection = (openSection === 'causes' ? null : 'causes')" class="w-full flex items-center justify-between gap-4 text-left p-6 lg:p-7">
                                    <span class="flex items-center gap-3">
                                        <span class="w-11 h-11 rounded-xl bg-gradient-to-br from-mint-50 to-teal-50 ring-1 ring-teal-100 flex items-center justify-center shrink-0">
                                            <x-app-icon name="cog" class="w-5 h-5 text-teal-600" />
                                        </span>
                                        <span class="font-heading font-bold text-base text-navy-600">Causes &amp; Risk Factors</span>
                                    </span>
                                    <span class="w-8 h-8 rounded-full flex items-center justify-center shrink-0 transition-colors duration-200" :class="openSection === 'causes' ? 'bg-teal-500 text-white' : 'bg-mint-100 text-teal-600'">
                                        <x-app-icon name="chevron-down" class="w-4 h-4 transition-transform duration-200" x-bind:class="openSection === 'causes' && 'rotate-180'" />
                                    </span>
                                </button>
                                <div x-show="openSection === 'causes'" x-cloak x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0">
                                    <div class="px-6 lg:px-7 pb-6 lg:pb-7">
                                        <ul class="grid sm:grid-cols-2 gap-y-0.5 gap-x-4">
                                            @foreach ($condition->causes as $item)
                                                <li class="flex items-start gap-2.5 text-sm text-navy-600 rounded-lg px-2 py-1.5 -mx-2 hover:bg-mint-50/60 transition-colors duration-200">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-teal-500 shrink-0 mt-2"></span>
                                                    {{ $item }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (!empty($condition->diagnosis))
                            <div id="diagnosis" class="bg-white rounded-2xl border transition-colors duration-200 scroll-mt-28" :class="openSection === 'diagnosis' ? 'border-teal-200 shadow-md' : 'border-navy-100'">
                                <button type="button" @click="openSection = (openSection === 'diagnosis' ? null : 'diagnosis')" class="w-full flex items-center justify-between gap-4 text-left p-6 lg:p-7">
                                    <span class="flex items-center gap-3">
                                        <span class="w-11 h-11 rounded-xl bg-gradient-to-br from-mint-50 to-teal-50 ring-1 ring-teal-100 flex items-center justify-center shrink-0">
                                            <x-app-icon name="diagnostic" class="w-5 h-5 text-teal-600" />
                                        </span>
                                        <span class="font-heading font-bold text-base text-navy-600">Diagnosis</span>
                                    </span>
                                    <span class="w-8 h-8 rounded-full flex items-center justify-center shrink-0 transition-colors duration-200" :class="openSection === 'diagnosis' ? 'bg-teal-500 text-white' : 'bg-mint-100 text-teal-600'">
                                        <x-app-icon name="chevron-down" class="w-4 h-4 transition-transform duration-200" x-bind:class="openSection === 'diagnosis' && 'rotate-180'" />
                                    </span>
                                </button>
                                <div x-show="openSection === 'diagnosis'" x-cloak x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0">
                                    <div class="px-6 lg:px-7 pb-6 lg:pb-7">
                                        <ul class="grid sm:grid-cols-2 gap-y-0.5 gap-x-4">
                                            @foreach ($condition->diagnosis as $item)
                                                <li class="flex items-start gap-2.5 text-sm text-navy-600 rounded-lg px-2 py-1.5 -mx-2 hover:bg-mint-50/60 transition-colors duration-200">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-teal-500 shrink-0 mt-2"></span>
                                                    {{ $item }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (!empty($condition->treatment_options))
                            <div id="treatment" class="bg-white rounded-2xl border transition-colors duration-200 scroll-mt-28" :class="openSection === 'treatment' ? 'border-teal-200 shadow-md' : 'border-navy-100'">
                                <button type="button" @click="openSection = (openSection === 'treatment' ? null : 'treatment')" class="w-full flex items-center justify-between gap-4 text-left p-6 lg:p-7">
                                    <span class="flex items-center gap-3">
                                        <span class="w-11 h-11 rounded-xl bg-gradient-to-br from-mint-50 to-teal-50 ring-1 ring-teal-100 flex items-center justify-center shrink-0">
                                            <x-app-icon name="briefcase" class="w-5 h-5 text-teal-600" />
                                        </span>
                                        <span class="font-heading font-bold text-base text-navy-600">Treatment Options</span>
                                    </span>
                                    <span class="w-8 h-8 rounded-full flex items-center justify-center shrink-0 transition-colors duration-200" :class="openSection === 'treatment' ? 'bg-teal-500 text-white' : 'bg-mint-100 text-teal-600'">
                                        <x-app-icon name="chevron-down" class="w-4 h-4 transition-transform duration-200" x-bind:class="openSection === 'treatment' && 'rotate-180'" />
                                    </span>
                                </button>
                                <div x-show="openSection === 'treatment'" x-cloak x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0">
                                    <div class="px-6 lg:px-7 pb-6 lg:pb-7">
                                        <ul class="grid sm:grid-cols-2 gap-y-0.5 gap-x-4">
                                            @foreach ($condition->treatment_options as $item)
                                                <li class="flex items-start gap-2.5 text-sm text-navy-600 rounded-lg px-2 py-1.5 -mx-2 hover:bg-mint-50/60 transition-colors duration-200">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-teal-500 shrink-0 mt-2"></span>
                                                    {{ $item }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                @endif

                @if ($condition->prevention)
                    <div id="prevention" class="bg-white rounded-2xl border transition-colors duration-200 scroll-mt-28" :class="openSection === 'prevention' ? 'border-teal-200 shadow-md' : 'border-navy-100'">
                        <button type="button" @click="openSection = (openSection === 'prevention' ? null : 'prevention')" class="w-full flex items-center justify-between gap-4 text-left p-6 lg:p-7">
                            <span class="flex items-center gap-3">
                                <span class="w-11 h-11 rounded-xl bg-gradient-to-br from-mint-50 to-teal-50 ring-1 ring-teal-100 flex items-center justify-center shrink-0">
                                    <x-app-icon name="shield" class="w-5 h-5 text-teal-600" />
                                </span>
                                <span class="font-heading font-bold text-base text-navy-600">Prevention</span>
                            </span>
                            <span class="w-8 h-8 rounded-full flex items-center justify-center shrink-0 transition-colors duration-200" :class="openSection === 'prevention' ? 'bg-teal-500 text-white' : 'bg-mint-100 text-teal-600'">
                                <x-app-icon name="chevron-down" class="w-4 h-4 transition-transform duration-200" x-bind:class="openSection === 'prevention' && 'rotate-180'" />
                            </span>
                        </button>
                        <div x-show="openSection === 'prevention'" x-cloak x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0">
                            <div class="px-6 lg:px-7 pb-6 lg:pb-7 space-y-3 [&>p]:text-sm [&>p]:text-navy-600 [&>p]:leading-relaxed [&_ul]:list-disc [&_ul]:pl-5 [&_ol]:list-decimal [&_ol]:pl-5 [&_strong]:font-semibold">
                                {!! $condition->prevention !!}
                            </div>
                        </div>
                    </div>
                @endif

                @if ($condition->why_choose_us)
                    <div id="why-choose-us" class="bg-white rounded-2xl border transition-colors duration-200 scroll-mt-28" :class="openSection === 'why-choose-us' ? 'border-teal-200 shadow-md' : 'border-navy-100'">
                        <button type="button" @click="openSection = (openSection === 'why-choose-us' ? null : 'why-choose-us')" class="w-full flex items-center justify-between gap-4 text-left p-6 lg:p-7">
                            <span class="flex items-center gap-3">
                                <span class="w-11 h-11 rounded-xl bg-gradient-to-br from-mint-50 to-teal-50 ring-1 ring-teal-100 flex items-center justify-center shrink-0">
                                    <x-app-icon name="award" class="w-5 h-5 text-teal-600" />
                                </span>
                                <span class="font-heading font-bold text-base text-navy-600">Why Choose Dr Hans' Centre for ENT?</span>
                            </span>
                            <span class="w-8 h-8 rounded-full flex items-center justify-center shrink-0 transition-colors duration-200" :class="openSection === 'why-choose-us' ? 'bg-teal-500 text-white' : 'bg-mint-100 text-teal-600'">
                                <x-app-icon name="chevron-down" class="w-4 h-4 transition-transform duration-200" x-bind:class="openSection === 'why-choose-us' && 'rotate-180'" />
                            </span>
                        </button>
                        <div x-show="openSection === 'why-choose-us'" x-cloak x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0">
                            <div class="px-6 lg:px-7 pb-6 lg:pb-7 space-y-3 [&>p]:text-sm [&>p]:text-navy-600 [&>p]:leading-relaxed [&_ul]:list-disc [&_ul]:pl-5 [&_ol]:list-decimal [&_ol]:pl-5 [&_strong]:font-semibold">
                                {!! $condition->why_choose_us !!}
                            </div>
                        </div>
                    </div>
                @endif

                @if (!empty($condition->when_to_see_doctor))
                    <div id="when-to-see-doctor" class="relative rounded-2xl bg-gradient-to-br from-navy-600 to-navy-700 p-6 lg:p-7 overflow-hidden scroll-mt-28">
                        <div class="absolute -top-12 -right-12 w-40 h-40 bg-teal-500/20 rounded-full blur-2xl"></div>
                        <div class="relative flex gap-5">
                            <div class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center shrink-0">
                                <x-app-icon name="heart" class="w-6 h-6 text-teal-300" />
                            </div>
                            <div class="flex-1">
                                <h2 class="font-heading font-bold text-lg text-white mb-3">When to See a Doctor</h2>
                                <ul class="grid sm:grid-cols-2 gap-y-2 gap-x-4">
                                    @foreach ($condition->when_to_see_doctor as $item)
                                        <li class="flex items-center gap-2 text-sm text-navy-100">
                                            <x-app-icon name="check-circle" class="w-4 h-4 text-teal-300 shrink-0" /> {{ $item }}
                                        </li>
                                    @endforeach
                                </ul>
                                <a href="{{ route('appointment.create') }}" class="mt-5 inline-flex items-center gap-2 bg-gradient-to-r from-teal-500 to-teal-600 hover:from-teal-600 hover:to-teal-700 text-white font-heading font-semibold px-5 py-2.5 rounded-full text-sm shadow-md shadow-teal-500/30 hover:shadow-lg transition-all duration-200">
                                    <x-app-icon name="calendar" class="w-4 h-4" /> Book an Appointment Now
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <aside class="space-y-6 self-start">
                @php
                    $jumpLinks = collect([
                        'overview' => 'Overview',
                        'symptoms' => 'Symptoms',
                        'causes' => 'Causes & Risk Factors',
                        'diagnosis' => 'Diagnosis',
                        'treatment' => 'Treatment Options',
                        'prevention' => 'Prevention',
                        'why-choose-us' => 'Why Choose Us',
                        'when-to-see-doctor' => 'When to See a Doctor',
                    ])->filter(fn ($label, $key) => match ($key) {
                        'overview' => (bool) $condition->overview,
                        'symptoms' => !empty($condition->symptoms),
                        'causes' => !empty($condition->causes),
                        'diagnosis' => !empty($condition->diagnosis),
                        'treatment' => !empty($condition->treatment_options),
                        'prevention' => (bool) $condition->prevention,
                        'why-choose-us' => (bool) $condition->why_choose_us,
                        'when-to-see-doctor' => !empty($condition->when_to_see_doctor),
                        default => false,
                    });
                @endphp

                @if ($jumpLinks->count() > 1)
                    <div class="hidden lg:block bg-white rounded-2xl border border-navy-100 p-5">
                        <h3 class="font-heading font-bold text-navy-600 mb-3 text-sm">On This Page</h3>
                        <ul class="space-y-1">
                            @foreach ($jumpLinks as $id => $label)
                                <li>
                                    <a
                                        href="#{{ $id }}"
                                        @if (in_array($id, ['symptoms', 'causes', 'diagnosis', 'treatment', 'prevention', 'why-choose-us'])) @click="openSection = '{{ $id }}'" @endif
                                        class="flex items-center gap-2 text-sm text-navy-500 hover:text-teal-600 py-1.5 px-2 rounded-lg hover:bg-mint-50 transition-colors duration-200"
                                    >
                                        <x-app-icon name="chevron-right" class="w-3.5 h-3.5 text-teal-500 shrink-0" /> {{ $label }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <x-booking-widget :centres="$centres" :specialists="$specialists" />

                <div class="bg-mint-50 rounded-2xl p-6">
                    <h3 class="font-heading font-bold text-navy-600 mb-2">Need Help?</h3>
                    <p class="text-sm text-navy-500 mb-4">Talk to our care team for guidance.</p>
                    <a href="{{ \App\Models\Setting::current()->phoneUrl() }}" class="inline-flex w-full items-center justify-center gap-2 border-2 border-teal-500 text-teal-700 hover:bg-teal-500 hover:text-white font-heading font-semibold px-4 py-2.5 rounded-full text-sm transition-colors duration-200">
                        <x-app-icon name="phone" class="w-4 h-4" /> Talk to Our Care Team
                    </a>
                </div>

                @if ($otherConditions->count())
                    <div class="bg-white rounded-2xl shadow-sm p-6">
                        <h3 class="font-heading font-bold text-navy-600 mb-3">Explore Other Conditions</h3>
                        <ul class="space-y-1">
                            @foreach ($otherConditions as $other)
                                <li>
                                    <a href="{{ route('conditions.show', $other) }}" class="flex items-center justify-between gap-2 text-sm text-navy-600 hover:text-teal-600 py-2 px-2 rounded-lg hover:bg-mint-50 transition-colors duration-200">
                                        <span class="flex items-center gap-2">
                                            <x-app-icon :name="$other->icon ?: 'heart'" class="w-4 h-4 text-teal-500 shrink-0" /> {{ $other->name }}
                                        </span>
                                        <x-app-icon name="chevron-right" class="w-3.5 h-3.5 text-navy-300 shrink-0" />
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <a href="{{ route('conditions.index') }}" class="mt-3 inline-flex items-center justify-center w-full border border-teal-500 text-teal-700 hover:bg-teal-500 hover:text-white font-heading font-semibold px-4 py-2.5 rounded-full text-sm transition-colors duration-200">
                            View All Conditions
                        </a>
                    </div>
                @endif
            </aside>
        </div>
    </section>

    @if (!empty($condition->faqs))
        <section class="bg-mint-50 py-16" x-data="{ openFaq: 0 }">
            <div class="mx-auto max-w-4xl px-6">
            <div class="text-center mb-10">
                <p class="inline-block text-teal-700 font-semibold text-xs tracking-widest uppercase bg-white px-3 py-1 rounded-full shadow-sm">Common Questions</p>
                <h2 class="font-heading font-bold text-2xl lg:text-3xl text-navy-600 mt-3">Frequently Asked Questions</h2>
            </div>
            <div class="space-y-3">
                @foreach ($condition->faqs as $i => $faq)
                    <div class="bg-white rounded-2xl border transition-colors duration-200" :class="openFaq === {{ $i }} ? 'border-teal-200 shadow-md' : 'border-navy-100'">
                        <button
                            type="button"
                            @click="openFaq = (openFaq === {{ $i }} ? null : {{ $i }})"
                            class="w-full flex items-center justify-between gap-4 text-left px-6 py-4"
                        >
                            <span class="font-heading font-semibold text-navy-600 text-sm lg:text-base">{{ $faq['question'] }}</span>
                            <span class="w-8 h-8 rounded-full flex items-center justify-center shrink-0 transition-colors duration-200" :class="openFaq === {{ $i }} ? 'bg-teal-500 text-white' : 'bg-mint-100 text-teal-600'">
                                <x-app-icon name="chevron-down" class="w-4 h-4 transition-transform duration-200" x-bind:class="openFaq === {{ $i }} && 'rotate-180'" />
                            </span>
                        </button>
                        <div x-show="openFaq === {{ $i }}" x-cloak x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0">
                            <p class="px-6 pb-5 text-sm text-navy-500 leading-relaxed">{{ $faq['answer'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            </div>
        </section>
    @endif

    <x-cta-banner
        title="We're Here to Help You Hear Better"
        subtitle="Our experts are ready to help you with accurate diagnosis and the right treatment."
    />
</x-layouts.app>
