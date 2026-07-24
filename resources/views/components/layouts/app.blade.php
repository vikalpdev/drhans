@props(['title' => null, 'description' => null])
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? "Dr Hans' Centre for ENT" }} | {{ config('app.name') }}</title>
    <meta name="description" content="{{ $description ?? "India's advanced ENT & Hearing Care network led by Padma Shri awardee Dr. J. M. Hans. Precision ENT, hearing, vertigo, sinus and cochlear implant care across Delhi NCR." }}">
    <link rel="icon" href="/favicon.ico" sizes="any">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-navy-600 antialiased">
    <a href="#main" class="sr-only focus:not-sr-only focus:absolute focus:top-2 focus:left-2 focus:z-[100] focus:bg-white focus:px-4 focus:py-2 focus:rounded">Skip to content</a>

    <x-header />

    <main id="main" class="pt-16 lg:pt-[106px]">
        {{ $slot }}
    </main>

    <x-footer />

    {{-- Floating quick actions --}}
    <div
        x-data="{ show: false }"
        @scroll.window.passive="show = window.scrollY > 500"
        x-show="show"
        x-cloak
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0 translate-y-4"
        class="fixed bottom-5 right-5 z-40 flex flex-col gap-2.5"
    >
        <a href="https://wa.me/919811703926" target="_blank" rel="noopener" aria-label="Chat on WhatsApp" class="w-12 h-12 rounded-full bg-[#25D366] shadow-lg shadow-black/15 flex items-center justify-center text-white hover:scale-110 active:scale-95 transition-transform duration-200">
            <x-app-icon name="whatsapp" class="w-6 h-6" />
        </a>
        <a href="tel:+919811703926" aria-label="Call us" class="w-12 h-12 rounded-full bg-gradient-to-br from-navy-600 to-navy-700 shadow-lg shadow-black/15 flex items-center justify-center text-white hover:scale-110 active:scale-95 transition-transform duration-200">
            <x-app-icon name="phone" class="w-5 h-5" />
        </a>
    </div>

    <x-chatbot />
</body>
</html>
