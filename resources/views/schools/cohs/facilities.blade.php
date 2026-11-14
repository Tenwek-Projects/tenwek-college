@php
    $L = $cohsLanding ?? config('tenwek.cohs_landing');
    $F = $L['facilities'] ?? config('tenwek.cohs_landing.facilities');
    $heroPath = $F['hero_image'] ?? 'tenwekoverhead.jpg';
    $heroImage = \App\Support\Cohs\CohsLandingRepository::publicMediaUrl(is_string($heroPath) ? $heroPath : null) ?? asset(is_string($heroPath) ? $heroPath : 'tenwekoverhead.jpg');
    $heroAlt = $F['hero_image_alt'] ?? 'Aerial view of Tenwek and the surrounding hills';
@endphp

<x-layouts.public :seo="$seo" landing-header="cohs" :school="$school">
    <section class="relative isolate overflow-hidden bg-[#0b1953] text-white" aria-labelledby="cohs-facilities-title">
        <div class="mx-auto grid max-w-[1600px] items-stretch lg:grid-cols-[0.92fr_1.08fr]">
            <div class="relative z-10 flex flex-col justify-center px-5 py-9 sm:px-8 sm:py-12 lg:px-12 lg:py-14 xl:px-16" data-reveal>
                <nav class="mb-8 text-xs font-medium text-white/75 sm:text-sm" aria-label="Breadcrumb">
                    <ol class="flex flex-wrap items-center gap-2">
                        <li><a href="{{ route('home') }}" class="transition hover:text-white">Home</a></li>
                        <li aria-hidden="true" class="text-white/50">/</li>
                        <li><a href="{{ route('schools.show', $school) }}" class="transition hover:text-white">{{ $school->name }}</a></li>
                        <li aria-hidden="true" class="text-white/50">/</li>
                        <li class="font-semibold text-white">Facilities</li>
                    </ol>
                </nav>
                <p class="flex items-center gap-3 text-xs font-bold uppercase tracking-[0.22em] text-white/85">
                    <span>{{ $F['kicker'] }}</span><span class="h-px w-20 bg-white/70 sm:w-28" aria-hidden="true"></span>
                </p>
                <h1 id="cohs-facilities-title" class="mt-4 max-w-xl font-serif text-4xl font-semibold leading-[1.03] tracking-tight text-white sm:text-5xl lg:text-[3.5rem]">
                    {{ $F['headline_before'] }} <span class="text-violet-300">{{ $F['headline_emphasis'] }}</span>
                </h1>
                <span class="mt-4 block h-1.5 w-36 -rotate-2 rounded-full bg-violet-500" aria-hidden="true"></span>
                <p class="mt-5 max-w-xl text-base leading-relaxed text-white/90 sm:text-lg">{{ $F['lead'] ?? $page->excerpt }}</p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="#campus-facilities" class="inline-flex min-h-12 items-center justify-center gap-3 rounded-full bg-violet-600 px-6 py-3 text-sm font-bold text-white shadow-lg transition hover:bg-violet-500">Explore our facilities <span aria-hidden="true">↓</span></a>
                    <a href="{{ route('schools.pages.show', [$school, 'application-forms']) }}" class="inline-flex min-h-12 items-center justify-center gap-2 rounded-full border border-white/70 px-6 py-3 text-sm font-bold text-white transition hover:bg-white/10">Apply now <span aria-hidden="true">→</span></a>
                </div>
            </div>
            <figure class="relative min-h-[17rem] overflow-hidden sm:min-h-[22rem] lg:min-h-[31rem]" data-reveal>
                <img src="{{ $heroImage }}" alt="{{ $heroAlt }}" class="absolute inset-0 h-full w-full object-cover object-center" fetchpriority="high" decoding="async">
                <div class="absolute inset-0 bg-gradient-to-t from-[#0b1953]/50 via-transparent to-transparent lg:bg-[linear-gradient(90deg,#0b1953_0%,rgba(11,25,83,.24)_12%,transparent_48%)]" aria-hidden="true"></div>
                <figcaption class="absolute bottom-5 right-5 rounded-xl border border-white/25 bg-[#0b1953]/65 px-4 py-2 text-xs font-semibold text-white backdrop-blur sm:bottom-7 sm:right-7">Tenwek campus · Bomet County</figcaption>
            </figure>
        </div>
    </section>

    <section class="border-b border-thc-cohs-blue/10 bg-white" aria-label="Facilities at a glance">
        <ul class="mx-auto grid max-w-7xl gap-4 px-5 py-7 sm:grid-cols-2 sm:px-8 lg:grid-cols-4 lg:gap-0 lg:px-10 lg:py-8" role="list">
            @foreach($F['stats'] as $stat)
                <li class="flex items-center gap-4 border-thc-cohs-blue/15 px-3 py-2 sm:px-5 lg:border-r lg:px-6 lg:first:pl-0 lg:last:border-r-0 lg:last:pr-0" data-reveal>
                    <span class="font-serif text-3xl font-semibold tracking-tight text-thc-cohs-indigo sm:text-4xl">{{ $stat['value'] }}</span>
                    <span class="max-w-[10rem] text-sm font-medium leading-snug text-thc-navy/80">{{ $stat['label'] }}</span>
                </li>
            @endforeach
        </ul>
    </section>

    <section id="campus-facilities" class="scroll-mt-24 bg-thc-cohs-wash/55" aria-labelledby="cohs-campus-heading">
        <div class="mx-auto max-w-7xl px-5 py-14 sm:px-8 lg:px-10 lg:py-20">
            <div class="flex flex-col gap-5 border-b border-thc-cohs-blue/15 pb-7 sm:flex-row sm:items-end sm:justify-between" data-reveal>
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-thc-cohs-indigo">Study · Practise · Grow</p>
                    <h2 id="cohs-campus-heading" class="mt-3 font-serif text-[30px] font-semibold leading-tight tracking-[-0.6px] text-[#13007c] sm:text-[36px] sm:leading-[45px] sm:tracking-[-0.9px]">What you’ll find on campus</h2>
                    <span class="mt-3 block h-1 w-16 -rotate-2 rounded-full bg-violet-500" aria-hidden="true"></span>
                </div>
                <p class="max-w-xl text-base leading-relaxed text-thc-navy/80">Everything you need to study, practise and live well during your training.</p>
            </div>

            <ul class="mt-8 grid gap-5 md:grid-cols-2 xl:grid-cols-3" role="list">
                @foreach($F['facility_cards'] as $facility)
                    @php
                        $facilityImage = \App\Support\Cohs\CohsLandingRepository::publicMediaUrl($facility['image'] ?? null) ?? asset($facility['image'] ?? '');
                    @endphp
                    <li class="group flex h-full flex-col overflow-hidden rounded-2xl border border-thc-cohs-blue/15 bg-white shadow-[var(--shadow-thc-card)] transition duration-300 hover:-translate-y-1 hover:border-thc-cohs-blue/35 hover:shadow-[var(--shadow-thc-card-hover)]" data-reveal>
                        <div class="relative overflow-hidden bg-thc-cohs-wash">
                            <img src="{{ $facilityImage }}" alt="{{ $facility['image_alt'] ?? $facility['title'] }}" class="aspect-[3/2] w-full object-cover transition duration-500 group-hover:scale-[1.025]" loading="lazy" decoding="async">
                            <span class="absolute left-4 top-4 rounded-full border border-white/60 bg-white/90 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.12em] text-thc-cohs-indigo shadow-sm">Tenwek campus</span>
                        </div>
                        <div class="flex flex-1 flex-col p-6 sm:p-7">
                            <h3 class="font-serif text-2xl font-semibold leading-tight text-[#13007c]">{{ $facility['title'] }}</h3>
                            <p class="mt-3 flex-1 text-sm leading-relaxed text-thc-navy/80 sm:text-base">{{ $facility['description'] }}</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    <section class="border-y border-thc-cohs-blue/10 bg-white" aria-labelledby="cohs-accommodation-heading">
        <div class="mx-auto max-w-7xl px-5 py-14 sm:px-8 lg:px-10 lg:py-16">
            <div class="grid gap-8 lg:grid-cols-[0.8fr_1.2fr] lg:items-center lg:gap-14">
                <div data-reveal>
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-thc-cohs-indigo">Settle in and focus</p>
                    <h2 id="cohs-accommodation-heading" class="mt-3 font-serif text-[30px] font-semibold leading-tight tracking-[-0.6px] text-[#13007c] sm:text-[36px] sm:leading-[45px] sm:tracking-[-0.9px]">{{ $F['accommodation_heading'] }}</h2>
                    <span class="mt-3 block h-1 w-16 -rotate-2 rounded-full bg-violet-500" aria-hidden="true"></span>
                </div>
                <div class="grid gap-4 sm:grid-cols-2" data-reveal>
                    @foreach($F['accommodation_paragraphs'] as $index => $paragraph)
                        <article class="rounded-2xl border border-thc-cohs-blue/15 bg-thc-cohs-wash/50 p-5 sm:p-6">
                            <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-white text-thc-cohs-indigo shadow-sm" aria-hidden="true">
                                @if($index === 0)
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M3 20V8l9-5 9 5v12M7 20v-6h10v6M9 9h.01M15 9h.01"/></svg>
                                @else
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M12 21s-7-4.4-7-11a7 7 0 1 1 14 0c0 6.6-7 11-7 11Z"/><circle cx="12" cy="10" r="2.5" stroke-width="1.7"/></svg>
                                @endif
                            </span>
                            <p class="mt-4 text-sm leading-relaxed text-thc-navy/85 sm:text-base">{{ $paragraph }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white" aria-labelledby="cohs-campus-visit-heading">
        <div class="mx-auto max-w-7xl px-5 py-12 sm:px-8 lg:px-10 lg:py-16">
            <div class="flex flex-col gap-6 rounded-3xl bg-thc-cohs-indigo px-6 py-8 text-white shadow-[var(--shadow-thc-card-hover)] sm:flex-row sm:items-center sm:justify-between sm:px-9 sm:py-9" data-reveal>
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-violet-200">Come and see</p>
                    <h2 id="cohs-campus-visit-heading" class="mt-2 font-serif text-2xl font-semibold leading-tight text-white sm:text-3xl">See the campus for yourself</h2>
                    <p class="mt-2 max-w-2xl text-sm leading-relaxed text-white/80 sm:text-base">Visit Tenwek and get a feel for studying at the College of Health Sciences.</p>
                </div>
                <div class="flex shrink-0 flex-wrap gap-3">
                    <a href="{{ route('schools.pages.show', [$school, 'contact-us']) }}" class="inline-flex min-h-11 items-center justify-center gap-2 rounded-full bg-white px-5 py-3 text-sm font-bold text-thc-cohs-indigo transition hover:bg-violet-100">Arrange a visit <span aria-hidden="true">→</span></a>
                    <a href="{{ route('schools.pages.show', [$school, 'social-life']) }}" class="inline-flex min-h-11 items-center justify-center gap-2 rounded-full border border-white/50 px-5 py-3 text-sm font-bold text-white transition hover:bg-white/10">Student life</a>
                </div>
            </div>
        </div>
    </section>
</x-layouts.public>
