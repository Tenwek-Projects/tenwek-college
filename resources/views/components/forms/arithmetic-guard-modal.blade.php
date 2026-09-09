<div
    x-data
    x-show="$store.mathGuard.open"
    x-cloak
    class="fixed inset-0 z-[300] flex items-end justify-center sm:items-center"
    role="dialog"
    aria-modal="true"
    aria-labelledby="math-guard-title"
    @keydown.escape.window="$store.mathGuard.cancel()"
>
    <div class="absolute inset-0 bg-thc-navy/60 backdrop-blur-[2px]" @click="$store.mathGuard.cancel()" aria-hidden="true"></div>
    <div class="relative z-10 m-0 w-full max-w-md rounded-t-2xl border border-thc-navy/10 bg-white p-6 shadow-2xl sm:m-4 sm:rounded-2xl sm:p-8" @click.stop>
        <h2 id="math-guard-title" class="font-serif text-xl font-semibold text-thc-navy">Quick spam check</h2>
        <p class="mt-2 text-sm leading-relaxed text-thc-text/80">
            Solve this short sum to confirm you are human, then continue.
        </p>

        <p class="mt-6 text-center font-serif text-3xl font-semibold tabular-nums text-thc-navy" x-text="$store.mathGuard.prompt"></p>

        <label for="math-guard-answer" class="mt-6 block text-sm font-semibold text-thc-navy">Your answer</label>
        <input
            id="math-guard-answer"
            type="number"
            inputmode="numeric"
            class="mt-1.5 w-full rounded-xl border border-thc-navy/15 px-4 py-3 text-sm transition focus:border-thc-royal focus:outline-none focus:ring-2 focus:ring-thc-royal/25"
            x-model="$store.mathGuard.answer"
            x-ref="mathAnswer"
            @keydown.enter.prevent="$store.mathGuard.confirm()"
            autocomplete="off"
        >

        <p class="mt-2 text-sm font-medium text-red-700" x-show="$store.mathGuard.error" x-text="$store.mathGuard.error" x-cloak></p>

        <div class="mt-6 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
            <button
                type="button"
                class="inline-flex items-center justify-center rounded-xl border border-thc-navy/15 bg-white px-5 py-2.5 text-sm font-semibold text-thc-navy shadow-sm transition hover:bg-thc-royal/8"
                @click="$store.mathGuard.cancel()"
            >
                Cancel
            </button>
            <button
                type="button"
                class="inline-flex items-center justify-center rounded-xl bg-thc-navy px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-thc-navy/90 disabled:opacity-60"
                :disabled="$store.mathGuard.loading"
                @click="$store.mathGuard.confirm()"
            >
                <span x-show="!$store.mathGuard.loading">Continue</span>
                <span x-show="$store.mathGuard.loading" x-cloak>Checking…</span>
            </button>
        </div>
    </div>
</div>
