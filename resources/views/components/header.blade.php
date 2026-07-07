@props(['navCentres' => collect(), 'navTreatments' => collect(), 'navConditionGroups' => collect()])

<header x-data="{ mobileOpen: false, centresOpen: false, treatmentsOpen: false, conditionsOpen: false }" class="fixed inset-x-0 top-0 z-50">
    {{-- Top bar --}}
    <div class="hidden lg:block bg-navy-700 text-white text-sm">
        <div class="mx-auto max-w-7xl px-6 flex items-center justify-between h-9">
            <div class="flex items-center gap-2">
                <x-app-icon name="phone" class="w-4 h-4" />
                <span>Emergency ENT Care</span>
                <a href="tel:+919811703926" class="font-semibold hover:text-teal-300">+91-9811703926</a>
            </div>
            <div class="flex items-center gap-6">
                <span class="flex items-center gap-1"><x-app-icon name="location" class="w-4 h-4" /> Select Location</span>
                <a href="https://wa.me/919811703926" target="_blank" class="flex items-center gap-1 hover:text-teal-300">
                    <x-app-icon name="whatsapp" class="w-4 h-4" /> WhatsApp Us
                </a>
            </div>
        </div>
    </div>

    {{-- Main nav --}}
    <div class="bg-white shadow-sm">
        <div class="mx-auto max-w-7xl px-6 flex items-center justify-between h-16 lg:h-[70px]">
            <a href="{{ route('home') }}" class="flex items-center gap-2 shrink-0">
                <span class="font-heading font-extrabold text-xl text-navy-700 leading-none">Dr Hans'</span>
                <span class="hidden sm:block text-[10px] tracking-widest text-teal-500 font-semibold uppercase">Centre for ENT</span>
            </a>

            <nav class="hidden lg:flex items-center gap-7 font-heading text-[15px] font-medium text-navy-700">
                <a href="{{ route('home') }}" class="hover:text-teal-500 {{ request()->routeIs('home') ? 'text-teal-500' : '' }}">Home</a>

                <div class="relative" @mouseenter="centresOpen = true" @mouseleave="centresOpen = false">
                    <button class="flex items-center gap-1 hover:text-teal-500">Our Centres <x-app-icon name="chevron-down" class="w-3.5 h-3.5" /></button>
                    <div x-show="centresOpen" x-cloak x-transition class="absolute left-0 top-full pt-3 w-64">
                        <div class="bg-white rounded-xl shadow-xl border border-navy-100 py-2">
                            @foreach ($navCentres as $centre)
                                <a href="{{ route('centres.index') }}#{{ $centre->slug }}" class="block px-4 py-2 text-sm hover:bg-mint-100">{{ $centre->name }}</a>
                            @endforeach
                            <a href="{{ route('centres.index') }}" class="block px-4 py-2 text-sm font-semibold text-teal-500 border-t border-navy-100 mt-1 pt-2">View All Centres</a>
                        </div>
                    </div>
                </div>

                <div class="relative" @mouseenter="treatmentsOpen = true" @mouseleave="treatmentsOpen = false">
                    <button class="flex items-center gap-1 hover:text-teal-500">Speciality Service <x-app-icon name="chevron-down" class="w-3.5 h-3.5" /></button>
                    <div x-show="treatmentsOpen" x-cloak x-transition class="absolute left-0 top-full pt-3 w-72">
                        <div class="bg-white rounded-xl shadow-xl border border-navy-100 py-2">
                            @foreach ($navTreatments as $treatment)
                                <a href="{{ route('treatments.show', $treatment) }}" class="block px-4 py-2 text-sm hover:bg-mint-100">{{ $treatment->name }}</a>
                            @endforeach
                            <a href="{{ route('treatments.index') }}" class="block px-4 py-2 text-sm font-semibold text-teal-500 border-t border-navy-100 mt-1 pt-2">View All Speciality Services</a>
                        </div>
                    </div>
                </div>

                <a href="{{ route('specialists.index') }}" class="hover:text-teal-500 {{ request()->routeIs('specialists.*') ? 'text-teal-500' : '' }}">Specialists</a>

                <div class="relative" @mouseenter="conditionsOpen = true" @mouseleave="conditionsOpen = false">
                    <button class="flex items-center gap-1 hover:text-teal-500 {{ request()->routeIs('conditions.*') ? 'text-teal-500' : '' }}">Conditions Treated <x-app-icon name="chevron-down" class="w-3.5 h-3.5" /></button>
                    <div x-show="conditionsOpen" x-cloak x-transition class="absolute right-0 top-full pt-3 w-[640px]">
                        <div class="bg-white rounded-xl shadow-xl border border-navy-100 p-5">
                            <div class="grid grid-cols-3 gap-x-6 gap-y-5">
                                @foreach ($navConditionGroups as $group)
                                    <div>
                                        @if ($group['items']->count() > 1)
                                            <p class="px-2 text-xs font-semibold text-teal-600 uppercase tracking-wide mb-1.5">{{ $group['label'] }}</p>
                                            @foreach ($group['items'] as $item)
                                                <a href="{{ route('conditions.show', $item) }}" class="block px-2 py-1.5 text-sm rounded-lg hover:bg-mint-100">{{ $item->name }}</a>
                                            @endforeach
                                        @else
                                            <a href="{{ route('conditions.show', $group['items']->first()) }}" class="block px-2 py-1.5 text-sm font-semibold text-navy-700 rounded-lg hover:bg-mint-100">{{ $group['label'] }}</a>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            <a href="{{ route('conditions.index') }}" class="block mt-4 px-2 py-2 text-sm font-semibold text-teal-500 border-t border-navy-100 pt-3">View All Conditions</a>
                        </div>
                    </div>
                </div>

                <div class="relative" x-data="{ moreOpen: false }" @mouseenter="moreOpen = true" @mouseleave="moreOpen = false">
                    <button class="flex items-center gap-1 hover:text-teal-500">More <x-app-icon name="chevron-down" class="w-3.5 h-3.5" /></button>
                    <div x-show="moreOpen" x-cloak x-transition class="absolute right-0 top-full pt-3 w-56">
                        <div class="bg-white rounded-xl shadow-xl border border-navy-100 py-2">
                            <a href="{{ route('about.index') }}" class="block px-4 py-2 text-sm hover:bg-mint-100">About Us</a>
                            <a href="{{ route('about.chairman') }}" class="block px-4 py-2 text-sm hover:bg-mint-100">Chairman's Desk</a>
                            <a href="{{ route('gallery.index') }}" class="block px-4 py-2 text-sm hover:bg-mint-100">Photo Gallery</a>
                            <a href="{{ route('gallery.videos') }}" class="block px-4 py-2 text-sm hover:bg-mint-100">Video Gallery</a>
                            <a href="{{ route('careers.index') }}" class="block px-4 py-2 text-sm hover:bg-mint-100">Careers</a>
                            <a href="{{ route('contact.index') }}" class="block px-4 py-2 text-sm hover:bg-mint-100">Contact Us</a>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="flex items-center gap-3">
                <a href="{{ route('appointment.create') }}" class="group hidden lg:inline-flex items-center gap-2 bg-gradient-to-r from-navy-600 to-navy-700 hover:from-navy-700 hover:to-navy-800 text-white font-heading font-semibold text-sm px-5 py-2.5 rounded-full shadow-md shadow-navy-600/20 hover:shadow-lg hover:shadow-navy-600/30 transition-all duration-200">
                    <x-app-icon name="calendar" class="w-4 h-4 transition-transform duration-200 group-hover:scale-110" /> Book Appointment
                </a>
                <button @click="mobileOpen = true" class="lg:hidden p-2 text-navy-700" aria-label="Open menu">
                    <x-app-icon name="menu" class="w-7 h-7" />
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile drawer --}}
    <div x-show="mobileOpen" x-cloak class="lg:hidden fixed inset-0 z-[60]">
        <div class="absolute inset-0 bg-navy-900/50" @click="mobileOpen = false" x-show="mobileOpen" x-transition.opacity></div>
        <div x-show="mobileOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full" class="absolute right-0 top-0 h-full w-[85%] max-w-sm bg-white overflow-y-auto">
            <div class="flex items-center justify-between px-5 h-16 border-b border-navy-100">
                <span class="font-heading font-bold text-navy-700">Menu</span>
                <button @click="mobileOpen = false" class="p-2" aria-label="Close menu"><x-app-icon name="close" class="w-6 h-6" /></button>
            </div>
            <nav class="p-5 flex flex-col gap-1 font-heading font-medium text-navy-700">
                <a href="{{ route('home') }}" class="py-3 border-b border-navy-50">Home</a>
                <a href="{{ route('about.index') }}" class="py-3 border-b border-navy-50">About Us</a>
                <a href="{{ route('centres.index') }}" class="py-3 border-b border-navy-50">Our Centres</a>
                <a href="{{ route('treatments.index') }}" class="py-3 border-b border-navy-50">Speciality Service</a>
                <a href="{{ route('specialists.index') }}" class="py-3 border-b border-navy-50">Specialists</a>
                <a href="{{ route('conditions.index') }}" class="py-3 border-b border-navy-50">Conditions Treated</a>
                <a href="{{ route('gallery.index') }}" class="py-3 border-b border-navy-50">Photo Gallery</a>
                <a href="{{ route('gallery.videos') }}" class="py-3 border-b border-navy-50">Video Gallery</a>
                <a href="{{ route('careers.index') }}" class="py-3 border-b border-navy-50">Careers</a>
                <a href="{{ route('contact.index') }}" class="py-3 border-b border-navy-50">Contact Us</a>
                <a href="{{ route('appointment.create') }}" class="mt-4 inline-flex items-center justify-center gap-2 bg-gradient-to-r from-navy-600 to-navy-700 text-white font-semibold px-5 py-3 rounded-full shadow-md shadow-navy-600/20">
                    <x-app-icon name="calendar" class="w-4 h-4" /> Book Appointment
                </a>
                <a href="tel:+919811703926" class="mt-2 inline-flex items-center justify-center gap-2 border-2 border-teal-500 text-teal-700 font-semibold px-5 py-3 rounded-full">
                    <x-app-icon name="phone" class="w-4 h-4" /> +91-98117 03926
                </a>
            </nav>
        </div>
    </div>
</header>
