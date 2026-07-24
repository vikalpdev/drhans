<x-layouts.app :title="$page->content['meta_title'] ?? 'Careers'" :description="$page->content['meta_description'] ?? null">
    <x-hero
        :title="$page->content['hero_title'] ?? 'Build Your Career With Us'"
        :subtitle="$page->content['hero_subtitle'] ?? 'Join Dr Hans\' Centre for ENT and be part of a team that\'s passionate about delivering exceptional care and making a real difference in people\'s lives.'"
        :breadcrumbs="['Careers' => null]"
    >
        <x-slot:stats>
            @foreach ($page->content['hero_stats'] ?? ['Patient First Approach', 'Growth & Learning Opportunities', 'Supportive & Inclusive Work Culture'] as $s)
                <span class="flex items-start gap-1.5"><x-app-icon name="check-circle" class="w-4 h-4 text-teal-500 shrink-0 mt-0.5" /> {{ $s }}</span>
            @endforeach
        </x-slot:stats>
    </x-hero>

    <section class="mx-auto max-w-7xl px-6 py-12">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 bg-mint-50 rounded-2xl p-6 text-center">
            @foreach ($page->content['stats_strip'] ?? [['stat' => '100+', 'label' => 'Team Members'], ['stat' => '6', 'label' => 'Centres Across India'], ['stat' => '20+', 'label' => 'Specialities'], ['stat' => 'Endless', 'label' => 'Opportunities']] as $item)
                @php
                    if ($item['label'] === 'Centres Across India') {
                        $item['stat'] = (string) $centres->count();
                    }
                @endphp
                <div>
                    <p class="font-heading font-bold text-xl text-navy-600">{{ $item['stat'] }}</p>
                    <p class="text-xs text-navy-500 mt-1">{{ $item['label'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <section x-data="{ dept: 'all' }" class="mx-auto max-w-7xl px-6 pb-16 grid grid-cols-1 lg:grid-cols-[1fr_340px] gap-8">
        <div class="min-w-0">
            <h2 class="font-heading font-bold text-xl text-navy-600 mb-5">Current Openings</h2>
            <div class="flex flex-nowrap sm:flex-wrap gap-2.5 mb-6 bg-mint-50 border border-navy-100 rounded-2xl p-2 w-full sm:w-fit overflow-x-auto sm:overflow-visible [&::-webkit-scrollbar]:hidden" style="scrollbar-width: none;">
                <button @click="dept = 'all'" :class="dept === 'all' ? 'bg-gradient-to-r from-navy-600 to-navy-700 text-white shadow-md shadow-navy-600/25' : 'bg-white text-navy-600 shadow-sm hover:text-teal-600'" class="shrink-0 inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-sm font-heading font-medium transition-colors duration-200">
                    <x-app-icon name="briefcase" class="w-3.5 h-3.5" /> All Departments
                </button>
                @foreach (\App\Models\JobOpening::DEPARTMENTS as $key => $label)
                    <button @click="dept = '{{ $key }}'" :class="dept === '{{ $key }}' ? 'bg-gradient-to-r from-navy-600 to-navy-700 text-white shadow-md shadow-navy-600/25' : 'bg-white text-navy-600 shadow-sm hover:text-teal-600'" class="shrink-0 px-4 py-2 rounded-full text-sm font-heading font-medium transition-colors duration-200">{{ $label }}</button>
                @endforeach
            </div>

            <div class="space-y-4">
                @forelse ($jobs as $job)
                    <div x-show="dept === 'all' || dept === '{{ $job->department }}'" x-transition.opacity class="group bg-white rounded-2xl border border-navy-100 hover:border-teal-100 shadow-sm hover:shadow-xl transition-all duration-300 p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div class="min-w-0">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-mint-100 group-hover:bg-teal-500 flex items-center justify-center shrink-0 transition-colors duration-300">
                                    <x-app-icon name="briefcase" class="w-5 h-5 sm:w-6 sm:h-6 text-teal-500 group-hover:text-white transition-colors duration-300" />
                                </div>
                                <p class="font-heading font-semibold text-navy-600">{{ $job->title }}</p>
                            </div>
                            <div class="flex flex-wrap gap-1.5 mt-2.5">
                                <span class="text-[11px] font-semibold text-teal-700 bg-mint-100 px-2.5 py-0.5 rounded-full">{{ \App\Models\JobOpening::DEPARTMENTS[$job->department] }}</span>
                                <span class="text-[11px] font-semibold text-navy-500 bg-navy-50 px-2.5 py-0.5 rounded-full">{{ $job->type }}</span>
                                <span class="text-[11px] font-semibold text-navy-500 bg-navy-50 px-2.5 py-0.5 rounded-full inline-flex items-center gap-1"><x-app-icon name="location" class="w-3 h-3" /> {{ $job->location }}</span>
                            </div>
                            <p class="text-sm text-navy-500 mt-2 max-w-lg">{{ $job->description }}</p>
                        </div>
                        <a href="{{ $job->apply_email ? 'mailto:'.$job->apply_email.'?subject='.rawurlencode('Application for '.$job->title) : route('contact.index') }}" class="shrink-0 inline-flex w-fit items-center gap-1 border-2 border-teal-500 text-teal-700 hover:bg-teal-500 hover:text-white font-heading font-semibold text-sm px-4 py-2 rounded-full transition-colors duration-200">
                            Apply Now <x-app-icon name="chevron-right" class="w-4 h-4" />
                        </a>
                    </div>
                @empty
                    <p class="text-navy-500 text-sm">No current openings. Please check back soon.</p>
                @endforelse
            </div>
        </div>

        <aside class="space-y-6">
            <div class="bg-gradient-to-br from-navy-600 to-navy-700 rounded-2xl p-6 text-white">
                <x-app-icon name="mail" class="w-8 h-8 text-teal-300 mb-3" />
                <h3 class="font-heading font-bold mb-2">{{ $page->content['resume_box_title'] ?? "Don't See a Role for You?" }}</h3>
                <p class="text-sm text-navy-200 mb-4">{{ $page->content['resume_box_description'] ?? "We're always looking for talented individuals. Share your resume with us." }}</p>
                <a href="{{ route('contact.index') }}" class="inline-flex w-full items-center justify-center gap-2 bg-gradient-to-r from-teal-500 to-teal-600 hover:from-teal-600 hover:to-teal-700 text-white font-heading font-semibold px-4 py-2.5 rounded-full text-sm shadow-md shadow-teal-500/20 hover:shadow-lg transition-all duration-200">
                    <x-app-icon name="mail" class="w-4 h-4" /> Send Your Resume
                </a>
            </div>
            <div class="bg-white rounded-2xl border border-navy-100 p-6">
                <h3 class="font-heading font-bold text-navy-600 mb-3">Why Work With Us?</h3>
                <ul class="space-y-2">
                    @foreach ($page->content['why_work_with_us'] ?? ['Meaningful work that impacts lives', 'Continuous learning & development', 'Modern facilities & technology', 'Collaborative & friendly environment', 'Work-life balance'] as $item)
                        <li class="flex items-center gap-2 text-sm text-navy-600"><x-app-icon name="check-circle" class="w-4 h-4 text-teal-500 shrink-0" /> {{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        </aside>
    </section>

    <section class="relative bg-mint-50 py-14 overflow-hidden">
        <div class="absolute -top-20 -right-20 w-72 h-72 bg-teal-200/20 rounded-full blur-3xl hidden sm:block"></div>

        <div class="relative mx-auto max-w-7xl px-6">
            <div class="text-center mb-8">
                <p class="inline-block text-teal-700 font-semibold text-xs tracking-widest uppercase bg-white px-3 py-1 rounded-full shadow-sm">{{ $page->content['culture_eyebrow'] ?? "Life at Dr Hans'" }}</p>
                <h2 class="font-heading font-bold text-xl lg:text-2xl text-navy-600 mt-3">{{ $page->content['culture_title'] ?? 'Our Culture. Our Commitment.' }}</h2>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5 text-center">
                @foreach ($page->content['culture_cards'] ?? [
                    ['icon' => 'shield', 'title' => 'Integrity & Respect', 'description' => 'We treat every patient and team member with honesty and respect.'],
                    ['icon' => 'award', 'title' => 'Excellence', 'description' => 'We strive for excellence in everything we do.'],
                    ['icon' => 'user-group', 'title' => 'Teamwork', 'description' => 'We believe great outcomes come from working together.'],
                    ['icon' => 'heart', 'title' => 'Empathy', 'description' => 'We care deeply for our patients and each other.'],
                ] as $card)
                    <div class="group bg-white rounded-2xl p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        <div class="w-12 h-12 rounded-xl bg-mint-100 group-hover:bg-teal-500 flex items-center justify-center mx-auto mb-3 transition-colors duration-300">
                            <x-app-icon :name="$card['icon']" class="w-6 h-6 text-teal-500 group-hover:text-white transition-colors duration-300" />
                        </div>
                        <p class="font-heading font-semibold text-navy-600 text-sm">{{ $card['title'] }}</p>
                        <p class="text-xs text-navy-500 mt-1.5">{{ $card['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <x-cta-banner
        :title="$page->content['cta_title'] ?? 'Ready to make a difference?'"
        :subtitle="$page->content['cta_subtitle'] ?? 'Join a team that helps people hear better and live better, every day.'"
    />
</x-layouts.app>
