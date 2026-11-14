@php
    $soc = $socLanding ?? config('tenwek.soc_landing');
    $A = $soc['academic_programmes'] ?? [];
    $pageUrl = fn (string $slug) => route('schools.pages.show', [$school, $slug]);
    $groups = $A['groups'] ?? [];
    $introParagraphs = array_values($A['intro_paragraphs'] ?? []);
    $lead = $introParagraphs[0] ?? null;
    $overview = array_slice($introParagraphs, 1);
@endphp

<x-layouts.public :seo="$seo" landing-header="soc" :school="$school">
    <div class="soc-academic-crumb-band">
        <div class="mx-auto max-w-7xl px-4 py-3 sm:px-6 lg:px-8">
            <x-schools.soc.breadcrumbs :school="$school" :current="$page->title" variant="hero" />
        </div>
    </div>

    <header class="soc-academic-hero">
        <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 sm:py-16 lg:px-8 lg:py-20">
            <div class="max-w-4xl" data-reveal>
                <p class="soc-academic-kicker">{{ $A['kicker'] ?? 'Our courses' }}</p>
                <h1 class="soc-academic-title mt-4 font-serif text-4xl leading-[1.08] sm:text-5xl lg:text-6xl">
                    {{ $page->title }}
                </h1>
                @if(filled($lead))
                    <p class="soc-academic-lead mt-6 max-w-3xl text-lg leading-relaxed sm:text-xl">
                        {{ $lead }}
                    </p>
                @endif
            </div>
        </div>
    </header>

    @if(count($overview) > 0)
        <section class="soc-academic-overview" aria-labelledby="soc-academic-overview-heading">
            <div class="mx-auto grid max-w-7xl gap-8 px-4 py-12 sm:px-6 sm:py-16 lg:grid-cols-[0.9fr_1.1fr] lg:gap-16 lg:px-8 lg:py-20">
                <div data-reveal>
                    <p class="soc-academic-kicker">What is chaplaincy?</p>
                    <h2 id="soc-academic-overview-heading" class="soc-academic-heading mt-4 max-w-xl font-serif text-3xl leading-tight sm:text-4xl">
                        A minister for people of every faith background — and none
                    </h2>
                </div>
                <div class="soc-academic-copy space-y-5 text-base leading-7 sm:text-lg" data-reveal>
                    @foreach($overview as $paragraph)
                        <p>{{ $paragraph }}</p>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @foreach($groups as $group)
        @php
            $groupSlug = \Illuminate\Support\Str::slug($group['heading'] ?? 'group');
            $groupId = 'soc-programme-'.$groupSlug;
            $isLevels = $loop->first;
            $isFuture = $loop->last && ! $isLevels;
        @endphp

        @if($isLevels)
            <section class="soc-academic-levels" aria-labelledby="{{ $groupId }}">
                <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 sm:py-16 lg:px-8 lg:py-20">
                    <header class="max-w-3xl" data-reveal>
                        <p class="soc-academic-kicker">Study pathways</p>
                        <h2 id="{{ $groupId }}" class="soc-academic-heading mt-3 font-serif text-3xl leading-tight sm:text-4xl">
                            {{ $group['heading'] ?? '' }}
                        </h2>
                        @if(filled($group['description'] ?? null))
                            <p class="soc-academic-copy mt-4 text-base leading-7 sm:text-lg">{{ $group['description'] }}</p>
                        @endif
                    </header>

                    <ul class="mt-8 grid gap-5 md:grid-cols-2 lg:gap-6" role="list">
                        @foreach($group['items'] ?? [] as $item)
                            @php($href = $pageUrl($item['slug']))
                            <li data-reveal>
                                <a href="{{ $href }}" class="soc-academic-level-card group flex h-full flex-col rounded-2xl border-t-4 p-6 sm:p-8 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-thc-royal">
                                    @if(filled($item['badge'] ?? null))
                                        <span class="soc-academic-badge w-fit rounded-full px-3 py-1 text-xs font-bold uppercase tracking-[0.08em]">
                                            {{ $item['badge'] }} · CDACC
                                        </span>
                                    @endif
                                    <h3 class="soc-academic-card-title mt-4 font-serif text-2xl leading-tight sm:text-3xl">
                                        {{ $item['title'] }}
                                    </h3>
                                    @if(filled($item['summary'] ?? null))
                                        <p class="soc-academic-copy mt-3 flex-1 text-base leading-7">{{ $item['summary'] }}</p>
                                    @endif
                                    <span class="soc-academic-link mt-6 inline-flex items-center gap-2 text-sm font-bold">
                                        View programme <span aria-hidden="true" class="transition-transform group-hover:translate-x-1">→</span>
                                    </span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>
        @elseif($isFuture)
            <section class="soc-academic-future" aria-labelledby="{{ $groupId }}">
                <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
                    <div class="soc-academic-future-panel flex flex-col gap-6 rounded-2xl p-7 sm:p-9 lg:flex-row lg:items-center lg:justify-between">
                        <div class="max-w-2xl" data-reveal>
                            <p class="soc-academic-future-kicker">Looking ahead</p>
                            <h2 id="{{ $groupId }}" class="mt-3 font-serif text-2xl font-semibold leading-tight text-white sm:text-3xl">
                                {{ $group['heading'] ?? 'Future programmes' }}
                            </h2>
                            @foreach($group['items'] ?? [] as $item)
                                @if(filled($item['summary'] ?? null))
                                    <p class="mt-3 text-sm leading-6 text-white/85 sm:text-base">{{ $item['summary'] }}</p>
                                @endif
                            @endforeach
                        </div>
                        <a href="{{ $pageUrl(($group['items'][0]['slug'] ?? 'future-chaplaincy-programmes')) }}" class="soc-academic-future-link inline-flex shrink-0 items-center justify-center rounded-lg px-5 py-3 text-sm font-bold transition focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-white">
                            Explore future programmes <span aria-hidden="true" class="ml-2">→</span>
                        </a>
                    </div>
                </div>
            </section>
        @else
            <section class="soc-academic-specialisations" aria-labelledby="{{ $groupId }}">
                <div class="mx-auto grid max-w-7xl gap-8 px-4 py-12 sm:px-6 sm:py-16 lg:grid-cols-[0.8fr_1.2fr] lg:gap-16 lg:px-8 lg:py-20">
                    <header data-reveal>
                        <p class="soc-academic-kicker">Where chaplains serve</p>
                        <h2 id="{{ $groupId }}" class="soc-academic-heading mt-3 font-serif text-3xl leading-tight sm:text-4xl">
                            {{ $group['heading'] ?? '' }}
                        </h2>
                        @if(filled($group['description'] ?? null))
                            <p class="soc-academic-copy mt-4 text-base leading-7">{{ $group['description'] }}</p>
                        @endif
                    </header>

                    <ul class="soc-academic-specialisation-list" role="list">
                        @foreach($group['items'] ?? [] as $item)
                            <li data-reveal>
                                <a href="{{ $pageUrl($item['slug']) }}" class="soc-academic-specialisation group flex items-start justify-between gap-4 py-5 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-thc-royal">
                                    <span>
                                        <span class="soc-academic-card-title block font-serif text-xl font-semibold">{{ $item['title'] }}</span>
                                        @if(filled($item['summary'] ?? null))
                                            <span class="soc-academic-copy mt-1.5 block text-sm leading-6 sm:text-base">{{ $item['summary'] }}</span>
                                        @endif
                                    </span>
                                    <span class="soc-academic-link mt-1 shrink-0 text-lg font-bold transition-transform group-hover:translate-x-1" aria-hidden="true">→</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>
        @endif
    @endforeach

    <section class="soc-academic-cta-wrap">
        <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 sm:py-16 lg:px-8">
            <div class="soc-academic-cta flex flex-col gap-6 rounded-2xl p-7 sm:p-9 lg:flex-row lg:items-center lg:justify-between">
                <div class="max-w-2xl" data-reveal>
                    <p class="soc-academic-cta-kicker">Take the next step</p>
                    <h2 class="mt-3 font-serif text-2xl font-semibold leading-tight text-white sm:text-3xl">Prepare for service through chaplaincy</h2>
                    <p class="mt-3 text-sm leading-6 text-white/85 sm:text-base">Explore admission details or review programme fees before you apply.</p>
                </div>
                <div class="flex flex-wrap gap-3" data-reveal>
                    <a href="{{ $pageUrl('admissions') }}" class="soc-academic-cta-primary inline-flex items-center justify-center rounded-lg px-5 py-3 text-sm font-bold transition focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-white">How to apply</a>
                    <a href="{{ $pageUrl('fee') }}" class="soc-academic-cta-secondary inline-flex items-center justify-center rounded-lg border px-5 py-3 text-sm font-bold transition focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-white">See fees</a>
                </div>
            </div>
        </div>
    </section>
</x-layouts.public>
