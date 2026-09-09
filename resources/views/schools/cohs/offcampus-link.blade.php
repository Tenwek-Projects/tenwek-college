@php
    $L = $cohsLanding ?? config('tenwek.cohs_landing');
    $applyUrl = $L['off_campus_application_url'] ?? null;
@endphp

<x-layouts.public :seo="$seo" landing-header="cohs" :school="$school">
    <div class="relative overflow-hidden cohs-page-hero">
        <div class="pointer-events-none absolute -left-16 top-10 h-36 w-36 rounded-full bg-thc-cohs-sky/30 blur-2xl" aria-hidden="true"></div>
        <div class="pointer-events-none absolute -right-12 bottom-0 h-40 w-40 rounded-full bg-thc-cohs-coral/15 blur-2xl" aria-hidden="true"></div>
        <div class="relative mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8 lg:py-16">
            <nav class="mb-8 text-sm text-thc-text/65" aria-label="Breadcrumb" data-reveal>
                <ol class="flex flex-wrap items-center gap-2">
                    <li><a href="{{ route('home') }}" class="transition hover:text-thc-cohs-blue">Home</a></li>
                    <li aria-hidden="true" class="text-thc-text/35">/</li>
                    <li><a href="{{ route('schools.show', $school) }}" class="transition hover:text-thc-cohs-blue">{{ $school->name }}</a></li>
                    <li aria-hidden="true" class="text-thc-text/35">/</li>
                    <li class="font-medium text-thc-navy">{{ $page->title }}</li>
                </ol>
            </nav>

            <header class="max-w-2xl" data-reveal>
                <p class="thc-kicker">Application</p>
                <h1 class="mt-4 bg-gradient-to-r from-thc-cohs-indigo via-thc-cohs-footer to-thc-cohs-blue bg-clip-text font-serif text-4xl font-semibold tracking-tight text-transparent sm:text-5xl">
                    {{ $page->title }}
                </h1>
                @if(filled($page->excerpt))
                    <p class="mt-5 text-lg leading-relaxed text-thc-text/88">{{ $page->excerpt }}</p>
                @endif
            </header>
        </div>
    </div>

    <div class="mx-auto max-w-3xl px-4 pb-16 sm:px-6 lg:px-8 lg:pb-24">
        <div
            class="overflow-hidden rounded-2xl border border-thc-navy/10 bg-white shadow-[var(--shadow-thc-card)] ring-1 ring-thc-cohs-blue/10"
            data-reveal
        >
            <div class="h-1.5 bg-gradient-to-r from-thc-cohs-indigo via-thc-cohs-blue to-thc-cohs-coral" aria-hidden="true"></div>
            <div class="p-8 sm:p-10">
                <p class="text-base leading-relaxed text-thc-text/90">
                    Complete your application through the college online application portal. The form opens in a new browser tab.
                </p>
                @if(filled($applyUrl))
                    <a
                        href="{{ $applyUrl }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="thc-btn-primary mt-8 inline-flex w-full items-center justify-center gap-2 px-8 py-3.5 sm:w-auto"
                    >
                        Open online application
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </a>
                    <p class="mt-4 break-all text-xs text-thc-text/55">{{ $applyUrl }}</p>
                @else
                    <p class="mt-6 text-sm text-thc-text/70">Application URL is not configured. Please contact the college office.</p>
                @endif

                <div class="mt-10 overflow-hidden rounded-xl border border-thc-cohs-blue/20 bg-gradient-to-br from-thc-cohs-wash via-white to-white">
                    <div class="border-l-4 border-thc-cohs-coral px-5 py-4 sm:px-6">
                        <p class="text-xs font-bold uppercase tracking-[0.16em] text-thc-cohs-coral">Also helpful</p>
                        <p class="mt-2 text-sm leading-relaxed text-thc-text/85">
                            Prefer paper forms or need help? Download materials or reach the college office.
                        </p>
                        <p class="mt-4 text-sm">
                            <a href="{{ route('schools.pages.show', [$school, 'application-forms']) }}" class="font-semibold text-thc-cohs-blue transition hover:text-thc-cohs-indigo hover:underline">Application forms &amp; downloads</a>
                            <span class="text-thc-text/40"> · </span>
                            <a href="{{ route('schools.pages.show', [$school, 'contact-us']) }}" class="font-semibold text-thc-cohs-blue transition hover:text-thc-cohs-indigo hover:underline">Contact us</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.public>
