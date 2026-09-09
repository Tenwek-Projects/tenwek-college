@php
    $L = $cohsLanding ?? config('tenwek.cohs_landing');
    $A = $L['about_us'] ?? config('tenwek.cohs_landing.about_us');
    $histPath = $A['history_image'] ?? 'banner-nursing.jpg';
    $historyImage = \App\Support\Cohs\CohsLandingRepository::publicMediaUrl(is_string($histPath) ? $histPath : null) ?? asset(is_string($histPath) ? $histPath : 'banner-nursing.jpg');
    $historyAlt = $A['history_image_alt'] ?? '';
@endphp

<x-layouts.public :seo="$seo" landing-header="cohs" :school="$school">
    <div class="relative overflow-hidden cohs-page-hero">
        <div class="pointer-events-none absolute -right-24 top-1/2 hidden h-[min(28rem,50vh)] w-[min(28rem,45vw)] -translate-y-1/2 rounded-full bg-thc-cohs-sky/30 blur-3xl md:block" aria-hidden="true"></div>
        <div class="pointer-events-none absolute -left-20 top-8 h-40 w-40 rounded-full bg-thc-cohs-coral/15 blur-2xl" aria-hidden="true"></div>
        <div class="pointer-events-none absolute bottom-0 left-1/3 h-32 w-64 rounded-full bg-thc-cohs-blue/15 blur-3xl" aria-hidden="true"></div>
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
                <p class="thc-kicker">{{ $A['kicker'] }}</p>
                <h1 class="mt-4 bg-gradient-to-r from-thc-cohs-indigo via-thc-cohs-footer to-thc-cohs-blue bg-clip-text font-serif text-4xl font-semibold tracking-tight text-transparent sm:text-5xl lg:text-[3.25rem]">
                    {{ $A['headline'] }}
                </h1>
                @if(filled($page->excerpt))
                    <p class="mt-6 text-lg leading-relaxed text-thc-text/90 sm:text-xl">{{ $page->excerpt }}</p>
                @else
                    <p class="mt-6 text-lg leading-relaxed text-thc-text/85 sm:text-xl">
                        Our history, vision, mission, and the hospital board that governs the College of Health Sciences.
                    </p>
                @endif
            </header>
        </div>
    </div>

    <section
        class="border-b border-thc-cohs-blue/15 bg-white"
        aria-labelledby="cohs-history-heading"
    >
        <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8 lg:py-20">
            <div class="grid items-center gap-10 lg:grid-cols-2 lg:gap-14 xl:gap-20" data-reveal>
                <div class="min-w-0 lg:pr-4">
                    <div class="inline-flex items-center gap-2 rounded-full border border-thc-cohs-coral/30 bg-thc-cohs-coral/10 px-3 py-1 text-xs font-semibold uppercase tracking-wider text-thc-cohs-coral">
                        <span class="h-1.5 w-1.5 rounded-full bg-thc-cohs-coral" aria-hidden="true"></span>
                        Since 1987
                    </div>
                    <h2 id="cohs-history-heading" class="mt-4 font-serif text-2xl font-semibold text-thc-navy sm:text-3xl lg:text-[2rem]">
                        {{ $A['history_heading'] }}
                    </h2>
                    <div class="mt-6 space-y-4 border-l-2 border-thc-cohs-blue/35 pl-5 text-base leading-relaxed text-thc-text/90 sm:text-lg">
                        @foreach($A['history_paragraphs'] as $p)
                            <p>{{ $p }}</p>
                        @endforeach
                    </div>
                    <div class="mt-8 flex flex-wrap gap-3">
                        <a href="{{ route('schools.pages.show', [$school, 'diploma-in-nursing']) }}" class="thc-btn-ghost">Diploma in Nursing</a>
                        <a href="{{ route('schools.pages.show', [$school, 'diploma-in-clinical-medicine']) }}" class="inline-flex items-center gap-2 text-sm font-semibold text-thc-cohs-blue transition hover:text-thc-cohs-indigo hover:underline">
                            Clinical Medicine →
                        </a>
                    </div>
                </div>
                @if(filled($A['history_image'] ?? null))
                    <div class="relative mx-auto w-full max-w-lg lg:mx-0 lg:max-w-none">
                        <div class="pointer-events-none absolute -inset-3 rounded-[2rem] bg-gradient-to-br from-thc-cohs-blue/25 via-thc-cohs-sky/20 to-thc-cohs-coral/15 opacity-90 blur-sm" aria-hidden="true"></div>
                        <div class="pointer-events-none absolute -right-4 -bottom-4 hidden h-24 w-24 rounded-3xl border-2 border-dashed border-thc-cohs-coral/40 sm:block" aria-hidden="true"></div>
                        <figure class="relative overflow-hidden rounded-3xl shadow-[var(--shadow-thc-card-hover)] ring-2 ring-white ring-offset-2 ring-offset-thc-cohs-blue/20">
                            <div class="absolute inset-x-0 top-0 z-10 h-1.5 bg-gradient-to-r from-thc-cohs-indigo via-thc-cohs-blue to-thc-cohs-coral" aria-hidden="true"></div>
                            <img
                                src="{{ $historyImage }}"
                                alt="{{ $historyAlt }}"
                                class="aspect-[4/5] w-full object-cover sm:aspect-[5/6] lg:aspect-[4/5] lg:min-h-[20rem]"
                                loading="lazy"
                                decoding="async"
                            >
                            <figcaption class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-thc-cohs-indigo/95 via-thc-cohs-footer/50 to-transparent px-5 py-6 pt-16 text-sm font-medium text-white/95">
                                {{ $school->name }}
                            </figcaption>
                        </figure>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="cohs-landing-programmes border-b border-thc-cohs-blue/15" aria-labelledby="cohs-vmm-heading">
        <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8 lg:py-20">
            <div class="mx-auto max-w-2xl text-center" data-reveal>
                <p class="thc-kicker">Who we are</p>
                <h2 id="cohs-vmm-heading" class="mt-4 font-serif text-3xl font-semibold text-thc-navy sm:text-4xl">
                    Vision, mission &amp; motto
                </h2>
                <p class="mt-4 text-lg text-thc-text/85">
                    The compass that guides training, clinical practice, and Christian witness at the college.
                </p>
            </div>

            <div class="mt-12 grid items-stretch gap-6 lg:grid-cols-3 lg:gap-8">
                @foreach([
                    'vision' => ['bar' => 'from-thc-cohs-indigo via-thc-cohs-footer to-thc-cohs-blue', 'icon_bg' => 'bg-thc-cohs-wash text-thc-cohs-indigo ring-thc-cohs-blue/25', 'wash' => 'from-thc-cohs-wash/90'],
                    'mission' => ['bar' => 'from-thc-cohs-blue via-thc-cohs-sky to-thc-cohs-blue', 'icon_bg' => 'bg-thc-cohs-blue/10 text-thc-cohs-blue ring-thc-cohs-blue/25', 'wash' => 'from-thc-cohs-sky/15'],
                    'motto' => ['bar' => 'from-thc-cohs-coral via-thc-cohs-footer to-thc-cohs-indigo', 'icon_bg' => 'bg-thc-cohs-coral/10 text-thc-cohs-coral ring-thc-cohs-coral/25', 'wash' => 'from-thc-cohs-coral/[0.08]'],
                ] as $key => $meta)
                    @php $block = $A[$key]; @endphp
                    <article
                        class="group flex h-full flex-col overflow-hidden rounded-2xl border border-thc-navy/10 bg-gradient-to-br {{ $meta['wash'] }} to-white shadow-[var(--shadow-thc-card)] transition duration-300 hover:-translate-y-0.5 hover:shadow-[var(--shadow-thc-card-hover)]"
                        data-reveal
                    >
                        <div class="h-1.5 shrink-0 bg-gradient-to-r {{ $meta['bar'] }}" aria-hidden="true"></div>
                        <div class="flex flex-1 flex-col p-8 sm:p-9">
                            <span class="inline-flex h-11 w-11 items-center justify-center rounded-xl ring-1 {{ $meta['icon_bg'] }}" aria-hidden="true">
                                @if($key === 'vision')
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                @elseif($key === 'mission')
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/></svg>
                                @else
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/></svg>
                                @endif
                            </span>
                            <h3 class="mt-5 font-serif text-xl font-semibold text-thc-navy">{{ $block['title'] }}</h3>
                            <p class="mt-4 flex-1 text-base leading-relaxed text-thc-text/90">{{ $block['text'] }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="cohs-landing-testimonials border-b border-thc-cohs-blue/15" aria-labelledby="cohs-board-team-heading">
        <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8 lg:py-20">
            <div class="overflow-hidden rounded-2xl border border-thc-navy/10 bg-white shadow-[var(--shadow-thc-card)]" data-reveal>
                <div class="h-1.5 bg-gradient-to-r from-thc-cohs-coral via-thc-cohs-blue to-thc-cohs-indigo" aria-hidden="true"></div>
                <div class="grid gap-8 p-6 sm:p-8 lg:grid-cols-12 lg:gap-10 lg:p-10">
                    <div class="lg:col-span-5">
                        <p class="thc-kicker">Governance</p>
                        <h2 id="cohs-board-team-heading" class="mt-4 font-serif text-2xl font-semibold text-thc-navy sm:text-3xl">
                            {{ $A['board_section_heading'] }}
                        </h2>
                    </div>
                    <div class="lg:col-span-7">
                        <p class="text-base leading-relaxed text-thc-text/90 sm:text-lg">
                            {{ $A['board_intro'] }}
                        </p>
                        <p class="mt-4 rounded-xl bg-thc-cohs-wash/80 px-4 py-3 text-sm leading-relaxed text-thc-navy/80 ring-1 ring-thc-cohs-blue/15">
                            The same board that stewards Tenwek Hospital also oversees the College of Health Sciences.
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-12 lg:mt-16" data-reveal>
                <div class="flex flex-wrap items-end justify-between gap-4 border-b border-thc-cohs-blue/20 pb-5">
                    <div>
                        <h2 id="cohs-board-heading" class="font-serif text-2xl font-semibold text-thc-navy sm:text-3xl">
                            {{ $A['board_heading'] }}
                        </h2>
                        <p class="mt-1 text-sm text-thc-text/65">Hospital board members</p>
                    </div>
                    <span class="inline-flex items-center gap-2 rounded-full border border-thc-cohs-blue/25 bg-thc-cohs-wash px-3 py-1 text-xs font-semibold uppercase tracking-wider text-thc-cohs-indigo">
                        {{ count($A['board'] ?? []) }} members
                    </span>
                </div>
                <ul class="mt-10 grid gap-6 sm:grid-cols-2 xl:grid-cols-3" role="list">
                    @foreach($A['board'] as $person)
                        <li>
                            <article class="group flex h-full flex-col overflow-hidden rounded-2xl border border-thc-navy/10 bg-white shadow-[var(--shadow-thc-card)] transition duration-300 hover:-translate-y-0.5 hover:shadow-[var(--shadow-thc-card-hover)] {{ ! empty($person['highlight']) ? 'ring-1 ring-thc-cohs-coral/30' : '' }}">
                                <div class="h-1.5 shrink-0 bg-gradient-to-r {{ ! empty($person['highlight']) ? 'from-thc-cohs-coral via-thc-cohs-blue to-thc-cohs-indigo' : 'from-thc-cohs-indigo via-thc-cohs-blue to-thc-cohs-sky' }}" aria-hidden="true"></div>
                                <div class="relative aspect-[5/6] w-full overflow-hidden bg-gradient-to-b from-thc-cohs-wash to-white sm:aspect-[4/5]">
                                    @php
                                        $image = $person['image'] ?? null;
                                        $parts = array_values(array_filter(preg_split('/\s+/', (string) ($person['name'] ?? '')) ?: []));
                                        $initials = count($parts) >= 2
                                            ? mb_strtoupper(mb_substr($parts[0], 0, 1).mb_substr($parts[count($parts) - 1], 0, 1))
                                            : (count($parts) === 1 ? mb_strtoupper(mb_substr($parts[0], 0, 2)) : '?');
                                    @endphp
                                    @if(filled($image))
                                        <img
                                            src="{{ \App\Support\Cohs\CohsLandingRepository::publicMediaUrl($image) ?? asset($image) }}"
                                            alt="{{ $person['name'] ?? '' }}"
                                            class="h-full w-full object-cover transition duration-500 group-hover:scale-[1.03]"
                                            loading="lazy"
                                            decoding="async"
                                            width="400"
                                            height="500"
                                        >
                                    @else
                                        <div class="flex h-full w-full flex-col items-center justify-center gap-3 p-6 text-center" aria-hidden="true">
                                            <span class="flex h-[4.5rem] w-[4.5rem] items-center justify-center rounded-full bg-gradient-to-br from-thc-cohs-coral to-thc-cohs-indigo font-serif text-2xl font-semibold tracking-tight text-white shadow-sm sm:h-20 sm:w-20 sm:text-3xl">
                                                {{ $initials }}
                                            </span>
                                            <span class="max-w-[10rem] text-[10px] font-semibold uppercase leading-tight tracking-[0.12em] text-thc-text/45">Photo to be added</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex flex-1 flex-col p-5 sm:p-6">
                                    <h3 class="font-serif text-lg font-semibold leading-snug text-thc-navy sm:text-xl">
                                        {{ $person['name'] ?? '' }}
                                    </h3>
                                    <p class="mt-3 text-[11px] font-bold uppercase leading-snug tracking-[0.14em] text-thc-cohs-coral sm:text-xs">
                                        {{ $person['role'] ?? '' }}
                                    </p>
                                    @if(filled($person['bio'] ?? null))
                                        <p class="mt-3 text-sm leading-relaxed text-thc-text/80">
                                            {{ $person['bio'] }}
                                        </p>
                                    @endif
                                </div>
                            </article>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    <div class="bg-white">
        <div class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-4 px-4 py-10 sm:px-6 lg:px-8">
            <p class="text-sm text-thc-text/75">Explore programmes and application resources.</p>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('schools.show', $school) }}#programmes" class="thc-btn-primary">View programmes</a>
                <a href="{{ route('schools.pages.show', [$school, 'application-forms']) }}" class="thc-btn-ghost">Application forms</a>
            </div>
        </div>
    </div>
</x-layouts.public>
