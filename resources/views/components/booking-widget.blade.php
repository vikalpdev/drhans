@props(['centres', 'specialist' => null])

<div
    class="bg-white rounded-2xl shadow-lg p-6 h-fit"
    x-data="{
        open: null,
        centre: '', centreLabel: 'Choose a centre',
        date: '', dateLabel: 'Choose date',
        calMonth: new Date().getMonth(),
        calYear: new Date().getFullYear(),
        monthNames: ['January','February','March','April','May','June','July','August','September','October','November','December'],
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
            if (!d || !this.date) return false;
            const [y, m, dd] = this.date.split('-').map(Number);
            return d === dd && this.calMonth === (m - 1) && this.calYear === y;
        },
        selectDay(d) {
            if (!d || this.isPast(d)) return;
            const mm = String(this.calMonth + 1).padStart(2, '0');
            const dd = String(d).padStart(2, '0');
            this.date = `${this.calYear}-${mm}-${dd}`;
            this.dateLabel = `${dd}/${mm}/${this.calYear}`;
            this.open = null;
        },
    }"
    @click.outside="open = null"
>
    <h3 class="font-heading font-bold text-navy-600 mb-5 flex items-center gap-2">
        <x-app-icon name="calendar" class="w-4 h-4 text-teal-500" /> Book an Appointment
    </h3>
    <form action="{{ route('appointment.create') }}" method="GET" class="space-y-4">
        @if ($specialist)
            <input type="hidden" name="specialist" value="{{ $specialist }}">
        @endif
        <input type="hidden" name="centre" x-bind:value="centre">
        <input type="hidden" name="date" x-bind:value="date">

        <div>
            <label class="block text-xs font-semibold text-navy-500 mb-1.5">Select Centre</label>
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
                    class="absolute z-20 mt-2 w-full bg-white rounded-xl shadow-xl border border-navy-100 py-2 max-h-56 overflow-y-auto"
                >
                    <button type="button" @click="centre=''; centreLabel='Choose a centre'; open=null" class="block w-full text-left px-4 py-2 text-sm text-navy-600 hover:bg-mint-100 transition-colors">Choose a centre</button>
                    @foreach ($centres as $centre)
                        <button type="button" @click="centre='{{ $centre->slug }}'; centreLabel='{{ $centre->name }}'; open=null" class="block w-full text-left px-4 py-2 text-sm text-navy-600 hover:bg-mint-100 transition-colors">{{ $centre->name }}</button>
                    @endforeach
                </div>
            </div>
        </div>

        <div>
            <label class="block text-xs font-semibold text-navy-500 mb-1.5">Preferred Date</label>
            <div class="relative">
                <button
                    type="button"
                    @click="open = (open === 'date' ? null : 'date')"
                    class="w-full flex items-center gap-3 rounded-xl border bg-white pl-4 pr-3.5 py-2.5 text-left transition-colors duration-200"
                    :class="open === 'date' ? 'border-teal-500 ring-1 ring-teal-500' : 'border-navy-100 hover:border-teal-300'"
                >
                    <x-app-icon name="calendar" class="w-4 h-4 text-navy-400 shrink-0" />
                    <span class="flex-1 text-sm text-navy-600 truncate" x-text="dateLabel"></span>
                    <x-app-icon name="chevron-down" class="w-4 h-4 text-navy-400 shrink-0 transition-transform duration-150" x-bind:class="open === 'date' && 'rotate-180'" />
                </button>
                <div
                    x-show="open === 'date'" x-cloak
                    x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
                    class="absolute z-20 mt-2 w-full bg-white rounded-xl shadow-xl border border-navy-100 p-4"
                >
                    <div class="flex items-center justify-between mb-3">
                        <button type="button" @click="prevMonth()" class="p-1.5 rounded-lg hover:bg-mint-100 transition-colors">
                            <x-app-icon name="chevron-right" class="w-4 h-4 rotate-180 text-navy-500" />
                        </button>
                        <p class="font-heading font-semibold text-sm text-navy-600" x-text="monthNames[calMonth] + ' ' + calYear"></p>
                        <button type="button" @click="nextMonth()" class="p-1.5 rounded-lg hover:bg-mint-100 transition-colors">
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
                                class="w-8 h-8 rounded-lg text-sm transition-colors flex items-center justify-center"
                                :class="{
                                    'invisible': day === null,
                                    'bg-teal-500 text-white font-semibold': day && isSelected(day),
                                    'text-teal-600 font-semibold ring-1 ring-teal-500': day && isToday(day) && !isSelected(day),
                                    'text-navy-600 hover:bg-mint-100': day && !isSelected(day) && !isToday(day) && !isPast(day),
                                    'text-navy-200 cursor-not-allowed': day && isPast(day),
                                }"
                            ></button>
                        </template>
                    </div>
                    <button type="button" @click="date=''; dateLabel='Choose date'; open=null" class="mt-3 w-full text-center text-xs font-medium text-navy-500 hover:text-teal-600 transition-colors">
                        Clear date
                    </button>
                </div>
            </div>
        </div>

        <button type="submit" class="group w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-navy-600 to-navy-700 hover:from-navy-700 hover:to-navy-800 text-white font-heading font-semibold py-3 rounded-full text-sm shadow-md shadow-navy-600/20 hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0 active:shadow-sm transition-all duration-200">
            <x-app-icon name="calendar" class="w-4 h-4 transition-transform duration-200 group-hover:scale-110" /> Book Now
        </button>
    </form>
</div>
