@props(['specialist'])

@php
    $university = collect($specialist->education ?? [])->first()['institution'] ?? null;
@endphp

<div class="group bg-white rounded-2xl border border-navy-100 hover:border-teal-100 overflow-hidden flex flex-col shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
    <div class="relative aspect-[4/3] overflow-hidden">
        <x-media-image :model="$specialist" collection="photo" conversion="card" :alt="$specialist->name" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
    </div>
    <div class="p-4 flex flex-col flex-1">
        <h3 class="font-heading font-semibold text-navy-600 group-hover:text-teal-600 transition-colors duration-200">
            <a href="{{ route('specialists.show', $specialist) }}">{{ $specialist->name }}</a>
        </h3>

        <div class="flex flex-wrap items-center gap-1.5 mt-2">
            @if ($specialist->experience_years)
                <span class="inline-flex w-fit items-center gap-1 text-[11px] font-semibold text-teal-600 bg-mint-100 px-2.5 py-1 rounded-full">
                    <x-app-icon name="clock" class="w-3 h-3 shrink-0" /> {{ $specialist->experience_years }}+ years of exp
                </span>
            @endif
            @if (!empty($specialist->languages))
                <span class="inline-flex w-fit items-center gap-1 text-[11px] font-semibold text-navy-500 bg-navy-50 px-2.5 py-1 rounded-full">
                    <x-app-icon name="chat" class="w-3 h-3 shrink-0" /> {{ implode(', ', $specialist->languages) }}
                </span>
            @endif
        </div>

        @if ($specialist->designation)
            <p class="text-xs text-navy-500 mt-2.5">{{ $specialist->designation }}</p>
        @endif

        @if ($specialist->qualifications || $university)
            <p class="text-xs text-navy-400 mt-1">
                {{ $specialist->qualifications }}{{ $specialist->qualifications && $university ? ' — ' : '' }}{{ $university }}
            </p>
        @endif

        <div class="mt-auto pt-4">
            <a href="{{ route('specialists.show', $specialist) }}" class="w-full inline-flex items-center justify-center border-2 border-teal-500 text-teal-700 hover:bg-teal-500 hover:text-white font-heading font-semibold text-sm px-4 py-2 rounded-full transition-colors duration-200">
                Know More
            </a>
        </div>
    </div>
</div>
