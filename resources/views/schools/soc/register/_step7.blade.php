@php
    $fc = 'mt-1 block w-full text-sm text-thc-text file:mr-4 file:rounded-lg file:border-0 file:bg-thc-royal file:px-4 file:py-2 file:font-semibold file:text-white hover:file:bg-thc-navy';
@endphp

<section class="space-y-6" aria-labelledby="step7-title">
    <h2 id="step7-title" class="font-serif text-xl font-semibold text-thc-navy sm:text-2xl">Upload documents & submit</h2>
    <p class="text-sm text-thc-text/85">PDF or images (JPG, PNG, WebP) unless noted. The paper form asks for <strong>three</strong> passport photographs, a bank slip, and academic certificates.</p>

    <div class="rounded-2xl border border-thc-navy/10 bg-white p-5 shadow-sm">
        <h3 class="font-serif text-lg font-semibold text-thc-navy">Application fee (KES 1,000, non-refundable)</h3>
        <p class="mt-2 text-sm text-thc-text/90">Pay by bank transfer only (cash is not accepted):</p>
        <ul class="mt-3 list-disc space-y-1 pl-5 text-sm text-thc-text/90">
            <li>Bank: <strong>KCB Bank</strong>, Bomet branch</li>
            <li>Account name: <strong>Tenwek Hospital School of Chaplaincy</strong></li>
            <li>Account number: <strong>1104955806</strong></li>
        </ul>
        <p class="mt-3 text-sm text-thc-text/80">Then upload the bank slip below. Applications are also emailed to <a class="font-semibold text-thc-royal hover:underline" href="mailto:soc@tenwekhosp.org">soc@tenwekhosp.org</a>.</p>
    </div>

    <div class="space-y-5 rounded-2xl border border-thc-navy/10 bg-white p-5 shadow-sm">
        <div>
            <label for="bank_slip" class="block text-sm font-semibold text-thc-navy">Bank slip for application fee (KES 1,000) <span class="text-thc-maroon">*</span></label>
            <input type="file" name="bank_slip" id="bank_slip" accept=".pdf,.jpg,.jpeg,.png,.webp" required class="{{ $fc }} @error('bank_slip') ring-2 ring-thc-maroon/40 @enderror">
            @error('bank_slip')
                <p class="mt-1 text-sm text-thc-maroon">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="photograph" class="block text-sm font-semibold text-thc-navy">Passport photograph 1 <span class="text-thc-maroon">*</span></label>
            <input type="file" name="photograph" id="photograph" accept=".jpg,.jpeg,.png,.webp" required class="{{ $fc }} @error('photograph') ring-2 ring-thc-maroon/40 @enderror">
            @error('photograph')
                <p class="mt-1 text-sm text-thc-maroon">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="photograph_2" class="block text-sm font-semibold text-thc-navy">Passport photograph 2 <span class="font-normal text-thc-text/65">(paper form asks for three)</span></label>
            <input type="file" name="photograph_2" id="photograph_2" accept=".jpg,.jpeg,.png,.webp" class="{{ $fc }} @error('photograph_2') ring-2 ring-thc-maroon/40 @enderror">
            @error('photograph_2')
                <p class="mt-1 text-sm text-thc-maroon">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="photograph_3" class="block text-sm font-semibold text-thc-navy">Passport photograph 3</label>
            <input type="file" name="photograph_3" id="photograph_3" accept=".jpg,.jpeg,.png,.webp" class="{{ $fc }} @error('photograph_3') ring-2 ring-thc-maroon/40 @enderror">
            @error('photograph_3')
                <p class="mt-1 text-sm text-thc-maroon">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="certificates" class="block text-sm font-semibold text-thc-navy">Academic &amp; professional certificates (A-level, O-level, or transcript) <span class="text-thc-maroon">*</span></label>
            <p class="mt-1 text-xs text-thc-text/70">If documents are not in English, upload a certified translation (you may combine pages into one PDF).</p>
            <input type="file" name="certificates" id="certificates" accept=".pdf,.jpg,.jpeg,.png,.webp" required class="{{ $fc }} @error('certificates') ring-2 ring-thc-maroon/40 @enderror">
            @error('certificates')
                <p class="mt-1 text-sm text-thc-maroon">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="english_proof" class="block text-sm font-semibold text-thc-navy">English competence proof <span class="font-normal text-thc-text/65">(if certificates are not in English)</span></label>
            <input type="file" name="english_proof" id="english_proof" accept=".pdf,.jpg,.jpeg,.png,.webp" class="{{ $fc }} @error('english_proof') ring-2 ring-thc-maroon/40 @enderror">
            @error('english_proof')
                <p class="mt-1 text-sm text-thc-maroon">{{ $message }}</p>
            @enderror
        </div>
    </div>

    @include('schools.soc.register._text', ['name' => 'applicant_signature', 'label' => 'Signature (type your full legal name)', 'autocomplete' => 'name'])

    <label class="flex items-start gap-3 rounded-2xl border border-thc-navy/10 bg-white p-5 shadow-sm">
        <input type="checkbox" name="checklist_complete" value="1" class="mt-1 text-thc-maroon focus:ring-thc-royal" @checked(old('checklist_complete')) required>
        <span class="text-sm leading-relaxed text-thc-text/90">
            I confirm that all details in this form are complete and that I have attached the required documents (bank slip, photographs, and academic certificates).
        </span>
    </label>
    @error('checklist_complete')
        <p class="text-sm text-thc-maroon">{{ $message }}</p>
    @enderror

    <label class="flex items-start gap-3 rounded-2xl border border-thc-navy/10 bg-white p-5 shadow-sm">
        <input type="checkbox" name="agree_declaration" value="1" class="mt-1 text-thc-maroon focus:ring-thc-royal" @checked(old('agree_declaration')) required>
        <span class="text-sm leading-relaxed text-thc-text/90">
            I certify that all information given is true and accurate to the best of my knowledge. I understand that false information may lead to dismissal if admitted.
        </span>
    </label>
    @error('agree_declaration')
        <p class="text-sm text-thc-maroon">{{ $message }}</p>
    @enderror

    <p class="text-xs text-thc-text/65">By submitting this form you consent to the college processing your data for admissions purposes.</p>
</section>
