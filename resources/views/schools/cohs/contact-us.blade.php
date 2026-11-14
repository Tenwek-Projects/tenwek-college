@php
    $L = $cohsLanding ?? config('tenwek.cohs_landing');
    $C = $L['contact_page'] ?? config('tenwek.cohs_landing.contact_page');
    $contactBlock = $L['contact'] ?? [];
    $mapUrl = $L['map_embed_url'] ?? null;
    $locationLines = $contactBlock['location_lines'] ?? $C['address_lines'] ?? [];
    $officeLines = $contactBlock['office_hours_lines'] ?? [];
    $phoneNumbers = collect($C['phone_rows'] ?? [])
        ->flatMap(fn ($row) => $row['numbers'] ?? [])
        ->values();
    $heroPath = 'banner-nursing.jpg';
    $heroImage = \App\Support\Cohs\CohsLandingRepository::publicMediaUrl($heroPath) ?? asset($heroPath);
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
                <h1 class="mt-4 font-serif text-4xl font-semibold tracking-tight text-[#13007c] sm:text-5xl lg:text-[3.25rem]">
                    {{ $C['headline'] }}
                    @if(filled($C['headline_accent'] ?? null))
                        <span class="italic text-thc-cohs-coral">{{ $C['headline_accent'] }}</span>
                    @endif
                </h1>
                <span class="mt-4 block h-1 w-16 -rotate-2 rounded-full bg-violet-500" aria-hidden="true"></span>
                <p class="mt-5 text-lg leading-relaxed text-thc-text/85 sm:text-xl">{{ $C['lead'] }}</p>
            </header>
        </div>
    </div>

    <section class="cohs-landing-contact scroll-mt-24 border-t border-thc-navy/10 pb-0" aria-labelledby="cohs-contact-heading">
        <div class="mx-auto max-w-7xl px-4 pt-14 sm:px-6 sm:pt-16 lg:px-8 lg:pt-20">
            <div class="max-w-3xl lg:max-w-2xl" data-reveal>
                <p class="thc-kicker cohs-section-kicker">{{ $contactBlock['kicker'] ?? 'Contact us' }}</p>
                <h2 id="cohs-contact-heading" class="mt-4 font-serif text-[32px] font-semibold leading-tight tracking-[-0.7px] text-[#13007c] sm:text-[36px] sm:leading-[45px] sm:tracking-[-0.9px]">We would love to hear from you</h2>
                <p class="mt-4 text-lg leading-relaxed text-thc-text/85">Admissions, programme questions, or general enquiries: reach the College of Health Sciences office.</p>
            </div>

            <div class="mt-9 grid items-stretch gap-6 lg:grid-cols-12 lg:gap-8">
                @if($mapUrl)
                    <div class="h-full lg:col-span-5" data-reveal>
                        <div class="flex h-full flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-[0_8px_24px_rgb(23_35_61_/_0.08)]">
                            <div class="flex items-center gap-3 border-b border-slate-200 px-5 py-4 sm:px-6">
                                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-700" aria-hidden="true">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                                </span>
                                <div>
                                    <p class="text-xs font-bold uppercase tracking-[0.16em] text-blue-800">Find us</p>
                                    <h3 class="mt-0.5 text-base font-semibold text-slate-900">Visit the College</h3>
                                </div>
                            </div>
                            <iframe
                                title="Map: Tenwek Hospital College of Health Sciences"
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
                    @if(session('status'))
                        <div class="mb-6 rounded-xl border border-blue-200 bg-blue-50 px-4 py-3 text-sm font-medium text-slate-900">{{ session('status') }}</div>
                    @endif

                    <div class="cohs-landing-contact-form overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-[0_8px_24px_rgb(23_35_61_/_0.08)]">
                        <div class="h-1 bg-blue-600" aria-hidden="true"></div>
                        <div class="p-6 sm:p-8">
                            <h3 class="font-serif text-xl font-semibold text-slate-900">Send a message</h3>
                            <p class="mt-2 text-sm leading-relaxed text-slate-700">Use this form for enquiries to the College of Health Sciences. Required fields are marked.</p>

                            <form method="post" action="{{ route('contact.store') }}" class="mt-7 space-y-5" data-arithmetic-guard>
                                @csrf
                                <input type="hidden" name="school_id" value="{{ $school->id }}">
                                <input type="text" name="fax" tabindex="-1" autocomplete="off" class="absolute -left-[9999px] h-0 w-0 opacity-0" aria-hidden="true">

                                <div class="grid gap-x-5 gap-y-4 sm:grid-cols-2">
                                    <div class="sm:col-span-2">
                                        <label for="cohs-contact-name" class="block text-sm font-semibold text-slate-800">Full name</label>
                                        <input type="text" name="name" id="cohs-contact-name" value="{{ old('name') }}" required autocomplete="name" class="mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 transition placeholder:text-slate-500 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600/20" placeholder="Full name">
                                        @error('name')<p class="mt-1 text-sm text-red-700">{{ $message }}</p>@enderror
                                    </div>
                                    <div>
                                        <label for="cohs-contact-email" class="block text-sm font-semibold text-slate-800">Email</label>
                                        <input type="email" name="email" id="cohs-contact-email" value="{{ old('email') }}" required autocomplete="email" class="mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 transition placeholder:text-slate-500 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600/20" placeholder="you@example.com">
                                        @error('email')<p class="mt-1 text-sm text-red-700">{{ $message }}</p>@enderror
                                    </div>
                                    <div>
                                        <label for="cohs-contact-phone" class="block text-sm font-semibold text-slate-800">Phone <span class="font-normal text-slate-600">(optional)</span></label>
                                        <input type="text" name="phone" id="cohs-contact-phone" value="{{ old('phone') }}" autocomplete="tel" class="mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 transition placeholder:text-slate-500 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600/20" placeholder="Phone number">
                                        @error('phone')<p class="mt-1 text-sm text-red-700">{{ $message }}</p>@enderror
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label for="cohs-contact-topic" class="block text-sm font-semibold text-slate-800">Topic <span class="font-normal text-slate-600">(optional)</span></label>
                                        <input type="text" name="topic" id="cohs-contact-topic" value="{{ old('topic', 'College of Health Sciences enquiry') }}" class="mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 transition placeholder:text-slate-500 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600/20" placeholder="e.g. Admissions enquiry">
                                        @error('topic')<p class="mt-1 text-sm text-red-700">{{ $message }}</p>@enderror
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label for="cohs-contact-message" class="block text-sm font-semibold text-slate-800">Message</label>
                                        <textarea name="message" id="cohs-contact-message" rows="5" required class="mt-1.5 min-h-[9rem] w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 transition placeholder:text-slate-500 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600/20" placeholder="How can we help?">{{ old('message') }}</textarea>
                                        @error('message')<p class="mt-1 text-sm text-red-700">{{ $message }}</p>@enderror
                                    </div>
                                </div>

                                <div class="flex flex-col gap-4 border-t border-slate-200 pt-5 sm:flex-row sm:items-center sm:justify-between">
                                    <button type="submit" class="thc-btn-primary w-full justify-center bg-blue-700 text-white hover:bg-blue-800 sm:w-auto sm:min-w-[12rem]">Send message <span aria-hidden="true">→</span></button>
                                    <p class="text-xs leading-relaxed text-slate-600">By submitting, you agree we may respond using the details provided.</p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-10 sm:mt-12" data-reveal>
                <div class="mb-5 flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.16em] text-blue-800">Contact details</p>
                        <h3 class="mt-1 font-serif text-2xl font-semibold text-slate-900">Reach the College office</h3>
                    </div>
                    <p class="max-w-xl text-sm leading-relaxed text-slate-700">Choose the easiest way to reach us or plan your visit to Tenwek.</p>
                </div>

                <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
                    <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:border-blue-200 hover:shadow-md">
                        <div class="flex items-center gap-3">
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-700" aria-hidden="true">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                            </span>
                            <h4 class="text-sm font-bold text-slate-900">Location</h4>
                        </div>
                        <address class="mt-3 space-y-1 text-sm leading-relaxed text-slate-700 not-italic">
                            @foreach($locationLines as $line)
                                <div @class([
                                    'font-semibold text-slate-900' => $loop->iteration <= 2,
                                    'mt-3 inline-flex rounded-full bg-blue-50 px-3 py-1 font-semibold text-blue-900' => $loop->iteration === 3,
                                    'mt-2 border-t border-slate-100 pt-2 text-xs font-medium text-slate-600' => $loop->iteration > 3,
                                ])>{{ $line }}</div>
                            @endforeach
                        </address>
                    </article>

                    <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:border-blue-200 hover:shadow-md">
                        <div class="flex items-center gap-3">
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-700" aria-hidden="true">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg>
                            </span>
                            <h4 class="text-sm font-bold text-slate-900">Phone</h4>
                        </div>
                        <ul class="mt-3 space-y-2" role="list">
                            @foreach($phoneNumbers as $number)
                                <li><a href="tel:{{ preg_replace('/[^0-9+]/', '', $number['tel']) }}" class="cohs-contact-phone-link"><span>{{ $number['display'] }}</span><svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17 17 7M8 7h9v9"/></svg></a></li>
                            @endforeach
                        </ul>
                    </article>

                    <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:border-blue-200 hover:shadow-md">
                        <div class="flex items-center gap-3">
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-700" aria-hidden="true">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M3.75 6.75h16.5v10.5H3.75z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="m4.5 7.5 7.5 6 7.5-6"/></svg>
                            </span>
                            <h4 class="text-sm font-bold text-slate-900">Email</h4>
                        </div>
                        <a href="mailto:{{ $C['email'] }}" class="cohs-contact-email-link mt-3" aria-label="Email the College at {{ $C['email'] }}">
                            <span class="break-all">{{ $C['email'] }}</span>
                            <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17 17 7M8 7h9v9"/></svg>
                        </a>
                    </article>

                    <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:border-blue-200 hover:shadow-md">
                        <div class="flex items-center gap-3">
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-700" aria-hidden="true">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9" stroke-width="1.75"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M12 7v5l3 2"/></svg>
                            </span>
                            <h4 class="text-sm font-bold text-slate-900">Admissions information</h4>
                        </div>
                        <div class="mt-3 space-y-2 text-sm leading-relaxed text-slate-700">
                            @foreach($officeLines as $hourIndex => $hourLine)
                                @if($hourIndex === 0)
                                    <p class="font-semibold text-slate-900">{{ $hourLine }}</p>
                                @elseif($hourIndex === 1)
                                    <p class="cohs-contact-intake">{{ $hourLine }}</p>
                                @else
                                    <div class="cohs-contact-fee-note">{{ $hourLine }}</div>
                                @endif
                            @endforeach
                        </div>
                        <a href="{{ route('schools.pages.show', [$school, 'application-forms']) }}" class="mt-4 inline-flex items-center gap-2 text-sm font-bold text-blue-800 underline-offset-4 hover:text-blue-950 hover:underline">View application forms <span aria-hidden="true">→</span></a>
                    </article>
                </div>
            </div>
        </div>
        <div class="h-12 sm:h-16 lg:h-20" aria-hidden="true"></div>
    </section>
</x-layouts.public>
