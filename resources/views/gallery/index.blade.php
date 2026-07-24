<x-layouts.app title="Photo Gallery" description="Browse photos of Dr Hans' Centre for ENT facilities, equipment and patient care moments across our centres.">
    <x-hero
        title="Photo Gallery"
        subtitle="Moments that reflect our commitment to advanced care, compassion, and healthy lives."
        :breadcrumbs="['Photo Gallery' => null]"
    >
        <x-slot:actions>
            <a href="{{ route('gallery.videos') }}" class="inline-flex items-center gap-2 border-2 border-navy-200 text-navy-700 hover:border-teal-500 hover:text-teal-600 font-heading font-semibold px-5 py-2.5 rounded-full text-sm transition-colors duration-200">
                <x-app-icon name="play" class="w-4 h-4" /> View Video Gallery
            </a>
        </x-slot:actions>
    </x-hero>

    <section
        x-data="{ cat: 'all', lightboxOpen: false, activeImage: null, activeTitle: null }"
        @keydown.escape.window="lightboxOpen = false"
        class="mx-auto max-w-7xl px-6 py-12"
    >
        <div class="flex flex-nowrap sm:flex-wrap gap-2.5 mb-10 bg-mint-50 border border-navy-100 rounded-2xl p-2 w-full sm:w-fit overflow-x-auto sm:overflow-visible [&::-webkit-scrollbar]:hidden" style="scrollbar-width: none;">
            <button
                @click="cat = 'all'"
                :class="cat === 'all' ? 'bg-gradient-to-r from-navy-600 to-navy-700 text-white shadow-md shadow-navy-600/25' : 'bg-white text-navy-600 shadow-sm hover:text-teal-600'"
                class="shrink-0 inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-sm font-heading font-medium transition-colors duration-200"
            >
                <x-app-icon name="camera" class="w-3.5 h-3.5" /> All Photos
            </button>
            @foreach ($categories as $category)
                <button
                    @click="cat = '{{ $category->slug }}'"
                    :class="cat === '{{ $category->slug }}' ? 'bg-gradient-to-r from-navy-600 to-navy-700 text-white shadow-md shadow-navy-600/25' : 'bg-white text-navy-600 shadow-sm hover:text-teal-600'"
                    class="shrink-0 inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-sm font-heading font-medium transition-colors duration-200"
                >{{ $category->name }}</button>
            @endforeach
        </div>

        @foreach ($items as $categorySlug => $categoryItems)
            <div x-show="cat === 'all' || cat === '{{ $categorySlug }}'" x-transition.opacity class="mb-12">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-9 h-9 rounded-lg bg-mint-100 flex items-center justify-center shrink-0">
                        <x-app-icon name="camera" class="w-4 h-4 text-teal-500" />
                    </div>
                    <h2 class="font-heading font-bold text-lg text-navy-600">{{ $categories->firstWhere('slug', $categorySlug)?->name ?? $categorySlug }}</h2>
                    <span class="text-xs font-semibold text-teal-600 bg-mint-100 px-2.5 py-1 rounded-full">{{ $categoryItems->count() }}</span>
                </div>
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                    @foreach ($categoryItems as $item)
                        <x-card.gallery-item :item="$item" />
                    @endforeach
                </div>
            </div>
        @endforeach

        <template x-if="lightboxOpen">
            <div class="fixed inset-0 z-[100] flex items-center justify-center p-4" x-transition.opacity>
                <div class="absolute inset-0 bg-navy-900/85" @click="lightboxOpen = false"></div>
                <div class="relative w-full max-w-4xl">
                    <button @click="lightboxOpen = false" aria-label="Close" class="absolute -top-11 right-0 w-9 h-9 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center text-white transition-colors">
                        <x-app-icon name="close" class="w-5 h-5" />
                    </button>
                    <template x-if="activeImage">
                        <img :src="activeImage" :alt="activeTitle" class="w-full max-h-[80vh] object-contain rounded-2xl shadow-2xl">
                    </template>
                    <template x-if="!activeImage">
                        <div class="w-full aspect-video rounded-2xl bg-gradient-to-br from-navy-100 to-teal-100 flex items-center justify-center">
                            <div class="text-center">
                                <x-app-icon name="camera" class="w-14 h-14 text-teal-500/40 mx-auto mb-2" />
                                <p class="text-navy-500 text-sm">Photo coming soon</p>
                            </div>
                        </div>
                    </template>
                    <p class="text-center text-white font-heading font-medium mt-4" x-text="activeTitle"></p>
                </div>
            </div>
        </template>
    </section>

    <x-cta-banner
        title="We're here to help you hear better, live better."
        subtitle="Book an appointment or visit our nearest centre today."
    />
</x-layouts.app>
