<x-layouts.app title="Contact Us">
    <x-hero
        title="Contact Us"
        subtitle="We're here to help you with all your ENT, Hearing and Vertigo care needs. Reach out to us or visit our nearest centre."
        :breadcrumbs="['Contact Us' => null]"
    >
        <x-slot:stats>
            <span class="flex items-center gap-1.5"><x-app-icon name="phone" class="w-4 h-4 text-teal-500" /> +91-98117 03926</span>
            <span class="flex items-center gap-1.5"><x-app-icon name="mail" class="w-4 h-4 text-teal-500" /> info@drhansent.com</span>
        </x-slot:stats>
    </x-hero>

    <section class="mx-auto max-w-7xl px-6 py-16 grid lg:grid-cols-[1fr_360px] gap-8">
        <div class="bg-white rounded-2xl border border-navy-100 p-6 lg:p-8">
            <h2 class="font-heading font-bold text-navy-600 text-lg mb-1">Send Us a Message</h2>
            <p class="text-sm text-navy-500 mb-6">Fill out the form below and our team will get back to you shortly.</p>

            @if (session('success'))
                <div class="mb-6 bg-mint-100 border border-teal-200 text-teal-800 rounded-lg p-4 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <form
                action="{{ route('contact.store') }}"
                method="POST"
                class="space-y-4"
                x-data="{
                    open: null,
                    centre_id: '{{ old('centre_id') }}',
                    centreLabel: '{{ old('centre_id') ? ($centres->firstWhere('id', (int) old('centre_id'))?->name ?? 'Choose a centre') : 'Choose a centre' }}',
                    subject: '{{ old('subject') }}',
                    subjectLabel: '{{ old('subject') ?: 'Select subject' }}',
                }"
                @click.outside="open = null"
            >
                @csrf
                <input type="text" name="website" class="hidden" tabindex="-1" autocomplete="off">

                @php $inputClasses = 'mt-1.5 w-full rounded-xl border border-navy-100 px-4 py-2.5 text-sm text-navy-600 transition-colors duration-200 focus:border-teal-500 focus:ring-1 focus:ring-teal-500 focus:outline-none'; @endphp
                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs font-medium text-navy-500">Full Name *</label>
                        <input type="text" name="name" value="{{ old('name') }}" required class="{{ $inputClasses }} @error('name') border-red-400 @enderror">
                        @error('name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="text-xs font-medium text-navy-500">Phone Number *</label>
                        <input type="tel" name="phone" value="{{ old('phone') }}" required class="{{ $inputClasses }} @error('phone') border-red-400 @enderror">
                        @error('phone') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs font-medium text-navy-500">Email Address *</label>
                        <input type="email" name="email" value="{{ old('email') }}" required class="{{ $inputClasses }} @error('email') border-red-400 @enderror">
                        @error('email') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="text-xs font-medium text-navy-500">Select Centre</label>
                        <input type="hidden" name="centre_id" x-bind:value="centre_id">
                        <div class="relative mt-1.5">
                            <button
                                type="button"
                                @click="open = (open === 'centre' ? null : 'centre')"
                                class="w-full flex items-center gap-3 rounded-xl border bg-white pl-4 pr-3.5 py-2.5 text-left transition-colors duration-200"
                                :class="open === 'centre' ? 'border-teal-500 ring-1 ring-teal-500' : 'border-navy-100 hover:border-teal-300'"
                            >
                                <x-app-icon name="location" class="w-4 h-4 text-navy-400 shrink-0" />
                                <span class="flex-1 text-sm text-navy-600 truncate" x-text="centreLabel"></span>
                                <x-app-icon name="chevron-down" class="w-4 h-4 text-navy-400 shrink-0 transition-transform duration-150" x-bind:class="open === 'centre' && 'rotate-180'" />
                            </button>
                            <div
                                x-show="open === 'centre'" x-cloak
                                x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
                                class="absolute z-20 mt-2 w-full bg-white rounded-xl shadow-xl border border-navy-100 py-2 max-h-56 overflow-y-auto"
                            >
                                <button type="button" @click="centre_id=''; centreLabel='Choose a centre'; open=null" class="block w-full text-left px-4 py-2 text-sm text-navy-600 hover:bg-mint-100 transition-colors">Choose a centre</button>
                                @foreach ($centres as $centre)
                                    <button type="button" @click="centre_id='{{ $centre->id }}'; centreLabel='{{ $centre->name }}'; open=null" class="block w-full text-left px-4 py-2 text-sm text-navy-600 hover:bg-mint-100 transition-colors">{{ $centre->name }}</button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs font-medium text-navy-500">Subject</label>
                        <input type="hidden" name="subject" x-bind:value="subject">
                        <div class="relative mt-1.5">
                            <button
                                type="button"
                                @click="open = (open === 'subject' ? null : 'subject')"
                                class="w-full flex items-center gap-3 rounded-xl border bg-white pl-4 pr-3.5 py-2.5 text-left transition-colors duration-200"
                                :class="open === 'subject' ? 'border-teal-500 ring-1 ring-teal-500' : 'border-navy-100 hover:border-teal-300'"
                            >
                                <x-app-icon name="mail" class="w-4 h-4 text-navy-400 shrink-0" />
                                <span class="flex-1 text-sm text-navy-600 truncate" x-text="subjectLabel"></span>
                                <x-app-icon name="chevron-down" class="w-4 h-4 text-navy-400 shrink-0 transition-transform duration-150" x-bind:class="open === 'subject' && 'rotate-180'" />
                            </button>
                            <div
                                x-show="open === 'subject'" x-cloak
                                x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
                                class="absolute z-20 mt-2 w-full bg-white rounded-xl shadow-xl border border-navy-100 py-2"
                            >
                                <button type="button" @click="subject=''; subjectLabel='Select subject'; open=null" class="block w-full text-left px-4 py-2 text-sm text-navy-600 hover:bg-mint-100 transition-colors">Select subject</button>
                                @foreach (['General Enquiry', 'Appointment Query', 'Feedback', 'Careers'] as $subj)
                                    <button type="button" @click="subject='{{ $subj }}'; subjectLabel='{{ $subj }}'; open=null" class="block w-full text-left px-4 py-2 text-sm text-navy-600 hover:bg-mint-100 transition-colors">{{ $subj }}</button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="text-xs font-medium text-navy-500">Preferred Date</label>
                        <input type="date" name="preferred_date" value="{{ old('preferred_date') }}" min="{{ now()->toDateString() }}" class="{{ $inputClasses }}">
                    </div>
                </div>
                <div>
                    <label class="text-xs font-medium text-navy-500">Your Message *</label>
                    <textarea name="message" rows="4" required class="{{ $inputClasses }} @error('message') border-red-400 @enderror" placeholder="Type your message here...">{{ old('message') }}</textarea>
                    @error('message') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
                <label class="flex items-start gap-2 text-xs text-navy-500">
                    <input type="checkbox" required class="mt-0.5 rounded border-navy-300">
                    I agree to the <a href="#" class="text-teal-500 underline">Privacy Policy</a> and <a href="#" class="text-teal-500 underline">Terms &amp; Conditions</a>
                </label>
                <button type="submit" class="group inline-flex items-center gap-2 bg-gradient-to-r from-navy-600 to-navy-700 hover:from-navy-700 hover:to-navy-800 text-white font-heading font-semibold px-6 py-3 rounded-full text-sm shadow-md shadow-navy-600/20 hover:shadow-lg transition-all duration-200">
                    Send Message <x-app-icon name="arrow-right" class="w-4 h-4 transition-transform duration-200 group-hover:translate-x-1" />
                </button>
            </form>
        </div>

        <aside class="space-y-6">
            <div class="bg-gradient-to-br from-navy-600 to-navy-700 rounded-2xl p-6 text-white">
                <x-app-icon name="phone" class="w-8 h-8 text-teal-300 mb-3" />
                <h3 class="font-heading font-bold mb-2">Need Immediate Assistance?</h3>
                <p class="text-sm text-navy-200 mb-4">For urgent ENT care or emergency appointments, please call us directly.</p>
                <a href="tel:+919811703926" class="inline-flex w-full items-center justify-center gap-2 bg-white hover:bg-teal-50 text-teal-700 font-heading font-semibold px-4 py-2.5 rounded-full text-sm shadow-md transition-colors duration-200">
                    <x-app-icon name="phone" class="w-4 h-4" /> +91-98117 03926
                </a>
                <a href="https://wa.me/919811703926" target="_blank" class="mt-2.5 inline-flex w-full items-center justify-center gap-2 border-2 border-white/30 hover:border-white text-white font-heading font-semibold px-4 py-2.5 rounded-full text-sm transition-colors duration-200">
                    <x-app-icon name="whatsapp" class="w-4 h-4" /> WhatsApp Us
                </a>
            </div>

            <div class="bg-mint-50 rounded-2xl p-6">
                <h3 class="font-heading font-bold text-navy-600 mb-3">We're Here for You</h3>
                <ul class="space-y-1">
                    @foreach (['Expert ENT Specialists', 'Advanced Technology', 'Personalised Care', 'Multiple Centres for Your Convenience'] as $item)
                        <li class="flex items-center gap-3 p-2 rounded-lg hover:bg-white transition-colors duration-200 text-sm text-navy-600">
                            <x-app-icon name="check-circle" class="w-4 h-4 text-teal-500 shrink-0" /> {{ $item }}
                        </li>
                    @endforeach
                </ul>
                <p class="text-xs text-navy-400 mt-4 flex items-center gap-1.5">
                    <x-app-icon name="clock" class="w-3.5 h-3.5 shrink-0" /> Mon - Sat: 9 AM - 7 PM &middot; Sun: 10 AM - 2 PM
                </p>
            </div>
        </aside>
    </section>

    <section class="relative bg-gradient-to-br from-navy-600 to-navy-700 py-16 overflow-hidden">
        <div class="absolute -top-24 -right-24 w-80 h-80 bg-teal-500/15 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-72 h-72 bg-teal-500/10 rounded-full blur-3xl"></div>

        <div class="relative mx-auto max-w-7xl px-6">
        <div class="flex items-end justify-between mb-6" data-reveal>
            <div>
                <p class="inline-block text-teal-300 font-semibold text-xs tracking-widest uppercase bg-white/10 px-3 py-1 rounded-full">Visit Us</p>
                <h2 class="font-heading font-bold text-white text-2xl mt-2">Our Centres</h2>
            </div>
            <a href="{{ route('centres.index') }}" class="group inline-flex items-center gap-1 text-teal-300 hover:text-teal-200 font-heading font-semibold text-sm transition-colors">
                View All <x-app-icon name="chevron-right" class="w-4 h-4 transition-transform duration-200 group-hover:translate-x-1" />
            </a>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach ($centres as $centre)
                <div class="group bg-white rounded-2xl shadow-lg shadow-navy-900/20 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 p-5 flex flex-col" data-reveal style="--reveal-delay: {{ ($loop->index % 3) * 0.06 }}s">
                    <p class="font-heading font-semibold text-navy-600 text-sm flex items-center gap-2">
                        <span class="w-8 h-8 rounded-lg bg-mint-100 group-hover:bg-teal-500 flex items-center justify-center shrink-0 transition-colors duration-300">
                            <x-app-icon name="location" class="w-4 h-4 text-teal-500 group-hover:text-white transition-colors duration-300" />
                        </span>
                        {{ $centre->name }}
                    </p>
                    <p class="text-xs text-navy-500 mt-3 flex-1">{{ $centre->address }}</p>
                    <div class="flex items-center justify-between mt-3 pt-3 border-t border-navy-50">
                        <a href="tel:{{ $centre->phone }}" class="text-xs text-navy-500 hover:text-teal-600 flex items-center gap-1.5 transition-colors">
                            <x-app-icon name="phone" class="w-3.5 h-3.5 shrink-0" /> {{ $centre->phone }}
                        </a>
                        <a href="https://www.google.com/maps/dir/?api=1&destination={{ $centre->lat }},{{ $centre->lng }}" target="_blank" rel="noopener" class="text-xs font-semibold text-teal-600 hover:text-teal-700 flex items-center gap-1 transition-colors">
                            Directions <x-app-icon name="chevron-right" class="w-3 h-3" />
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        </div>
    </section>
</x-layouts.app>
