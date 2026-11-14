@php
    $L = $cohsLanding ?? config('tenwek.cohs_landing');
    $S = $L['social_life'] ?? config('tenwek.cohs_landing.social_life');
    $heroPath = $S['hero_image'] ?? 'images/cohs/TWH163-1024x701.jpg';
    $heroImage = \App\Support\Cohs\CohsLandingRepository::publicMediaUrl(is_string($heroPath) ? $heroPath : null) ?? asset(is_string($heroPath) ? $heroPath : 'images/cohs/TWH163-1024x701.jpg');
    $communityPath = $S['community_image'] ?? 'images/cohs/TWH330-1024x682.jpg';
    $communityImage = \App\Support\Cohs\CohsLandingRepository::publicMediaUrl(is_string($communityPath) ? $communityPath : null) ?? asset(is_string($communityPath) ? $communityPath : 'images/cohs/TWH330-1024x682.jpg');
    $activityIcons = [
        'M12 3a9 9 0 1 0 0 18 9 9 0 0 0 0-18Zm0 0 2.5 5.5L20 9.5M12 3 9.5 8.5 4 9.5m5.5-1 1 6.5h3l1-6.5M10.5 15 7 19.5m6.5-4.5 3.5 4.5',
        'M12 3v18M7 8h10',
        'm3 20 6-12 4 7 3-4 5 9zM17 6h.01',
        'M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.7l-1-1.1a5.5 5.5 0 0 0-7.8 7.8L12 21l8.8-8.6a5.5 5.5 0 0 0 0-7.8z',
    ];
@endphp

<x-layouts.public :seo="$seo" landing-header="cohs" :school="$school">
    <section class="relative isolate overflow-hidden bg-[#0b1953] text-white" aria-labelledby="cohs-social-title">
        <div class="mx-auto grid max-w-[1600px] items-stretch lg:grid-cols-[0.92fr_1.08fr]">
            <div class="relative z-10 flex flex-col justify-center px-5 py-9 sm:px-8 sm:py-12 lg:px-12 lg:py-14 xl:px-16" data-reveal>
                <nav class="mb-8 text-xs font-medium text-white/75 sm:text-sm" aria-label="Breadcrumb">
                    <ol class="flex flex-wrap items-center gap-2">
                        <li><a href="{{ route('home') }}" class="transition hover:text-white">Home</a></li>
                        <li aria-hidden="true" class="text-white/50">/</li>
                        <li><a href="{{ route('schools.show', $school) }}" class="transition hover:text-white">{{ $school->name }}</a></li>
                        <li aria-hidden="true" class="text-white/50">/</li>
                        <li class="font-semibold text-white">Social life</li>
                    </ol>
                </nav>
                <p class="flex items-center gap-3 text-xs font-bold uppercase tracking-[0.22em] text-white/85">
                    <span>{{ $S['kicker'] }}</span><span class="h-px w-20 bg-white/70 sm:w-28" aria-hidden="true"></span>
                </p>
                <h1 id="cohs-social-title" class="mt-4 max-w-xl font-serif text-4xl font-semibold leading-[1.03] tracking-tight text-white sm:text-5xl lg:text-[3.5rem]">
                    {{ $S['headline_before'] }} <span class="text-violet-300">{{ $S['headline_emphasis'] }}</span>
                </h1>
                <span class="mt-4 block h-1.5 w-36 -rotate-2 rounded-full bg-violet-500" aria-hidden="true"></span>
                <p class="mt-5 max-w-xl text-base leading-relaxed text-white/90 sm:text-lg">{{ $S['lead'] ?? $page->excerpt }}</p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="#activities" class="inline-flex min-h-12 items-center justify-center gap-3 rounded-full bg-violet-600 px-6 py-3 text-sm font-bold text-white shadow-lg transition hover:bg-violet-500">What students get up to <span aria-hidden="true">↓</span></a>
                    <a href="{{ route('schools.pages.show', [$school, 'contact-us']) }}" class="inline-flex min-h-12 items-center justify-center gap-2 rounded-full border border-white/70 px-6 py-3 text-sm font-bold text-white transition hover:bg-white/10">Visit the college <span aria-hidden="true">→</span></a>
                </div>
            </div>
            <figure class="relative min-h-[17rem] overflow-hidden sm:min-h-[22rem] lg:min-h-[31rem]" data-reveal>
                <img src="{{ $heroImage }}" alt="A group of Tenwek College students in uniform reading together outdoors" class="absolute inset-0 h-full w-full object-cover object-center" fetchpriority="high" decoding="async">
                <div class="absolute inset-0 bg-gradient-to-t from-[#0b1953]/70 via-transparent to-transparent lg:bg-[linear-gradient(90deg,#0b1953_0%,rgba(11,25,83,.38)_12%,transparent_46%)]" aria-hidden="true"></div>
                <figcaption class="absolute bottom-5 right-5 rounded-xl border border-white/25 bg-[#0b1953]/65 px-4 py-2 text-xs font-semibold text-white backdrop-blur sm:bottom-7 sm:right-7">Learn together · Grow together</figcaption>
            </figure>
        </div>
    </section>

    <section class="border-b border-thc-cohs-blue/10 bg-white" aria-labelledby="cohs-social-intro-heading">
        <div class="mx-auto grid max-w-7xl gap-6 px-5 py-11 sm:px-8 lg:grid-cols-[0.7fr_1.3fr] lg:items-center lg:px-10 lg:py-14">
            <div data-reveal>
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-thc-cohs-indigo">A place to belong</p>
                <h2 id="cohs-social-intro-heading" class="mt-3 font-serif text-[30px] font-semibold leading-tight tracking-[-0.6px] text-[#13007c] sm:text-[36px] sm:leading-[45px] sm:tracking-[-0.9px]">{{ $S['pull_quote'] }}</h2>
                <span class="mt-3 block h-1 w-16 -rotate-2 rounded-full bg-violet-500" aria-hidden="true"></span>
            </div>
            <div class="space-y-3 text-base leading-relaxed text-thc-navy/85 sm:text-lg" data-reveal>
                @foreach($S['paragraphs'] as $paragraph)
                    <p>{{ $paragraph }}</p>
                @endforeach
            </div>
        </div>
    </section>

    <section id="activities" class="scroll-mt-24 bg-thc-cohs-wash/55" aria-labelledby="cohs-activities-heading">
        <div class="mx-auto max-w-7xl px-5 py-14 sm:px-8 lg:px-10 lg:py-20">
            <div class="flex flex-col gap-5 border-b border-thc-cohs-blue/15 pb-7 sm:flex-row sm:items-end sm:justify-between" data-reveal>
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-thc-cohs-indigo">Find your people</p>
                    <h2 id="cohs-activities-heading" class="mt-3 font-serif text-[30px] font-semibold leading-tight tracking-[-0.6px] text-[#13007c] sm:text-[36px] sm:leading-[45px] sm:tracking-[-0.9px]">Things to get involved in</h2>
                    <span class="mt-3 block h-1 w-16 -rotate-2 rounded-full bg-violet-500" aria-hidden="true"></span>
                </div>
                <p class="max-w-xl text-base leading-relaxed text-thc-navy/80">{{ $S['activities_intro'] ?? 'The college provides facilities and spaces for students to interact, grow and have fun.' }}</p>
            </div>

            <ul class="mt-8 grid gap-4 sm:grid-cols-2 xl:grid-cols-4" role="list">
                @foreach($S['highlights'] as $index => $item)
                    <li class="group flex h-full flex-col rounded-2xl border border-thc-cohs-blue/15 bg-white p-6 shadow-[var(--shadow-thc-card)] transition duration-300 hover:-translate-y-1 hover:border-thc-cohs-blue/35 hover:shadow-[var(--shadow-thc-card-hover)] sm:p-7" data-reveal>
                        <div class="flex items-center justify-between">
                            <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-thc-cohs-wash text-thc-cohs-indigo transition group-hover:bg-thc-cohs-indigo group-hover:text-white" aria-hidden="true">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="{{ $activityIcons[$index] ?? $activityIcons[0] }}"/></svg>
                            </span>
                            <span class="font-serif text-2xl font-semibold text-thc-cohs-blue/45" aria-hidden="true">{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <h3 class="mt-6 font-serif text-2xl font-semibold leading-tight text-[#13007c]">{{ $item['title'] }}</h3>
                        <p class="mt-3 flex-1 text-sm leading-relaxed text-thc-navy/80 sm:text-base">{{ $item['description'] }}</p>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    <section class="overflow-hidden bg-[#0b1953] text-white" aria-labelledby="cohs-community-heading">
        <div class="mx-auto grid max-w-7xl items-center gap-9 px-5 py-14 sm:px-8 lg:grid-cols-2 lg:gap-14 lg:px-10 lg:py-20">
            <figure class="relative" data-reveal>
                <div class="absolute -left-3 -top-3 h-20 w-20 rounded-3xl border border-violet-300/60 sm:-left-4 sm:-top-4 sm:h-24 sm:w-24" aria-hidden="true"></div>
                <img src="{{ $communityImage }}" alt="Tenwek College health sciences students gathered together on campus" class="relative aspect-[3/2] w-full rounded-3xl object-cover shadow-2xl ring-1 ring-white/20" loading="lazy" decoding="async">
            </figure>
            <div data-reveal>
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-violet-200">Together at Tenwek</p>
                <h2 id="cohs-community-heading" class="mt-3 font-serif text-[30px] font-semibold leading-tight tracking-[-0.6px] text-white sm:text-[36px] sm:leading-[45px] sm:tracking-[-0.9px]">{{ $S['community_heading'] }}</h2>
                <span class="mt-3 block h-1 w-16 -rotate-2 rounded-full bg-violet-400" aria-hidden="true"></span>
                <div class="mt-5 space-y-4 text-base leading-relaxed text-white/85 sm:text-lg">
                    @foreach($S['community_paragraphs'] as $paragraph)
                        <p>{{ $paragraph }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="border-b border-thc-cohs-blue/10 bg-white" aria-labelledby="cohs-everyday-heading">
        <div class="mx-auto max-w-7xl px-5 py-14 sm:px-8 lg:px-10 lg:py-16">
            <div class="max-w-2xl" data-reveal>
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-thc-cohs-indigo">Room to rest. Space to serve.</p>
                <h2 id="cohs-everyday-heading" class="mt-3 font-serif text-[30px] font-semibold leading-tight tracking-[-0.6px] text-[#13007c] sm:text-[36px] sm:leading-[45px] sm:tracking-[-0.9px]">A balanced student experience</h2>
                <span class="mt-3 block h-1 w-16 -rotate-2 rounded-full bg-violet-500" aria-hidden="true"></span>
            </div>
            <div class="mt-8 grid gap-5 md:grid-cols-2">
                <article class="flex gap-5 rounded-2xl border border-thc-cohs-blue/15 bg-thc-cohs-wash/45 p-6 sm:p-8" data-reveal>
                    <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-white text-thc-cohs-indigo shadow-sm" aria-hidden="true"><svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M3 20V8l9-5 9 5v12M7 20v-6h10v6M9 9h.01M15 9h.01"/></svg></span>
                    <div><h3 class="font-serif text-xl font-semibold text-[#13007c]">Hostels and time to recharge</h3><p class="mt-2 text-sm leading-relaxed text-thc-navy/80 sm:text-base">Serene student accommodation gives you space to study, rest, and enjoy the campus community.</p></div>
                </article>
                <article class="flex gap-5 rounded-2xl border border-thc-cohs-blue/15 bg-thc-cohs-wash/45 p-6 sm:p-8" data-reveal>
                    <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-white text-thc-cohs-indigo shadow-sm" aria-hidden="true"><svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M12 22s8-4 8-11V5l-8-3-8 3v6c0 7 8 11 8 11Z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M8 12h2l1.5-3 2 6 1.5-3H17"/></svg></span>
                    <div><h3 class="font-serif text-xl font-semibold text-[#13007c]">Clinical learning and service</h3><p class="mt-2 text-sm leading-relaxed text-thc-navy/80 sm:text-base">Alongside classroom and practical training, students learn in county hospitals, national referral care, and surrounding communities.</p></div>
                </article>
            </div>
        </div>
    </section>

    <section class="bg-white" aria-labelledby="cohs-visit-heading">
        <div class="mx-auto max-w-7xl px-5 py-12 sm:px-8 lg:px-10 lg:py-16">
            <div class="flex flex-col gap-6 rounded-3xl bg-thc-cohs-indigo px-6 py-8 text-white shadow-[var(--shadow-thc-card-hover)] sm:flex-row sm:items-center sm:justify-between sm:px-9 sm:py-9" data-reveal>
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-violet-200">Come and see</p>
                    <h2 id="cohs-visit-heading" class="mt-2 font-serif text-2xl font-semibold leading-tight text-white sm:text-3xl">Visit and get a feel for student life</h2>
                    <p class="mt-2 max-w-2xl text-sm leading-relaxed text-white/80 sm:text-base">See where you could learn, grow, and build community at the College of Health Sciences.</p>
                </div>
                <div class="flex shrink-0 flex-wrap gap-3">
                    <a href="{{ route('schools.pages.show', [$school, 'contact-us']) }}" class="inline-flex min-h-11 items-center justify-center gap-2 rounded-full bg-white px-5 py-3 text-sm font-bold text-thc-cohs-indigo transition hover:bg-violet-100">Arrange a visit <span aria-hidden="true">→</span></a>
                    <a href="{{ route('schools.pages.show', [$school, 'facilities']) }}" class="inline-flex min-h-11 items-center justify-center gap-2 rounded-full border border-white/50 px-5 py-3 text-sm font-bold text-white transition hover:bg-white/10">Explore facilities</a>
                </div>
            </div>
        </div>
    </section>
</x-layouts.public>
