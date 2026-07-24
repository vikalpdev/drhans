<x-layouts.app title="Share Your Experience" description="Share your experience with Dr Hans' Centre for ENT. Your feedback helps us improve care and helps other patients choose the right ENT specialist.">
    <x-hero
        title="Share Your Experience"
        subtitle="Your feedback helps us improve and helps other patients make informed decisions. Choose your centre below to leave a review."
        :breadcrumbs="['Share Your Experience' => null]"
    />

    <section class="mx-auto max-w-5xl px-6 py-16">
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($centres as $centre)
                @if ($centre->practo_url || $centre->justdial_url)
                    <div class="bg-white rounded-2xl border border-navy-100 p-6 text-center">
                        <div class="w-11 h-11 rounded-xl bg-mint-100 flex items-center justify-center mx-auto mb-3">
                            <x-app-icon name="location" class="w-5 h-5 text-teal-500" />
                        </div>
                        <p class="font-heading font-semibold text-navy-600">{{ $centre->name }}</p>
                        <p class="text-xs text-navy-400 mb-5">{{ $centre->city }}</p>

                        <div class="space-y-2.5">
                            @if ($centre->practo_url)
                                <a href="{{ $centre->practo_url }}" target="_blank" rel="noopener" class="w-full inline-flex items-center justify-center gap-2 border-2 border-teal-500 text-teal-700 hover:bg-teal-500 hover:text-white font-heading font-semibold text-sm px-4 py-2.5 rounded-full transition-colors duration-200">
                                    Review on Practo
                                </a>
                            @endif
                            @if ($centre->justdial_url)
                                <a href="{{ $centre->justdial_url }}" target="_blank" rel="noopener" class="w-full inline-flex items-center justify-center gap-2 border-2 border-navy-200 text-navy-700 hover:border-teal-500 hover:text-teal-600 font-heading font-semibold text-sm px-4 py-2.5 rounded-full transition-colors duration-200">
                                    Review on Justdial
                                </a>
                            @endif
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </section>
</x-layouts.app>
