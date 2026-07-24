@props(['title', 'subtitle' => null, 'breadcrumbs' => [], 'image' => null, 'imageModel' => null, 'imageCollection' => 'image'])

@php
    $hasImage = $imageModel && $imageModel->getFirstMedia($imageCollection);
@endphp

<section class="relative bg-gradient-to-br from-mint-50 via-mint-50 to-white border-b border-navy-100 overflow-hidden">
    <div class="absolute -top-20 -right-20 w-72 h-72 bg-teal-200/20 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-navy-200/10 rounded-full blur-3xl"></div>

    <div class="relative mx-auto max-w-7xl px-6 py-8 lg:py-10 grid {{ $hasImage ? 'lg:grid-cols-3 gap-8 items-center' : '' }}">
        <div class="{{ $hasImage ? 'lg:col-span-2' : '' }}">
            @if (count($breadcrumbs))
                <nav class="text-sm text-navy-500 mb-3 flex items-center flex-wrap gap-1">
                    <a href="{{ route('home') }}" class="hover:text-teal-500">Home</a>
                    @foreach ($breadcrumbs as $label => $url)
                        <x-app-icon name="chevron-right" class="w-3.5 h-3.5" />
                        @if ($url)
                            <a href="{{ $url }}" class="hover:text-teal-500">{{ $label }}</a>
                        @else
                            <span class="text-navy-700">{{ $label }}</span>
                        @endif
                    @endforeach
                </nav>
            @endif

            <h1 class="font-heading font-extrabold text-2xl lg:text-3xl text-navy-600 leading-tight">{{ $title }}</h1>

            @if ($subtitle)
                <p class="mt-3 text-navy-600 max-w-2xl">{{ $subtitle }}</p>
            @endif

            @isset($stats)
                <div class="mt-5 flex flex-wrap items-center gap-x-6 gap-y-2 text-sm text-navy-600">
                    {{ $stats }}
                </div>
            @endisset

            @isset($actions)
                <div class="mt-5 flex flex-wrap gap-3">
                    {{ $actions }}
                </div>
            @endisset
        </div>

        @if ($hasImage)
            <div class="relative hidden lg:block lg:col-span-1">
                <div class="rounded-3xl overflow-hidden aspect-[16/10] shadow-xl">
                    <x-media-image :model="$imageModel" :collection="$imageCollection" conversion="hero" :alt="$title" eager class="w-full h-full object-cover" />
                </div>
            </div>
        @endif
    </div>
</section>
