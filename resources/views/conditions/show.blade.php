<x-layouts.app :title="$condition->name">
    <x-hero
        :title="$condition->name"
        :subtitle="$condition->overview ?? $condition->summary"
        :breadcrumbs="['Conditions Treated' => route('conditions.index'), $condition->name => null]"
    >
        <x-slot:stats>
            <span class="flex items-center gap-1.5"><x-app-icon name="user-group" class="w-4 h-4 text-teal-500" /> Expert ENT Specialists</span>
            <span class="flex items-center gap-1.5"><x-app-icon name="diagnostic" class="w-4 h-4 text-teal-500" /> Advanced Diagnostic Tools</span>
            <span class="flex items-center gap-1.5"><x-app-icon name="shield" class="w-4 h-4 text-teal-500" /> Personalised Treatment Plans</span>
        </x-slot:stats>
    </x-hero>

    <section class="mx-auto max-w-7xl px-6 py-16">
        <div class="grid lg:grid-cols-[1fr_340px] gap-10">
            <div>
                @if ($condition->overview)
                    <div class="flex gap-5 pb-8 border-b border-navy-100">
                        <div class="w-12 h-12 rounded-full bg-mint-50 flex items-center justify-center shrink-0">
                            <x-app-icon :name="$condition->icon ?: 'heart'" class="w-6 h-6 text-teal-600" />
                        </div>
                        <div>
                            <h2 class="font-heading font-bold text-lg text-navy-600 mb-2">Overview</h2>
                            <p class="text-sm text-navy-600 leading-relaxed">{{ $condition->overview }}</p>
                        </div>
                    </div>
                @endif

                @if (!empty($condition->symptoms))
                    <div class="flex gap-5 py-8 border-b border-navy-100">
                        <div class="w-12 h-12 rounded-full bg-mint-50 flex items-center justify-center shrink-0">
                            <x-app-icon name="voice" class="w-6 h-6 text-teal-600" />
                        </div>
                        <div class="flex-1">
                            <h2 class="font-heading font-bold text-lg text-navy-600 mb-3">Common Symptoms</h2>
                            <ul class="grid sm:grid-cols-2 gap-y-2 gap-x-4">
                                @foreach ($condition->symptoms as $item)
                                    <li class="flex items-center gap-2 text-sm text-navy-600">
                                        <x-app-icon name="check-circle" class="w-4 h-4 text-teal-500 shrink-0" /> {{ $item }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                @if (!empty($condition->causes))
                    <div class="flex gap-5 py-8 border-b border-navy-100">
                        <div class="w-12 h-12 rounded-full bg-mint-50 flex items-center justify-center shrink-0">
                            <x-app-icon name="cog" class="w-6 h-6 text-teal-600" />
                        </div>
                        <div class="flex-1">
                            <h2 class="font-heading font-bold text-lg text-navy-600 mb-3">Causes</h2>
                            <ul class="grid sm:grid-cols-2 gap-y-2 gap-x-4">
                                @foreach ($condition->causes as $item)
                                    <li class="flex items-center gap-2 text-sm text-navy-600">
                                        <x-app-icon name="check-circle" class="w-4 h-4 text-teal-500 shrink-0" /> {{ $item }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                @if (!empty($condition->treatment_options))
                    <div class="flex gap-5 py-8 border-b border-navy-100">
                        <div class="w-12 h-12 rounded-full bg-mint-50 flex items-center justify-center shrink-0">
                            <x-app-icon name="briefcase" class="w-6 h-6 text-teal-600" />
                        </div>
                        <div class="flex-1">
                            <h2 class="font-heading font-bold text-lg text-navy-600 mb-3">Treatment Options</h2>
                            <ul class="grid sm:grid-cols-2 gap-y-2 gap-x-4">
                                @foreach ($condition->treatment_options as $item)
                                    <li class="flex items-center gap-2 text-sm text-navy-600">
                                        <x-app-icon name="check-circle" class="w-4 h-4 text-teal-500 shrink-0" /> {{ $item }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                @if (!empty($condition->when_to_see_doctor))
                    <div class="relative mt-8 rounded-2xl bg-gradient-to-br from-navy-600 to-navy-700 p-6 lg:p-7 overflow-hidden">
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

            <aside class="space-y-6">
                <x-booking-widget :centres="$centres" />

                <div class="bg-mint-50 rounded-2xl p-6">
                    <h3 class="font-heading font-bold text-navy-600 mb-2">Need Help?</h3>
                    <p class="text-sm text-navy-500 mb-4">Talk to our care team for guidance.</p>
                    <a href="tel:+919876543210" class="inline-flex w-full items-center justify-center gap-2 border-2 border-teal-500 text-teal-700 hover:bg-teal-500 hover:text-white font-heading font-semibold px-4 py-2.5 rounded-full text-sm transition-colors duration-200">
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

    <x-cta-banner
        title="We're Here to Help You Hear Better"
        subtitle="Our experts are ready to help you with accurate diagnosis and the right treatment."
    />
</x-layouts.app>
