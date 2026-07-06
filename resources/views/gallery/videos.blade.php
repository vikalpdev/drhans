<x-layouts.app title="Video Gallery">
    <x-hero
        title="Video Gallery"
        subtitle="Watch real patient stories, treatment insights and a glimpse into life at Dr Hans' Centre for ENT."
        :breadcrumbs="['Video Gallery' => null]"
    >
        <x-slot:stats>
            <span class="flex items-center gap-1.5"><x-app-icon name="play" class="w-4 h-4 text-teal-500" /> Patient Stories</span>
            <span class="flex items-center gap-1.5"><x-app-icon name="heart" class="w-4 h-4 text-teal-500" /> Real Transformations</span>
            <span class="flex items-center gap-1.5"><x-app-icon name="camera" class="w-4 h-4 text-teal-500" /> Inside Our Centres</span>
        </x-slot:stats>
        <x-slot:actions>
            <a href="{{ route('gallery.index') }}" class="inline-flex items-center gap-2 border-2 border-navy-200 text-navy-700 hover:border-teal-500 hover:text-teal-600 font-heading font-semibold px-5 py-2.5 rounded-full text-sm transition-colors duration-200">
                <x-app-icon name="camera" class="w-4 h-4" /> View Photo Gallery
            </a>
        </x-slot:actions>
    </x-hero>

    <section
        class="mx-auto max-w-7xl px-6 py-16"
        x-data="{ lightboxOpen: false, activeVideo: null, activeTitle: '' }"
        @keydown.escape.window="lightboxOpen = false; activeVideo = null"
    >
        @if ($videos->count())
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($videos as $video)
                    <button
                        type="button"
                        @click="lightboxOpen = true; activeVideo = @js($video->embedUrl()); activeTitle = @js($video->title)"
                        class="group text-left bg-white rounded-2xl border border-navy-100 hover:border-teal-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden"
                    >
                        <div class="aspect-video relative flex items-center justify-center overflow-hidden bg-gradient-to-br from-navy-600 to-teal-600">
                            <x-app-icon name="play" class="absolute w-14 h-14 text-white/20" />
                            @if ($video->thumbnailUrl())
                                <img src="{{ $video->thumbnailUrl() }}" alt="{{ $video->title }}" loading="lazy" onerror="this.remove()" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            @endif
                            <div class="absolute inset-0 bg-navy-900/0 group-hover:bg-navy-900/25 transition-colors duration-300"></div>
                            <div class="relative w-14 h-14 rounded-full bg-white/90 group-hover:bg-teal-500 flex items-center justify-center shadow-lg group-hover:scale-110 transition-all duration-300">
                                <x-app-icon name="play" class="w-5 h-5 text-navy-600 group-hover:text-white transition-colors duration-300 translate-x-0.5" />
                            </div>
                        </div>
                        <div class="p-4">
                            <p class="font-heading font-semibold text-navy-600 text-sm">{{ $video->title }}</p>
                            @if ($video->patient_name)
                                <p class="text-xs text-navy-500 mt-1 flex items-center gap-1.5">
                                    <x-app-icon name="user" class="w-3.5 h-3.5 text-teal-500" /> {{ $video->patient_name }}
                                </p>
                            @endif
                        </div>
                    </button>
                @endforeach
            </div>
        @else
            <div class="text-center py-16 border-2 border-dashed border-navy-100 rounded-2xl">
                <x-app-icon name="play" class="w-12 h-12 text-navy-200 mx-auto mb-3" />
                <p class="text-navy-500">Videos coming soon. Please check back shortly.</p>
            </div>
        @endif

        {{-- Lightbox --}}
        <template x-if="lightboxOpen">
            <div class="fixed inset-0 z-[100] flex items-center justify-center p-4" x-transition.opacity>
                <div class="absolute inset-0 bg-navy-900/85" @click="lightboxOpen = false; activeVideo = null"></div>
                <div class="relative w-full max-w-3xl">
                    <div class="flex items-center justify-between mb-3">
                        <p class="text-white font-heading font-semibold text-sm truncate pr-4" x-text="activeTitle"></p>
                        <button @click="lightboxOpen = false; activeVideo = null" aria-label="Close video" class="w-9 h-9 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center text-white shrink-0 transition-colors">
                            <x-app-icon name="close" class="w-5 h-5" />
                        </button>
                    </div>
                    <div class="aspect-video rounded-2xl overflow-hidden shadow-2xl bg-black">
                        <iframe :src="activeVideo" class="w-full h-full" frameborder="0" allow="autoplay; encrypted-media; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </template>
    </section>

    <x-cta-banner
        title="Ready to write your own success story?"
        subtitle="Book an appointment with our specialists today."
    />
</x-layouts.app>
