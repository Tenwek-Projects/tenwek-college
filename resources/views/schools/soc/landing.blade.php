@php
    use App\Support\Soc\SocLandingRepository;
    $L = $socLanding ?? config('tenwek.soc_landing');
    $hero = $L['hero'];
    $heroImg = $L['hero_image'];
    $aboutImg = $L['about_image'];
    $heroImageUrl = SocLandingRepository::publicMediaUrl($heroImg) ?? asset('banner-a.jpg');
    $aboutImageUrl = SocLandingRepository::publicMediaUrl($aboutImg) ?? asset('banner-a.jpg');
    $primaryCta = $hero['primary_cta'];
    $mapUrl = $L['map_embed_url'];
    $testimonials = $L['testimonials'];
    $contactBlock = $L['contact'];
@endphp

<x-layouts.public :seo="$seo" landing-header="soc" :school="$school">
    <x-schools.soc.page-breadcrumb-band :school="$school" />

    {{-- Hero --}}
    <section
        class="relative flex min-h-[min(92svh,52rem)] flex-col justify-end overflow-hidden"
        aria-label="School of Chaplaincy hero"
    >
        <div class="pointer-events-none absolute inset-0 thc-hero-ken-bg bg-cover bg-center" style="background-image: url('{{ e($heroImageUrl) }}');" aria-hidden="true"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-thc-navy via-thc-soc-purple/55 to-thc-soc-sky/35" aria-hidden="true"></div>
        <div class="pointer-events-none absolute inset-0 opacity-[0.16] mix-blend-overlay" style="background-image: radial-gradient(circle at 20% 25%, rgba(255,255,255,0.45), transparent 45%), radial-gradient(circle at 85% 70%, rgba(90,200,250,0.4), transparent 42%), radial-gradient(circle at 70% 20%, rgba(130,101,174,0.28), transparent 46%);" aria-hidden="true"></div>

        <div class="relative z-10 mx-auto w-full max-w-7xl px-4 pb-16 pt-28 sm:px-6 sm:pb-20 sm:pt-32 lg:px-8 lg:pb-24">
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
                    <a href="{{ route($primaryCta['route'], $primaryCta['params']) }}" class="thc-btn-primary justify-center px-8 shadow-xl ring-1 ring-white/20">
                        {{ $primaryCta['label'] }}
                    </a>
                    <a href="#{{ $hero['secondary_cta']['hash'] }}" class="thc-btn-secondary justify-center px-8">
                        {{ $hero['secondary_cta']['label'] }}
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- About (Karibu) --}}
    <section id="about" class="soc-landing-about scroll-mt-24 border-b border-thc-soc-purple/15">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:grid lg:grid-cols-12 lg:gap-12 lg:px-8 lg:py-24">
            <div class="lg:col-span-5" data-reveal>
                <div class="relative aspect-[4/5] overflow-hidden rounded-2xl shadow-[var(--shadow-thc-card)] ring-1 ring-thc-soc-purple/15 sm:aspect-[3/4] lg:sticky lg:top-28 lg:max-h-[min(85vh,36rem)] lg:min-h-[20rem]">
                    <div class="absolute inset-x-0 top-0 z-10 h-1.5 bg-gradient-to-r from-thc-soc-purple via-thc-soc-sky to-thc-soc-sky-soft" aria-hidden="true"></div>
                    <div class="absolute inset-0 bg-cover bg-center transition duration-700 hover:scale-[1.02]" style="background-image: url('{{ e($aboutImageUrl) }}');"></div>
                    <div class="absolute inset-0 bg-gradient-to-tr from-thc-navy/35 via-transparent to-thc-soc-sky/25" aria-hidden="true"></div>
                </div>
            </div>
            <div class="mt-12 lg:col-span-7 lg:mt-0" data-reveal>
                <p class="thc-kicker">{{ $L['about']['kicker'] }}</p>
                <h2 class="mt-4 font-serif text-3xl font-semibold tracking-tight text-thc-navy sm:text-4xl">
                    {{ $L['about']['title'] }}
                </h2>
                <p class="mt-6 text-lg font-medium text-thc-soc-purple">{{ $L['about']['lead'] }}</p>
                <div class="mt-6 space-y-4 text-base leading-relaxed text-thc-text/90 sm:text-lg">
                    @foreach($L['about']['paragraphs'] as $p)
                        <p>{{ $p }}</p>
                    @endforeach
                </div>
                <div class="mt-10 flex flex-wrap gap-4">
                    <a href="{{ route('schools.pages.show', [$school, 'about-us']) }}" class="thc-btn-ghost">Read more about us</a>
                    <a href="{{ route('schools.pages.show', [$school, 'admissions']) }}" class="inline-flex items-center gap-2 text-sm font-semibold text-thc-soc-purple transition hover:text-thc-navy hover:underline">Admissions →</a>
                </div>
            </div>
        </div>
    </section>

    {{-- Mission & Vision --}}
    <section id="mission-vision" class="soc-landing-mission scroll-mt-24">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 lg:py-24">
            <div class="mx-auto max-w-2xl text-center" data-reveal>
                <p class="thc-kicker">Who we are</p>
                <h2 class="mt-4 font-serif text-3xl font-semibold text-thc-navy sm:text-4xl">Mission &amp; vision</h2>
                <p class="mt-4 text-lg text-thc-text/85">Anchors that shape every classroom, placement, and conversation.</p>
            </div>
            <div class="mt-12 grid gap-6 lg:grid-cols-2 lg:gap-8">
                <article
                    data-reveal
                    class="group relative flex h-full flex-col overflow-hidden rounded-2xl border border-thc-navy/10 bg-white shadow-[var(--shadow-thc-card)] transition duration-300 hover:-translate-y-0.5 hover:shadow-[var(--shadow-thc-card-hover)]"
                >
                    <div class="h-1.5 shrink-0 bg-gradient-to-r from-thc-soc-purple via-thc-soc-sky to-thc-soc-sky-soft" aria-hidden="true"></div>
                    <div class="flex flex-1 flex-col p-8 sm:p-10">
                        <h3 class="font-serif text-xl font-semibold text-thc-soc-purple sm:text-2xl">{{ $L['vision']['title'] }}</h3>
                        <p class="mt-6 flex-1 text-lg leading-relaxed text-thc-text/90">{{ $L['vision']['text'] }}</p>
                    </div>
                </article>
                <article
                    data-reveal
                    class="group relative flex h-full flex-col overflow-hidden rounded-2xl border border-thc-navy/10 bg-white shadow-[var(--shadow-thc-card)] transition duration-300 hover:-translate-y-0.5 hover:shadow-[var(--shadow-thc-card-hover)]"
                >
                    <div class="h-1.5 shrink-0 bg-gradient-to-r from-thc-soc-sky via-thc-soc-sky-soft to-thc-soc-purple" aria-hidden="true"></div>
                    <div class="flex flex-1 flex-col p-8 sm:p-10">
                        <h3 class="font-serif text-xl font-semibold text-thc-soc-sky sm:text-2xl">{{ $L['mission']['title'] }}</h3>
                        <p class="mt-6 flex-1 text-lg leading-relaxed text-thc-text/90">{{ $L['mission']['text'] }}</p>
                    </div>
                </article>
            </div>
        </div>
    </section>

    {{-- Motto --}}
    <section id="motto" class="scroll-mt-24 relative overflow-hidden border-y border-thc-soc-purple/25 bg-thc-navy text-white">
        <div class="pointer-events-none absolute inset-0 opacity-35" style="background-image: radial-gradient(circle at 50% 0%, rgba(90,200,250,0.35), transparent 55%), radial-gradient(circle at 10% 90%, rgba(130,101,174,0.4), transparent 50%), radial-gradient(circle at 90% 10%, rgba(178,222,234,0.22), transparent 52%);" aria-hidden="true"></div>
        <div class="relative mx-auto max-w-4xl px-4 py-20 text-center sm:px-6 lg:py-28">
            <p class="text-[11px] font-bold uppercase tracking-[0.28em] text-thc-soc-sky-soft" data-reveal>{{ $L['motto']['kicker'] }}</p>
            <p class="mt-8 font-serif text-3xl font-medium leading-snug text-white sm:text-4xl lg:text-[2.75rem]" data-reveal>
                <span class="text-thc-soc-sky/50" aria-hidden="true">“</span>{{ $L['motto']['text'] }}<span class="text-thc-soc-sky/50" aria-hidden="true">”</span>
            </p>
        </div>
    </section>

    {{-- Testimonials --}}
    <section id="testimonials" class="soc-landing-testimonials scroll-mt-24" aria-labelledby="soc-testimonials-heading">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 lg:py-24">
            <div class="max-w-2xl" data-reveal>
                <p class="thc-kicker">{{ $testimonials['kicker'] }}</p>
                <h2 id="soc-testimonials-heading" class="mt-4 font-serif text-3xl font-semibold text-thc-navy sm:text-4xl">{{ $testimonials['title'] }}</h2>
            </div>

            @php $tCount = count($testimonials['items']); @endphp
            <div
                class="relative mt-12"
                x-data="{ active: 0, count: {{ $tCount }} }"
                data-reveal
            >
                <div class="overflow-hidden rounded-2xl border border-thc-navy/10 bg-white shadow-[var(--shadow-thc-card)] ring-1 ring-thc-soc-sky/15">
                    <div class="h-1.5 bg-gradient-to-r from-thc-soc-purple via-thc-soc-sky to-thc-soc-sky-soft" aria-hidden="true"></div>
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
                            <p class="text-xs font-bold uppercase tracking-[0.18em] text-thc-soc-sky">{{ $t['role'] }}</p>
                            <blockquote class="mt-6 font-serif text-xl font-normal leading-relaxed text-thc-navy sm:text-2xl">
                                “{{ $t['quote'] }}”
                            </blockquote>
                            <footer class="mt-8 flex items-center gap-4">
                                @php
                                    $tImg = $t['image'] ?? null;
                                    $tImgUrl = $tImg ? (\App\Support\Soc\SocLandingRepository::publicMediaUrl($tImg) ?? asset($tImg)) : null;
                                @endphp
                                @if(filled($tImgUrl))
                                    <span class="relative h-12 w-12 shrink-0 overflow-hidden rounded-full border border-thc-soc-sky/30 bg-thc-soc-wash shadow-sm ring-1 ring-thc-soc-purple/10" aria-hidden="true">
                                        <img src="{{ $tImgUrl }}" alt="" class="h-full w-full object-cover" width="48" height="48" loading="lazy" decoding="async">
                                    </span>
                                @else
                                    <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-thc-soc-sky to-thc-soc-purple text-sm font-bold text-white" aria-hidden="true">{{ \Illuminate\Support\Str::substr($t['name'], 0, 1) }}</span>
                                @endif
                                <div>
                                    <cite class="not-italic text-base font-semibold text-thc-navy">{{ $t['name'] }}</cite>
                                    @if(filled($t['organization'] ?? null))
                                        <p class="mt-0.5 text-sm text-thc-text/75">{{ $t['organization'] }}</p>
                                    @endif
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
                                    :class="active === {{ $ti }} ? 'w-8 bg-thc-soc-sky' : 'w-2.5 bg-thc-navy/20 hover:bg-thc-soc-purple/40'"
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
                                class="rounded-full border border-thc-soc-purple/20 px-4 py-2 text-sm font-semibold text-thc-navy transition hover:border-thc-soc-sky/40 hover:bg-thc-soc-wash"
                                @click="active = (active - 1 + count) % count"
                            >Previous</button>
                            <button
                                type="button"
                                class="rounded-full border border-thc-soc-purple/20 px-4 py-2 text-sm font-semibold text-thc-navy transition hover:border-thc-soc-sky/40 hover:bg-thc-soc-wash"
                                @click="active = (active + 1) % count"
                            >Next</button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- Contact --}}
    <section id="contact" class="soc-landing-contact scroll-mt-24 border-t border-thc-soc-sky/25 pb-0">
        <div class="mx-auto max-w-7xl px-4 pt-16 sm:px-6 lg:px-8 lg:pt-24">
            <div class="max-w-3xl lg:max-w-2xl" data-reveal>
                <p class="thc-kicker">{{ $contactBlock['kicker'] }}</p>
                <h2 class="mt-4 font-serif text-3xl font-semibold text-thc-navy sm:text-4xl">We would love to hear from you</h2>
                <p class="mt-4 text-lg text-thc-text/85">Admissions, programme questions, or prayer: reach the School of Chaplaincy office directly.</p>
            </div>

            <div class="mt-10 grid items-stretch gap-6 lg:grid-cols-12 lg:gap-8">
                @if($mapUrl)
                    <div class="h-full lg:col-span-5" data-reveal>
                        <div class="flex h-full flex-col overflow-hidden rounded-2xl border border-thc-soc-purple/15 bg-white shadow-[var(--shadow-thc-card)]">
                            <div class="flex items-center gap-3 border-b border-thc-soc-purple/10 px-5 py-4 sm:px-6">
                                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-thc-soc-wash text-thc-soc-purple" aria-hidden="true">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                                </span>
                                <div>
                                    <p class="text-xs font-bold uppercase tracking-[0.16em] text-thc-soc-purple">Find us</p>
                                    <h3 class="mt-0.5 text-base font-semibold text-thc-navy">Visit the School of Chaplaincy</h3>
                                </div>
                            </div>
                            <iframe
                                title="Map: Tenwek Hospital College School of Chaplaincy"
                                src="{{ $mapUrl }}"
                                class="h-full min-h-[22rem] w-full flex-1 border-0 lg:min-h-[30rem]"
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"
                                allowfullscreen
                            ></iframe>
                        </div>
                    </div>
                @endif

                <div class="lg:col-span-{{ $mapUrl ? '7' : '12' }}" data-reveal>
                    @if (session('status'))
                        <div class="mb-6 rounded-xl border border-thc-soc-sky/40 bg-thc-soc-wash px-4 py-3 text-sm font-medium text-thc-navy">{{ session('status') }}</div>
                    @endif

                    <div class="overflow-hidden rounded-2xl border border-thc-soc-purple/15 bg-white shadow-[var(--shadow-thc-card)]">
                        <div class="h-1.5 bg-gradient-to-r from-thc-soc-purple via-thc-soc-sky to-thc-soc-sky-soft" aria-hidden="true"></div>
                        <div class="p-6 sm:p-8">
                            <h3 class="font-serif text-xl font-semibold text-thc-navy">Send a message</h3>
                            <p class="mt-2 text-sm leading-relaxed text-thc-text/85">All required fields must be completed. Your message is protected the same way as our main contact form.</p>

                            <form method="post" action="{{ route('contact.store') }}" class="mt-7 space-y-5" data-arithmetic-guard>
                                @csrf
                                <input type="hidden" name="school_id" value="{{ $school->id }}">
                                <input type="text" name="fax" tabindex="-1" autocomplete="off" class="absolute -left-[9999px] h-0 w-0 opacity-0" aria-hidden="true">

                                <div class="grid gap-x-5 gap-y-4 sm:grid-cols-2">
                                    <div class="sm:col-span-2">
                                        <label for="soc-contact-name" class="block text-sm font-semibold text-thc-navy">Full name</label>
                                        <input type="text" name="name" id="soc-contact-name" value="{{ old('name') }}" required autocomplete="name" class="mt-1.5 w-full rounded-xl border border-thc-soc-purple/20 bg-white px-4 py-3 text-sm text-thc-navy transition focus:border-thc-soc-purple focus:outline-none focus:ring-2 focus:ring-thc-soc-purple/20">
                                        @error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                    </div>
                                    <div>
                                        <label for="soc-contact-email" class="block text-sm font-semibold text-thc-navy">Email</label>
                                        <input type="email" name="email" id="soc-contact-email" value="{{ old('email') }}" required autocomplete="email" class="mt-1.5 w-full rounded-xl border border-thc-soc-purple/20 bg-white px-4 py-3 text-sm text-thc-navy transition focus:border-thc-soc-purple focus:outline-none focus:ring-2 focus:ring-thc-soc-purple/20">
                                        @error('email')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                    </div>
                                    <div>
                                        <label for="soc-contact-phone" class="block text-sm font-semibold text-thc-navy">Phone <span class="font-normal text-thc-text/65">(optional)</span></label>
                                        <input type="text" name="phone" id="soc-contact-phone" value="{{ old('phone') }}" autocomplete="tel" class="mt-1.5 w-full rounded-xl border border-thc-soc-purple/20 bg-white px-4 py-3 text-sm text-thc-navy transition focus:border-thc-soc-purple focus:outline-none focus:ring-2 focus:ring-thc-soc-purple/20">
                                        @error('phone')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label for="soc-contact-topic" class="block text-sm font-semibold text-thc-navy">Topic <span class="font-normal text-thc-text/65">(optional)</span></label>
                                        <input type="text" name="topic" id="soc-contact-topic" value="{{ old('topic', 'School of Chaplaincy enquiry') }}" class="mt-1.5 w-full rounded-xl border border-thc-soc-purple/20 bg-white px-4 py-3 text-sm text-thc-navy transition focus:border-thc-soc-purple focus:outline-none focus:ring-2 focus:ring-thc-soc-purple/20">
                                        @error('topic')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label for="soc-contact-message" class="block text-sm font-semibold text-thc-navy">Message</label>
                                        <textarea name="message" id="soc-contact-message" rows="5" required class="mt-1.5 min-h-[9rem] w-full rounded-xl border border-thc-soc-purple/20 bg-white px-4 py-3 text-sm text-thc-navy transition focus:border-thc-soc-purple focus:outline-none focus:ring-2 focus:ring-thc-soc-purple/20">{{ old('message') }}</textarea>
                                        @error('message')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                    </div>
                                </div>

                                <div class="flex flex-col gap-4 border-t border-thc-soc-purple/10 pt-5 sm:flex-row sm:items-center sm:justify-between">
                                    <button type="submit" class="thc-btn-primary w-full justify-center sm:w-auto sm:min-w-[12rem]">Send message <span aria-hidden="true">→</span></button>
                                    <p class="text-xs leading-relaxed text-thc-text/70">By submitting, you agree we may respond using the details provided.</p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-10 sm:mt-12" data-reveal>
                <div class="mb-5 flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.16em] text-thc-soc-purple">Contact details</p>
                        <h3 class="mt-1 font-serif text-2xl font-semibold text-thc-navy">Reach the School of Chaplaincy</h3>
                    </div>
                    <p class="max-w-xl text-sm leading-relaxed text-thc-text/85">Choose the easiest way to reach us or plan your visit to Tenwek.</p>
                </div>

                <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
                    <article class="rounded-2xl border border-thc-soc-purple/15 bg-white p-5 shadow-sm transition hover:border-thc-soc-sky/50 hover:shadow-md">
                        <div class="flex items-center gap-3">
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-thc-soc-wash text-thc-soc-purple" aria-hidden="true">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                            </span>
                            <h4 class="text-sm font-bold text-thc-navy">Location</h4>
                        </div>
                        <address class="mt-3 space-y-1 text-sm leading-relaxed text-thc-text/90 not-italic">
                            @foreach($contactBlock['location_lines'] as $line)
                                <div @class([
                                    'font-semibold text-thc-navy' => $loop->iteration <= 2,
                                    'mt-2 border-t border-thc-soc-purple/10 pt-2 text-xs font-medium text-thc-text/80' => $loop->iteration > 2,
                                ])>{{ $line }}</div>
                            @endforeach
                        </address>
                    </article>

                    <article class="rounded-2xl border border-thc-soc-purple/15 bg-white p-5 shadow-sm transition hover:border-thc-soc-sky/50 hover:shadow-md">
                        <div class="flex items-center gap-3">
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-thc-soc-wash text-thc-soc-purple" aria-hidden="true">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg>
                            </span>
                            <h4 class="text-sm font-bold text-thc-navy">Phone</h4>
                        </div>
                        <ul class="mt-3 space-y-2">
                            @foreach($contactBlock['phones'] as $phone)
                                <li><a href="tel:{{ preg_replace('/[^0-9+]/', '', \Illuminate\Support\Str::before($phone, ',')) }}" class="flex min-h-11 items-center justify-between gap-3 rounded-lg bg-thc-soc-wash px-3 py-2 text-sm font-semibold text-thc-soc-purple transition hover:bg-thc-soc-sky/20 hover:text-thc-navy"><span>{{ $phone }}</span><span aria-hidden="true">↗</span></a></li>
                            @endforeach
                        </ul>
                    </article>

                    <article class="rounded-2xl border border-thc-soc-purple/15 bg-white p-5 shadow-sm transition hover:border-thc-soc-sky/50 hover:shadow-md">
                        <div class="flex items-center gap-3">
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-thc-soc-wash text-thc-soc-purple" aria-hidden="true">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M3.75 6.75h16.5v10.5H3.75z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="m4.5 7.5 7.5 6 7.5-6"/></svg>
                            </span>
                            <h4 class="text-sm font-bold text-thc-navy">Email</h4>
                        </div>
                        <a href="mailto:{{ $contactBlock['email'] }}" class="mt-3 inline-flex min-h-11 items-center gap-2 rounded-lg bg-thc-soc-wash px-3 py-2 text-sm font-semibold text-thc-soc-purple transition hover:bg-thc-soc-sky/20 hover:text-thc-navy">{{ $contactBlock['email'] }} <span aria-hidden="true">↗</span></a>
                    </article>

                    @if(count($contactBlock['office_hours_lines'] ?? []) > 0)
                        <article class="rounded-2xl border border-thc-soc-purple/15 bg-white p-5 shadow-sm transition hover:border-thc-soc-sky/50 hover:shadow-md">
                            <div class="flex items-center gap-3">
                                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-thc-soc-wash text-thc-soc-purple" aria-hidden="true">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9" stroke-width="1.75"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M12 7v5l3 2"/></svg>
                                </span>
                                <h4 class="text-sm font-bold text-thc-navy">Office hours</h4>
                            </div>
                            <ul class="mt-3 space-y-1.5 text-sm leading-relaxed text-thc-text/90">
                                @foreach($contactBlock['office_hours_lines'] as $hourLine)
                                    <li>{{ $hourLine }}</li>
                                @endforeach
                            </ul>
                        </article>
                    @endif

                    @if(count($contactBlock['social_links'] ?? []) > 0)
                        <article class="rounded-2xl border border-thc-soc-purple/15 bg-white p-5 shadow-sm transition hover:border-thc-soc-sky/50 hover:shadow-md">
                            <div class="flex items-center gap-3">
                                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-thc-soc-wash text-thc-soc-purple" aria-hidden="true">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="18" cy="5" r="3" stroke-width="1.75"/><circle cx="6" cy="12" r="3" stroke-width="1.75"/><circle cx="18" cy="19" r="3" stroke-width="1.75"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="m8.7 10.7 6.6-4.4m-6.6 7 6.6 4.4"/></svg>
                                </span>
                                <h4 class="text-sm font-bold text-thc-navy">Social</h4>
                            </div>
                            <ul class="mt-3 space-y-2 text-sm font-semibold">
                                @foreach($contactBlock['social_links'] as $s)
                                    <li><a href="{{ $s['url'] }}" class="text-thc-soc-purple underline-offset-4 hover:text-thc-navy hover:underline" target="_blank" rel="noopener noreferrer">{{ $s['label'] }} <span aria-hidden="true">↗</span></a></li>
                                @endforeach
                            </ul>
                        </article>
                    @endif
                </div>
            </div>
        </div>

        <div class="h-12 sm:h-16 lg:h-20" aria-hidden="true"></div>
    </section>
</x-layouts.public>
