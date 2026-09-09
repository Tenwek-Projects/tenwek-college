<x-layouts.public :seo="$seo" landing-header="cohs" :school="$school">
    <div class="cohs-page-hero relative overflow-hidden">
        <div class="relative mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14">
            <nav class="mb-6 text-sm text-thc-text/65" aria-label="Breadcrumb" data-reveal>
                <ol class="flex flex-wrap items-center gap-2">
                    <li><a href="{{ route('home') }}" class="transition hover:text-thc-royal">Home</a></li>
                    <li aria-hidden="true" class="text-thc-text/35">/</li>
                    <li><a href="{{ route('schools.show', $school) }}" class="transition hover:text-thc-royal">{{ $school->name }}</a></li>
                    <li aria-hidden="true" class="text-thc-text/35">/</li>
                    <li><a href="{{ route('schools.pages.show', [$school, 'application-forms']) }}" class="transition hover:text-thc-royal">Application forms</a></li>
                    <li aria-hidden="true" class="text-thc-text/35">/</li>
                    <li class="font-medium text-thc-navy">Apply online</li>
                </ol>
            </nav>

            <header class="max-w-3xl" data-reveal>
                <p class="thc-kicker">College of Health Sciences</p>
                <h1 class="mt-3 font-serif text-4xl font-semibold tracking-tight text-thc-navy sm:text-5xl">
                    Apply <span class="italic text-thc-royal">online</span>
                </h1>
                <p class="mt-5 text-lg leading-relaxed text-thc-text/88">{{ $form['programme'] }}</p>
                <p class="mt-3 text-sm text-thc-text/70">Duration: {{ $form['duration'] }} · {{ $form['intake'] }}</p>
            </header>
        </div>
    </div>

    <div
        class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14"
        x-data="cohsProgrammeApplyWizard({ maritalStatus: @js(old('marital_status', '')), gender: @js(old('sex', '')) })"
    >
        @if(session('status'))
            <div class="mb-8 rounded-2xl border border-emerald-600/25 bg-emerald-50 px-5 py-4 text-emerald-950" role="status" data-reveal>
                {{ session('status') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-8 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-red-950" data-reveal>
                <p class="font-semibold">Please correct the following:</p>
                <ul class="mt-2 list-disc space-y-1 pl-5 text-sm">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-8 rounded-2xl border border-thc-navy/10 bg-white p-4 shadow-sm" data-reveal>
            <div class="flex items-center justify-between gap-3 text-sm font-medium text-thc-navy">
                <span>Step <span x-text="step"></span> of <span x-text="totalSteps"></span></span>
                <span x-text="progress() + '%'"></span>
            </div>
            <div class="mt-2 h-2 overflow-hidden rounded-full bg-thc-navy/10" role="progressbar" :aria-valuenow="progress()" aria-valuemin="0" aria-valuemax="100">
                <div class="h-full rounded-full bg-gradient-to-r from-thc-navy to-thc-royal transition-all duration-300" :style="`width: ${progress()}%`"></div>
            </div>
        </div>

        <form method="post" action="{{ route('cohs.programme-application.store', $form['slug']) }}" enctype="multipart/form-data" class="space-y-8" x-ref="appForm" data-arithmetic-guard>
            @csrf

            <div class="absolute -left-[9999px] h-px w-px overflow-hidden opacity-0" aria-hidden="true">
                <label for="cohs-prog-fax">Leave blank</label>
                <input id="cohs-prog-fax" type="text" name="fax" value="" tabindex="-1" autocomplete="off">
            </div>

            <div data-step="1" x-show="step === 1" x-cloak>
                @include('schools.cohs.programme-application._step-intro')
            </div>
            <div data-step="2" x-show="step === 2" x-cloak>
                @include('schools.cohs.programme-application._step-personal')
            </div>
            <div data-step="3" x-show="step === 3" x-cloak>
                @include('schools.cohs.programme-application._step-education')
            </div>
            <div data-step="4" x-show="step === 4" x-cloak>
                @include('schools.cohs.programme-application._step-experience')
            </div>
            <div data-step="5" x-show="step === 5" x-cloak>
                @include('schools.cohs.programme-application._step-essays')
            </div>
            <div data-step="6" x-show="step === 6" x-cloak>
                @include('schools.cohs.programme-application._step-health')
            </div>
            <div data-step="7" x-show="step === 7" x-cloak>
                @include('schools.cohs.programme-application._step-documents')
            </div>

            <div class="flex flex-col-reverse gap-3 border-t border-thc-navy/10 pt-8 sm:flex-row sm:justify-between">
                <button
                    type="button"
                    class="inline-flex items-center justify-center rounded-xl border border-thc-navy/15 bg-white px-5 py-2.5 text-sm font-semibold text-thc-navy shadow-sm transition hover:bg-thc-royal/8"
                    x-show="step > 1"
                    @click="prev()"
                >
                    Back
                </button>
                <div class="flex flex-col gap-3 sm:ml-auto sm:flex-row">
                    <button
                        type="button"
                        class="inline-flex items-center justify-center rounded-xl bg-thc-navy px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-thc-navy/90"
                        x-show="step < totalSteps"
                        @click="next()"
                    >
                        Continue
                    </button>
                    <button
                        type="submit"
                        class="inline-flex items-center justify-center rounded-xl bg-emerald-700 px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-800"
                        x-show="step === totalSteps"
                    >
                        Submit application
                    </button>
                </div>
            </div>
        </form>

        <p class="mt-10 text-center text-sm text-thc-text/70" data-reveal>
            <a href="{{ route('schools.pages.show', [$school, 'application-forms']) }}" class="font-semibold text-thc-royal hover:underline">Paper forms &amp; downloads</a>
            ·
            <a href="{{ route('schools.pages.show', [$school, 'contact-us']) }}" class="font-semibold text-thc-royal hover:underline">Contact the office</a>
        </p>
    </div>
</x-layouts.public>
