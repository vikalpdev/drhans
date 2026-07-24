@php
    $chatbotCentres = \App\Models\Centre::orderBy('order')->get();
    $chatbotSpecialists = \App\Models\Specialist::orderBy('order')->get();
    $chatbotDepartments = ['ENT', 'Hearing Care', 'Vertigo'];
@endphp

<div
    x-data="{
        open: false,
        step: 'name',
        input: '',
        errorMsg: '',
        form: { name: '', phone: '', email: '', centre_id: '', centreLabel: '', department: '', specialist_id: '', specialistLabel: '', preferred_date: '', preferred_time: '' },
        messages: [{ from: 'bot', text: 'Hi! I\'m the booking assistant for Dr Hans\' Centre for ENT. What\'s your name?' }],
        addBot(text) { this.messages.push({ from: 'bot', text }); this.scrollDown(); },
        addUser(text) { this.messages.push({ from: 'user', text }); this.scrollDown(); },
        scrollDown() { this.$nextTick(() => { if (this.$refs.scrollArea) this.$refs.scrollArea.scrollTop = this.$refs.scrollArea.scrollHeight; }); },
        toggle() {
            if (this.open) {
                localStorage.setItem('chatbotDismissed', '1');
            }
            this.open = !this.open;
            if (this.open) this.scrollDown();
        },
        submitName() {
            if (!this.input.trim()) return;
            this.form.name = this.input.trim();
            this.addUser(this.form.name);
            this.input = '';
            this.step = 'phone';
            this.addBot('Thanks, ' + this.form.name.split(' ')[0] + '! What\'s the best phone number to reach you on?');
        },
        submitPhone() {
            if (!this.input.trim()) return;
            this.form.phone = this.input.trim();
            this.addUser(this.form.phone);
            this.input = '';
            this.step = 'email';
            this.addBot('Great. Would you like to share your email too? You can type it in, or just skip.');
        },
        submitEmail() {
            const val = this.input.trim();
            if (val && val.toLowerCase() !== 'skip') {
                this.form.email = val;
                this.addUser(val);
            } else {
                this.addUser('Skip');
            }
            this.input = '';
            this.step = 'centre';
            this.addBot('Which centre would you like to visit?');
        },
        skipEmail() {
            this.input = '';
            this.addUser('Skip');
            this.step = 'centre';
            this.addBot('Which centre would you like to visit?');
        },
        selectCentre(id, label) {
            this.form.centre_id = id;
            this.form.centreLabel = label;
            this.addUser(label);
            this.step = 'department';
            this.addBot('Which department do you need?');
        },
        selectDepartment(dept) {
            this.form.department = dept;
            this.addUser(dept);
            this.step = 'specialist';
            this.addBot('Do you have a preferred doctor? You can also skip this.');
        },
        selectSpecialist(id, label) {
            this.form.specialist_id = id;
            this.form.specialistLabel = label;
            this.addUser(label);
            this.step = 'date';
            this.addBot('What date works best for you?');
        },
        skipSpecialist() {
            this.addUser('No preference');
            this.step = 'date';
            this.addBot('What date works best for you?');
        },
        submitDate() {
            if (!this.form.preferred_date) return;
            this.addUser(this.form.preferred_date);
            this.step = 'time';
            this.addBot('And a preferred time of day?');
        },
        selectTime(label) {
            this.form.preferred_time = label === 'No preference' ? '' : label;
            this.addUser(label);
            this.step = 'review';
            this.addBot('Here\'s your appointment request — shall I send it to our team?');
        },
        async confirmSubmit() {
            this.step = 'submitting';
            this.errorMsg = '';
            try {
                const res = await fetch('{{ route('appointment.store') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                    },
                    body: JSON.stringify({
                        name: this.form.name,
                        phone: this.form.phone,
                        email: this.form.email,
                        centre_id: this.form.centre_id,
                        department: this.form.department,
                        specialist_id: this.form.specialist_id || null,
                        preferred_date: this.form.preferred_date,
                        preferred_time: this.form.preferred_time,
                    }),
                });
                if (!res.ok) throw new Error('Request failed');
                this.step = 'done';
                this.addBot('Thank you! Your appointment request has been received. Our team will confirm shortly.');
            } catch (e) {
                this.step = 'review';
                this.errorMsg = 'Something went wrong sending your request. Please try again, or call us directly.';
            }
        },
        editRequest() {
            this.step = 'name';
        },
        restart() {
            this.form = { name: '', phone: '', email: '', centre_id: '', centreLabel: '', department: '', specialist_id: '', specialistLabel: '', preferred_date: '', preferred_time: '' };
            this.messages = [{ from: 'bot', text: 'Let\'s book another appointment. What\'s your name?' }];
            this.step = 'name';
        },
    }"
    x-init="if (localStorage.getItem('chatbotDismissed') !== '1') { setTimeout(() => { open = true; scrollDown(); }, 1500); }"
    class="fixed bottom-5 right-5 z-50"
>
    {{-- Toggle button --}}
    <button
        type="button"
        @click="toggle()"
        aria-label="Book appointment chat"
        class="w-14 h-14 rounded-full bg-gradient-to-br from-teal-500 to-teal-600 shadow-lg shadow-black/20 flex items-center justify-center text-white hover:scale-110 active:scale-95 transition-transform duration-200"
    >
        <x-app-icon name="chat" x-show="!open" class="w-6 h-6" />
        <x-app-icon name="close" x-show="open" x-cloak class="w-6 h-6" />
    </button>

    {{-- Chat panel --}}
    <div
        x-show="open"
        x-cloak
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-4 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0 translate-y-4 scale-95"
        class="absolute bottom-[68px] right-0 w-[92vw] max-w-sm bg-white rounded-2xl shadow-2xl border border-navy-100 flex flex-col overflow-hidden"
        style="height: min(70vh, 560px);"
    >
        {{-- Header --}}
        <div class="bg-gradient-to-r from-navy-600 to-navy-700 px-4 py-3.5 flex items-center gap-3 shrink-0">
            <div class="w-9 h-9 rounded-full bg-white/15 flex items-center justify-center shrink-0">
                <x-app-icon name="calendar" class="w-4 h-4 text-white" />
            </div>
            <div class="min-w-0">
                <p class="font-heading font-semibold text-white text-sm leading-tight">Book an Appointment</p>
                <p class="text-[11px] text-navy-200 leading-tight">Usually replies instantly</p>
            </div>
        </div>

        {{-- Messages --}}
        <div x-ref="scrollArea" class="flex-1 overflow-y-auto px-4 py-4 space-y-3 bg-mint-50/50">
            <template x-for="(msg, i) in messages" :key="i">
                <div :class="msg.from === 'bot' ? 'flex justify-start' : 'flex justify-end'">
                    <p
                        :class="msg.from === 'bot' ? 'bg-white text-navy-600 border border-navy-100 rounded-tl-sm' : 'bg-teal-500 text-white rounded-tr-sm'"
                        class="max-w-[85%] rounded-2xl px-3.5 py-2 text-sm leading-relaxed"
                        x-text="msg.text"
                    ></p>
                </div>
            </template>

            {{-- Email skip --}}
            <div x-show="step === 'email'" class="flex flex-wrap gap-2 pt-1">
                <button type="button" @click="skipEmail()" class="px-3 py-1.5 rounded-full text-xs font-semibold bg-white border border-navy-100 text-navy-600 hover:border-teal-500 hover:text-teal-600 transition-colors">Skip, I'd rather not</button>
            </div>

            {{-- Time choices --}}
            <div x-show="step === 'time'" class="flex flex-wrap gap-2 pt-1">
                @foreach (['Morning', 'Afternoon', 'Evening', 'No preference'] as $time)
                    <button type="button" @click="selectTime('{{ $time }}')" class="px-3 py-1.5 rounded-full text-xs font-semibold bg-white border border-navy-100 text-navy-600 hover:border-teal-500 hover:text-teal-600 transition-colors">{{ $time }}</button>
                @endforeach
            </div>

            {{-- Centre choices --}}
            <div x-show="step === 'centre'" class="flex flex-wrap gap-2 pt-1">
                @foreach ($chatbotCentres as $centre)
                    <button type="button" @click="selectCentre({{ $centre->id }}, '{{ addslashes($centre->name) }}')" class="px-3 py-1.5 rounded-full text-xs font-semibold bg-white border border-navy-100 text-navy-600 hover:border-teal-500 hover:text-teal-600 transition-colors">{{ $centre->name }}</button>
                @endforeach
            </div>

            {{-- Department choices --}}
            <div x-show="step === 'department'" class="flex flex-wrap gap-2 pt-1">
                @foreach ($chatbotDepartments as $dept)
                    <button type="button" @click="selectDepartment('{{ $dept }}')" class="px-3 py-1.5 rounded-full text-xs font-semibold bg-white border border-navy-100 text-navy-600 hover:border-teal-500 hover:text-teal-600 transition-colors">{{ $dept }}</button>
                @endforeach
            </div>

            {{-- Specialist choices --}}
            <div x-show="step === 'specialist'" class="flex flex-wrap gap-2 pt-1">
                <button type="button" @click="skipSpecialist()" class="px-3 py-1.5 rounded-full text-xs font-semibold bg-white border border-navy-100 text-navy-600 hover:border-teal-500 hover:text-teal-600 transition-colors">No preference</button>
                @foreach ($chatbotSpecialists as $specialist)
                    <button type="button" @click="selectSpecialist({{ $specialist->id }}, '{{ addslashes($specialist->name) }}')" class="px-3 py-1.5 rounded-full text-xs font-semibold bg-white border border-navy-100 text-navy-600 hover:border-teal-500 hover:text-teal-600 transition-colors">{{ $specialist->name }}</button>
                @endforeach
            </div>

            {{-- Review summary --}}
            <div x-show="step === 'review' || step === 'submitting'" class="bg-white border border-navy-100 rounded-2xl p-3.5 text-xs text-navy-600 space-y-1.5">
                <p><span class="font-semibold text-navy-500">Name:</span> <span x-text="form.name"></span></p>
                <p><span class="font-semibold text-navy-500">Phone:</span> <span x-text="form.phone"></span></p>
                <p x-show="form.email"><span class="font-semibold text-navy-500">Email:</span> <span x-text="form.email"></span></p>
                <p><span class="font-semibold text-navy-500">Centre:</span> <span x-text="form.centreLabel"></span></p>
                <p><span class="font-semibold text-navy-500">Department:</span> <span x-text="form.department"></span></p>
                <p x-show="form.specialistLabel"><span class="font-semibold text-navy-500">Doctor:</span> <span x-text="form.specialistLabel"></span></p>
                <p><span class="font-semibold text-navy-500">Date:</span> <span x-text="form.preferred_date"></span></p>
                <p><span class="font-semibold text-navy-500">Time:</span> <span x-text="form.preferred_time || 'No preference'"></span></p>
            </div>
            <p x-show="errorMsg" x-text="errorMsg" class="text-xs text-red-600"></p>
            <div x-show="step === 'review'" class="flex gap-2">
                <button type="button" @click="confirmSubmit()" class="flex-1 bg-gradient-to-r from-teal-500 to-teal-600 hover:from-teal-600 hover:to-teal-700 text-white text-xs font-heading font-semibold px-4 py-2.5 rounded-xl transition-colors">Confirm &amp; Send</button>
                <button type="button" @click="editRequest()" class="px-4 py-2.5 rounded-xl text-xs font-heading font-semibold border border-navy-200 text-navy-600 hover:border-teal-500 hover:text-teal-600 transition-colors">Edit</button>
            </div>
            <div x-show="step === 'submitting'" class="flex items-center gap-2 text-xs text-navy-500">
                <span class="w-3.5 h-3.5 border-2 border-teal-500 border-t-transparent rounded-full animate-spin"></span> Sending your request&hellip;
            </div>

            {{-- Done state --}}
            <div x-show="step === 'done'" class="bg-white border border-teal-100 rounded-2xl p-4 text-center">
                <x-app-icon name="check-circle" class="w-8 h-8 text-teal-500 mx-auto mb-2" />
                <p class="text-xs text-navy-600 mb-3">We'll call you shortly to confirm your appointment.</p>
                <button type="button" @click="restart()" class="text-xs font-heading font-semibold text-teal-600 hover:text-teal-700">Book another appointment</button>
            </div>
        </div>

        {{-- Text input footer (only for free-text steps) --}}
        <div x-show="['name','phone','email'].includes(step)" class="border-t border-navy-100 p-3 flex items-center gap-2 shrink-0">
            <input
                type="text"
                x-model="input"
                @keydown.enter="step === 'name' ? submitName() : step === 'phone' ? submitPhone() : submitEmail()"
                :placeholder="step === 'name' ? 'Type your name...' : step === 'phone' ? 'Type your phone number...' : 'Type your email (optional)...'"
                class="flex-1 min-w-0 bg-mint-50 border border-navy-100 rounded-xl px-3 py-2 text-sm text-navy-600 focus:outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20"
            >
            <button
                type="button"
                @click="step === 'name' ? submitName() : step === 'phone' ? submitPhone() : submitEmail()"
                aria-label="Send"
                class="w-9 h-9 rounded-xl bg-teal-500 hover:bg-teal-600 flex items-center justify-center text-white shrink-0 transition-colors"
            >
                <x-app-icon name="chevron-right" class="w-4 h-4" />
            </button>
        </div>

        {{-- Date input footer --}}
        <div x-show="step === 'date'" class="border-t border-navy-100 p-3 flex items-center gap-2 shrink-0">
            <input
                type="date"
                x-model="form.preferred_date"
                :min="new Date().toISOString().split('T')[0]"
                class="flex-1 min-w-0 bg-mint-50 border border-navy-100 rounded-xl px-3 py-2 text-sm text-navy-600 focus:outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20"
            >
            <button
                type="button"
                @click="submitDate()"
                aria-label="Send"
                class="w-9 h-9 rounded-xl bg-teal-500 hover:bg-teal-600 flex items-center justify-center text-white shrink-0 transition-colors"
            >
                <x-app-icon name="chevron-right" class="w-4 h-4" />
            </button>
        </div>
    </div>
</div>
