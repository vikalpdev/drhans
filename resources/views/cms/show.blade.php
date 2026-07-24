<x-layouts.app :title="$cmsPage->meta_title ?? $cmsPage->title" :description="$cmsPage->meta_description ?? null">
    <x-hero
        :title="$cmsPage->title"
        :breadcrumbs="[$cmsPage->title => null]"
    />

    <section class="mx-auto max-w-4xl px-6 py-16">
        <div class="prose prose-navy max-w-none [&_p]:text-sm [&_p]:text-navy-500 [&_p]:leading-relaxed [&_ul]:list-disc [&_ul]:pl-5 [&_ol]:list-decimal [&_ol]:pl-5 [&_h2]:font-heading [&_h2]:font-bold [&_h2]:text-navy-600 [&_h2]:text-xl [&_h2]:mt-8 [&_h2]:mb-3 [&_strong]:font-semibold">
            {!! $cmsPage->body !!}
        </div>
    </section>

    <x-cta-banner />
</x-layouts.app>
