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
    {{-- Hero --}}
    <section
        class="relative flex min-h-[min(92svh,52rem)] flex-col justify-end overflow-hidden"
        aria-label="School of Chaplaincy hero"
    >
        <div class="pointer-events-none absolute inset-0 thc-hero-ken-bg bg-cover bg-center" style="background-image: url('{{ e($heroImageUrl) }}');" aria-hidden="true"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-thc-navy via-thc-soc-purple/55 to-thc-soc-sky/35" aria-hidden="true"></div>
        <div class="pointer-events-none absolute inset-0 opacity-[0.16] mix-blend-overlay" style="background-image: radial-gradient(circle at 20% 25%, rgba(255,255,255,0.45), transparent 45%), radial-gradient(circle at 85% 70%, rgba(90,200,250,0.4), transparent 42%), radial-gradient(circle at 70% 20%, rgba(130,101,174,0.28), transparent 46%);" aria-hidden="true"></div>

        <div class="relative z-10 mx-auto w-full max-w-7xl px-4 pb-16 pt-28 sm:px-6 sm:pb-20 sm:pt-32 lg:px-8 lg:pb-24">
            <x-schools.soc.breadcrumbs :school="$school" variant="hero" class="mb-8" />
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

            <div class="mt-12 grid items-stretch gap-8 lg:grid-cols-12 lg:gap-10 xl:gap-14">
                <div class="lg:col-span-5" data-reveal>
                    <div class="flex h-full flex-col gap-8">
                    <div class="overflow-hidden rounded-2xl border border-thc-navy/10 bg-white shadow-sm ring-1 ring-thc-soc-sky/10 sm:p-0">
                        <div class="h-1.5 bg-gradient-to-r from-thc-soc-purple via-thc-soc-sky to-thc-soc-sky-soft" aria-hidden="true"></div>
                        <div class="p-6 sm:p-8">
                        <div class="grid gap-8 sm:grid-cols-2 sm:gap-8 lg:grid-cols-1 lg:gap-10">
                            <div>
                                <h3 class="text-xs font-bold uppercase tracking-[0.18em] text-thc-soc-purple">Our location</h3>
                                <ul class="mt-4 space-y-2 text-sm leading-relaxed text-thc-text/90">
                                    @foreach($contactBlock['location_lines'] as $line)
                                        <li>{{ $line }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="border-t border-thc-navy/10 pt-8 sm:border-l sm:border-t-0 sm:pl-8 sm:pt-0 lg:border-l-0 lg:border-t lg:pl-0 lg:pt-8">
                                <h3 class="text-xs font-bold uppercase tracking-[0.18em] text-thc-soc-purple">Phone</h3>
                                <ul class="mt-4 space-y-2 text-sm font-medium text-thc-navy">
                                    @foreach($contactBlock['phones'] as $phone)
                                        <li><a href="tel:{{ preg_replace('/[^0-9+]/', '', \Illuminate\Support\Str::before($phone, ',')) }}" class="hover:text-thc-soc-sky hover:underline">{{ $phone }}</a></li>
                                    @endforeach
                                </ul>
                                <h3 class="mt-6 text-xs font-bold uppercase tracking-[0.18em] text-thc-soc-purple">Email</h3>
                                <p class="mt-3">
                                    <a href="mailto:{{ $contactBlock['email'] }}" class="text-sm font-semibold text-thc-soc-purple hover:text-thc-soc-sky hover:underline">{{ $contactBlock['email'] }}</a>
                                </p>
                                @if(count($contactBlock['office_hours_lines'] ?? []) > 0)
                                    <h3 class="mt-6 text-xs font-bold uppercase tracking-[0.18em] text-thc-soc-purple">Office hours</h3>
                                    <ul class="mt-3 space-y-1.5 text-sm text-thc-text/90">
                                        @foreach($contactBlock['office_hours_lines'] as $hourLine)
                                            <li>{{ $hourLine }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                                @if(count($contactBlock['social_links'] ?? []) > 0)
                                    <h3 class="mt-6 text-xs font-bold uppercase tracking-[0.18em] text-thc-soc-purple">Social</h3>
                                    <ul class="mt-3 space-y-2 text-sm font-medium text-thc-navy">
                                        @foreach($contactBlock['social_links'] as $s)
                                            <li>
                                                <a href="{{ $s['url'] }}" class="text-thc-soc-purple hover:underline" target="_blank" rel="noopener noreferrer">{{ $s['label'] }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                        </div>
                    </div>

                    @if($mapUrl)
                        <div class="flex-1 overflow-hidden rounded-2xl border border-thc-navy/10 bg-thc-soc-wash shadow-[var(--shadow-thc-card)] ring-1 ring-thc-soc-sky/15">
                            <iframe
                                title="Map: Tenwek Hospital College area"
                                src="{{ $mapUrl }}"
                                class="block h-full min-h-[16rem] w-full border-0"
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"
                                allowfullscreen
                            ></iframe>
                        </div>
                    @endif
                    </div>
                </div>

                <div class="lg:col-span-7" data-reveal>
                    @if (session('status'))
                        <div class="mb-6 rounded-xl border border-thc-soc-sky/40 bg-thc-soc-wash px-4 py-3 text-sm text-thc-navy">{{ session('status') }}</div>
                    @endif

                    <div class="h-full overflow-hidden rounded-2xl border border-thc-navy/10 bg-white shadow-[var(--shadow-thc-card)] ring-1 ring-thc-soc-purple/10">
                        <div class="h-1.5 bg-gradient-to-r from-thc-soc-sky via-thc-soc-sky-soft to-thc-soc-purple" aria-hidden="true"></div>
                        <div class="p-6 sm:p-8">
                        <h3 class="font-serif text-xl font-semibold text-thc-navy">Send a message</h3>
                        <p class="mt-2 text-sm text-thc-text/80">All fields marked required must be completed. Your message is protected the same way as our main contact form.</p>

                        <form method="post" action="{{ route('contact.store') }}" class="mt-8 space-y-5" data-arithmetic-guard>
                            @csrf
                            <input type="hidden" name="school_id" value="{{ $school->id }}">
                            <input type="text" name="fax" tabindex="-1" autocomplete="off" class="absolute -left-[9999px] h-0 w-0 opacity-0" aria-hidden="true">

                            <div class="grid gap-5 sm:grid-cols-2">
                                <div class="sm:col-span-2">
                                    <label for="soc-contact-name" class="block text-sm font-medium text-thc-navy">Full name</label>
                                    <input type="text" name="name" id="soc-contact-name" value="{{ old('name') }}" required autocomplete="name" class="mt-1.5 w-full rounded-xl border border-thc-navy/12 bg-thc-soc-wash/40 px-4 py-3 text-sm transition focus:border-thc-soc-sky focus:bg-white focus:outline-none focus:ring-2 focus:ring-thc-soc-sky/25">
                                    @error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label for="soc-contact-email" class="block text-sm font-medium text-thc-navy">Email</label>
                                    <input type="email" name="email" id="soc-contact-email" value="{{ old('email') }}" required autocomplete="email" class="mt-1.5 w-full rounded-xl border border-thc-navy/12 bg-thc-soc-wash/40 px-4 py-3 text-sm transition focus:border-thc-soc-sky focus:bg-white focus:outline-none focus:ring-2 focus:ring-thc-soc-sky/25">
                                    @error('email')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label for="soc-contact-phone" class="block text-sm font-medium text-thc-navy">Phone <span class="font-normal text-thc-text/60">(optional)</span></label>
                                    <input type="text" name="phone" id="soc-contact-phone" value="{{ old('phone') }}" autocomplete="tel" class="mt-1.5 w-full rounded-xl border border-thc-navy/12 bg-thc-soc-wash/40 px-4 py-3 text-sm transition focus:border-thc-soc-sky focus:bg-white focus:outline-none focus:ring-2 focus:ring-thc-soc-sky/25">
                                    @error('phone')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="soc-contact-topic" class="block text-sm font-medium text-thc-navy">Topic <span class="font-normal text-thc-text/60">(optional)</span></label>
                                    <input type="text" name="topic" id="soc-contact-topic" value="{{ old('topic', 'School of Chaplaincy enquiry') }}" class="mt-1.5 w-full rounded-xl border border-thc-navy/12 bg-thc-soc-wash/40 px-4 py-3 text-sm transition focus:border-thc-soc-sky focus:bg-white focus:outline-none focus:ring-2 focus:ring-thc-soc-sky/25">
                                    @error('topic')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="soc-contact-message" class="block text-sm font-medium text-thc-navy">Message</label>
                                    <textarea name="message" id="soc-contact-message" rows="5" required class="mt-1.5 w-full rounded-xl border border-thc-navy/12 bg-thc-soc-wash/40 px-4 py-3 text-sm transition focus:border-thc-soc-sky focus:bg-white focus:outline-none focus:ring-2 focus:ring-thc-soc-sky/25">{{ old('message') }}</textarea>
                                    @error('message')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                                <button type="submit" class="thc-btn-primary w-full justify-center sm:w-auto sm:min-w-[12rem]">Send message</button>
                                <p class="text-xs text-thc-text/65">By submitting, you agree we may respond using the details provided.</p>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="h-12 sm:h-16 lg:h-20" aria-hidden="true"></div>
    </section>
</x-layouts.public>
