@php
    $L = $cohsLanding ?? config('tenwek.cohs_landing');
    $C = $L['contact_page'] ?? config('tenwek.cohs_landing.contact_page');
    $heroPath = $L['hero_image'] ?? 'banner-nursing.jpg';
    $heroImage = \App\Support\Cohs\CohsLandingRepository::publicMediaUrl(is_string($heroPath) ? $heroPath : null) ?? asset(is_string($heroPath) ? $heroPath : 'banner-nursing.jpg');
    $introHtml = str_replace(
        ':email',
        '<a href="mailto:'.e($C['email']).'" class="font-medium text-thc-cohs-blue underline decoration-thc-cohs-blue/35 decoration-1 underline-offset-[0.2em] transition hover:decoration-thc-cohs-indigo">'.e($C['email']).'</a>',
        e($C['intro'])
    );
@endphp

<x-layouts.public :seo="$seo" landing-header="cohs" :school="$school">
    <div class="relative overflow-hidden cohs-page-hero">
        <div class="pointer-events-none absolute -left-20 top-8 h-40 w-40 rounded-full bg-thc-cohs-coral/15 blur-2xl" aria-hidden="true"></div>
        <div class="pointer-events-none absolute -right-16 bottom-0 h-48 w-48 rounded-full bg-thc-cohs-sky/25 blur-3xl" aria-hidden="true"></div>
        <div class="pointer-events-none absolute inset-y-0 right-0 hidden w-[42%] opacity-[0.12] lg:block" aria-hidden="true">
            <div class="h-full bg-cover bg-center" style="background-image: url('{{ e($heroImage) }}');"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-white via-white/95 to-transparent"></div>
        </div>
        <div class="relative mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8 lg:py-16">
            <nav class="mb-10 text-sm text-thc-text/65 sm:mb-12" aria-label="Breadcrumb" data-reveal>
                <ol class="flex flex-wrap items-center gap-2">
                    <li><a href="{{ route('home') }}" class="transition hover:text-thc-cohs-blue">Home</a></li>
                    <li aria-hidden="true" class="text-thc-text/35">/</li>
                    <li><a href="{{ route('schools.show', $school) }}" class="transition hover:text-thc-cohs-blue">{{ $school->name }}</a></li>
                    <li aria-hidden="true" class="text-thc-text/35">/</li>
                    <li class="font-medium text-thc-navy">{{ $page->title }}</li>
                </ol>
            </nav>

            <header class="max-w-2xl" data-reveal>
                <p class="thc-kicker">{{ $C['hero_kicker'] }}</p>
                <h1 class="mt-4 font-serif text-4xl font-semibold tracking-tight text-thc-navy sm:text-5xl lg:text-[3.25rem]">
                    {{ $C['headline'] }}
                    @if(filled($C['headline_accent'] ?? null))
                        <span class="italic text-thc-cohs-coral">{{ $C['headline_accent'] }}</span>
                    @endif
                </h1>
                <p class="mt-5 text-lg leading-relaxed text-thc-text/88 sm:text-xl">
                    {{ $C['lead'] }}
                </p>
            </header>
        </div>
    </div>

    <section class="cohs-landing-contact border-t border-thc-cohs-blue/15">
        <div class="relative mx-auto max-w-7xl px-4 pt-12 pb-16 sm:px-6 sm:pt-14 lg:px-8 lg:pt-16 lg:pb-24">
            <div class="mx-auto grid max-w-6xl items-stretch gap-8 lg:grid-cols-12 lg:gap-10 xl:gap-14">
                <div class="flex lg:col-span-5" data-reveal>
                    <div class="cohs-contact-prose flex h-full w-full flex-col overflow-hidden rounded-2xl border border-thc-navy/10 bg-white shadow-[var(--shadow-thc-card)]">
                        <div class="h-1.5 shrink-0 bg-gradient-to-r from-thc-cohs-indigo via-thc-cohs-blue to-thc-cohs-coral" aria-hidden="true"></div>
                        <div class="flex flex-1 flex-col p-8 sm:p-10">
                            <h2 class="font-serif text-2xl font-semibold tracking-tight text-thc-navy sm:text-[1.65rem]">
                                Contact.
                            </h2>
                            <p class="mt-5 text-base leading-[1.75] text-thc-text/90 sm:text-[1.05rem]">
                                {!! $introHtml !!}
                            </p>

                            <div class="mt-10 border-t border-thc-cohs-blue/20 pt-10">
                                <h3 class="text-xs font-bold uppercase tracking-[0.2em] text-thc-cohs-coral">
                                    {{ $C['office_title'] }}
                                </h3>
                                <ul class="mt-8 space-y-8" role="list">
                                    @foreach($C['phone_rows'] ?? [] as $row)
                                        <li class="flex gap-4">
                                            <span class="mt-0.5 flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-thc-cohs-coral/10 text-thc-cohs-coral ring-1 ring-thc-cohs-coral/25">
                                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                                </svg>
                                            </span>
                                            <div>
                                                <p class="text-xs font-semibold uppercase tracking-wider text-thc-text/55">{{ $row['label'] }}</p>
                                                <p class="mt-1.5 flex flex-wrap gap-x-2 gap-y-1 text-base font-medium text-thc-navy">
                                                    @foreach($row['numbers'] as $i => $num)
                                                        @if($i > 0)<span class="text-thc-text/25" aria-hidden="true">·</span>@endif
                                                        <a href="tel:{{ preg_replace('/\s+/', '', $num['tel']) }}" class="transition hover:text-thc-cohs-blue">{{ $num['display'] }}</a>
                                                    @endforeach
                                                </p>
                                            </div>
                                        </li>
                                    @endforeach
                                    <li class="flex gap-4">
                                        <span class="mt-0.5 flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-thc-cohs-blue/10 text-thc-cohs-blue ring-1 ring-thc-cohs-blue/25">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                            </svg>
                                        </span>
                                        <div>
                                            <p class="text-xs font-semibold uppercase tracking-wider text-thc-text/55">Email</p>
                                            <a href="mailto:{{ $C['email'] }}" class="mt-1.5 block text-base font-medium text-thc-cohs-blue transition hover:text-thc-cohs-indigo">{{ $C['email'] }}</a>
                                        </div>
                                    </li>
                                    <li class="flex gap-4">
                                        <span class="mt-0.5 flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-thc-cohs-wash text-thc-cohs-indigo ring-1 ring-thc-cohs-blue/25">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                            </svg>
                                        </span>
                                        <div>
                                            <p class="text-xs font-semibold uppercase tracking-wider text-thc-text/55">Postal address</p>
                                            <p class="mt-1.5 text-base leading-relaxed text-thc-navy">
                                                @foreach($C['address_lines'] as $line)
                                                    {{ $line }}@if(!$loop->last)<br>@endif
                                                @endforeach
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <p class="mt-auto rounded-xl bg-thc-cohs-wash/80 px-4 py-3 text-sm leading-relaxed text-thc-navy/80 ring-1 ring-thc-cohs-blue/15">
                                Office hours follow the college calendar. We aim to reply within a few working days.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="flex lg:col-span-7" data-reveal>
                    <div class="relative flex h-full w-full flex-col overflow-hidden rounded-2xl border border-thc-navy/10 bg-white shadow-[var(--shadow-thc-card)]">
                        <div class="h-1.5 shrink-0 bg-gradient-to-r from-thc-cohs-coral via-thc-cohs-blue to-thc-cohs-indigo" aria-hidden="true"></div>
                        <div class="pointer-events-none absolute -right-16 -top-16 h-48 w-48 rounded-full bg-thc-cohs-sky/20 blur-3xl" aria-hidden="true"></div>
                        <div class="pointer-events-none absolute -bottom-12 -left-12 h-40 w-40 rounded-full bg-thc-cohs-coral/10 blur-3xl" aria-hidden="true"></div>

                        <div class="relative flex flex-1 flex-col p-8 sm:p-10">
                            @if (session('status'))
                                <div class="mb-8 rounded-2xl border border-thc-cohs-blue/30 bg-thc-cohs-wash px-5 py-4 text-sm font-medium text-thc-navy">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <h3 class="font-serif text-xl font-semibold text-thc-navy">Send a message</h3>
                            <p class="mt-2 text-sm text-thc-text/80">Required fields are marked. We will reply using the details you provide.</p>

                            <form method="post" action="{{ route('contact.store') }}" class="relative mt-8 flex flex-1 flex-col space-y-6" data-arithmetic-guard>
                                @csrf
                                <input type="hidden" name="school_id" value="{{ $school->id }}">
                                <input type="text" name="fax" tabindex="-1" autocomplete="off" class="absolute -left-[9999px] h-0 w-0 opacity-0" aria-hidden="true">

                                <div class="grid flex-1 content-start gap-6 sm:grid-cols-2">
                                    <div class="sm:col-span-2">
                                        <label for="cohs-contact-name" class="block text-xs font-semibold uppercase tracking-wider text-thc-text/70">Your name</label>
                                        <input
                                            type="text"
                                            name="name"
                                            id="cohs-contact-name"
                                            value="{{ old('name') }}"
                                            required
                                            autocomplete="name"
                                            class="cohs-contact-input mt-2"
                                            placeholder="Full name"
                                        >
                                        @error('name')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label for="cohs-contact-email" class="block text-xs font-semibold uppercase tracking-wider text-thc-text/70">Your email</label>
                                        <input
                                            type="email"
                                            name="email"
                                            id="cohs-contact-email"
                                            value="{{ old('email') }}"
                                            required
                                            autocomplete="email"
                                            class="cohs-contact-input mt-2"
                                            placeholder="you@example.com"
                                        >
                                        @error('email')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label for="cohs-contact-subject" class="block text-xs font-semibold uppercase tracking-wider text-thc-text/70">Subject</label>
                                        <input
                                            type="text"
                                            name="topic"
                                            id="cohs-contact-subject"
                                            value="{{ old('topic') }}"
                                            class="cohs-contact-input mt-2"
                                            placeholder="e.g. Admissions enquiry"
                                        >
                                        @error('topic')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
                                    </div>
                                    <div class="sm:col-span-2 flex min-h-0 flex-1 flex-col">
                                        <label for="cohs-contact-message" class="block text-xs font-semibold uppercase tracking-wider text-thc-text/70">
                                            Your message <span class="font-normal normal-case tracking-normal text-thc-text/50">(optional)</span>
                                        </label>
                                        <textarea
                                            name="message"
                                            id="cohs-contact-message"
                                            rows="5"
                                            class="cohs-contact-input mt-2 min-h-[8.5rem] flex-1 resize-y"
                                            placeholder="How can we help?"
                                        >{{ old('message') }}</textarea>
                                        @error('message')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
                                    </div>
                                </div>

                                <div class="mt-auto flex flex-col gap-4 border-t border-thc-cohs-blue/15 pt-6 sm:flex-row sm:items-center sm:justify-between">
                                    <button type="submit" class="cohs-contact-submit inline-flex items-center justify-center rounded-full px-10 py-3.5 text-sm font-semibold text-white shadow-lg shadow-thc-navy/15 transition hover:brightness-110 focus:outline-none focus-visible:ring-2 focus-visible:ring-thc-cohs-blue focus-visible:ring-offset-2">
                                        Send message
                                    </button>
                                    <p class="text-xs text-thc-text/55 sm:text-right">
                                        Prefer email?
                                        <a href="mailto:{{ $C['email'] }}" class="font-medium text-thc-cohs-blue hover:underline">{{ $C['email'] }}</a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.public>
