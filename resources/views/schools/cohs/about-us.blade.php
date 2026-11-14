@php
    $L = $cohsLanding ?? config('tenwek.cohs_landing');
    $A = $L['about_us'] ?? config('tenwek.cohs_landing.about_us');
    $histPath = $A['history_image'] ?? 'banner-nursing.jpg';
    $historyImage = \App\Support\Cohs\CohsLandingRepository::publicMediaUrl(is_string($histPath) ? $histPath : null) ?? asset(is_string($histPath) ? $histPath : 'banner-nursing.jpg');
    $historyAlt = $A['history_image_alt'] ?? '';
    $heroImage = asset('images/image-2.jpg');
    $todayImage = asset('images/image-1.jpg');
@endphp

<x-layouts.public :seo="$seo" landing-header="cohs" :school="$school">
    <section class="relative isolate overflow-hidden bg-[#0b1953] text-white" aria-labelledby="cohs-about-title">
        <div class="absolute inset-0 z-0" aria-hidden="true">
            <img src="{{ $heroImage }}" alt="" class="h-full w-full object-cover object-center">
        </div>
        <div class="absolute inset-0 z-[1] bg-[linear-gradient(90deg,#08164d_0%,rgba(8,22,77,.98)_25%,rgba(8,22,77,.82)_43%,rgba(8,22,77,.2)_72%,rgba(8,22,77,.03)_100%)]" aria-hidden="true"></div>
        <div class="absolute inset-0 z-[1] bg-gradient-to-t from-[#08164d]/45 via-transparent to-[#08164d]/10" aria-hidden="true"></div>
        <div class="relative z-10 mx-auto flex min-h-[23rem] max-w-7xl flex-col justify-center px-5 pb-14 pt-8 sm:px-8 lg:min-h-[22rem] lg:px-10 lg:pb-16">
            <nav class="mb-8 text-xs font-medium text-white/75 sm:text-sm" aria-label="Breadcrumb" data-reveal>
                <ol class="flex flex-wrap items-center gap-2">
                    <li><a href="{{ route('home') }}" class="transition hover:text-white">Home</a></li>
                    <li aria-hidden="true" class="text-white/50">/</li>
                    <li><a href="{{ route('schools.show', $school) }}" class="transition hover:text-white">{{ $school->name }}</a></li>
                    <li aria-hidden="true" class="text-white/50">/</li>
                    <li class="font-semibold text-white">About Us</li>
                </ol>
            </nav>
            <div class="max-w-2xl" data-reveal>
                <p class="flex items-center gap-3 text-xs font-bold uppercase tracking-[0.22em] text-white/85">
                    <span>About us</span><span class="h-px w-24 bg-white/70 sm:w-36" aria-hidden="true"></span>
                </p>
                <h1 id="cohs-about-title" class="mt-4 max-w-xl font-serif text-4xl font-semibold leading-[1.02] tracking-tight text-white sm:text-5xl lg:text-[3.5rem]">
                    {{ $A['headline'] }}
                </h1>
                <span class="mt-4 block h-1.5 w-40 -rotate-2 rounded-full bg-violet-500" aria-hidden="true"></span>
                <p class="mt-5 max-w-lg text-base leading-relaxed text-white/95 sm:text-lg">
                    Our history, vision, mission, and the hospital board that governs the College of Health Sciences.
                </p>
            </div>
        </div>
        <div class="pointer-events-none absolute inset-x-0 bottom-0 h-5 bg-white [clip-path:ellipse(58%_100%_at_50%_100%)]" aria-hidden="true"></div>
    </section>

    <section class="relative z-10 border-b border-thc-cohs-blue/10 bg-white" aria-label="What defines our college">
        <div class="mx-auto grid max-w-7xl gap-5 px-5 py-8 sm:grid-cols-2 sm:px-8 lg:grid-cols-4 lg:gap-0 lg:px-10 lg:py-7">
            @foreach([
                ['title' => 'Quality Training', 'text' => 'Professional and competent graduates', 'path' => 'M3 7.5 12 3l9 4.5-9 4.5-9-4.5Zm3.5 2v5c3.5 2.7 7.5 2.7 11 0v-5M21 7.5v6'],
                ['title' => 'Christ-Centred', 'text' => 'Service rooted in Christian values', 'path' => 'M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2m6-10a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm10 10v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75'],
                ['title' => 'Practical Learning', 'text' => 'Hands-on clinical experience at Tenwek Hospital', 'path' => 'M8 12h8m-8 4h5M7 3h7l5 5v13H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2Zm7 0v5h5'],
                ['title' => 'Community Impact', 'text' => 'Serving communities in Kenya and beyond', 'path' => 'M12 22V12m0 4C6 16 4 12 4 7c5 0 8 2 8 8Zm0-3c0-5 3-8 8-8 0 5-3 8-8 8Z'],
            ] as $feature)
                <div class="flex items-center gap-4 border-thc-cohs-blue/15 px-3 py-2 sm:px-5 lg:border-r lg:px-6 lg:first:pl-0 lg:last:border-r-0 lg:last:pr-0" data-reveal>
                    <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-thc-cohs-wash text-thc-cohs-indigo ring-1 ring-thc-cohs-blue/10" aria-hidden="true">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="{{ $feature['path'] }}"/></svg>
                    </span>
                    <span><strong class="block text-sm font-bold text-thc-cohs-indigo">{{ $feature['title'] }}</strong><span class="mt-1 block text-sm leading-snug text-thc-navy/85">{{ $feature['text'] }}</span></span>
                </div>
            @endforeach
        </div>
    </section>

    <section class="border-b border-thc-cohs-blue/10 bg-white" aria-labelledby="cohs-history-heading">
        <div class="mx-auto grid max-w-7xl items-center gap-10 px-5 py-14 sm:px-8 lg:grid-cols-2 lg:gap-14 lg:px-10 lg:py-20">
            <div data-reveal>
                <span class="inline-flex items-center gap-2 rounded-full bg-fuchsia-100 px-3 py-1 text-xs font-bold uppercase tracking-wide text-thc-cohs-indigo"><span aria-hidden="true">▣</span> Since 1987</span>
                <h2 id="cohs-history-heading" class="mt-4 font-serif text-3xl font-semibold tracking-tight text-thc-cohs-indigo sm:text-4xl">{{ $A['history_heading'] }}</h2>
                <span class="mt-3 block h-1 w-16 -rotate-2 rounded-full bg-violet-500" aria-hidden="true"></span>
                <div class="mt-5 space-y-3 text-[15px] leading-relaxed text-thc-navy/90 sm:text-base">
                    @foreach($A['history_paragraphs'] as $p)
                        <p>{{ $p }}</p>
                    @endforeach
                </div>
                <div class="mt-7 flex flex-wrap gap-3">
                    <a href="{{ route('schools.pages.show', [$school, 'diploma-in-nursing']) }}" class="inline-flex min-h-11 items-center justify-center gap-2 rounded-full bg-thc-cohs-indigo px-6 py-3 text-sm font-bold text-white shadow-md transition hover:bg-thc-cohs-blue">Diploma in Nursing <span aria-hidden="true">→</span></a>
                    <a href="{{ route('schools.pages.show', [$school, 'diploma-in-clinical-medicine']) }}" class="inline-flex min-h-11 items-center justify-center gap-2 rounded-full border border-thc-cohs-indigo px-6 py-3 text-sm font-bold text-thc-cohs-indigo transition hover:bg-thc-cohs-wash">Clinical Medicine <span aria-hidden="true">→</span></a>
                </div>
            </div>
            @if(filled($A['history_image'] ?? null))
                <div class="relative mx-auto w-full max-w-xl lg:max-w-none" data-reveal>
                    <div class="absolute -right-4 -top-4 h-28 w-28 rounded-[1.75rem] bg-gradient-to-br from-violet-500 to-indigo-600 sm:-right-5 sm:-top-5 sm:h-32 sm:w-32" aria-hidden="true"></div>
                    <figure class="relative overflow-hidden rounded-[1.75rem] border-4 border-white shadow-[var(--shadow-thc-card-hover)]">
                        <img src="{{ $historyImage }}" alt="{{ $historyAlt }}" class="aspect-[4/3] w-full object-cover sm:aspect-[5/4]" loading="lazy" decoding="async">
                        <figcaption class="absolute bottom-5 left-5 inline-flex items-center gap-3 rounded-2xl bg-white/95 px-4 py-3 text-sm font-bold text-thc-cohs-indigo shadow-lg backdrop-blur">
                            <svg class="h-7 w-7 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M4 5.5A2.5 2.5 0 0 1 6.5 3H20v16H6.5A2.5 2.5 0 0 0 4 21V5.5Zm0 0V21m4-13h8m-8 4h8"/></svg>
                            <span>College of<br>Health Sciences</span>
                        </figcaption>
                    </figure>
                    <div class="absolute -bottom-3 right-3 h-5 w-1/2 -skew-x-12 rounded-full bg-gradient-to-r from-sky-400 via-indigo-600 to-violet-500" aria-hidden="true"></div>
                </div>
            @endif
        </div>
    </section>

    <section class="bg-thc-cohs-wash/70" aria-labelledby="cohs-guiding-heading">
        <div class="mx-auto max-w-7xl px-5 py-9 sm:px-8 lg:px-10 lg:py-10">
            <h2 id="cohs-guiding-heading" class="sr-only">What guides us</h2>
            <div class="grid gap-7 rounded-3xl border border-thc-cohs-blue/10 bg-white/50 p-6 sm:p-8 lg:grid-cols-3 lg:gap-0">
                @foreach(['mission', 'vision', 'motto'] as $key)
                    @php $block = $A[$key]; @endphp
                    <article class="flex gap-4 border-thc-cohs-blue/20 lg:px-7 lg:first:pl-2 lg:last:pr-2 {{ $loop->iteration < 3 ? 'lg:border-r' : '' }}" data-reveal>
                        <span class="mt-1 shrink-0 text-thc-cohs-blue" aria-hidden="true">
                            @if($key === 'mission')
                                <svg class="h-9 w-9" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9" stroke-width="1.7"/><circle cx="12" cy="12" r="5" stroke-width="1.7"/><circle cx="12" cy="12" r="1" stroke-width="1.7"/></svg>
                            @elseif($key === 'vision')
                                <svg class="h-9 w-9" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"/><circle cx="12" cy="12" r="3" stroke-width="1.7"/></svg>
                            @else
                                <svg class="h-9 w-9" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="m12 3 2.7 5.5 6.1.9-4.4 4.3 1 6.1-5.4-2.9-5.4 2.9 1-6.1-4.4-4.3 6.1-.9L12 3Z"/></svg>
                            @endif
                        </span>
                        <div><h3 class="font-serif text-xl font-bold text-thc-cohs-indigo">Our {{ $block['title'] }}</h3><p class="mt-2 text-sm leading-relaxed text-thc-navy/85">{{ $block['text'] }}</p></div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="overflow-hidden bg-white" aria-labelledby="cohs-today-heading">
        <div class="mx-auto grid max-w-7xl items-center gap-10 px-5 py-14 sm:px-8 lg:grid-cols-2 lg:gap-14 lg:px-10 lg:py-16">
            <div class="relative mx-auto w-full max-w-xl lg:mx-0 lg:max-w-none" data-reveal>
                <div class="absolute -left-4 -top-4 h-28 w-28 rounded-[2rem] bg-violet-200 sm:-left-5 sm:-top-5 sm:h-32 sm:w-32" aria-hidden="true"></div>
                <img src="{{ $todayImage }}" alt="Health sciences students learning together at Tenwek Hospital College" class="relative aspect-[4/3] w-full rounded-[1.75rem] object-cover shadow-[var(--shadow-thc-card-hover)]" loading="lazy" decoding="async">
            </div>
            <div data-reveal>
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-thc-cohs-indigo">The college today</p>
                <h2 id="cohs-today-heading" class="mt-4 max-w-xl font-serif text-3xl font-semibold leading-tight tracking-tight text-thc-cohs-indigo sm:text-4xl">Training health professionals with compassion</h2>
                <span class="mt-3 block h-1 w-16 -rotate-2 rounded-full bg-violet-500" aria-hidden="true"></span>
                <p class="mt-5 max-w-xl text-base leading-relaxed text-thc-navy/85 sm:text-lg">We combine classroom learning, clinical practice, and Christian service to equip competent, ethical, and compassionate health professionals who make a difference in their communities.</p>
                <a href="{{ route('schools.pages.show', [$school, 'about-us']) }}#cohs-guiding-heading" class="mt-7 inline-flex min-h-11 items-center justify-center gap-3 rounded-full bg-thc-cohs-indigo px-6 py-3 text-sm font-bold text-white shadow-md transition hover:bg-thc-cohs-blue">Learn more about us <span aria-hidden="true">→</span></a>
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
                            @php
                                $image = $person['image'] ?? null;
                                $parts = array_values(array_filter(preg_split('/\s+/', (string) ($person['name'] ?? '')) ?: []));
                                $initials = count($parts) >= 2
                                    ? mb_strtoupper(mb_substr($parts[0], 0, 1).mb_substr($parts[count($parts) - 1], 0, 1))
                                    : (count($parts) === 1 ? mb_strtoupper(mb_substr($parts[0], 0, 2)) : '?');
                            @endphp
                            <article class="group flex h-full flex-col overflow-hidden rounded-2xl border border-thc-navy/10 bg-white shadow-sm transition duration-300 hover:-translate-y-0.5 hover:shadow-[var(--shadow-thc-card-hover)] {{ ! empty($person['highlight']) ? 'border-thc-cohs-indigo/30 bg-gradient-to-br from-thc-cohs-wash/70 to-white ring-1 ring-thc-cohs-indigo/15' : '' }}">
                                <div class="relative aspect-[5/6] w-full overflow-hidden bg-gradient-to-b from-thc-cohs-wash to-thc-cohs-wash/30 sm:aspect-[4/5]">
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
                                        <div class="pointer-events-none absolute inset-x-0 bottom-0 h-24 bg-gradient-to-t from-thc-cohs-indigo/35 to-transparent" aria-hidden="true"></div>
                                    @else
                                        <div class="relative flex h-full w-full items-center justify-center overflow-hidden" aria-hidden="true">
                                            <span class="absolute -right-10 -top-10 h-40 w-40 rounded-full border border-thc-cohs-blue/10"></span>
                                            <span class="absolute -bottom-16 -left-10 h-48 w-48 rounded-full border border-thc-cohs-indigo/10"></span>
                                            <span class="relative flex h-20 w-20 items-center justify-center rounded-full border-2 border-dashed border-thc-cohs-indigo/25 bg-white/90 font-serif text-3xl font-semibold tracking-tight text-thc-cohs-indigo shadow-sm sm:h-24 sm:w-24 sm:text-4xl">
                                                {{ $initials }}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex flex-1 flex-col p-5 sm:p-6">
                                    <h3 class="font-serif text-lg font-semibold leading-snug text-thc-navy sm:text-xl">
                                        {{ $person['name'] ?? '' }}
                                    </h3>
                                    <p class="mt-3 text-[11px] font-bold uppercase leading-snug tracking-[0.14em] text-thc-cohs-indigo sm:text-xs">
                                        {{ $person['role'] ?? '' }}
                                    </p>
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
