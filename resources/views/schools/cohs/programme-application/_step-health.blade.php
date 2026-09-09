<div class="space-y-8 rounded-2xl border border-thc-navy/10 bg-white p-6 shadow-sm sm:p-8">
    <h2 class="font-serif text-2xl font-semibold text-thc-navy">Medical health history</h2>
    <p class="text-sm text-thc-text/80">To be filled by the applicant. Mark every item. Choose Yes if it applies to you, No if it does not.</p>

    <div>
        <label for="family_hereditary" class="mb-1.5 block text-sm font-medium text-thc-navy">Any hereditary or important diseases in the family (for example tuberculosis)? If yes, specify.</label>
        <textarea id="family_hereditary" name="family_hereditary" maxlength="2000" class="cohs-app-input">{{ old('family_hereditary') }}</textarea>
    </div>

    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @foreach($healthFlags as $flag)
            <div class="rounded-xl border border-thc-navy/10 p-4">
                <span class="block text-sm font-medium text-thc-navy">{{ $flag['label'] }} <span class="text-red-600">*</span></span>
                <div class="mt-2 flex gap-4">
                    <label class="inline-flex items-center gap-2 text-sm">
                        <input type="radio" name="health[{{ $flag['key'] }}]" value="yes" class="text-thc-royal" @checked(old('health.'.$flag['key']) === 'yes') required>
                        Yes
                    </label>
                    <label class="inline-flex items-center gap-2 text-sm">
                        <input type="radio" name="health[{{ $flag['key'] }}]" value="no" class="text-thc-royal" @checked(old('health.'.$flag['key'], 'no') === 'no')>
                        No
                    </label>
                </div>
            </div>
        @endforeach
    </div>

    <div class="grid gap-5 lg:grid-cols-2">
        <div>
            <label for="hospital_admission_dates" class="mb-1.5 block text-sm font-medium text-thc-navy">Admission date(s), if any</label>
            <input id="hospital_admission_dates" type="text" name="hospital_admission_dates" value="{{ old('hospital_admission_dates') }}" maxlength="500" class="cohs-app-input">
        </div>
        <div>
            <label for="surgical_dates" class="mb-1.5 block text-sm font-medium text-thc-navy">Surgical operation date(s), if any</label>
            <input id="surgical_dates" type="text" name="surgical_dates" value="{{ old('surgical_dates') }}" maxlength="500" class="cohs-app-input">
        </div>
    </div>

    <div>
        <label for="health_explanations" class="mb-1.5 block text-sm font-medium text-thc-navy">Explain any “Yes” answers above</label>
        <textarea id="health_explanations" name="health_explanations" maxlength="5000" class="cohs-app-input">{{ old('health_explanations') }}</textarea>
    </div>
    <div>
        <label for="health_medicines_info" class="mb-1.5 block text-sm font-medium text-thc-navy">More information on frequent or regular medicine, if Yes</label>
        <textarea id="health_medicines_info" name="health_medicines_info" maxlength="5000" class="cohs-app-input">{{ old('health_medicines_info') }}</textarea>
    </div>
    <div>
        <label for="health_other" class="mb-1.5 block text-sm font-medium text-thc-navy">
            Any other information about your health
            @if($form['health_pregnancy_note'])
                (for female applicants, indicate if you are pregnant)
            @endif
        </label>
        <textarea id="health_other" name="health_other" maxlength="5000" class="cohs-app-input">{{ old('health_other') }}</textarea>
    </div>

    @if($form['family'] === \App\Support\CohsProgrammeApplicationCatalog::FAMILY_PRE_SERVICE)
        <div class="grid gap-5 lg:grid-cols-2" x-show="gender === 'female'" x-cloak>
            <div>
                <label for="female_lmp" class="mb-1.5 block text-sm font-medium text-thc-navy">Date of last menstrual period</label>
                <input id="female_lmp" type="text" name="female_lmp" value="{{ old('female_lmp') }}" maxlength="80" class="cohs-app-input">
            </div>
            <div>
                <label for="female_period_sick" class="mb-1.5 block text-sm font-medium text-thc-navy">Do you go off sick with periods?</label>
                <input id="female_period_sick" type="text" name="female_period_sick" value="{{ old('female_period_sick') }}" maxlength="200" class="cohs-app-input">
            </div>
        </div>
    @endif
</div>
