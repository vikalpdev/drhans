@props(['specialist', 'showQualification' => true])

<div class="group bg-white rounded-2xl border border-navy-100 hover:border-teal-100 overflow-hidden flex flex-col shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
    <div class="relative aspect-[4/3] overflow-hidden">
        @if ($specialist->is_chairman)
            <span class="absolute top-3 left-3 z-10 inline-flex items-center gap-1 bg-gradient-to-r from-navy-600 to-navy-700 text-white text-[10px] font-bold uppercase tracking-wide px-2.5 py-1 rounded-full shadow-md">
                <x-app-icon name="award" class="w-3 h-3" /> Chairman
            </span>
        @endif
        <x-media-image :model="$specialist" collection="photo" conversion="card" :alt="$specialist->name" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
        <div class="absolute inset-x-0 bottom-0 h-16 bg-gradient-to-t from-navy-900/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        <div class="absolute bottom-3 inset-x-0 flex justify-center gap-2 opacity-0 group-hover:opacity-100 translate-y-2 group-hover:translate-y-0 transition-all duration-300">
            <a href="{{ route('appointment.create', ['specialist' => $specialist->slug]) }}" class="w-9 h-9 rounded-full bg-white flex items-center justify-center text-teal-600 hover:bg-teal-500 hover:text-white transition-colors" title="Book Appointment">
                <x-app-icon name="calendar" class="w-4 h-4" />
            </a>
        </div>
    </div>
    <div class="p-4 flex flex-col flex-1">
        <h3 class="font-heading font-semibold text-navy-600 group-hover:text-teal-600 transition-colors duration-200">
            <a href="{{ route('specialists.show', $specialist) }}">{{ $specialist->name }}</a>
        </h3>
        @if ($showQualification)
            <p class="text-xs text-navy-500 mt-0.5">{{ $specialist->qualifications }}</p>
        @endif
        <div class="flex flex-wrap items-center gap-1.5 mt-2.5">
            <span class="inline-flex w-fit items-center text-[11px] font-semibold text-teal-600 bg-mint-100 px-2.5 py-1 rounded-full">{{ $specialist->designation }}</span>
        </div>
        <div class="mt-auto pt-4">
            <a href="{{ route('specialists.show', $specialist) }}" class="w-full inline-flex items-center justify-center border-2 border-teal-500 text-teal-700 hover:bg-teal-500 hover:text-white font-heading font-semibold text-sm px-4 py-2 rounded-full transition-colors duration-200">
                View Profile
            </a>
        </div>
    </div>
</div>
