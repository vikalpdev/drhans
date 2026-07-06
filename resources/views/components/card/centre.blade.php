@props(['centre'])

<div id="{{ $centre->slug }}" class="group bg-white rounded-2xl border border-navy-100 hover:border-teal-100 overflow-hidden flex flex-col scroll-mt-32 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
    <div class="relative aspect-[16/9] overflow-hidden">
        <x-media-image :model="$centre" collection="image" conversion="card" :alt="$centre->name" icon="building" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
        <div class="absolute inset-x-0 bottom-0 h-14 bg-gradient-to-t from-navy-900/60 to-transparent"></div>
        <span class="absolute bottom-3 left-3 inline-flex items-center gap-1 bg-white/95 text-navy-700 text-[11px] font-semibold px-2.5 py-1 rounded-full shadow-sm">
            <x-app-icon name="location" class="w-3 h-3 text-teal-500" /> {{ $centre->city }}
        </span>
    </div>
    <div class="p-5 flex flex-col flex-1">
        <h3 class="font-heading font-semibold text-navy-600 group-hover:text-teal-600 transition-colors duration-200">{{ $centre->name }}</h3>
        <p class="text-sm text-navy-500 mt-1.5 line-clamp-2">{{ $centre->address }}</p>
        <div class="text-xs text-navy-500 mt-3 space-y-1.5">
            <p class="flex items-center gap-1.5">
                <x-app-icon name="clock" class="w-3.5 h-3.5 text-teal-500 shrink-0" /> {{ $centre->opd_weekday }}
            </p>
            <a href="tel:{{ $centre->phone }}" class="flex items-center gap-1.5 hover:text-teal-600 transition-colors w-fit">
                <x-app-icon name="phone" class="w-3.5 h-3.5 text-teal-500 shrink-0" /> {{ $centre->phone }}
            </a>
        </div>
        <div class="mt-auto pt-4 flex items-center gap-2">
            <a href="{{ route('appointment.create', ['centre' => $centre->slug]) }}" class="flex-1 inline-flex items-center justify-center gap-2 bg-gradient-to-r from-navy-600 to-navy-700 hover:from-navy-700 hover:to-navy-800 text-white font-heading font-semibold text-sm px-4 py-2.5 rounded-full shadow-md shadow-navy-600/20 hover:shadow-lg transition-all duration-200">
                Book Appointment
            </a>
            <a href="https://www.google.com/maps/dir/?api=1&destination={{ $centre->lat }},{{ $centre->lng }}" target="_blank" rel="noopener" aria-label="Get directions to {{ $centre->name }}" title="Get Directions" class="w-10 h-10 shrink-0 rounded-full border-2 border-teal-500 text-teal-600 hover:bg-teal-500 hover:text-white flex items-center justify-center transition-colors duration-200">
                <x-app-icon name="location" class="w-4 h-4" />
            </a>
        </div>
    </div>
</div>
