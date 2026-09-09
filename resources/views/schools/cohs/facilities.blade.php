@php
    $L = $cohsLanding ?? config('tenwek.cohs_landing');
    $F = $L['facilities'] ?? config('tenwek.cohs_landing.facilities');
    $fHero = $F['hero_image'] ?? 'banner-nursing.jpg';
    $heroImage = \App\Support\Cohs\CohsLandingRepository::publicMediaUrl(is_string($fHero) ? $fHero : null) ?? asset(is_string($fHero) ? $fHero : 'banner-nursing.jpg');
@endphp

<x-layouts.public :seo="$seo" landing-header="cohs" :school="$school">
    <div class="relative overflow-hidden cohs-page-hero">
        <div class="pointer-events-none absolute -left-16 top-10 h-36 w-36 rounded-full bg-thc-cohs-sky/30 blur-2xl" aria-hidden="true"></div>
        <div class="pointer-events-none absolute -right-12 bottom-0 h-40 w-40 rounded-full bg-thc-cohs-coral/15 blur-2xl" aria-hidden="true"></div>
        <div class="pointer-events-none absolute inset-y-0 right-0 hidden w-2/5 opacity-[0.14] lg:block" aria-hidden="true">
            <div class="h-full bg-cover bg-center" style="background-image: url('{{ e($heroImage) }}');"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-white via-white/92 to-transparent"></div>
        </div>
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

            <header class="max-w-3xl" data-reveal>
                <p class="thc-kicker">{{ $F['kicker'] }}</p>
                <h1 class="mt-4 font-serif text-4xl font-semibold tracking-tight text-thc-navy sm:text-5xl lg:text-[3.25rem]">
                    {{ $F['headline_before'] }}
                    <span class="italic text-thc-cohs-coral">{{ $F['headline_emphasis'] }}</span>
                </h1>
                @if(filled($page->excerpt))
                    <p class="mt-5 text-lg leading-relaxed text-thc-text/88 sm:text-xl">{{ $page->excerpt }}</p>
                @endif
            </header>
        </div>
    </div>

    <section class="cohs-landing-programmes border-b border-thc-cohs-blue/15">
        <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8 lg:py-16">
            <div class="mx-auto max-w-3xl space-y-6 text-base leading-[1.75] text-thc-text/90 sm:text-lg" data-reveal>
                @foreach($F['paragraphs'] as $p)
                    <p>{{ $p }}</p>
                @endforeach
            </div>

            <ul class="mt-14 grid gap-5 sm:grid-cols-2 lg:grid-cols-3" role="list" data-reveal>
                @foreach($F['highlights'] as $h)
                    <li class="group flex h-full flex-col overflow-hidden rounded-2xl border border-thc-navy/10 bg-white shadow-[var(--shadow-thc-card)] ring-1 ring-thc-cohs-blue/10 transition duration-300 hover:-translate-y-0.5 hover:shadow-[var(--shadow-thc-card-hover)]">
                        <div class="h-1.5 shrink-0 bg-gradient-to-r from-thc-cohs-indigo via-thc-cohs-blue to-thc-cohs-coral" aria-hidden="true"></div>
                        <div class="flex flex-1 flex-col p-6 sm:p-8">
                            <h2 class="font-serif text-xl font-semibold text-thc-navy">{{ $h['title'] }}</h2>
                            <p class="mt-4 flex-1 text-sm leading-relaxed text-thc-text/82 sm:text-base">{{ $h['description'] }}</p>
                        </div>
                    </li>
                @endforeach
            </ul>

            <div
                class="mt-14 overflow-hidden rounded-2xl border border-thc-cohs-blue/20 bg-gradient-to-br from-thc-cohs-wash via-white to-thc-cohs-sky/10 shadow-[var(--shadow-thc-card)] ring-1 ring-thc-cohs-blue/10"
                data-reveal
            >
                <div class="h-1.5 bg-gradient-to-r from-thc-cohs-indigo via-thc-cohs-blue to-thc-cohs-coral" aria-hidden="true"></div>
                <div class="flex flex-wrap items-center justify-between gap-6 px-6 py-8 sm:px-10">
                    <p class="max-w-xl text-base font-medium text-thc-navy sm:text-lg">See student life and how our community learns together.</p>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('schools.pages.show', [$school, 'social-life']) }}" class="thc-btn-primary px-6 py-3 text-sm">Social life</a>
                        <a href="{{ route('schools.pages.show', [$school, 'contact-us']) }}" class="thc-btn-ghost px-6 py-3 text-sm">Plan a visit</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.public>
