@php
    $soc = config('tenwek.soc_landing', []);
    $A = $soc['about_page'] ?? [];
    $heroImage = $A['hero_image'] ?? 'about.jpg';
    $heroAlt = $A['hero_image_alt'] ?? 'School of Chaplaincy';
    $heroSrc = \Illuminate\Support\Str::startsWith($heroImage, ['http://', 'https://']) ? $heroImage : asset($heroImage);
    $accent = $A['accent'] ?? '#8265ae';
    $coreValues = $A['core_values'] ?? [];
    $coreHeading = $A['core_values_heading'] ?? 'Our core values';
    $ctaLabel = $A['programmes_cta_label'] ?? 'Our programmes';
    $programmesUrl = route('schools.pages.show', [$school, 'academic-programmes']);

    $rawBody = (string) $page->body;
    $introBody = preg_replace('/<h2[^>]*>\s*Our core values\s*<\/h2>.*$/is', '', $rawBody) ?? $rawBody;
    if (trim(strip_tags($introBody)) === '' && filled(trim(strip_tags($rawBody)))) {
        $introBody = $rawBody;
    }
@endphp

<x-layouts.public :seo="$seo" landing-header="soc" :school="$school">
    {{-- Hero — accent #8265ae (thc-royal) --}}
    <div
        class="relative overflow-hidden text-white"
        style="background: linear-gradient(135deg, #1a1a68 0%, {{ $accent }}d9 45%, #1a1a68 100%);"
    >
        <div
            class="pointer-events-none absolute inset-0 opacity-25"
            style="background-image: radial-gradient(circle at 25% 20%, rgba(255,255,255,0.35), transparent 42%), radial-gradient(circle at 80% 75%, rgba(130,101,174,0.5), transparent 48%);"
            aria-hidden="true"
        ></div>
        <div class="relative mx-auto max-w-7xl px-4 py-12 sm:px-6 sm:py-16 lg:px-8 lg:py-20">
            <x-schools.soc.breadcrumbs :school="$school" :current="$page->title" variant="hero" class="mb-8" data-reveal />
            <header class="max-w-3xl" data-reveal>
                <p class="text-[11px] font-bold uppercase tracking-[0.22em] text-white/90 sm:text-xs">
                    {{ $A['kicker'] ?? 'Tenwek Hospital College' }}
                </p>
                <h1 class="mt-4 font-serif text-4xl font-semibold leading-tight tracking-tight sm:text-5xl lg:text-[3.25rem]">
                    {{ $page->title }}
                </h1>
                @if(filled($page->excerpt))
                    <p class="mt-6 max-w-2xl text-base leading-relaxed text-white/90 sm:text-lg">
                        {{ $page->excerpt }}
                    </p>
                @endif
            </header>
        </div>
    </div>

    {{-- Row 1: image + opening paragraphs + CTA --}}
    <div class="bg-white">
        <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8 lg:py-16">
            <div class="flex flex-col gap-10 lg:flex-row lg:items-stretch lg:gap-12 xl:gap-16">
                <figure
                    class="mx-auto w-full max-w-xl shrink-0 lg:mx-0 lg:w-[min(42%,30rem)] lg:max-w-none"
                    data-reveal
                >
                    <div class="h-full overflow-hidden rounded-2xl shadow-[var(--shadow-thc-card)] ring-2 ring-thc-royal/35 ring-offset-2 ring-offset-white">
                        <img
                            src="{{ $heroSrc }}"
                            alt="{{ $heroAlt }}"
                            class="aspect-[4/3] h-full min-h-[240px] w-full object-cover sm:aspect-[3/2] lg:aspect-[4/5] lg:min-h-[320px]"
                            width="1200"
                            height="900"
                            loading="eager"
                            decoding="async"
                            fetchpriority="high"
                        >
                    </div>
                </figure>

                <div class="flex min-w-0 flex-1 flex-col justify-center" data-reveal>
                    <div
                        class="space-y-4 text-base leading-relaxed text-thc-text [&_a]:font-medium [&_a]:text-thc-royal [&_strong]:text-thc-navy"
                    >
                        {!! $introBody !!}
                    </div>
                    <div class="mt-8">
                        <a
                            href="{{ $programmesUrl }}"
                            class="inline-flex items-center justify-center gap-2 rounded-full px-8 py-3.5 text-sm font-semibold uppercase tracking-[0.12em] text-white shadow-md transition hover:brightness-110 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-thc-royal focus-visible:ring-offset-2 sm:px-10 sm:py-4 sm:text-base"
                            style="background-color: {{ $accent }};"
                        >
                            {{ $ctaLabel }}
                            <svg class="h-4 w-4 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0-7 7m7-7H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Row 2: core values — horizontal flow / grid --}}
    @if(count($coreValues) > 0)
        <section
            class="border-t border-thc-navy/8"
            style="background: linear-gradient(to bottom, color-mix(in srgb, {{ $accent }} 10%, white) 0%, white 55%);"
            aria-labelledby="soc-about-core-values-heading"
            data-reveal
        >
            <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 sm:py-14 lg:px-8 lg:py-16">
                <h2 id="soc-about-core-values-heading" class="text-center font-serif text-2xl font-semibold sm:text-3xl" style="color: {{ $accent }};">
                    {{ $coreHeading }}
                </h2>
                <div class="mt-10 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    @foreach($coreValues as $item)
                        <div
                            class="flex flex-col rounded-2xl border border-thc-navy/10 bg-white p-5 shadow-sm transition hover:border-thc-royal/35 hover:shadow-md sm:p-6"
                        >
                            <h3 class="font-serif text-lg font-semibold text-thc-royal sm:text-xl">
                                {{ $item['title'] ?? '' }}
                            </h3>
                            <p class="mt-3 text-sm leading-relaxed text-thc-text/88 sm:text-base">
                                {{ $item['text'] ?? '' }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</x-layouts.public>
