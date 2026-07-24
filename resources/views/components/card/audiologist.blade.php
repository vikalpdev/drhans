@props(['specialist'])

<div class="group bg-white rounded-2xl border border-navy-100 hover:border-teal-100 overflow-hidden flex flex-col shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
    <div class="relative aspect-[4/3] overflow-hidden">
        <x-media-image :model="$specialist" collection="photo" conversion="card" :alt="$specialist->name" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
    </div>
    <div class="p-4 flex flex-col flex-1">
        <h3 class="font-heading font-semibold text-navy-600 group-hover:text-teal-600 transition-colors duration-200">
            <a href="{{ route('specialists.show', $specialist) }}">{{ $specialist->name }}</a>
        </h3>

        @if ($specialist->designation)
            <div class="mt-2.5">
                <span class="inline-flex w-fit items-center text-[11px] font-semibold text-teal-600 bg-mint-100 px-2.5 py-1 rounded-full">{{ $specialist->designation }}</span>
            </div>
        @endif

        <div class="mt-auto pt-4">
            <a href="{{ route('specialists.show', $specialist) }}" class="w-full inline-flex items-center justify-center border-2 border-teal-500 text-teal-700 hover:bg-teal-500 hover:text-white font-heading font-semibold text-sm px-4 py-2 rounded-full transition-colors duration-200">
                Know More
            </a>
        </div>
    </div>
</div>
