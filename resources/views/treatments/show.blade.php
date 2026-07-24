<x-layouts.app :title="$treatment->meta_title ?? $treatment->name" :description="$treatment->meta_description">
    <x-hero
        :title="$treatment->name"
        :subtitle="$treatment->overview ?? $treatment->summary"
        :breadcrumbs="['Speciality Service' => route('treatments.index'), $treatment->name => null]"
        :image-model="$treatment"
        image-collection="hero_image"
    >
        <x-slot:actions>
            <a href="{{ route('appointment.create') }}" class="group inline-flex items-center gap-2 bg-gradient-to-r from-navy-600 to-navy-700 hover:from-navy-700 hover:to-navy-800 text-white font-heading font-semibold px-5 py-2.5 rounded-full text-sm shadow-md shadow-navy-600/20 hover:shadow-lg transition-all duration-200">
                <x-app-icon name="calendar" class="w-4 h-4 transition-transform duration-200 group-hover:scale-110" /> Book Consultation
            </a>
            <a href="{{ route('centres.index') }}" class="inline-flex items-center gap-2 border-2 border-navy-200 text-navy-700 hover:border-teal-500 hover:text-teal-600 font-heading font-semibold px-5 py-2.5 rounded-full text-sm transition-colors duration-200">
                <x-app-icon name="location" class="w-4 h-4" /> Find a Centre
            </a>
        </x-slot:actions>
    </x-hero>

    @if ($treatment->details)
        <section class="mx-auto max-w-7xl px-6 py-16">
            <div class="grid lg:grid-cols-[1fr_320px] gap-8">
                <div class="bg-white rounded-2xl border border-navy-100 p-8">
                    <p class="inline-block text-teal-700 font-semibold text-xs tracking-widest uppercase bg-mint-100 px-3 py-1 rounded-full">About the Treatment</p>
                    <h2 class="font-heading font-bold text-xl lg:text-2xl text-navy-600 mt-2 mb-5">Understanding {{ $treatment->name }}</h2>
                    <div class="space-y-4 [&>p]:text-sm [&>p]:text-navy-600 [&>p]:leading-relaxed [&_ul]:list-disc [&_ul]:pl-5 [&_ul]:mb-2 [&_ol]:list-decimal [&_ol]:pl-5 [&_ol]:mb-2 [&_strong]:font-semibold [&_a]:text-teal-600 [&_a]:underline">
                        {!! $treatment->details !!}
                    </div>
                </div>

                <aside>
                    <div class="bg-gradient-to-br from-navy-600 to-navy-700 rounded-2xl p-7 text-white lg:sticky lg:top-32">
                        <x-app-icon :name="$treatment->icon ?? 'heart'" class="w-9 h-9 text-teal-300 mb-4" />
                        <h3 class="font-heading font-bold">Why Choose Dr Hans' Centre?</h3>
                        <ul class="mt-4 space-y-2.5">
                            @foreach ($treatment->why_choose_us ?? ['Led by Padma Shri Dr. J. M. Hans', 'Complete care under one roof', 'Long-term rehabilitation support'] as $point)
                                <li class="flex items-start gap-2.5 text-sm text-navy-100">
                                    <x-app-icon name="check-circle" class="w-4 h-4 text-teal-300 shrink-0 mt-0.5" /> {{ $point }}
                                </li>
                            @endforeach
                        </ul>
                        <div class="mt-5 pt-5 border-t border-white/10 space-y-3">
                            <a href="{{ route('specialists.index') }}" class="group inline-flex items-center gap-1 text-teal-300 hover:text-teal-200 font-heading font-semibold text-sm transition-colors">
                                Meet Our Specialists <x-app-icon name="chevron-right" class="w-4 h-4 transition-transform duration-200 group-hover:translate-x-1" />
                            </a>
                            <a href="{{ \App\Models\Setting::current()->phoneUrl() }}" class="flex items-center gap-2 text-sm text-navy-100 hover:text-white transition-colors">
                                <x-app-icon name="phone" class="w-4 h-4 text-teal-300" /> {{ \App\Models\Setting::current()->phone }}
                            </a>
                        </div>
                    </div>
                </aside>
            </div>
        </section>
    @endif

    @if (!empty($treatment->services))
        <section class="bg-mint-50/60 py-16">
            <div class="mx-auto max-w-5xl px-6">
                <div class="text-center mb-12" data-reveal>
                    <p class="inline-block text-teal-700 font-semibold text-xs tracking-widest uppercase bg-white px-3 py-1 rounded-full shadow-sm">What We Offer</p>
                    <h2 class="font-heading font-bold text-2xl lg:text-3xl text-navy-600 mt-3">Our {{ $treatment->name }} Services</h2>
                </div>
                <div class="divide-y divide-navy-100 bg-white rounded-2xl border border-navy-100 shadow-sm overflow-hidden">
                    @foreach ($treatment->services as $i => $service)
                        <div class="group flex flex-col sm:flex-row gap-5 sm:gap-8 p-7 lg:p-8 hover:bg-mint-50/50 transition-colors duration-300" data-reveal style="--reveal-delay: {{ $i * 0.05 }}s">
                            <div class="flex sm:flex-col items-center sm:items-start gap-3 sm:gap-4 sm:w-16 shrink-0">
                                <span class="font-heading font-extrabold text-2xl text-mint-200 group-hover:text-teal-200 transition-colors duration-300 select-none">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                <div class="w-11 h-11 rounded-xl bg-mint-100 group-hover:bg-teal-500 flex items-center justify-center transition-colors duration-300 shrink-0">
                                    <x-app-icon :name="$treatment->icon ?? 'heart'" class="w-5 h-5 text-teal-600 group-hover:text-white transition-colors duration-300" />
                                </div>
                            </div>
                            <div>
                                <h3 class="font-heading font-bold text-lg text-navy-600 mb-2">{{ $service['title'] }}</h3>
                                <div class="text-sm text-navy-500 leading-relaxed [&>p]:mb-2 [&>p:last-child]:mb-0 [&_ul]:list-disc [&_ul]:pl-5 [&_ul]:mb-2 [&_ol]:list-decimal [&_ol]:pl-5 [&_ol]:mb-2 [&_strong]:font-semibold [&_a]:text-teal-600 [&_a]:underline">{!! $service['description'] !!}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if (!empty($treatment->process_steps))
        <section class="relative bg-gradient-to-br from-navy-600 to-navy-700 py-16 overflow-hidden">
            <div class="absolute -top-24 -right-24 w-80 h-80 bg-teal-500/15 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-24 -left-24 w-72 h-72 bg-teal-500/10 rounded-full blur-3xl"></div>

            <div class="relative mx-auto max-w-7xl px-6">
                <div class="text-center mb-10" data-reveal>
                    <p class="inline-block text-teal-300 font-semibold text-xs tracking-widest uppercase bg-white/10 px-3 py-1 rounded-full">Your Journey With Us</p>
                    <h2 class="font-heading font-bold text-2xl lg:text-3xl text-white mt-3">Comprehensive Care at Every Step</h2>
                </div>
                @php $stepCols = ['1' => 'lg:grid-cols-1', '2' => 'lg:grid-cols-2', '3' => 'lg:grid-cols-3', '4' => 'lg:grid-cols-4', '5' => 'lg:grid-cols-5', '6' => 'lg:grid-cols-3'][(string) min(count($treatment->process_steps), 6)] ?? 'lg:grid-cols-3' @endphp
                <div class="grid sm:grid-cols-2 {{ $stepCols }} gap-5">
                    @foreach ($treatment->process_steps as $i => $step)
                        <div class="group relative bg-white rounded-2xl p-6 shadow-lg shadow-navy-900/20 hover:shadow-xl hover:-translate-y-1 transition-all duration-300" data-reveal style="--reveal-delay: {{ $i * 0.05 }}s">
                            <span class="absolute top-4 right-5 font-heading font-extrabold text-4xl text-mint-100 group-hover:text-teal-100 transition-colors duration-300 select-none">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            <div class="relative w-11 h-11 rounded-xl bg-mint-100 group-hover:bg-teal-500 flex items-center justify-center mb-4 font-heading font-bold text-teal-600 group-hover:text-white transition-colors duration-300">{{ $i + 1 }}</div>
                            <p class="relative font-heading font-semibold text-navy-600">{{ $step['title'] }}</p>
                            <p class="relative text-sm text-navy-500 mt-1.5">{{ $step['description'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if (!empty($treatment->who_benefits))
        <section class="mx-auto max-w-7xl px-6 py-16 grid lg:grid-cols-[1fr_320px] gap-8">
            <div>
                <p class="inline-block text-teal-700 font-semibold text-xs tracking-widest uppercase bg-mint-100 px-3 py-1 rounded-full">Who Can Benefit?</p>
                <h2 class="font-heading font-bold text-2xl text-navy-600 mt-2 mb-6">{{ $treatment->name }} can help individuals with</h2>
                <div class="grid sm:grid-cols-2 gap-4">
                    @foreach ($treatment->who_benefits as $benefit)
                        <div class="group flex items-center gap-3 bg-white rounded-xl border border-navy-100 hover:border-teal-100 shadow-sm hover:shadow-lg transition-all duration-300 p-4">
                            <div class="w-9 h-9 rounded-lg bg-mint-100 group-hover:bg-teal-500 flex items-center justify-center shrink-0 transition-colors duration-300">
                                <x-app-icon name="check" class="w-4 h-4 text-teal-500 group-hover:text-white transition-colors duration-300" />
                            </div>
                            <span class="text-sm text-navy-700 font-medium">{{ $benefit }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="bg-gradient-to-br from-navy-600 to-navy-700 rounded-2xl p-7 text-white flex flex-col justify-between">
                <div>
                    <x-app-icon name="calendar" class="w-8 h-8 text-teal-300 mb-3" />
                    <h3 class="font-heading font-bold">Not sure if you need this treatment?</h3>
                    <p class="text-sm text-navy-300 mt-2">Book an evaluation with our experts.</p>
                </div>
                <a href="{{ route('appointment.create') }}" class="mt-5 inline-flex w-fit items-center gap-2 bg-gradient-to-r from-teal-500 to-teal-600 hover:from-teal-600 hover:to-teal-700 text-white font-heading font-semibold px-5 py-2.5 rounded-full text-sm shadow-md shadow-teal-500/20 hover:shadow-lg transition-all duration-200">
                    Book Evaluation <x-app-icon name="arrow-right" class="w-4 h-4" />
                </a>
            </div>
        </section>
    @endif

    @if (!empty($treatment->faqs))
        <section class="bg-mint-50 py-16" x-data="{ openFaq: 0 }">
            <div class="mx-auto max-w-4xl px-6">
            <div class="text-center mb-10">
                <p class="inline-block text-teal-700 font-semibold text-xs tracking-widest uppercase bg-white px-3 py-1 rounded-full shadow-sm">Common Questions</p>
                <h2 class="font-heading font-bold text-2xl lg:text-3xl text-navy-600 mt-3">Frequently Asked Questions</h2>
            </div>
            <div class="space-y-3">
                @foreach ($treatment->faqs as $i => $faq)
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
        title="Take the First Step Towards Better Health"
        subtitle="Our team is here to guide you with compassion and expertise."
    />
</x-layouts.app>
