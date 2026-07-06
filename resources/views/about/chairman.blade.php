<x-layouts.app title="From the Chairman's Desk">
    <x-hero
        title="From the Chairman's Desk"
        subtitle="For over three decades, my mission has been simple yet profound - to restore the gift of hearing, balance and communication, and to bring hope back to the lives of thousands of patients and their families."
        :breadcrumbs="['About Us' => route('about.index'), 'Chairman\'s Desk' => null]"
        :image-model="$chairman"
        image-collection="photo"
    />

    @if ($chairman)
        <section class="mx-auto max-w-6xl px-6 py-16">
            {{-- Photo + message --}}
            <div class="grid lg:grid-cols-[320px_1fr] gap-8 mb-12 items-start">
                <div class="lg:sticky lg:top-32">
                    <div class="relative">
                        <div class="absolute -top-3 -left-3 w-full h-full rounded-2xl bg-gradient-to-br from-teal-200 to-mint-100"></div>
                        <div class="relative rounded-2xl overflow-hidden aspect-[4/5] shadow-xl w-full max-w-[300px] mx-auto lg:mx-0">
                            <x-media-image :model="$chairman" collection="photo" conversion="card" :alt="$chairman->name" icon="user" eager class="w-full h-full object-cover" />
                        </div>
                    </div>
                    <div class="mt-6 text-center lg:text-left">
                        <p class="font-heading font-bold text-lg text-navy-600">{{ $chairman->name }}</p>
                        <p class="text-sm text-navy-500 mt-0.5">{{ $chairman->qualifications }}</p>
                        <span class="inline-flex items-center gap-1.5 mt-2 text-teal-700 font-semibold text-xs tracking-widest uppercase bg-mint-100 px-3 py-1 rounded-full">
                            <x-app-icon name="award" class="w-3.5 h-3.5" /> Padma Shri Awardee
                        </span>
                        <a href="{{ route('specialists.show', $chairman) }}" class="group mt-4 flex items-center justify-center lg:justify-start gap-1 text-teal-500 hover:text-teal-600 font-heading font-semibold text-sm transition-colors">
                            View Full Profile <x-app-icon name="chevron-right" class="w-4 h-4 transition-transform duration-200 group-hover:translate-x-1" />
                        </a>
                    </div>
                </div>

                <div class="space-y-8">
                    <blockquote class="relative bg-gradient-to-br from-navy-600 to-navy-700 rounded-2xl p-8 text-white italic text-lg overflow-hidden">
                        <div class="absolute -top-10 -right-10 w-40 h-40 bg-teal-500/20 rounded-full blur-2xl"></div>
                        <x-app-icon name="quote" class="relative w-10 h-10 text-teal-300 opacity-60 mb-4" />
                        <p class="relative">&ldquo;{{ $chairman->quote }}&rdquo;</p>
                        <footer class="relative mt-4 font-heading font-semibold not-italic text-teal-300 text-base">&mdash; {{ $chairman->name }}</footer>
                    </blockquote>

                    <div>
                        <p class="inline-block text-teal-700 font-semibold text-xs tracking-widest uppercase bg-mint-100 px-3 py-1 rounded-full">My Journey</p>
                        <h2 class="font-heading font-bold text-xl text-navy-600 mt-2 mb-4">A Journey of Purpose</h2>
                        <div class="space-y-3">
                            @foreach (explode("\n\n", $chairman->bio) as $paragraph)
                                <p class="text-sm text-navy-500 leading-relaxed">{{ $paragraph }}</p>
                            @endforeach
                        </div>
                    </div>

                    <div class="bg-mint-50 rounded-2xl p-7">
                        <p class="inline-block text-teal-700 font-semibold text-xs tracking-widest uppercase bg-white px-3 py-1 rounded-full shadow-sm">What Guides Me</p>
                        <h2 class="font-heading font-bold text-xl text-navy-600 mt-2 mb-3">My Beliefs</h2>
                        <ul class="grid sm:grid-cols-2 gap-1">
                            @foreach (['Patients first, always', 'Ethical practice and transparency', 'Innovation with compassion', 'Building a team that learns and grows together', 'Creating centres that are accessible, advanced and trusted'] as $belief)
                                <li class="flex items-center gap-3 p-2.5 rounded-lg hover:bg-white transition-colors duration-200 text-sm text-navy-600">
                                    <x-app-icon name="check-circle" class="w-4 h-4 text-teal-500 shrink-0" /> {{ $belief }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="mb-12">
                <div class="text-center mb-8">
                    <p class="inline-block text-teal-700 font-semibold text-xs tracking-widest uppercase bg-mint-100 px-3 py-1 rounded-full">Recognition</p>
                    <h2 class="font-heading font-bold text-xl lg:text-2xl text-navy-600 mt-3">Milestones &amp; Achievements</h2>
                </div>
                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
                    @foreach ([
                        ['award', 'Padma Shri Awardee', 'Honoured by the Government of India for outstanding contribution to medicine.'],
                        ['ear-implant', 'Pioneer in Cochlear Implant Surgery', 'Performed 3500+ successful cochlear implant procedures.'],
                        ['clock', $chairman->experience_years . '+ Years of Experience', 'Dedicated to clinical excellence, research and innovation.'],
                        ['user-group', 'Global Recognition', 'Author of numerous research papers and invited faculty at national & international conferences.'],
                    ] as [$icon, $title, $desc])
                        <div class="group bg-white rounded-2xl border border-navy-100 hover:border-teal-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 p-6 text-center">
                            <div class="w-12 h-12 rounded-xl bg-mint-100 group-hover:bg-teal-500 flex items-center justify-center mx-auto mb-3 transition-colors duration-300">
                                <x-app-icon :name="$icon" class="w-6 h-6 text-teal-500 group-hover:text-white transition-colors duration-300" />
                            </div>
                            <p class="font-heading font-semibold text-navy-600 text-sm">{{ $title }}</p>
                            <p class="text-xs text-navy-500 mt-1.5">{{ $desc }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="bg-mint-50 py-10">
            <div class="mx-auto max-w-7xl px-6 grid grid-cols-2 lg:grid-cols-5 gap-6 text-center">
                @foreach ([['3500+', 3500, '+', 'Cochlear Implants Performed'], ['35+', 35, '+', 'Years of Clinical Excellence'], ['50,000+', 50000, '+', 'Patients Treated Successfully'], ['6', 6, '', 'Centres Across India'], ['100+', 100, '+', 'Advanced Equipment & Technologies']] as [$stat, $number, $suffix, $label])
                    <div class="{{ $loop->last ? 'col-span-2 lg:col-span-1' : '' }}">
                        <p class="font-heading font-bold text-2xl text-navy-600" x-data="countUp({{ $number }}, '{{ $suffix }}')" x-text="display">{{ $stat }}</p>
                        <p class="text-xs text-navy-500 mt-1">{{ $label }}</p>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    <x-cta-banner
        title="We're here to help you hear better, live better."
        subtitle="Book an appointment or visit our nearest centre today."
    />
</x-layouts.app>
