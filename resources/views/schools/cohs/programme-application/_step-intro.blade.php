<div class="space-y-8 rounded-2xl border border-thc-navy/10 bg-white p-6 shadow-sm sm:p-8">
    <h2 class="font-serif text-2xl font-semibold text-thc-navy">Before you apply</h2>
    <p class="text-sm leading-relaxed text-thc-text/80">
        This online form matches the official printable pack for <strong>{{ $form['pdf_title'] }}</strong>.
        Essays may be typed here instead of handwritten. Your application is not complete until every required document is uploaded.
    </p>

    <div class="grid gap-6 lg:grid-cols-3">
        <div class="rounded-xl bg-thc-navy/[0.04] p-4">
            <p class="text-xs font-bold uppercase tracking-wider text-thc-navy/70">Intake</p>
            <p class="mt-2 text-sm text-thc-text">{{ $form['intake'] }}</p>
        </div>
        <div class="rounded-xl bg-thc-navy/[0.04] p-4">
            <p class="text-xs font-bold uppercase tracking-wider text-thc-navy/70">Duration</p>
            <p class="mt-2 text-sm text-thc-text">{{ $form['duration'] }}</p>
        </div>
        <div class="rounded-xl bg-thc-navy/[0.04] p-4">
            <p class="text-xs font-bold uppercase tracking-wider text-thc-navy/70">Deadline</p>
            <p class="mt-2 text-sm text-thc-text">{{ $form['deadline'] ?? 'Apply as soon as possible. Intake closes when the class is full.' }}</p>
        </div>
    </div>

    <div>
        <h3 class="font-serif text-lg font-semibold text-thc-navy">Eligibility</h3>
        <ul class="mt-3 list-disc space-y-2 pl-5 text-sm leading-relaxed text-thc-text/85">
            @foreach($form['eligibility'] as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>
    </div>

    <div>
        <h3 class="font-serif text-lg font-semibold text-thc-navy">Required documents</h3>
        <ul class="mt-3 list-disc space-y-2 pl-5 text-sm leading-relaxed text-thc-text/85">
            @foreach($form['required_documents'] as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>
    </div>

    <p class="text-sm leading-relaxed text-thc-text/80">{{ $form['fees_summary'] }}</p>
    <p class="text-sm leading-relaxed text-thc-text/80">{{ $paymentInstructions }}</p>

    <label class="flex items-start gap-3 rounded-xl border border-thc-navy/10 bg-thc-navy/[0.03] p-4 text-sm text-thc-navy">
        <input type="checkbox" name="acknowledge_instructions" value="1" class="mt-0.5 text-thc-royal" @checked(old('acknowledge_instructions')) required>
        <span>I have read these instructions. I understand that applying does not guarantee admission, and that only shortlisted candidates are contacted for interview.</span>
    </label>
</div>
