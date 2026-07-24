<x-layouts.app :title="$specialist->name">
    <section class="relative bg-gradient-to-br from-mint-50 via-mint-50 to-white border-b border-navy-100 overflow-hidden">
        <div class="absolute -top-20 -right-20 w-72 h-72 bg-teal-200/20 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-navy-200/10 rounded-full blur-3xl"></div>

        <div class="relative mx-auto max-w-7xl px-6 py-10 lg:py-14">
            <nav class="text-sm text-navy-500 mb-6 flex items-center gap-1">
                <a href="{{ route('home') }}" class="hover:text-teal-500">Home</a>
                <x-app-icon name="chevron-right" class="w-3.5 h-3.5" />
                <a href="{{ route('specialists.index') }}" class="hover:text-teal-500">Specialists</a>
                <x-app-icon name="chevron-right" class="w-3.5 h-3.5" />
                <span class="text-navy-700">{{ $specialist->name }}</span>
            </nav>

            <div class="grid lg:grid-cols-[280px_1fr_320px] gap-8">
                <div class="rounded-2xl overflow-hidden aspect-square shadow-xl w-full max-w-[280px] mx-auto lg:mx-0">
                    <x-media-image :model="$specialist" collection="photo" conversion="card" :alt="$specialist->name" eager class="w-full h-full object-cover" />
                </div>

                <div>
                    @if ($specialist->is_chairman)
                        <span class="inline-flex items-center gap-1.5 text-teal-700 font-semibold text-xs tracking-widest uppercase bg-white px-3 py-1 rounded-full shadow-sm">
                            <x-app-icon name="award" class="w-3.5 h-3.5" /> Mentor &amp; Visionary Chairman
                        </span>
                    @endif
                    <h1 class="font-heading font-extrabold text-3xl text-navy-600 mt-3">{{ $specialist->name }}</h1>
                    <p class="text-sm text-navy-500 mt-1">{{ $specialist->qualifications }}</p>
                    @if ($specialist->designation && !$specialist->is_chairman)
                        <span class="inline-flex items-center bg-teal-50 text-teal-700 font-heading font-semibold text-sm px-3 py-1 rounded-full mt-3">
                            {{ $specialist->designation }}
                        </span>
                    @endif

                    <div class="flex flex-wrap gap-3 mt-6">
                        @if ($specialist->experience_years)
                            <div class="bg-white rounded-xl shadow-sm px-4 py-2.5 text-center">
                                <p class="font-heading font-bold text-navy-600">{{ $specialist->experience_years }}+</p>
                                <p class="text-[11px] text-navy-500">Years Experience</p>
                            </div>
                        @endif
                        @if ($specialist->procedures_count)
                            <div class="bg-white rounded-xl shadow-sm px-4 py-2.5 text-center">
                                <p class="font-heading font-bold text-navy-600">{{ $specialist->procedures_count }}+</p>
                                <p class="text-[11px] text-navy-500">Procedures</p>
                            </div>
                        @endif
                        @if ($specialist->is_chairman)
                            <div class="bg-white rounded-xl shadow-sm px-4 py-2.5 text-center">
                                <p class="font-heading font-bold text-navy-600">Padma Shri</p>
                                <p class="text-[11px] text-navy-500">Awardee</p>
                            </div>
                        @endif
                        @if ($specialist->centres->count())
                            <div class="bg-white rounded-xl shadow-sm px-4 py-2.5 text-center">
                                <p class="font-heading font-bold text-navy-600">{{ $specialist->centres->count() }}</p>
                                <p class="text-[11px] text-navy-500">{{ Str::plural('Centre', $specialist->centres->count()) }}</p>
                            </div>
                        @endif
                        @if ($specialist->reviewsCount())
                            <div class="bg-white rounded-xl shadow-sm px-4 py-2.5 text-center">
                                <p class="font-heading font-bold text-navy-600 flex items-center justify-center gap-1">
                                    <x-app-icon name="star" class="w-4 h-4 text-amber-400 fill-amber-400" /> {{ number_format($specialist->averageRating(), 1) }}
                                </p>
                                <p class="text-[11px] text-navy-500">{{ $specialist->reviewsCount() }} {{ Str::plural('Review', $specialist->reviewsCount()) }}</p>
                            </div>
                        @endif
                    </div>

                    @if (!empty($specialist->expertise))
                        <div class="mt-6 bg-teal-50/60 border border-teal-100 rounded-xl p-4">
                            <p class="text-[11px] font-semibold text-teal-700 uppercase tracking-wider mb-2.5">Specializes In</p>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($specialist->expertise as $item)
                                    <span class="bg-white shadow-sm text-navy-600 text-xs font-semibold px-3 py-1.5 rounded-lg">
                                        {{ $item }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <x-booking-widget :centres="$specialist->centres" :specialist="$specialist->slug" />
            </div>
        </div>
    </section>

    @if ($specialist->bio)
        <section class="mx-auto max-w-7xl px-6 py-14">
            <div class="grid lg:grid-cols-[1fr_320px] gap-8">
                <div class="bg-white rounded-2xl border border-navy-100 p-8">
                    <p class="text-teal-700 font-semibold text-xs tracking-widest uppercase mb-2">About {{ $specialist->is_chairman ? 'the Chairman' : 'the Doctor' }}</p>
                    <h2 class="font-heading font-bold text-xl text-navy-600 mb-5">Meet {{ $specialist->name }}</h2>
                    <div class="space-y-4 [&>p]:text-sm [&>p]:text-navy-600 [&>p]:leading-relaxed [&_ul]:list-disc [&_ul]:pl-5 [&_ol]:list-decimal [&_ol]:pl-5 [&_strong]:font-semibold">
                        {!! $specialist->bio !!}
                    </div>
                </div>

                <aside class="space-y-6">
                    @if ($specialist->quote)
                        <div class="bg-gradient-to-br from-navy-600 to-navy-700 rounded-2xl p-7 text-white">
                            <x-app-icon name="quote" class="w-8 h-8 text-teal-300 mb-4 opacity-60" />
                            <p class="italic text-sm leading-relaxed">&ldquo;{{ $specialist->quote }}&rdquo;</p>
                            <p class="mt-4 font-heading font-semibold text-teal-300 text-sm">&mdash; {{ $specialist->name }}</p>
                        </div>
                    @endif

                    @if (!empty($specialist->interests))
                        <div class="bg-mint-50 rounded-2xl p-6">
                            <h3 class="font-heading font-bold text-navy-600 mb-3">Areas of Interest</h3>
                            <ul class="space-y-1">
                                @foreach ($specialist->interests as $item)
                                    <li class="flex items-center gap-3 p-2 rounded-lg hover:bg-white transition-colors duration-200">
                                        <x-app-icon name="check-circle" class="w-4 h-4 text-teal-500 shrink-0" />
                                        <span class="text-sm text-navy-600">{{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </aside>
            </div>
        </section>
    @endif

    @if ($specialist->centres->count())
        @php
            $centreColsClass = match (min($specialist->centres->count(), 4)) {
                1 => 'sm:grid-cols-2 lg:grid-cols-3',
                2 => 'sm:grid-cols-2',
                3 => 'sm:grid-cols-2 lg:grid-cols-3',
                default => 'sm:grid-cols-2 lg:grid-cols-4',
            };
        @endphp
        <section class="mx-auto max-w-7xl px-6 py-14">
            <h3 class="font-heading font-bold text-navy-600 mb-5">Available At</h3>
            <div class="grid gap-5 {{ $centreColsClass }}">
                @foreach ($specialist->centres as $centre)
                    <a href="{{ route('appointment.create', ['centre' => $centre->slug, 'specialist' => $specialist->slug]) }}" class="group bg-white rounded-xl border border-transparent hover:border-teal-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                        <div class="aspect-video overflow-hidden">
                            <x-media-image :model="$centre" collection="image" conversion="thumb" :alt="$centre->name" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                        </div>
                        <div class="p-4">
                            <p class="font-heading font-semibold text-navy-600 text-sm">{{ $centre->name }}</p>
                            <p class="text-xs text-navy-500 mt-1">{{ $centre->opd_weekday }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif

    @if (!empty($specialist->education) || !empty($specialist->experience_timeline))
        <section class="bg-mint-50 py-14">
            <div class="mx-auto max-w-7xl px-6 grid lg:grid-cols-2 gap-6">
                @if (!empty($specialist->experience_timeline))
                    <div class="bg-white rounded-2xl shadow-sm p-6">
                        <h3 class="font-heading font-bold text-navy-600 mb-4">Experience</h3>
                        <ul>
                            @foreach ($specialist->experience_timeline as $item)
                                <li class="flex gap-4">
                                    <div class="flex flex-col items-center">
                                        <div class="w-4 h-4 rounded-full border-2 border-teal-500 bg-white flex items-center justify-center shrink-0">
                                            <div class="w-1.5 h-1.5 rounded-full bg-teal-500"></div>
                                        </div>
                                        @unless ($loop->last)
                                            <div class="flex-1 border-l-2 border-dashed border-teal-200 my-1"></div>
                                        @endunless
                                    </div>
                                    <div class="{{ $loop->last ? '' : 'pb-6' }}">
                                        <p class="text-sm font-semibold text-navy-600">{{ $item['role'] }}</p>
                                        <p class="text-xs text-navy-500 mt-0.5">{{ $item['place'] }}</p>
                                        <p class="text-xs text-navy-400 mt-0.5">{{ $item['period'] }}</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (!empty($specialist->education))
                    <div class="bg-white rounded-2xl shadow-sm p-6">
                        <h3 class="font-heading font-bold text-navy-600 mb-4">Education &amp; Credentials</h3>
                        <ul class="space-y-4">
                            @foreach ($specialist->education as $item)
                                <li class="flex gap-3">
                                    <x-app-icon name="award" class="w-4 h-4 text-teal-500 mt-0.5 shrink-0" />
                                    <div>
                                        <p class="text-sm font-semibold text-navy-600">{{ $item['degree'] }}</p>
                                        <p class="text-xs text-navy-500">{{ $item['institution'] }}</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </section>
    @endif

    <section class="mx-auto max-w-7xl px-6 py-14">
        <div class="grid lg:grid-cols-[1fr_400px] gap-8">
            <div>
                <div class="flex items-center gap-3 mb-6">
                    <h2 class="font-heading font-bold text-xl text-navy-600">Patient Reviews</h2>
                    @if ($specialist->reviewsCount())
                        <span class="inline-flex items-center gap-1 text-xs font-semibold text-teal-600 bg-mint-100 px-2.5 py-1 rounded-full">
                            <x-app-icon name="star" class="w-3.5 h-3.5 text-amber-400 fill-amber-400" /> {{ number_format($specialist->averageRating(), 1) }} &middot; {{ $specialist->reviewsCount() }} {{ Str::plural('Review', $specialist->reviewsCount()) }}
                        </span>
                    @endif
                </div>

                @if ($specialist->approvedReviews->count())
                    <div class="space-y-4">
                        @foreach ($specialist->approvedReviews as $review)
                            <div class="bg-white rounded-2xl border border-navy-100 p-5">
                                <div class="flex items-center justify-between gap-3 mb-2">
                                    <p class="font-heading font-semibold text-navy-600 text-sm">{{ $review->name }}</p>
                                    <p class="text-[11px] text-navy-400">{{ $review->created_at->format('M Y') }}</p>
                                </div>
                                <div class="flex items-center gap-0.5 mb-2">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <x-app-icon name="star" class="w-3.5 h-3.5 {{ $i <= $review->rating ? 'text-amber-400 fill-amber-400' : 'text-navy-100 fill-navy-100' }}" />
                                    @endfor
                                </div>
                                @if ($review->comment)
                                    <p class="text-sm text-navy-500 leading-relaxed">{{ $review->comment }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12 border-2 border-dashed border-navy-100 rounded-2xl">
                        <x-app-icon name="star" class="w-10 h-10 text-navy-200 mx-auto mb-2" />
                        <p class="text-navy-500 text-sm">No reviews yet. Be the first to share your experience.</p>
                    </div>
                @endif
            </div>

            <div class="bg-mint-50 rounded-2xl p-6 h-fit">
                <h3 class="font-heading font-bold text-navy-600 mb-1">Share Your Experience</h3>
                <p class="text-xs text-navy-500 mb-5">Your review will be published after a quick review by our team.</p>

                @if (session('reviewSuccess'))
                    <div class="mb-5 bg-teal-100 border border-teal-200 text-teal-800 rounded-lg p-3 text-xs">
                        {{ session('reviewSuccess') }}
                    </div>
                @endif

                <form
                    action="{{ route('specialists.reviews.store', $specialist) }}"
                    method="POST"
                    x-data="{ rating: 0, hoverRating: 0 }"
                    class="space-y-4"
                >
                    @csrf
                    <input type="text" name="website" class="hidden" tabindex="-1" autocomplete="off">

                    <div>
                        <label class="text-xs font-medium text-navy-500">Your Rating *</label>
                        <div class="flex items-center gap-1 mt-1.5">
                            @for ($i = 1; $i <= 5; $i++)
                                <button
                                    type="button"
                                    @click="rating = {{ $i }}"
                                    @mouseenter="hoverRating = {{ $i }}"
                                    @mouseleave="hoverRating = 0"
                                    aria-label="{{ $i }} star"
                                >
                                    <x-app-icon name="star" class="w-6 h-6 transition-colors" x-bind:class="(hoverRating || rating) >= {{ $i }} ? 'text-amber-400 fill-amber-400' : 'text-navy-200 fill-navy-200'" />
                                </button>
                            @endfor
                        </div>
                        <input type="hidden" name="rating" x-bind:value="rating" required>
                        @error('rating') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="text-xs font-medium text-navy-500">Your Name *</label>
                        <input type="text" name="name" value="{{ old('name') }}" required class="mt-1.5 w-full rounded-xl border border-navy-100 px-4 py-2.5 text-sm text-navy-600 bg-white transition-colors duration-200 focus:border-teal-500 focus:ring-1 focus:ring-teal-500 focus:outline-none @error('name') border-red-400 @enderror">
                        @error('name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="text-xs font-medium text-navy-500">Your Phone Number</label>
                        <input type="tel" name="phone" value="{{ old('phone') }}" class="mt-1.5 w-full rounded-xl border border-navy-100 px-4 py-2.5 text-sm text-navy-600 bg-white transition-colors duration-200 focus:border-teal-500 focus:ring-1 focus:ring-teal-500 focus:outline-none @error('phone') border-red-400 @enderror" placeholder="Optional — not shown publicly">
                        <p class="text-[11px] text-navy-400 mt-1">Helps our team verify your visit. Never displayed on the site.</p>
                        @error('phone') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="text-xs font-medium text-navy-500">Your Review</label>
                        <textarea name="comment" rows="4" class="mt-1.5 w-full rounded-xl border border-navy-100 px-4 py-2.5 text-sm text-navy-600 bg-white transition-colors duration-200 focus:border-teal-500 focus:ring-1 focus:ring-teal-500 focus:outline-none @error('comment') border-red-400 @enderror" placeholder="Share details of your experience...">{{ old('comment') }}</textarea>
                        @error('comment') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit" class="w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-teal-500 to-teal-600 hover:from-teal-600 hover:to-teal-700 text-white font-heading font-semibold text-sm px-5 py-2.5 rounded-full shadow-md shadow-teal-500/20 hover:shadow-lg transition-all duration-200">
                        Submit Review
                    </button>
                </form>
            </div>
        </div>
    </section>

    <x-cta-banner
        title="We're here to help you hear better, live better."
        subtitle="Book an appointment or visit our nearest centre today."
    />
</x-layouts.app>
