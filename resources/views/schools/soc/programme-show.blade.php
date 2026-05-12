@php
    $pageUrl = fn (string $slug) => route('schools.pages.show', [$school, $slug]);
    $programmesIndex = $pageUrl('academic-programmes');
    $trail = [['label' => 'Academic programmes', 'href' => $programmesIndex]];
    $feesUrl = $pageUrl('fee');
    $admissionsUrl = $pageUrl('admissions');
    $faqsUrl = $pageUrl('faqs');
    $registerPath = route('soc.register', [], false);
    $isCertificate = $page->slug === 'certificate-in-chaplaincy';
    $primaryApplyHref = $isCertificate ? $registerPath : $admissionsUrl;
    $primaryApplyLabel = $isCertificate ? 'Register online' : 'Admissions & how to apply';
    $meta = $programmeMeta ?? null;
@endphp

<x-layouts.public :seo="$seo" landing-header="soc" :school="$school">
    <div class="soc-page-hero">
        <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8 lg:py-16">
            <x-schools.soc.breadcrumbs :school="$school" :trail="$trail" :current="$page->title" class="mb-8" data-reveal />

            <header class="max-w-3xl" data-reveal>
                @if (! empty($meta['group_heading']))
                    <p class="thc-kicker">{{ $meta['group_heading'] }}</p>
                @endif
                <div class="mt-3 flex flex-wrap items-center gap-3">
                    <h1 class="font-serif text-4xl font-semibold tracking-tight text-thc-navy sm:text-5xl">
                        {{ $page->title }}
                    </h1>
                    @if (! empty($meta['badge']))
                        <span class="inline-flex items-center rounded-full border border-thc-navy/15 bg-thc-royal/10 px-3 py-1 text-xs font-bold uppercase tracking-wider text-thc-navy">
                            {{ $meta['badge'] }}
                        </span>
                    @endif
                </div>
                @if ($page->excerpt)
                    <p class="mt-5 text-lg leading-relaxed text-thc-text/90">{{ $page->excerpt }}</p>
                @endif

                <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:flex-wrap">
                    <a
                        href="{{ $primaryApplyHref }}"
                        class="thc-btn-primary inline-flex justify-center px-6 py-3 text-center"
                    >{{ $primaryApplyLabel }}</a>
                    <a
                        href="{{ $feesUrl }}"
                        class="thc-btn-secondary inline-flex justify-center px-6 py-3 text-center"
                    >View fees</a>
                    <a
                        href="{{ $faqsUrl }}"
                        class="inline-flex items-center justify-center rounded-full border border-thc-navy/18 bg-white px-6 py-3 text-sm font-semibold text-thc-navy shadow-sm transition hover:border-thc-royal/35 hover:bg-thc-navy/[0.03]"
                    >FAQs</a>
                </div>
            </header>
        </div>
    </div>

    <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:flex lg:gap-12 lg:px-8 lg:py-16">
        <article class="min-w-0 flex-1">
            <div
                class="programme-prose max-w-none space-y-4 text-base leading-relaxed text-thc-text [&_a]:font-semibold [&_a]:text-thc-royal [&_a]:underline-offset-2 [&_a]:hover:underline [&_h2]:mt-10 [&_h2]:scroll-mt-28 [&_h2]:border-b [&_h2]:border-thc-navy/10 [&_h2]:pb-2 [&_h2]:font-serif [&_h2]:text-2xl [&_h2]:font-semibold [&_h2]:text-thc-navy [&_h2]:first:mt-0 [&_li]:marker:text-thc-royal/80 [&_ul]:list-disc [&_ul]:space-y-2 [&_ul]:pl-6"
                data-reveal
            >
                {!! $page->body !!}
            </div>

            <aside
                class="mt-12 rounded-2xl border border-thc-navy/12 bg-gradient-to-br from-thc-royal/[0.07] to-thc-soc-teal/[0.06] p-6 sm:p-8"
                data-reveal
                aria-labelledby="programme-next-steps"
            >
                <h2 id="programme-next-steps" class="font-serif text-xl font-semibold text-thc-navy sm:text-2xl">
                    Next steps
                </h2>
                <p class="mt-3 max-w-2xl text-sm leading-relaxed text-thc-text/90 sm:text-base">
                    Explore fees and intake dates, read frequently asked questions, or return to the full programme list to compare pathways.
                </p>
                <ul class="mt-6 flex flex-col gap-3 sm:flex-row sm:flex-wrap">
                    <li>
                        <a class="font-semibold text-thc-royal hover:underline" href="{{ $primaryApplyHref }}">{{ $primaryApplyLabel }}</a>
                    </li>
                    <li class="hidden text-thc-text/30 sm:block" aria-hidden="true">·</li>
                    <li>
                        <a class="font-semibold text-thc-royal hover:underline" href="{{ $admissionsUrl }}">Admissions overview</a>
                    </li>
                    <li class="hidden text-thc-text/30 sm:block" aria-hidden="true">·</li>
                    <li>
                        <a class="font-semibold text-thc-royal hover:underline" href="{{ $feesUrl }}">Fees &amp; payment</a>
                    </li>
                </ul>
            </aside>

            <p class="mt-10" data-reveal>
                <a
                    href="{{ $programmesIndex }}"
                    class="inline-flex items-center gap-2 font-semibold text-thc-royal transition hover:text-thc-navy"
                >
                    ← Back to academic programmes
                </a>
            </p>
        </article>

        <x-schools.soc.about-sidebar :school="$school" :page="$page" />
    </div>
</x-layouts.public>
