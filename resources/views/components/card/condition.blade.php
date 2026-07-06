@props(['condition'])

<a href="{{ route('conditions.show', $condition) }}" class="group relative h-full bg-white hover:bg-gradient-to-br hover:from-teal-500 hover:to-navy-600 rounded-2xl border border-navy-100 hover:border-transparent shadow-sm hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 p-6 flex flex-col overflow-hidden">
    <x-app-icon :name="$condition->icon ?? 'heart'" class="absolute -right-5 -top-5 w-28 h-28 text-mint-100 group-hover:text-white/10 transition-colors duration-300" />

    <div class="relative w-14 h-14 rounded-2xl bg-mint-100 group-hover:bg-white/15 flex items-center justify-center mb-4 transition-colors duration-300">
        <x-app-icon :name="$condition->icon ?? 'heart'" class="w-6 h-6 text-teal-500 group-hover:text-white transition-colors duration-300" />
    </div>
    <h3 class="relative font-heading font-semibold text-navy-600 group-hover:text-white transition-colors duration-300">{{ $condition->name }}</h3>
    <p class="relative text-sm text-navy-500 group-hover:text-white/90 mt-2 flex-1 line-clamp-2 transition-colors duration-300">{{ $condition->summary }}</p>
    <span class="relative mt-4 inline-flex items-center gap-1 text-teal-500 group-hover:text-white font-heading font-semibold text-sm transition-colors duration-300">
        Learn More <x-app-icon name="chevron-right" class="w-4 h-4 transition-transform duration-200 group-hover:translate-x-1" />
    </span>
</a>
