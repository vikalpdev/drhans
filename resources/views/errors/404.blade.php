<x-layouts.app title="Page Not Found">
    <section class="relative bg-gradient-to-b from-mint-50 to-white overflow-hidden">
        <div class="absolute -top-24 -right-24 w-80 h-80 bg-teal-200/25 rounded-full blur-3xl hidden sm:block"></div>
        <div class="absolute -bottom-24 -left-24 w-72 h-72 bg-navy-200/15 rounded-full blur-3xl hidden sm:block"></div>

        <div class="relative mx-auto max-w-3xl px-6 py-20 lg:py-28 text-center">
            <div class="relative inline-flex items-center justify-center mb-6">
                <p class="font-heading font-extrabold text-[110px] lg:text-[140px] leading-none text-navy-100 select-none">404</p>
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="w-20 h-20 rounded-full bg-white shadow-xl flex items-center justify-center">
                        <x-app-icon name="search" class="w-9 h-9 text-teal-500" />
                    </div>
                </div>
            </div>

            <h1 class="font-heading font-extrabold text-2xl lg:text-3xl text-navy-600">Oops! This page seems to have lost its way.</h1>
            <p class="mt-3 text-navy-500 max-w-lg mx-auto">The page you're looking for doesn't exist or may have been moved. Let's get you back to the care you need.</p>

            <div class="mt-8 flex flex-wrap justify-center gap-3">
                <a href="{{ route('home') }}" class="group inline-flex items-center gap-2 bg-gradient-to-r from-navy-600 to-navy-700 hover:from-navy-700 hover:to-navy-800 text-white font-heading font-semibold px-6 py-3 rounded-full text-sm shadow-md shadow-navy-600/20 hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200">
                    <x-app-icon name="arrow-right" class="w-4 h-4 rotate-180 transition-transform duration-200 group-hover:-translate-x-1" /> Back to Home
                </a>
                <a href="{{ route('appointment.create') }}" class="inline-flex items-center gap-2 border-2 border-teal-500 text-teal-700 hover:bg-teal-500 hover:text-white font-heading font-semibold px-6 py-3 rounded-full text-sm transition-colors duration-200">
                    <x-app-icon name="calendar" class="w-4 h-4" /> Book Appointment
                </a>
            </div>

            <div class="mt-12 grid grid-cols-2 sm:grid-cols-4 gap-4 max-w-xl mx-auto">
                @foreach ([
                    ['ear', 'Speciality Service', route('treatments.index')],
                    ['user-group', 'Specialists', route('specialists.index')],
                    ['location', 'Our Centres', route('centres.index')],
                    ['phone', 'Contact Us', route('contact.index')],
                ] as [$icon, $label, $url])
                    <a href="{{ $url }}" class="group bg-white rounded-2xl border border-navy-100 hover:border-teal-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 p-4 text-center">
                        <div class="w-10 h-10 rounded-xl bg-mint-100 group-hover:bg-teal-500 flex items-center justify-center mx-auto mb-2 transition-colors duration-300">
                            <x-app-icon :name="$icon" class="w-5 h-5 text-teal-500 group-hover:text-white transition-colors duration-300" />
                        </div>
                        <p class="font-heading font-semibold text-navy-600 text-xs">{{ $label }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
</x-layouts.app>
