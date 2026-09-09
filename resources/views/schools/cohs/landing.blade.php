@php
    $L = $cohsLanding ?? config('tenwek.cohs_landing');
    $hero = $L['hero'] ?? [];
    $welcome = $L['welcome'] ?? [];
    $programmesBand = $L['programmes_band'] ?? ['items' => [], 'kicker' => '', 'title' => '', 'intro' => ''];
    $testimonials = $L['testimonials'] ?? ['items' => [], 'kicker' => '', 'title' => ''];
    $contactBlock = $L['contact'] ?? ['location_lines' => [], 'phones' => [], 'email' => '', 'kicker' => ''];
    $heroPath = $L['hero_image'] ?? 'banner-nursing.jpg';
    $welcomePath = $L['welcome_image'] ?? 'banner-nursing.jpg';
    $heroImageUrl = \App\Support\Cohs\CohsLandingRepository::publicMediaUrl(is_string($heroPath) ? $heroPath : null) ?? asset(is_string($heroPath) ? $heroPath : 'banner-nursing.jpg');
    $welcomeImageUrl = \App\Support\Cohs\CohsLandingRepository::publicMediaUrl(is_string($welcomePath) ? $welcomePath : null) ?? asset(is_string($welcomePath) ? $welcomePath : 'banner-nursing.jpg');
    $mapUrl = $L['map_embed_url'] ?? null;
    $primaryCta = $hero['primary_cta'] ?? ['label' => 'View programmes', 'route' => 'schools.pages.show', 'params' => ['school' => $school->slug, 'pageSlug' => 'diploma-in-nursing']];
@endphp

<x-layouts.public :seo="$seo" landing-header="cohs" :school="$school">
    {{-- Hero: rhythm inspired by https://tenwekhospitalcollege.ac.ke/cohs/ --}}
    <section
        class="relative flex min-h-[min(88svh,48rem)] flex-col justify-end overflow-hidden"
        aria-label="College of Health Sciences hero"
    >
        <div class="pointer-events-none absolute inset-0 thc-hero-ken-bg bg-cover bg-center" style="background-image: url('{{ e($heroImageUrl) }}');" aria-hidden="true"></div>
        <div class="cohs-landing-hero-overlay absolute inset-0" aria-hidden="true"></div>
        <div class="pointer-events-none absolute inset-0 opacity-[0.14] mix-blend-overlay" style="background-image: radial-gradient(circle at 25% 20%, rgba(255,255,255,0.45), transparent 42%), radial-gradient(circle at 80% 75%, rgba(90,200,250,0.45), transparent 40%);" aria-hidden="true"></div>

        <div class="relative z-10 mx-auto w-full max-w-7xl px-4 pb-16 pt-28 sm:px-6 sm:pb-20 sm:pt-32 lg:px-8 lg:pb-24">
            <nav class="mb-8 text-sm text-white/75" aria-label="Breadcrumb">
                <ol class="flex flex-wrap gap-2">
                    <li><a href="{{ route('home') }}" class="hover:text-white">Home</a></li>
                    <li aria-hidden="true">/</li>
                    <li class="text-white">{{ $school->name }}</li>
                </ol>
            </nav>
            <div data-reveal class="max-w-3xl">
                <p class="inline-flex items-center gap-2 rounded-full border border-white/25 bg-white/10 px-4 py-1.5 text-[11px] font-bold uppercase tracking-[0.2em] text-white/95 backdrop-blur-sm">
                    {{ $hero['badge'] }}
                </p>
                <p class="mt-6 text-sm font-semibold uppercase tracking-[0.28em] text-white/80">{{ $hero['eyebrow'] }}</p>
                <h1 class="mt-4 font-serif text-4xl font-semibold leading-[1.08] tracking-tight text-white sm:text-5xl lg:text-[3.25rem]">
                    {{ $hero['headline'] }}
                </h1>
                <p class="mt-6 max-w-2xl text-lg leading-relaxed text-white/92 sm:text-xl">
                    {{ $hero['subhead'] }}
                </p>
                <div class="mt-10 flex flex-col gap-4 sm:flex-row sm:flex-wrap sm:items-center">
                    <a href="{{ route($primaryCta['route'], $primaryCta['params']) }}" class="thc-btn-primary justify-center px-8 shadow-xl ring-1 ring-white/10">
                        {{ $primaryCta['label'] }}
                    </a>
                    <a href="#{{ $hero['secondary_cta']['hash'] }}" class="thc-btn-secondary justify-center px-8">
                        {{ $hero['secondary_cta']['label'] }}
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Welcome --}}
    <section id="about" class="scroll-mt-24 border-b border-thc-navy/8 bg-white">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:grid lg:grid-cols-12 lg:gap-12 lg:px-8 lg:py-24">
            <div class="lg:col-span-5" data-reveal>
                <div class="relative aspect-[4/5] overflow-hidden rounded-2xl shadow-[var(--shadow-thc-card)] ring-1 ring-thc-navy/10 sm:aspect-[3/4] lg:sticky lg:top-28 lg:max-h-[min(85vh,36rem)] lg:min-h-[20rem]">
                    <div class="absolute inset-0 bg-cover bg-center transition duration-700 hover:scale-[1.02]" style="background-image: url('{{ e($welcomeImageUrl) }}');"></div>
                    <div class="absolute inset-0 bg-gradient-to-tr from-thc-navy/40 via-transparent to-thc-cohs-sky/25" aria-hidden="true"></div>
                </div>
            </div>
            <div class="mt-12 lg:col-span-7 lg:mt-0" data-reveal>
                <p class="thc-kicker">{{ $welcome['kicker'] }}</p>
                <h2 class="mt-4 font-serif text-3xl font-semibold tracking-tight text-thc-navy sm:text-4xl">
                    {{ $welcome['title'] }}
                </h2>
                <p class="mt-6 text-lg font-medium text-thc-royal">{{ $welcome['lead'] }}</p>
                <div class="mt-6 space-y-4 text-base leading-relaxed text-thc-text/90 sm:text-lg">
                    @foreach($welcome['paragraphs'] as $p)
                        <p>{{ $p }}</p>
                    @endforeach
                </div>
                <div class="mt-10 flex flex-wrap gap-4">
                    <a href="{{ route('schools.pages.show', [$school, 'about-us']) }}" class="thc-btn-ghost">Read more about us</a>
                    <a href="{{ route('schools.pages.show', [$school, 'application-forms']) }}" class="inline-flex items-center gap-2 text-sm font-semibold text-thc-royal hover:underline">Application forms →</a>
                </div>
            </div>
        </div>
    </section>

    {{-- Programmes band (legacy “About us” + two cards) --}}
    <section id="programmes" class="cohs-landing-programmes scroll-mt-24" aria-labelledby="cohs-programmes-heading">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 lg:py-24">
            <div class="mx-auto max-w-2xl text-center" data-reveal>
                <p class="thc-kicker">{{ $programmesBand['kicker'] }}</p>
                <h2 id="cohs-programmes-heading" class="mt-4 font-serif text-3xl font-semibold text-thc-navy sm:text-4xl">
                    {{ $programmesBand['title'] }}
                </h2>
                <p class="mt-4 text-lg text-thc-text/85">{{ $programmesBand['intro'] }}</p>
            </div>
            <div class="mt-12 grid gap-6 lg:grid-cols-2 lg:gap-8">
                @foreach($programmesBand['items'] as $prog)
                    <article
                        data-reveal
                        class="group flex flex-col overflow-hidden rounded-2xl border border-thc-navy/10 bg-white shadow-[var(--shadow-thc-card)] transition duration-300 hover:-translate-y-0.5 hover:shadow-[var(--shadow-thc-card-hover)]"
                    >
                        <div class="h-1.5 bg-gradient-to-r from-thc-cohs-indigo via-thc-cohs-blue to-thc-cohs-coral" aria-hidden="true"></div>
                        <div class="flex flex-1 flex-col p-8 sm:p-10">
                            <h3 class="font-serif text-xl font-semibold text-thc-navy sm:text-2xl">{{ $prog['title'] }}</h3>
                            <p class="mt-4 flex-1 text-base leading-relaxed text-thc-text/90">{{ $prog['summary'] }}</p>
                            <a
                                href="{{ route('schools.pages.show', [$school, $prog['page_slug']]) }}"
                                class="mt-8 inline-flex items-center gap-2 text-sm font-semibold text-thc-royal hover:underline"
                            >
                                Read more
                                <span aria-hidden="true">→</span>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Testimonials --}}
    <section id="testimonials" class="cohs-landing-testimonials scroll-mt-24" aria-labelledby="cohs-testimonials-heading">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 lg:py-24">
            <div class="max-w-2xl" data-reveal>
                <p class="thc-kicker">{{ $testimonials['kicker'] }}</p>
                <h2 id="cohs-testimonials-heading" class="mt-4 font-serif text-3xl font-semibold text-thc-navy sm:text-4xl">{{ $testimonials['title'] }}</h2>
            </div>

            @php $tCount = count($testimonials['items']); @endphp
            <div
                class="relative mt-12"
                x-data="{ active: 0, count: {{ $tCount }} }"
                data-reveal
            >
                <div class="overflow-hidden rounded-2xl border border-thc-navy/10 bg-gradient-to-br from-thc-cohs-wash via-white to-white shadow-[var(--shadow-thc-card)]">
                    @foreach($testimonials['items'] as $ti => $t)
                        <div
                            x-show="active === {{ $ti }}"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            class="px-8 py-12 sm:px-12 sm:py-14"
                            role="tabpanel"
                            @if($ti > 0) style="display: none;" @endif
                        >
                            <p class="text-xs font-bold uppercase tracking-[0.18em] text-thc-royal">{{ $t['role'] }}</p>
                            <blockquote class="mt-6 font-serif text-xl font-normal leading-relaxed text-thc-navy sm:text-2xl">
                                “{{ $t['quote'] }}”
                            </blockquote>
                            <footer class="mt-8 flex items-center gap-4">
                                <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-thc-cohs-coral to-thc-cohs-indigo text-sm font-bold text-white" aria-hidden="true">{{ \Illuminate\Support\Str::substr($t['name'], 0, 1) }}</span>
                                <div>
                                    <cite class="not-italic text-base font-semibold text-thc-navy">{{ $t['name'] }}</cite>
                                </div>
                            </footer>
                        </div>
                    @endforeach
                </div>

                @if($tCount > 1)
                    <div class="mt-6 flex flex-wrap items-center justify-between gap-4">
                        <div class="flex gap-2" role="tablist" aria-label="Choose testimonial">
                            @foreach($testimonials['items'] as $ti => $t)
                                <button
                                    type="button"
                                    class="h-2.5 rounded-full transition-all"
                                    :class="active === {{ $ti }} ? 'w-8 bg-thc-royal' : 'w-2.5 bg-thc-navy/20 hover:bg-thc-navy/35'"
                                    @click="active = {{ $ti }}"
                                    :aria-selected="(active === {{ $ti }}).toString()"
                                    role="tab"
                                    aria-label="Show testimonial {{ $ti + 1 }}"
                                ></button>
                            @endforeach
                        </div>
                        <div class="flex gap-2">
                            <button
                                type="button"
                                class="rounded-full border border-thc-navy/15 px-4 py-2 text-sm font-semibold text-thc-navy transition hover:bg-thc-navy/5"
                                @click="active = (active - 1 + count) % count"
                            >Previous</button>
                            <button
                                type="button"
                                class="rounded-full border border-thc-navy/15 px-4 py-2 text-sm font-semibold text-thc-navy transition hover:bg-thc-navy/5"
                                @click="active = (active + 1) % count"
                            >Next</button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- Contact --}}
    <section id="contact" class="cohs-landing-contact scroll-mt-24 border-t border-thc-navy/10 pb-0">
        <div class="mx-auto max-w-7xl px-4 pt-16 sm:px-6 lg:px-8 lg:pt-24">
            <div class="max-w-3xl lg:max-w-2xl" data-reveal>
                <p class="thc-kicker">{{ $contactBlock['kicker'] }}</p>
                <h2 class="mt-4 font-serif text-3xl font-semibold text-thc-navy sm:text-4xl">We would love to hear from you</h2>
                <p class="mt-4 text-lg text-thc-text/85">Admissions, programme questions, or general enquiries: reach the College of Health Sciences office.</p>
            </div>

            <div class="mt-12 grid items-stretch gap-8 lg:grid-cols-12 lg:gap-10 xl:gap-14">
                <div class="flex lg:col-span-5" data-reveal>
                    <div class="cohs-landing-contact-card flex h-full w-full flex-col overflow-hidden rounded-2xl border border-thc-navy/10 bg-white shadow-[var(--shadow-thc-card)]">
                        <div class="h-1.5 shrink-0 bg-gradient-to-r from-thc-cohs-indigo via-thc-cohs-blue to-thc-cohs-coral" aria-hidden="true"></div>
                        <div class="flex flex-1 flex-col gap-8 p-6 sm:gap-10 sm:p-8">
                            <div>
                                <div class="flex items-center gap-3">
                                    <span class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-thc-cohs-wash text-thc-cohs-indigo ring-1 ring-thc-cohs-blue/25" aria-hidden="true">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                                    </span>
                                    <h3 class="text-xs font-bold uppercase tracking-[0.18em] text-thc-cohs-coral">Our location</h3>
                                </div>
                                <ul class="mt-4 space-y-2 border-l-2 border-thc-cohs-blue/35 pl-4 text-sm leading-relaxed text-thc-text/90">
                                    @foreach($contactBlock['location_lines'] as $line)
                                        <li>{{ $line }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="border-t border-thc-cohs-blue/20 pt-8">
                                <div class="flex items-center gap-3">
                                    <span class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-thc-cohs-coral/10 text-thc-cohs-coral ring-1 ring-thc-cohs-coral/25" aria-hidden="true">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg>
                                    </span>
                                    <h3 class="text-xs font-bold uppercase tracking-[0.18em] text-thc-cohs-coral">Phone</h3>
                                </div>
                                <ul class="mt-4 space-y-2 text-sm font-medium text-thc-navy">
                                    @foreach($contactBlock['phones'] as $phone)
                                        <li><a href="tel:{{ preg_replace('/[^0-9+]/', '', \Illuminate\Support\Str::before($phone, ',')) }}" class="transition hover:text-thc-cohs-blue hover:underline">{{ $phone }}</a></li>
                                    @endforeach
                                </ul>
                                <div class="mt-8 flex items-center gap-3">
                                    <span class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-thc-cohs-blue/10 text-thc-cohs-blue ring-1 ring-thc-cohs-blue/25" aria-hidden="true">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                                    </span>
                                    <h3 class="text-xs font-bold uppercase tracking-[0.18em] text-thc-cohs-coral">Email</h3>
                                </div>
                                <p class="mt-4">
                                    <a href="mailto:{{ $contactBlock['email'] }}" class="text-sm font-semibold text-thc-cohs-blue transition hover:text-thc-cohs-indigo hover:underline">{{ $contactBlock['email'] }}</a>
                                </p>
                            </div>
                            <p class="mt-auto rounded-xl bg-thc-cohs-wash/80 px-4 py-3 text-sm leading-relaxed text-thc-navy/80 ring-1 ring-thc-cohs-blue/15">
                                Office hours follow the college calendar. We aim to reply within a few working days.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="flex lg:col-span-7" data-reveal>
                    <div class="flex h-full w-full flex-col">
                        @if (session('status'))
                            <div class="mb-6 rounded-xl border border-thc-cohs-blue/30 bg-thc-cohs-wash px-4 py-3 text-sm text-thc-navy">{{ session('status') }}</div>
                        @endif

                        <div class="cohs-landing-contact-form flex h-full flex-1 flex-col overflow-hidden rounded-2xl border border-thc-navy/10 bg-white shadow-[var(--shadow-thc-card)]">
                            <div class="h-1.5 shrink-0 bg-gradient-to-r from-thc-cohs-coral via-thc-cohs-blue to-thc-cohs-indigo" aria-hidden="true"></div>
                            <div class="flex flex-1 flex-col p-6 sm:p-8">
                                <h3 class="font-serif text-xl font-semibold text-thc-navy">Send a message</h3>
                                <p class="mt-2 text-sm text-thc-text/80">Use this form for enquiries to the College of Health Sciences. Required fields are marked.</p>

                                <form method="post" action="{{ route('contact.store') }}" class="mt-8 flex flex-1 flex-col space-y-5" data-arithmetic-guard>
                                    @csrf
                                    <input type="hidden" name="school_id" value="{{ $school->id }}">
                                    <input type="text" name="fax" tabindex="-1" autocomplete="off" class="absolute -left-[9999px] h-0 w-0 opacity-0" aria-hidden="true">

                                    <div class="grid flex-1 gap-5 content-start sm:grid-cols-2">
                                        <div class="sm:col-span-2">
                                            <label for="cohs-contact-name" class="block text-sm font-medium text-thc-navy">Full name</label>
                                            <input type="text" name="name" id="cohs-contact-name" value="{{ old('name') }}" required autocomplete="name" class="mt-1.5 w-full rounded-xl border border-thc-navy/12 bg-thc-cohs-wash/40 px-4 py-3 text-sm transition focus:border-thc-cohs-blue focus:bg-white focus:outline-none focus:ring-2 focus:ring-thc-cohs-blue/25">
                                            @error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                        </div>
                                        <div>
                                            <label for="cohs-contact-email" class="block text-sm font-medium text-thc-navy">Email</label>
                                            <input type="email" name="email" id="cohs-contact-email" value="{{ old('email') }}" required autocomplete="email" class="mt-1.5 w-full rounded-xl border border-thc-navy/12 bg-thc-cohs-wash/40 px-4 py-3 text-sm transition focus:border-thc-cohs-blue focus:bg-white focus:outline-none focus:ring-2 focus:ring-thc-cohs-blue/25">
                                            @error('email')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                        </div>
                                        <div>
                                            <label for="cohs-contact-phone" class="block text-sm font-medium text-thc-navy">Phone <span class="font-normal text-thc-text/60">(optional)</span></label>
                                            <input type="text" name="phone" id="cohs-contact-phone" value="{{ old('phone') }}" autocomplete="tel" class="mt-1.5 w-full rounded-xl border border-thc-navy/12 bg-thc-cohs-wash/40 px-4 py-3 text-sm transition focus:border-thc-cohs-blue focus:bg-white focus:outline-none focus:ring-2 focus:ring-thc-cohs-blue/25">
                                            @error('phone')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                        </div>
                                        <div class="sm:col-span-2">
                                            <label for="cohs-contact-topic" class="block text-sm font-medium text-thc-navy">Topic <span class="font-normal text-thc-text/60">(optional)</span></label>
                                            <input type="text" name="topic" id="cohs-contact-topic" value="{{ old('topic', 'College of Health Sciences enquiry') }}" class="mt-1.5 w-full rounded-xl border border-thc-navy/12 bg-thc-cohs-wash/40 px-4 py-3 text-sm transition focus:border-thc-cohs-blue focus:bg-white focus:outline-none focus:ring-2 focus:ring-thc-cohs-blue/25">
                                            @error('topic')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                        </div>
                                        <div class="sm:col-span-2 flex min-h-0 flex-1 flex-col">
                                            <label for="cohs-contact-message" class="block text-sm font-medium text-thc-navy">Message</label>
                                            <textarea name="message" id="cohs-contact-message" rows="5" required class="mt-1.5 min-h-[8rem] w-full flex-1 rounded-xl border border-thc-navy/12 bg-thc-cohs-wash/40 px-4 py-3 text-sm transition focus:border-thc-cohs-blue focus:bg-white focus:outline-none focus:ring-2 focus:ring-thc-cohs-blue/25">{{ old('message') }}</textarea>
                                            @error('message')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                        </div>
                                    </div>

                                    <div class="mt-auto flex flex-col gap-4 border-t border-thc-cohs-blue/15 pt-6 sm:flex-row sm:items-center sm:justify-between">
                                        <button type="submit" class="thc-btn-primary w-full justify-center sm:w-auto sm:min-w-[12rem]">Send message</button>
                                        <p class="text-xs text-thc-text/65">By submitting, you agree we may respond using the details provided.</p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if($mapUrl)
                <div class="mt-10 w-full sm:mt-12 lg:mt-14" data-reveal>
                    <div class="overflow-hidden rounded-2xl border border-thc-navy/10 bg-thc-navy/[0.03] shadow-[var(--shadow-thc-card)] ring-1 ring-thc-navy/5">
                        <iframe
                            title="Map: Tenwek Hospital College area"
                            src="{{ $mapUrl }}"
                            class="block aspect-video min-h-[16rem] w-full max-w-full border-0 sm:min-h-[18rem] lg:min-h-[22rem]"
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            allowfullscreen
                        ></iframe>
                    </div>
                </div>
            @endif
        </div>

        <div class="h-12 sm:h-16 lg:h-20" aria-hidden="true"></div>
    </section>
</x-layouts.public>
