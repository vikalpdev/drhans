@props(['centres', 'specialists'])

<section class="mx-auto max-w-7xl px-6 pb-16">
    <form
        x-data="{
            open: null,
            centre: '', centreLabel: 'Choose a centre',
            specialist: '', specialistLabel: 'Choose a doctor',
            date: '', dateLabel: 'Choose date',
            specialistCentres: @js($specialists->mapWithKeys(fn ($s) => [$s->slug => $s->centres->pluck('slug')])),
            availableForCentre(specialistSlug) {
                if (!this.centre) return true;
                return (this.specialistCentres[specialistSlug] || []).includes(this.centre);
            },
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
            prevMonth() {
                this.calMonth--;
                if (this.calMonth < 0) { this.calMonth = 11; this.calYear--; }
            },
            nextMonth() {
                this.calMonth++;
                if (this.calMonth > 11) { this.calMonth = 0; this.calYear++; }
            },
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
        action="{{ route('appointment.create') }}"
        method="GET"
        class="bg-navy-600 rounded-2xl shadow-lg p-4 lg:p-5 grid lg:grid-cols-[auto_1fr_1fr_1fr_auto] gap-3 lg:gap-4 lg:items-center"
    >
        <div class="flex items-center gap-3 pr-2">
            <div class="w-11 h-11 rounded-full border-2 border-white/40 flex items-center justify-center shrink-0">
                <x-app-icon name="user" class="w-5 h-5 text-white" />
            </div>
            <div>
                <p class="font-heading font-semibold text-white text-sm leading-tight">Quick Appointment</p>
                <p class="text-xs text-navy-200 leading-tight">Schedule your visit<br>in just a few steps</p>
            </div>
        </div>

        {{-- Centre dropdown --}}
        <div class="relative">
            <button
                type="button"
                @click="open = (open === 'centre' ? null : 'centre')"
                class="w-full bg-white rounded-xl px-4 py-2.5 flex items-center justify-between gap-2 border transition-colors"
                :class="open === 'centre' ? 'border-teal-500 ring-2 ring-teal-500/30' : 'border-white/0 hover:border-teal-500/40'"
            >
                <span class="flex-1 min-w-0 text-left">
                    <span class="block text-xs font-semibold text-navy-600">Select Location</span>
                    <span class="block text-sm text-navy-400 truncate" x-text="centreLabel"></span>
                </span>
                <x-app-icon name="chevron-down" class="w-4 h-4 text-navy-400 shrink-0 transition-transform duration-150" x-bind:class="open === 'centre' && 'rotate-180'" />
            </button>
            <input type="hidden" name="centre" x-bind:value="centre">
            <div
                x-show="open === 'centre'" x-cloak
                x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
                class="absolute z-20 mt-2 w-full bg-white rounded-xl shadow-xl border border-navy-100 py-2 max-h-60 overflow-y-auto"
            >
                <button type="button" @click="centre=''; centreLabel='Choose a centre'; open=null" class="block w-full text-left px-4 py-2 text-sm text-navy-600 hover:bg-mint-100">Choose a centre</button>
                @foreach ($centres as $centre)
                    <button type="button" @click="centre='{{ $centre->slug }}'; centreLabel='{{ $centre->name }}'; open=null; if (specialist && !availableForCentre(specialist)) { specialist=''; specialistLabel='Choose a doctor'; }" class="block w-full text-left px-4 py-2 text-sm text-navy-600 hover:bg-mint-100">{{ $centre->name }}</button>
                @endforeach
            </div>
        </div>

        {{-- Doctor dropdown --}}
        <div class="relative">
            <button
                type="button"
                @click="open = (open === 'specialist' ? null : 'specialist')"
                class="w-full bg-white rounded-xl px-4 py-2.5 flex items-center justify-between gap-2 border transition-colors"
                :class="open === 'specialist' ? 'border-teal-500 ring-2 ring-teal-500/30' : 'border-white/0 hover:border-teal-500/40'"
            >
                <span class="flex-1 min-w-0 text-left">
                    <span class="block text-xs font-semibold text-navy-600">Select Doctor</span>
                    <span class="block text-sm text-navy-400 truncate" x-text="specialistLabel"></span>
                </span>
                <x-app-icon name="chevron-down" class="w-4 h-4 text-navy-400 shrink-0 transition-transform duration-150" x-bind:class="open === 'specialist' && 'rotate-180'" />
            </button>
            <input type="hidden" name="specialist" x-bind:value="specialist">
            <div
                x-show="open === 'specialist'" x-cloak
                x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
                class="absolute z-20 mt-2 w-full bg-white rounded-xl shadow-xl border border-navy-100 py-2 max-h-60 overflow-y-auto"
            >
                <button type="button" @click="specialist=''; specialistLabel='Choose a doctor'; open=null" class="block w-full text-left px-4 py-2 text-sm text-navy-600 hover:bg-mint-100">Choose a doctor</button>
                @foreach ($specialists as $specialist)
                    <button type="button" x-show="availableForCentre('{{ $specialist->slug }}')" @click="specialist='{{ $specialist->slug }}'; specialistLabel='{{ $specialist->name }}'; open=null" class="block w-full text-left px-4 py-2 text-sm text-navy-600 hover:bg-mint-100">{{ $specialist->name }}</button>
                @endforeach
            </div>
        </div>

        {{-- Date --}}
        <div class="relative">
            <button
                type="button"
                @click="open = (open === 'date' ? null : 'date')"
                class="w-full bg-white rounded-xl px-4 py-2.5 flex items-center justify-between gap-2 border transition-colors"
                :class="open === 'date' ? 'border-teal-500 ring-2 ring-teal-500/30' : 'border-white/0 hover:border-teal-500/40'"
            >
                <span class="flex-1 min-w-0 text-left">
                    <span class="block text-xs font-semibold text-navy-600">Select Date</span>
                    <span class="block text-sm text-navy-400 truncate" x-text="dateLabel"></span>
                </span>
                <x-app-icon name="calendar" class="w-4 h-4 text-navy-400 shrink-0" />
            </button>
            <input type="hidden" name="date" x-bind:value="date">
            <div
                x-show="open === 'date'" x-cloak
                x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
                class="absolute z-20 mt-2 right-0 w-full sm:w-72 bg-white rounded-xl shadow-xl border border-navy-100 p-4"
            >
                <div class="flex items-center justify-between mb-3">
                    <button type="button" @click="prevMonth()" class="p-1.5 rounded-lg hover:bg-mint-100">
                        <x-app-icon name="chevron-right" class="w-4 h-4 rotate-180 text-navy-500" />
                    </button>
                    <p class="font-heading font-semibold text-sm text-navy-600" x-text="monthNames[calMonth] + ' ' + calYear"></p>
                    <button type="button" @click="nextMonth()" class="p-1.5 rounded-lg hover:bg-mint-100">
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
                <button type="button" @click="date=''; dateLabel='Choose date'; open=null" class="mt-3 w-full text-center text-xs font-medium text-navy-500 hover:text-teal-600">
                    Clear date
                </button>
            </div>
        </div>

        <button type="submit" class="group bg-gradient-to-r from-teal-500 to-teal-600 hover:from-teal-600 hover:to-teal-700 text-white font-heading font-semibold text-sm px-6 py-3 rounded-xl text-center leading-tight shadow-md shadow-teal-500/20 hover:shadow-lg hover:shadow-teal-500/30 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200">
            Schedule Consultation
        </button>
    </form>
</section>
