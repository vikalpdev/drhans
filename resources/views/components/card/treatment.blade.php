@props(['treatment'])

<a href="{{ route('treatments.show', $treatment) }}" class="group relative h-full bg-white rounded-2xl border border-transparent hover:border-teal-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col">
    <div class="rounded-t-2xl overflow-hidden aspect-[16/10]">
        <x-media-image :model="$treatment" collection="hero_image" conversion="thumb" :alt="$treatment->name" :icon="$treatment->icon ?? 'heart'" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
    </div>
    <div class="p-5 flex flex-col flex-1">
        <div class="relative z-10 w-11 h-11 rounded-full bg-mint-100 group-hover:bg-teal-500 flex items-center justify-center -mt-9 mb-3 border-4 border-white transition-colors duration-300">
            <x-app-icon :name="$treatment->icon ?? 'heart'" class="w-5 h-5 text-teal-500 group-hover:text-white group-hover:scale-110 transition-all duration-300" />
        </div>
        <h3 class="font-heading font-semibold text-navy-600">{{ $treatment->name }}</h3>
        <p class="text-sm text-navy-500 mt-2 flex-1 line-clamp-2">{{ $treatment->summary }}</p>
        <span class="mt-4 inline-flex items-center gap-1 text-teal-500 font-heading font-semibold text-sm">
            Learn More <x-app-icon name="chevron-right" class="w-4 h-4 transition-transform duration-200 group-hover:translate-x-1" />
        </span>
    </div>
</a>
