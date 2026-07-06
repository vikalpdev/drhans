@props([
    'model',
    'collection' => 'image',
    'conversion' => 'card',
    'alt' => '',
    'icon' => null,
    'eager' => false,
])

@php
    $media = $model?->getFirstMedia($collection);
    $src = $media?->getUrl($conversion) ?: $media?->getUrl();
@endphp

@if ($src)
    <img
        src="{{ $src }}"
        alt="{{ $alt }}"
        loading="{{ $eager ? 'eager' : 'lazy' }}"
        @if ($eager) fetchpriority="high" @endif
        {{ $attributes }}
    >
@else
    <div {{ $attributes->merge(['class' => 'flex items-center justify-center bg-gradient-to-br from-navy-50 to-teal-50']) }}>
        @if ($icon)
            <x-app-icon :name="$icon" class="w-10 h-10 text-teal-500/60" />
        @else
            <svg class="w-10 h-10 text-teal-500/40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3 4.5h18M3 4.5v15a2.25 2.25 0 002.25 2.25h13.5A2.25 2.25 0 0021 19.5v-15M3 4.5A2.25 2.25 0 015.25 2.25h13.5A2.25 2.25 0 0121 4.5m-13.5 4.5h.008v.008H7.5V9z" />
            </svg>
        @endif
    </div>
@endif
