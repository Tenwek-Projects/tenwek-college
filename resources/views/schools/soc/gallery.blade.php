@php
    $soc = $socLanding ?? config('tenwek.soc_landing');
    $G = $soc['gallery'] ?? [];
    $items = $G['items'] ?? [];
    $lightboxItems = collect($items)
        ->filter(fn ($item) => filled($item['src'] ?? ''))
        ->map(function ($item) {
            $src = $item['src'] ?? '';

            return [
                'src' => \App\Support\Soc\SocLandingRepository::publicMediaUrl($src) ?? asset($src),
                'alt' => $item['alt'] ?? '',
                'caption' => $item['caption'] ?? '',
            ];
        })
        ->values()
        ->all();
    $galleryCollection = collect($lightboxItems);
    $featuredItem = $galleryCollection->first();
    $galleryGridItems = $galleryCollection->skip(1)->values();
@endphp

<x-layouts.public :seo="$seo" landing-header="soc" :school="$school">
    <x-schools.soc.page-breadcrumb-band :school="$school" :current="$page->title" />

    <main
        class="bg-white"
        x-data="socGallery({ items: @js($lightboxItems) })"
        @keydown.window="onKeydown($event)"
    >
        <section class="overflow-hidden bg-[#f3eff7]" aria-labelledby="soc-gallery-heading">
            <div class="mx-auto grid max-w-7xl items-center gap-10 px-4 py-10 sm:px-6 sm:py-14 lg:grid-cols-12 lg:gap-12 lg:px-8 lg:py-16">
                <header class="lg:col-span-5" data-reveal>
                    <p class="inline-flex items-center gap-2 rounded-full border border-thc-royal/20 bg-white/80 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.18em] text-[#76531f]">
                        <span class="h-1.5 w-1.5 rounded-full bg-thc-royal" aria-hidden="true"></span>
                        {{ $G['kicker'] ?? 'Our gallery' }}
                    </p>
                    <h1 id="soc-gallery-heading" class="mt-5 max-w-xl font-serif text-4xl font-semibold leading-[1.08] tracking-tight text-thc-navy sm:text-5xl lg:text-6xl">
                        {{ $G['headline'] ?? 'SOC life' }}
                    </h1>
                    @if(filled($G['intro'] ?? null))
                        <p class="mt-6 max-w-xl text-base leading-relaxed text-thc-text sm:text-lg">{{ $G['intro'] }}</p>
                    @endif
                    <div class="mt-8 flex flex-wrap items-center gap-4">
                        <a href="#soc-gallery-grid" class="inline-flex items-center gap-2 rounded-xl bg-thc-royal px-5 py-3 text-sm font-semibold text-white shadow-md transition hover:brightness-110 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-thc-royal">
                            Explore the gallery
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 13l5 5 5-5M12 18V6"/></svg>
                        </a>
                        <span class="text-sm font-medium text-thc-text/80">
                            <strong class="font-semibold text-thc-navy">{{ count($lightboxItems) }}</strong>
                            {{ \Illuminate\Support\Str::plural('moment', count($lightboxItems)) }} from life at Tenwek
                        </span>
                    </div>
                </header>

                @if($featuredItem)
                    <figure class="group relative overflow-hidden rounded-[1.75rem] border border-white/70 bg-thc-navy/10 shadow-[0_24px_70px_rgba(26,26,104,0.22)] ring-1 ring-thc-navy/10 lg:col-span-7" data-reveal>
                        <button
                            type="button"
                            class="relative block aspect-[4/3] w-full cursor-zoom-in text-left focus-visible:outline focus-visible:outline-4 focus-visible:outline-offset-4 focus-visible:outline-thc-royal sm:aspect-[16/10]"
                            @click="openAt(0)"
                            :aria-expanded="open && activeIndex === 0 ? 'true' : 'false'"
                            aria-haspopup="dialog"
                            aria-label="{{ __('View larger') }}: {{ $featuredItem['caption'] ?: $featuredItem['alt'] ?: __('Photo') }}"
                        >
                            <img
                                src="{{ $featuredItem['src'] }}"
                                alt="{{ $featuredItem['alt'] }}"
                                class="absolute inset-0 h-full w-full bg-[#e9e2f0] object-contain transition duration-500 ease-out group-hover:brightness-105"
                                loading="eager"
                                decoding="async"
                                fetchpriority="high"
                                sizes="(min-width: 1024px) 58vw, 100vw"
                            >
                            <span class="absolute inset-0 bg-gradient-to-t from-[#16123a]/90 via-[#16123a]/10 to-transparent" aria-hidden="true"></span>
                            <span class="absolute bottom-0 left-0 right-0 flex flex-wrap items-end justify-between gap-4 p-5 text-white sm:p-7">
                                <span class="max-w-lg">
                                    <span class="block text-[10px] font-bold uppercase tracking-[0.22em] text-white/75">A glimpse of our community</span>
                                    <span class="mt-2 block font-serif text-xl font-semibold leading-tight sm:text-2xl">{{ $featuredItem['caption'] ?: 'Life at Tenwek' }}</span>
                                </span>
                                <span class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-white/35 bg-white/15 backdrop-blur-sm transition group-hover:bg-white/25" aria-hidden="true">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 3h6v6m-11 5L21 3M5 7H4a1 1 0 00-1 1v12a1 1 0 001 1h12a1 1 0 001-1v-1"/></svg>
                                </span>
                            </span>
                        </button>
                    </figure>
                @else
                    <div class="flex aspect-[4/3] items-center justify-center rounded-[1.75rem] border border-thc-navy/10 bg-white p-8 text-center shadow-sm lg:col-span-7" data-reveal>
                        <p class="font-serif text-xl text-thc-text">Photographs will be published here soon.</p>
                    </div>
                @endif
            </div>
        </section>

        <section id="soc-gallery-grid" class="scroll-mt-24 mx-auto max-w-7xl px-4 py-12 sm:px-6 sm:py-16 lg:px-8 lg:py-20" aria-labelledby="soc-gallery-grid-heading">
            <div class="mb-8 flex flex-col gap-4 border-b border-thc-navy/10 pb-6 sm:flex-row sm:items-end sm:justify-between" data-reveal>
                <div>
                    <p class="text-[11px] font-bold uppercase tracking-[0.18em] text-[#76531f]">People, learning &amp; service</p>
                    <h2 id="soc-gallery-grid-heading" class="mt-2 font-serif text-2xl font-semibold tracking-tight text-thc-navy sm:text-3xl">Scenes from SOC</h2>
                </div>
                <p class="text-sm font-medium text-thc-text/75">Select any photo to view it full size.</p>
            </div>

            @if($galleryGridItems->isNotEmpty())
                <ul class="grid auto-rows-[10rem] grid-cols-2 gap-3 sm:auto-rows-[12rem] sm:gap-4 lg:auto-rows-[13rem] lg:grid-cols-4 lg:gap-5" role="list">
                    @foreach($galleryGridItems as $index => $item)
                        @php $lbIndex = $index + 1; @endphp
                        <li @class(['min-h-0 min-w-0', 'sm:col-span-2 lg:col-span-2 lg:row-span-2' => $index % 7 === 0, 'lg:row-span-2' => $index % 7 === 3]) data-reveal>
                            <div class="group relative h-full min-h-0 overflow-hidden rounded-2xl border border-thc-navy/10 bg-thc-navy/5 shadow-sm ring-1 ring-thc-navy/[0.04]">
                                <button
                                    type="button"
                                    class="absolute inset-0 h-full w-full cursor-zoom-in text-left focus-visible:outline focus-visible:outline-4 focus-visible:outline-offset-[-4px] focus-visible:outline-thc-royal"
                                    @click="openAt({{ $lbIndex }})"
                                    :aria-expanded="open && activeIndex === {{ $lbIndex }} ? 'true' : 'false'"
                                    aria-haspopup="dialog"
                                    aria-label="{{ __('View larger') }}: {{ $item['caption'] ?: $item['alt'] ?: __('Photo') }}"
                                >
                                    <img
                                        src="{{ $item['src'] }}"
                                        alt="{{ $item['alt'] }}"
                                        class="absolute inset-0 h-full w-full bg-[#e9e2f0] object-contain transition duration-500 ease-out group-hover:brightness-105"
                                        loading="{{ $index < 4 ? 'eager' : 'lazy' }}"
                                        decoding="async"
                                        sizes="(min-width: 1024px) 25vw, (min-width: 640px) 33vw, 50vw"
                                    >
                                    <span class="absolute inset-0 bg-gradient-to-t from-[#16123a]/80 via-transparent to-transparent opacity-80 transition-opacity group-hover:opacity-100" aria-hidden="true"></span>
                                    <span class="absolute inset-x-0 bottom-0 p-4 text-left text-sm font-semibold leading-snug text-white sm:p-5">{{ $item['caption'] ?: $item['alt'] ?: __('View photo') }}</span>
                                </button>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @elseif(!$featuredItem)
                <div class="rounded-2xl border border-dashed border-thc-navy/20 bg-[#f3eff7] px-8 py-16 text-center" data-reveal>
                    <p class="font-serif text-lg text-thc-text/85">Photographs will be published here soon.</p>
                </div>
            @endif
        </section>

        <template x-teleport="body">
            <div
                x-show="open"
                x-cloak
                x-transition:enter="transition ease-out duration-200 motion-reduce:transition-none"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-150 motion-reduce:transition-none"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 z-[200] flex flex-col items-stretch justify-end sm:justify-center"
                role="dialog"
                aria-modal="true"
                aria-labelledby="soc-gallery-lightbox-title"
            >
                <div
                    class="absolute inset-0 bg-thc-navy/88 backdrop-blur-md motion-reduce:backdrop-blur-none"
                    @click="close()"
                    aria-hidden="true"
                ></div>

                <div class="relative z-10 flex max-h-[100dvh] w-full flex-col p-4 pb-[max(1rem,env(safe-area-inset-bottom))] sm:p-8 sm:pb-8">
                    <div class="relative mx-auto w-full max-w-5xl">
                        <div class="mb-3 flex items-center justify-between gap-3 sm:absolute sm:-top-2 sm:right-0 sm:mb-0 sm:translate-y-[-100%]">
                            <p id="soc-gallery-lightbox-title" class="min-w-0 text-left text-xs font-semibold uppercase tracking-[0.18em] text-white/70 sm:text-white/80">
                                {{ __('Gallery') }}
                                <span x-show="hasMany" class="font-mono tabular-nums text-white/50" x-text="' · ' + (activeIndex + 1) + ' / ' + items.length"></span>
                            </p>
                            <button
                                type="button"
                                class="shrink-0 rounded-full border border-white/25 bg-white/10 px-3 py-1.5 text-xs font-semibold text-white shadow-sm backdrop-blur-sm transition hover:bg-white/20 focus-visible:outline focus-visible:ring-2 focus-visible:ring-white/60"
                                @click="close()"
                            >
                                {{ __('Close') }}
                                <span class="sr-only"> ({{ __('Escape') }})</span>
                            </button>
                        </div>

                        <div
                            class="relative overflow-hidden rounded-2xl border border-white/15 bg-black/20 shadow-2xl ring-1 ring-black/20"
                            @click.stop
                            @touchstart.passive="onTouchStart($event)"
                            @touchend.passive="onTouchEnd($event)"
                        >
                            <button
                                type="button"
                                class="absolute left-1 top-1/2 z-10 inline-flex -translate-y-1/2 rounded-full border border-white/20 bg-thc-navy/70 p-2 text-white shadow-lg backdrop-blur-sm transition hover:bg-thc-navy/90 focus-visible:outline focus-visible:ring-2 focus-visible:ring-white/50 sm:left-3 sm:p-2.5"
                                x-show="hasMany"
                                x-cloak
                                @click.stop="prev()"
                                aria-label="{{ __('Previous image') }}"
                            >
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                            </button>
                            <button
                                type="button"
                                class="absolute right-1 top-1/2 z-10 inline-flex -translate-y-1/2 rounded-full border border-white/20 bg-thc-navy/70 p-2 text-white shadow-lg backdrop-blur-sm transition hover:bg-thc-navy/90 focus-visible:outline focus-visible:ring-2 focus-visible:ring-white/50 sm:right-3 sm:p-2.5"
                                x-show="hasMany"
                                x-cloak
                                @click.stop="next()"
                                aria-label="{{ __('Next image') }}"
                            >
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </button>

                            <div
                                class="flex max-h-[min(78vh,720px)] min-h-[12rem] items-center justify-center bg-gradient-to-b from-thc-navy/40 to-black/30 p-2 sm:max-h-[min(82vh,800px)] sm:p-4"
                                x-transition:enter="transition ease-out duration-200 motion-reduce:transition-none"
                                x-transition:enter-start="opacity-0 scale-[0.98]"
                                x-transition:enter-end="opacity-100 scale-100"
                            >
                                <img
                                    x-show="open"
                                    :src="active.src"
                                    :alt="active.alt"
                                    class="max-h-[min(76vh,700px)] w-auto max-w-full rounded-lg object-contain shadow-lg motion-reduce:transition-none sm:max-h-[min(80vh,780px)]"
                                    width="1600"
                                    height="1200"
                                >
                            </div>
                        </div>

                        <p
                            class="mt-4 max-w-3xl px-1 text-center text-sm leading-relaxed text-white/90 sm:mx-auto sm:mt-5 sm:px-0 sm:text-base"
                            x-text="active.caption || ''"
                            x-show="active.caption"
                            x-cloak
                        ></p>
                        <p class="mt-2 text-center text-[11px] text-white/45" x-show="hasMany" x-cloak>{{ __('Swipe sideways or use arrow keys to browse') }}</p>
                    </div>
                </div>
            </div>
        </template>
    </main>
</x-layouts.public>
