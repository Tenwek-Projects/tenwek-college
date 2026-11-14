@props([
    'person',
    /** maroon | royal: role text and highlight accents */
    'accent' => 'maroon',
])

@php
    $highlight = ! empty($person['highlight']);
    $parts = array_values(array_filter(preg_split('/\s+/', (string) ($person['name'] ?? '')) ?: []));
    $initials = '';
    if (count($parts) >= 2) {
        $initials = mb_strtoupper(mb_substr($parts[0], 0, 1).mb_substr($parts[count($parts) - 1], 0, 1));
    } elseif (count($parts) === 1) {
        $initials = mb_strtoupper(mb_substr($parts[0], 0, 2));
    } else {
        $initials = '?';
    }
    $roleClass = $accent === 'royal'
        ? 'text-thc-soc-purple'
        : 'text-thc-soc-sky';
@endphp

<article
    {{ $attributes->class([
        'group flex h-full flex-col overflow-hidden rounded-2xl border bg-white shadow-sm transition hover:shadow-md',
        'border-thc-maroon/35 bg-gradient-to-br from-thc-maroon/[0.06] to-white ring-1 ring-thc-maroon/15' => $highlight && $accent === 'maroon',
        'border-thc-royal/30 bg-gradient-to-br from-thc-royal/[0.07] to-white ring-1 ring-thc-royal/15' => $highlight && $accent === 'royal',
        'border-thc-navy/10' => ! $highlight,
    ]) }}
>
    <div class="relative aspect-[5/6] w-full overflow-hidden bg-gradient-to-b from-thc-navy/[0.07] to-thc-navy/[0.02] sm:aspect-[4/5]">
        <div class="relative flex h-full w-full items-center justify-center overflow-hidden" aria-hidden="true">
            <span class="absolute -right-10 -top-10 h-40 w-40 rounded-full border border-thc-navy/10"></span>
            <span class="absolute -bottom-16 -left-10 h-48 w-48 rounded-full border border-thc-navy/10"></span>
            <span class="relative flex h-20 w-20 items-center justify-center rounded-full border-2 border-dashed border-thc-navy/20 bg-white/90 font-serif text-3xl font-semibold tracking-tight text-thc-navy shadow-sm sm:h-24 sm:w-24 sm:text-4xl">
                {{ $initials }}
            </span>
        </div>
    </div>
    <div class="flex flex-1 flex-col p-5 sm:p-6">
        <h3 class="font-serif text-lg font-semibold leading-snug text-thc-navy sm:text-xl">
            {{ $person['name'] ?? '' }}
        </h3>
        <p class="mt-3 text-[11px] font-bold uppercase leading-snug tracking-[0.14em] {{ $roleClass }} sm:text-xs">
            {{ $person['role'] ?? '' }}
        </p>
    </div>
</article>
