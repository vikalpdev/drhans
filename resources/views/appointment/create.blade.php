<x-layouts.app title="Book an Appointment" description="Book your ENT, hearing or vertigo consultation at Dr Hans' Centre for ENT. Choose your preferred centre, doctor and time slot in a few quick steps.">
    <x-hero
        title="Book an Appointment"
        subtitle="Schedule your visit with our ENT specialists. Select your preferred centre, doctor and time. We're here to help you hear better, breathe better and live better."
        :breadcrumbs="['Book an Appointment' => null]"
    >
        <x-slot:stats>
            @foreach (['Quick & Easy Booking', 'Flexible Timings', 'Experienced ENT Specialists', 'Patient First Approach'] as $s)
                <span class="flex items-center gap-1.5"><x-app-icon name="check-circle" class="w-4 h-4 text-teal-500" /> {{ $s }}</span>
            @endforeach
        </x-slot:stats>
    </x-hero>

    <section class="mx-auto max-w-7xl px-6 py-16 grid lg:grid-cols-[1fr_340px] gap-8">
        <div class="bg-white rounded-2xl border border-navy-100 p-6 lg:p-8"
             x-data="{
                step: {{ $errors->any() ? 3 : 1 }},
                open: null,
                centre_id: '{{ old('centre_id', $selectedCentre?->id) }}',
                centreLabel: '{{ old('centre_id') ? ($centres->firstWhere('id', (int) old('centre_id'))?->name ?? 'Choose your preferred centre') : ($selectedCentre?->name ?? 'Choose your preferred centre') }}',
                department: '{{ old('department', $selectedDepartment ?? 'ENT') }}',
                specialist_id: '{{ old('specialist_id', $selectedSpecialist?->id) }}',
                specialistLabel: '{{ old('specialist_id') ? ($specialists->firstWhere('id', (int) old('specialist_id'))?->name ?? 'Any Available Doctor') : ($selectedSpecialist?->name ?? 'Any Available Doctor') }}',
                preferred_date: '{{ old('preferred_date', $selectedDate) }}',
                preferred_time: '{{ old('preferred_time') }}',
                name: '{{ old('name') }}', phone: '{{ old('phone') }}', email: '{{ old('email') }}',
                centresMap: @js($centres->pluck('name', 'id')),
                specialistsMap: @js($specialists->pluck('name', 'id')),
                specialistCentres: @js($specialists->mapWithKeys(fn ($s) => [(string) $s->id => $s->centres->pluck('id')])),
                availableForCentre(specialistId) {
                    if (!this.centre_id) return true;
                    return (this.specialistCentres[specialistId] || []).includes(Number(this.centre_id));
                },
                calMonth: {{ $selectedDate ? (int) date('n', strtotime($selectedDate)) - 1 : now()->month - 1 }},
                calYear: {{ $selectedDate ? (int) date('Y', strtotime($selectedDate)) : now()->year }},
                monthNames: ['January','February','March','April','May','June','July','August','September','October','November','December'],
                next() { if (this.step < 3) this.step++ },
                back() { if (this.step > 1) this.step-- },
                get calendarDays() {
                    const firstDay = new Date(this.calYear, this.calMonth, 1).getDay();
                    const totalDays = new Date(this.calYear, this.calMonth + 1, 0).getDate();
                    const days = [];
                    for (let i = 0; i < firstDay; i++) days.push(null);
                    for (let d = 1; d <= totalDays; d++) days.push(d);
                    return days;
                },
                prevMonth() { this.calMonth--; if (this.calMonth < 0) { this.calMonth = 11; this.calYear--; } },
                nextMonth() { this.calMonth++; if (this.calMonth > 11) { this.calMonth = 0; this.calYear++; } },
                isPast(d) {
                    if (!d) return false;
                    const day = new Date(this.calYear, this.calMonth, d);
                    const today = new Date(); today.setHours(0, 0, 0, 0);
                    return day < today;
                },
                isToday(d) {
                    if (!d) return false;
                    const today = new Date();
                    return d === today.getDate() && this.calMonth === today.getMonth() && this.calYear === today.getFullYear();
                },
                isSelected(d) {
                    if (!d || !this.preferred_date) return false;
                    const [y, m, dd] = this.preferred_date.split('-').map(Number);
                    return d === dd && this.calMonth === (m - 1) && this.calYear === y;
                },
                selectDay(d) {
                    if (!d || this.isPast(d)) return;
                    const mm = String(this.calMonth + 1).padStart(2, '0');
                    const dd = String(d).padStart(2, '0');
                    this.preferred_date = `${this.calYear}-${mm}-${dd}`;
                    this.preferred_time = '';
                },
                get selectedDateLabel() {
                    if (!this.preferred_date) return '';
                    const [y, m, d] = this.preferred_date.split('-').map(Number);
                    return new Date(y, m - 1, d).toLocaleDateString('en-IN', { weekday: 'long', day: 'numeric', month: 'long' });
                },
                formatHour(h, min) {
                    const period = h >= 12 ? 'PM' : 'AM';
                    const displayHour = h % 12 === 0 ? 12 : h % 12;
                    return `${displayHour}:${String(min).padStart(2, '0')} ${period}`;
                },
                get timeSlots() {
                    if (!this.preferred_date) return [];
                    const [y, m, d] = this.preferred_date.split('-').map(Number);
                    const isSunday = new Date(y, m - 1, d).getDay() === 0;
                    const start = isSunday ? 10 : 9;
                    const end = isSunday ? 14 : 19;
                    const slots = [];
                    for (let h = start; h < end; h++) {
                        slots.push(this.formatHour(h, 0));
                        slots.push(this.formatHour(h, 30));
                    }
                    return slots;
                },
             }">

            @if (session('success'))
                <div class="mb-6 bg-mint-100 border border-teal-200 text-teal-800 rounded-lg p-4 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-navy-600 rounded-xl px-4 py-3 flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-full border-2 border-white/40 flex items-center justify-center shrink-0">
                    <x-app-icon name="user" class="w-5 h-5 text-white" />
                </div>
                <div>
                    <p class="font-heading font-semibold text-white text-sm leading-tight">Quick Appointment</p>
                    <p class="text-xs text-navy-200 leading-tight">Schedule your visit in just a few steps</p>
                </div>
            </div>

            {{-- Step indicator --}}
            <div class="flex items-center gap-2 mb-8">
                @foreach (['Centre & Doctor', 'Date & Time', 'Your Details'] as $i => $label)
                    <div class="flex items-center gap-2" :class="{ 'flex-1': {{ $i < 2 ? 'true' : 'false' }} }">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-heading font-bold shrink-0"
                             :class="step > {{ $i + 1 }} ? 'bg-teal-500 text-white' : (step === {{ $i + 1 }} ? 'bg-teal-500 text-white' : 'bg-navy-100 text-navy-400')">
                            {{ $i + 1 }}
                        </div>
                        <span class="text-xs font-medium hidden sm:block" :class="step === {{ $i + 1 }} ? 'text-navy-600' : 'text-navy-400'">{{ $label }}</span>
                        @if ($i < 2)
                            <div class="flex-1 h-px bg-navy-100"></div>
                        @endif
                    </div>
                @endforeach
            </div>

            <form action="{{ route('appointment.store') }}" method="POST" x-show="step === 3" x-cloak>
                @csrf
                <input type="hidden" name="centre_id" x-bind:value="centre_id">
                <input type="hidden" name="department" x-bind:value="department">
                <input type="hidden" name="specialist_id" x-bind:value="specialist_id">
                <input type="hidden" name="preferred_date" x-bind:value="preferred_date">
                <input type="hidden" name="preferred_time" x-bind:value="preferred_time">
                <input type="text" name="website" class="hidden" tabindex="-1" autocomplete="off">

                <div class="bg-mint-50 rounded-xl p-4 mb-6">
                    <div class="flex items-center justify-between mb-2">
                        <p class="text-xs font-semibold text-teal-700 uppercase tracking-wide">Your Appointment Summary</p>
                        <button type="button" @click="step = 1" class="text-xs font-semibold text-teal-600 hover:text-teal-700">Edit</button>
                    </div>
                    <div class="grid sm:grid-cols-2 gap-x-4 gap-y-1.5 text-sm text-navy-600">
                        <p class="flex items-center gap-2"><x-app-icon name="location" class="w-4 h-4 text-teal-500 shrink-0" /> <span x-text="centresMap[centre_id] || '—'"></span></p>
                        <p class="flex items-center gap-2"><x-app-icon name="user" class="w-4 h-4 text-teal-500 shrink-0" /> <span x-text="specialist_id ? (specialistsMap[specialist_id] || '—') : 'Any Available Doctor'"></span></p>
                        <p class="flex items-center gap-2"><x-app-icon name="calendar" class="w-4 h-4 text-teal-500 shrink-0" /> <span x-text="selectedDateLabel || '—'"></span></p>
                        <p class="flex items-center gap-2"><x-app-icon name="clock" class="w-4 h-4 text-teal-500 shrink-0" /> <span x-text="preferred_time || '—'"></span></p>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="text-xs font-medium text-navy-500">Full Name *</label>
                        <input type="text" name="name" x-model="name" required class="mt-1.5 w-full rounded-xl border border-navy-100 px-4 py-2.5 text-sm text-navy-600 transition-colors duration-200 focus:border-teal-500 focus:ring-1 focus:ring-teal-500 focus:outline-none @error('name') border-red-400 @enderror">
                        @error('name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs font-medium text-navy-500">Phone Number *</label>
                            <input type="tel" name="phone" x-model="phone" @input="phone = phone.replace(/\D/g, '').slice(0, 10)" inputmode="numeric" maxlength="10" pattern="\d{10}" title="Enter a 10-digit phone number" required class="mt-1.5 w-full rounded-xl border border-navy-100 px-4 py-2.5 text-sm text-navy-600 transition-colors duration-200 focus:border-teal-500 focus:ring-1 focus:ring-teal-500 focus:outline-none @error('phone') border-red-400 @enderror">
                            @error('phone') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="text-xs font-medium text-navy-500">Email Address</label>
                            <input type="email" name="email" x-model="email" class="mt-1.5 w-full rounded-xl border border-navy-100 px-4 py-2.5 text-sm text-navy-600 transition-colors duration-200 focus:border-teal-500 focus:ring-1 focus:ring-teal-500 focus:outline-none @error('email') border-red-400 @enderror">
                            @error('email') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <label class="flex items-start gap-2 text-xs text-navy-500">
                        <input type="checkbox" required class="mt-0.5 rounded border-navy-300">
                        I agree to the <a href="#" class="text-teal-500 underline">Privacy Policy</a> and <a href="#" class="text-teal-500 underline">Terms &amp; Conditions</a>
                    </label>
                </div>

                <div class="flex justify-between mt-8">
                    <button type="button" @click="back()" class="border-2 border-navy-200 text-navy-700 hover:border-teal-500 hover:text-teal-600 font-heading font-semibold text-sm px-6 py-2.5 rounded-full transition-colors duration-200">Back</button>
                    <button type="submit" class="inline-flex items-center gap-2 bg-gradient-to-r from-navy-600 to-navy-700 hover:from-navy-700 hover:to-navy-800 text-white font-heading font-semibold text-sm px-6 py-2.5 rounded-full shadow-md shadow-navy-600/20 hover:shadow-lg transition-all duration-200">
                        <x-app-icon name="check-circle" class="w-4 h-4" /> Confirm Appointment
                    </button>
                </div>
            </form>

            <div x-show="step === 1" @click.outside="open = null">
                <div class="space-y-4">
                    <div>
                        <label class="text-xs font-medium text-navy-500 mb-1.5 block">Select Centre</label>
                        <div class="relative">
                            <button
                                type="button"
                                @click="open = (open === 'centre' ? null : 'centre')"
                                class="w-full flex items-center gap-3 rounded-xl border bg-white pl-4 pr-3.5 py-2.5 text-left transition-colors duration-200"
                                :class="open === 'centre' ? 'border-teal-500 ring-1 ring-teal-500' : 'border-navy-100 hover:border-teal-300'"
                            >
                                <x-app-icon name="location" class="w-4 h-4 text-navy-400 shrink-0" />
                                <span class="flex-1 text-sm text-navy-600 truncate" x-text="centreLabel"></span>
                                <x-app-icon name="chevron-down" class="w-4 h-4 text-navy-400 shrink-0 transition-transform duration-150" x-bind:class="open === 'centre' && 'rotate-180'" />
                            </button>
                            <div
                                x-show="open === 'centre'" x-cloak
                                x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
                                class="absolute z-20 mt-2 w-full bg-white rounded-xl shadow-xl border border-navy-100 py-2 max-h-60 overflow-y-auto"
                            >
                                <button type="button" @click="centre_id=''; centreLabel='Choose your preferred centre'; open=null" class="block w-full text-left px-4 py-2 text-sm text-navy-600 hover:bg-mint-100 transition-colors">Choose your preferred centre</button>
                                @foreach ($centres as $centre)
                                    <button type="button" @click="centre_id='{{ $centre->id }}'; centreLabel='{{ $centre->name }}'; open=null; if (specialist_id && !availableForCentre(specialist_id)) { specialist_id=''; specialistLabel='Any Available Doctor'; }" class="block w-full text-left px-4 py-2 text-sm text-navy-600 hover:bg-mint-100 transition-colors">{{ $centre->name }}</button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="text-xs font-medium text-navy-500 mb-1.5 block">Select Doctor (Optional)</label>
                        <div class="relative">
                            <button
                                type="button"
                                @click="open = (open === 'specialist' ? null : 'specialist')"
                                class="w-full flex items-center gap-3 rounded-xl border bg-white pl-4 pr-3.5 py-2.5 text-left transition-colors duration-200"
                                :class="open === 'specialist' ? 'border-teal-500 ring-1 ring-teal-500' : 'border-navy-100 hover:border-teal-300'"
                            >
                                <x-app-icon name="user" class="w-4 h-4 text-navy-400 shrink-0" />
                                <span class="flex-1 text-sm text-navy-600 truncate" x-text="specialistLabel"></span>
                                <x-app-icon name="chevron-down" class="w-4 h-4 text-navy-400 shrink-0 transition-transform duration-150" x-bind:class="open === 'specialist' && 'rotate-180'" />
                            </button>
                            <div
                                x-show="open === 'specialist'" x-cloak
                                x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
                                class="absolute z-20 mt-2 w-full bg-white rounded-xl shadow-xl border border-navy-100 py-2 max-h-60 overflow-y-auto"
                            >
                                <button type="button" @click="specialist_id=''; specialistLabel='Any Available Doctor'; open=null" class="block w-full text-left px-4 py-2 text-sm text-navy-600 hover:bg-mint-100 transition-colors">Any Available Doctor</button>
                                @foreach ($specialists as $specialist)
                                    <button type="button" x-show="availableForCentre('{{ $specialist->id }}')" @click="specialist_id='{{ $specialist->id }}'; specialistLabel='{{ $specialist->name }}'; open=null" class="block w-full text-left px-4 py-2 text-sm text-navy-600 hover:bg-mint-100 transition-colors">{{ $specialist->name }}</button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-mint-50 rounded-lg p-4 mt-6 flex gap-3 text-sm text-navy-600">
                    <x-app-icon name="check-circle" class="w-5 h-5 text-teal-500 shrink-0" />
                    <p>Want to consult a specific doctor? You can select your preferred doctor (if available) or choose any available doctor for the earliest appointment.</p>
                </div>
                <div class="flex justify-end mt-8">
                    <button type="button" @click="next()" :disabled="!centre_id" class="inline-flex items-center gap-2 bg-gradient-to-r from-navy-600 to-navy-700 hover:from-navy-700 hover:to-navy-800 disabled:opacity-40 disabled:cursor-not-allowed text-white font-heading font-semibold text-sm px-6 py-2.5 rounded-full shadow-md shadow-navy-600/20 transition-all duration-200">Continue</button>
                </div>
            </div>

            <div x-show="step === 2" x-cloak>
                <div class="grid sm:grid-cols-[auto_1fr] gap-6">
                    {{-- Calendar --}}
                    <div class="bg-mint-50 rounded-xl p-4 sm:w-72">
                        <div class="flex items-center justify-between mb-3">
                            <button type="button" @click="prevMonth()" class="p-1.5 rounded-lg hover:bg-white transition-colors">
                                <x-app-icon name="chevron-right" class="w-4 h-4 rotate-180 text-navy-500" />
                            </button>
                            <p class="font-heading font-semibold text-sm text-navy-600" x-text="monthNames[calMonth] + ' ' + calYear"></p>
                            <button type="button" @click="nextMonth()" class="p-1.5 rounded-lg hover:bg-white transition-colors">
                                <x-app-icon name="chevron-right" class="w-4 h-4 text-navy-500" />
                            </button>
                        </div>
                        <div class="grid grid-cols-7 gap-1 text-center text-[11px] font-medium text-navy-400 mb-1">
                            <span>Su</span><span>Mo</span><span>Tu</span><span>We</span><span>Th</span><span>Fr</span><span>Sa</span>
                        </div>
                        <div class="grid grid-cols-7 gap-1">
                            <template x-for="(day, i) in calendarDays" :key="i">
                                <button
                                    type="button"
                                    @click="selectDay(day)"
                                    :disabled="day === null || isPast(day)"
                                    x-text="day ?? ''"
                                    class="w-9 h-9 rounded-lg text-sm transition-colors flex items-center justify-center"
                                    :class="{
                                        'invisible': day === null,
                                        'bg-teal-500 text-white font-semibold': day && isSelected(day),
                                        'text-teal-600 font-semibold ring-1 ring-teal-500': day && isToday(day) && !isSelected(day),
                                        'text-navy-600 hover:bg-white': day && !isSelected(day) && !isToday(day) && !isPast(day),
                                        'text-navy-200 cursor-not-allowed': day && isPast(day),
                                    }"
                                ></button>
                            </template>
                        </div>
                    </div>

                    {{-- Time slots --}}
                    <div>
                        <template x-if="!preferred_date">
                            <div class="h-full flex items-center justify-center text-center text-sm text-navy-400 border-2 border-dashed border-navy-100 rounded-xl p-8">
                                <p>Select a date to see available time slots</p>
                            </div>
                        </template>
                        <template x-if="preferred_date">
                            <div>
                                <p class="text-sm font-semibold text-navy-600 mb-3" x-text="'Available slots on ' + selectedDateLabel"></p>
                                <div class="grid grid-cols-3 sm:grid-cols-4 gap-2 max-h-64 overflow-y-auto pr-1">
                                    <template x-for="slot in timeSlots" :key="slot">
                                        <button
                                            type="button"
                                            @click="preferred_time = slot"
                                            x-text="slot"
                                            class="px-2 py-2 rounded-lg text-xs font-semibold border transition-colors duration-150"
                                            :class="preferred_time === slot ? 'bg-teal-500 border-teal-500 text-white shadow-md shadow-teal-500/20' : 'bg-white border-navy-100 text-navy-600 hover:border-teal-300 hover:text-teal-600'"
                                        ></button>
                                    </template>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <div class="bg-navy-50 rounded-lg p-4 mt-6 text-sm text-navy-600">
                    <p class="font-semibold text-navy-600 mb-1">Important Information</p>
                    <ul class="list-disc list-inside space-y-1 text-xs">
                        <li>Please arrive 15 minutes prior to your appointment time.</li>
                        <li>Carry your previous medical reports and prescriptions, if any.</li>
                        <li>In case you are unable to keep your appointment, please reschedule in advance.</li>
                        <li>For emergency care, please visit the nearest centre or call us.</li>
                    </ul>
                </div>
                <div class="flex justify-between mt-8">
                    <button type="button" @click="back()" class="border-2 border-navy-200 text-navy-700 hover:border-teal-500 hover:text-teal-600 font-heading font-semibold text-sm px-6 py-2.5 rounded-full transition-colors duration-200">Back</button>
                    <button type="button" @click="next()" :disabled="!preferred_date || !preferred_time" class="inline-flex items-center gap-2 bg-gradient-to-r from-navy-600 to-navy-700 hover:from-navy-700 hover:to-navy-800 disabled:opacity-40 disabled:cursor-not-allowed text-white font-heading font-semibold text-sm px-6 py-2.5 rounded-full shadow-md shadow-navy-600/20 transition-all duration-200">Continue</button>
                </div>
            </div>
        </div>

        <aside class="space-y-6">
            <div class="bg-white rounded-2xl border border-navy-100 p-6">
                <h3 class="font-heading font-bold text-navy-600 mb-2">Need Help?</h3>
                <p class="text-sm text-navy-500 mb-4">Our care team is happy to assist you.</p>
                @php $siteSettings = \App\Models\Setting::current(); @endphp
                <a href="{{ $siteSettings->phoneUrl() }}" class="inline-flex w-full items-center justify-center gap-2 border-2 border-teal-500 text-teal-700 hover:bg-teal-500 hover:text-white font-heading font-semibold px-4 py-2.5 rounded-full text-sm transition-colors duration-200">
                    <x-app-icon name="phone" class="w-4 h-4" /> {{ $siteSettings->phone }}
                </a>
                <p class="text-xs text-navy-400 mt-3">Timings: Mon - Sat: 9 AM - 7 PM<br>Sunday: 10 AM - 2 PM</p>
            </div>
            <div class="bg-mint-50 rounded-2xl p-6">
                <h3 class="font-heading font-bold text-navy-600 mb-3">Why Book With Us?</h3>
                <ul class="space-y-2">
                    @foreach (['Expert ENT specialists', 'Advanced technology & infrastructure', 'Personalised treatment', 'Multiple centres for your convenience', 'Safe & hygienic environment'] as $item)
                        <li class="flex items-center gap-2 text-sm text-navy-600"><x-app-icon name="check-circle" class="w-4 h-4 text-teal-500 shrink-0" /> {{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        </aside>
    </section>
</x-layouts.app>
