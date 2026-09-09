<div class="space-y-8 rounded-2xl border border-thc-navy/10 bg-white p-6 shadow-sm sm:p-8">
    <h2 class="font-serif text-2xl font-semibold text-thc-navy">Documents, payment, and declaration</h2>

    <div class="rounded-xl border border-thc-navy/10 bg-thc-navy/[0.04] p-4 text-sm leading-relaxed text-thc-text">
        {{ $paymentInstructions }}
    </div>

    <div class="grid gap-5 lg:grid-cols-3">
        <div>
            <label for="kcse_results" class="mb-1.5 block text-sm font-medium text-thc-navy">KCSE results <span class="text-red-600">*</span></label>
            <input id="kcse_results" type="file" name="kcse_results" required accept=".pdf,.jpg,.jpeg,.png,.webp" class="cohs-app-input">
        </div>
        <div>
            <label for="leaving_certificate" class="mb-1.5 block text-sm font-medium text-thc-navy">School leaving certificate <span class="text-red-600">*</span></label>
            <input id="leaving_certificate" type="file" name="leaving_certificate" required accept=".pdf,.jpg,.jpeg,.png,.webp" class="cohs-app-input">
        </div>
        <div>
            <label for="national_id" class="mb-1.5 block text-sm font-medium text-thc-navy">National ID <span class="text-red-600">*</span></label>
            <input id="national_id" type="file" name="national_id" required accept=".pdf,.jpg,.jpeg,.png,.webp" class="cohs-app-input">
        </div>
        <div>
            <label for="proof_of_payment" class="mb-1.5 block text-sm font-medium text-thc-navy">Proof of KSh 1,500 application fee <span class="text-red-600">*</span></label>
            <input id="proof_of_payment" type="file" name="proof_of_payment" required accept=".pdf,.jpg,.jpeg,.png,.webp" class="cohs-app-input">
        </div>
        @if($form['requires_licence_file'])
            <div>
                <label for="practice_licence" class="mb-1.5 block text-sm font-medium text-thc-navy">Practice licence <span class="text-red-600">*</span></label>
                <input id="practice_licence" type="file" name="practice_licence" required accept=".pdf,.jpg,.jpeg,.png,.webp" class="cohs-app-input">
            </div>
        @endif
        @if($form['requires_diploma_file'])
            <div>
                <label for="diploma_or_degree" class="mb-1.5 block text-sm font-medium text-thc-navy">Diploma or degree certificate <span class="text-red-600">*</span></label>
                <input id="diploma_or_degree" type="file" name="diploma_or_degree" required accept=".pdf,.jpg,.jpeg,.png,.webp" class="cohs-app-input">
            </div>
        @endif
        @if($form['requires_hd_anaesthesia_file'])
            <div>
                <label for="hd_anaesthesia_or_ecco" class="mb-1.5 block text-sm font-medium text-thc-navy">Higher diploma in anaesthesia or ECCO <span class="text-red-600">*</span></label>
                <input id="hd_anaesthesia_or_ecco" type="file" name="hd_anaesthesia_or_ecco" required accept=".pdf,.jpg,.jpeg,.png,.webp" class="cohs-app-input">
            </div>
        @endif
        <div x-show="maritalStatus === 'married'" x-cloak>
            <label for="marriage_certificate" class="mb-1.5 block text-sm font-medium text-thc-navy">Marriage certificate <span class="text-red-600">*</span></label>
            <input id="marriage_certificate" type="file" name="marriage_certificate" accept=".pdf,.jpg,.jpeg,.png,.webp" class="cohs-app-input" :required="maritalStatus === 'married'">
        </div>
        <div x-show="maritalStatus === 'married'" x-cloak>
            <label for="youngest_child_birth_certificate" class="mb-1.5 block text-sm font-medium text-thc-navy">Youngest child’s birth certificate</label>
            <input id="youngest_child_birth_certificate" type="file" name="youngest_child_birth_certificate" accept=".pdf,.jpg,.jpeg,.png,.webp" class="cohs-app-input">
        </div>
    </div>

    <div>
        <label for="applicant_signature" class="mb-1.5 block text-sm font-medium text-thc-navy">Type your full name as signature <span class="text-red-600">*</span></label>
        <input id="applicant_signature" type="text" name="applicant_signature" value="{{ old('applicant_signature') }}" required maxlength="200" class="cohs-app-input">
    </div>

    <label class="flex items-start gap-3 rounded-xl border border-thc-navy/10 bg-thc-navy/[0.03] p-4 text-sm text-thc-navy">
        <input type="checkbox" name="agree_declaration" value="1" class="mt-0.5 text-thc-royal" @checked(old('agree_declaration')) required>
        <span>I hereby declare that I have carefully considered the statements made above and to the best of my knowledge they are complete and correct. I have not withheld any important information or made any misleading statements.</span>
    </label>
</div>
