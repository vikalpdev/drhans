@props(['item'])

<button
    type="button"
    @click="lightboxOpen = true; activeImage = @js($item->getFirstMediaUrl('image')) || null; activeTitle = @js($item->title)"
    class="group relative rounded-xl overflow-hidden aspect-[4/3] shadow-sm hover:shadow-xl transition-shadow duration-300 text-left w-full"
>
    <x-media-image :model="$item" collection="image" conversion="thumb" :alt="$item->title" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
    <div class="absolute inset-0 bg-navy-900/0 group-hover:bg-navy-900/30 transition-colors duration-300"></div>
    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 scale-90 group-hover:scale-100 transition-all duration-300">
        <div class="w-11 h-11 rounded-full bg-white/90 flex items-center justify-center">
            <x-app-icon name="search" class="w-5 h-5 text-navy-600" />
        </div>
    </div>
    <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-navy-900/85 to-transparent p-3">
        <span class="text-white text-sm font-medium">{{ $item->title }}</span>
    </div>
</button>
