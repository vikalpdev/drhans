@props([
    'title' => 'Need Immediate ENT Assistance?',
    'subtitle' => 'Our team is here to help you. Get expert care, right when you need it.',
])
@php $siteSettings = \App\Models\Setting::current(); @endphp

<section class="relative bg-gradient-to-r from-navy-600 to-navy-700 overflow-hidden">
    <div class="absolute -top-16 -right-16 w-56 h-56 bg-teal-500/20 rounded-full blur-3xl hidden sm:block"></div>
    <div class="absolute -bottom-20 -left-20 w-56 h-56 bg-teal-500/10 rounded-full blur-3xl hidden sm:block"></div>

    <div class="relative mx-auto max-w-7xl px-6 py-8 flex flex-col lg:flex-row items-center justify-between gap-5 text-white">
        <div class="flex items-center gap-4 text-center lg:text-left">
            <x-app-icon name="phone" class="w-9 h-9 hidden sm:block shrink-0 text-teal-300" />
            <div>
                <h2 class="font-heading font-bold text-xl">{{ $title }}</h2>
                <p class="text-navy-200 text-sm mt-1">{{ $subtitle }}</p>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-2.5 sm:gap-3 w-full sm:flex sm:flex-wrap sm:w-auto sm:justify-center">
            <a href="{{ $siteSettings->phoneUrl() }}" class="group inline-flex items-center justify-center gap-1.5 sm:gap-2 bg-white hover:bg-mint-50 text-navy-700 font-heading font-semibold px-3 sm:px-5 py-3 sm:py-2.5 rounded-full text-xs sm:text-sm whitespace-nowrap shadow-md hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200">
                <x-app-icon name="phone" class="w-4 h-4 shrink-0 transition-transform duration-200 group-hover:scale-110" /> Call Now
            </a>
            <a href="{{ $siteSettings->whatsappUrl() }}" target="_blank" class="group inline-flex items-center justify-center gap-1.5 sm:gap-2 border-2 border-white/50 text-white hover:bg-white/10 hover:border-white font-heading font-semibold px-3 sm:px-5 py-3 sm:py-2.5 rounded-full text-xs sm:text-sm whitespace-nowrap hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200">
                <x-app-icon name="whatsapp" class="w-4 h-4 shrink-0 transition-transform duration-200 group-hover:scale-110" /> WhatsApp Us
            </a>
            <a href="{{ route('appointment.create') }}" class="group col-span-2 sm:col-span-1 inline-flex items-center justify-center gap-2 bg-gradient-to-r from-teal-500 to-teal-600 hover:from-teal-600 hover:to-teal-700 text-white font-heading font-semibold px-4 sm:px-5 py-3 sm:py-2.5 rounded-full text-xs sm:text-sm whitespace-nowrap shadow-md shadow-teal-500/30 hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200">
                <x-app-icon name="calendar" class="w-4 h-4 shrink-0 transition-transform duration-200 group-hover:scale-110" /> Book Emergency Consultation
            </a>
        </div>
    </div>
</section>
