<div class="space-y-8 rounded-2xl border border-thc-navy/10 bg-white p-6 shadow-sm sm:p-8">
    <h2 class="font-serif text-2xl font-semibold text-thc-navy">Education and qualifications</h2>

    @if($form['family'] === \App\Support\CohsProgrammeApplicationCatalog::FAMILY_PRE_SERVICE)
        <div class="grid gap-5 lg:grid-cols-3">
            <div class="lg:col-span-2">
                <label for="secondary_name" class="mb-1.5 block text-sm font-medium text-thc-navy">Secondary / high school <span class="text-red-600">*</span></label>
                <input id="secondary_name" type="text" name="secondary_name" value="{{ old('secondary_name') }}" required maxlength="200" class="cohs-app-input">
            </div>
            <div>
                <label for="principal_name" class="mb-1.5 block text-sm font-medium text-thc-navy">Name of principal</label>
                <input id="principal_name" type="text" name="principal_name" value="{{ old('principal_name') }}" maxlength="200" class="cohs-app-input">
            </div>
            <div class="lg:col-span-3">
                <label for="secondary_address" class="mb-1.5 block text-sm font-medium text-thc-navy">School address <span class="text-red-600">*</span></label>
                <input id="secondary_address" type="text" name="secondary_address" value="{{ old('secondary_address') }}" required maxlength="500" class="cohs-app-input">
            </div>
            <div>
                <label for="kcse_year" class="mb-1.5 block text-sm font-medium text-thc-navy">Year sat for KCSE <span class="text-red-600">*</span></label>
                <input id="kcse_year" type="number" name="kcse_year" value="{{ old('kcse_year') }}" required min="1980" max="{{ date('Y') }}" class="cohs-app-input">
            </div>
            <div>
                <label for="kcse_aggregate" class="mb-1.5 block text-sm font-medium text-thc-navy">KCSE aggregate score <span class="text-red-600">*</span></label>
                <input id="kcse_aggregate" type="text" name="kcse_aggregate" value="{{ old('kcse_aggregate') }}" required maxlength="32" class="cohs-app-input">
            </div>
            <div>
                <label for="kcse_english" class="mb-1.5 block text-sm font-medium text-thc-navy">English <span class="text-red-600">*</span></label>
                <input id="kcse_english" type="text" name="kcse_english" value="{{ old('kcse_english') }}" required maxlength="16" class="cohs-app-input">
            </div>
            <div>
                <label for="kcse_mathematics" class="mb-1.5 block text-sm font-medium text-thc-navy">Mathematics <span class="text-red-600">*</span></label>
                <input id="kcse_mathematics" type="text" name="kcse_mathematics" value="{{ old('kcse_mathematics') }}" required maxlength="16" class="cohs-app-input">
            </div>
            <div>
                <label for="kcse_biology" class="mb-1.5 block text-sm font-medium text-thc-navy">Biology <span class="text-red-600">*</span></label>
                <input id="kcse_biology" type="text" name="kcse_biology" value="{{ old('kcse_biology') }}" required maxlength="16" class="cohs-app-input">
            </div>
            @if($form['requires_clinical_kcse'])
                <div>
                    <label for="kcse_chemistry" class="mb-1.5 block text-sm font-medium text-thc-navy">Chemistry</label>
                    <input id="kcse_chemistry" type="text" name="kcse_chemistry" value="{{ old('kcse_chemistry') }}" maxlength="16" class="cohs-app-input">
                </div>
                <div>
                    <label for="kcse_physics" class="mb-1.5 block text-sm font-medium text-thc-navy">Physics</label>
                    <input id="kcse_physics" type="text" name="kcse_physics" value="{{ old('kcse_physics') }}" maxlength="16" class="cohs-app-input">
                </div>
                <div>
                    <label for="kcse_biological_sciences" class="mb-1.5 block text-sm font-medium text-thc-navy">Biological sciences</label>
                    <input id="kcse_biological_sciences" type="text" name="kcse_biological_sciences" value="{{ old('kcse_biological_sciences') }}" maxlength="16" class="cohs-app-input">
                </div>
                <div>
                    <label for="kcse_physical_sciences" class="mb-1.5 block text-sm font-medium text-thc-navy">Physical sciences</label>
                    <input id="kcse_physical_sciences" type="text" name="kcse_physical_sciences" value="{{ old('kcse_physical_sciences') }}" maxlength="16" class="cohs-app-input">
                </div>
            @endif
        </div>
    @else
        <h3 class="font-serif text-lg font-semibold text-thc-navy">Secondary or high school</h3>
        @foreach(range(0, 2) as $i)
            <div class="grid gap-5 lg:grid-cols-4">
                <div>
                    <label for="secondary_{{ $i }}_name" class="mb-1.5 block text-sm font-medium text-thc-navy">Name of school @if($i === 0)<span class="text-red-600">*</span>@endif</label>
                    <input id="secondary_{{ $i }}_name" type="text" name="secondary[{{ $i }}][name]" value="{{ old('secondary.'.$i.'.name') }}" maxlength="200" class="cohs-app-input" @if($i === 0) required @endif>
                </div>
                <div>
                    <label for="secondary_{{ $i }}_address" class="mb-1.5 block text-sm font-medium text-thc-navy">Address</label>
                    <input id="secondary_{{ $i }}_address" type="text" name="secondary[{{ $i }}][address]" value="{{ old('secondary.'.$i.'.address') }}" maxlength="500" class="cohs-app-input">
                </div>
                <div>
                    <label for="secondary_{{ $i }}_year" class="mb-1.5 block text-sm font-medium text-thc-navy">Year @if($i === 0)<span class="text-red-600">*</span>@endif</label>
                    <input id="secondary_{{ $i }}_year" type="number" name="secondary[{{ $i }}][year]" value="{{ old('secondary.'.$i.'.year') }}" min="1980" max="{{ date('Y') }}" class="cohs-app-input" @if($i === 0) required @endif>
                </div>
                <div>
                    <label for="secondary_{{ $i }}_mean" class="mb-1.5 block text-sm font-medium text-thc-navy">Mean grade @if($i === 0)<span class="text-red-600">*</span>@endif</label>
                    <input id="secondary_{{ $i }}_mean" type="text" name="secondary[{{ $i }}][mean_grade]" value="{{ old('secondary.'.$i.'.mean_grade') }}" maxlength="32" class="cohs-app-input" @if($i === 0) required @endif>
                </div>
            </div>
        @endforeach

        <h3 class="font-serif text-lg font-semibold text-thc-navy">Colleges / universities attended</h3>
        @foreach(range(0, 2) as $i)
            <div class="grid gap-5 lg:grid-cols-4">
                <div>
                    <label for="college_{{ $i }}_name" class="mb-1.5 block text-sm font-medium text-thc-navy">Training institution @if($i === 0)<span class="text-red-600">*</span>@endif</label>
                    <input id="college_{{ $i }}_name" type="text" name="colleges[{{ $i }}][name]" value="{{ old('colleges.'.$i.'.name') }}" maxlength="200" class="cohs-app-input" @if($i === 0) required @endif>
                </div>
                <div>
                    <label for="college_{{ $i }}_address" class="mb-1.5 block text-sm font-medium text-thc-navy">Address</label>
                    <input id="college_{{ $i }}_address" type="text" name="colleges[{{ $i }}][address]" value="{{ old('colleges.'.$i.'.address') }}" maxlength="500" class="cohs-app-input">
                </div>
                <div>
                    <label for="college_{{ $i }}_year" class="mb-1.5 block text-sm font-medium text-thc-navy">Year @if($i === 0)<span class="text-red-600">*</span>@endif</label>
                    <input id="college_{{ $i }}_year" type="number" name="colleges[{{ $i }}][year]" value="{{ old('colleges.'.$i.'.year') }}" min="1980" max="{{ date('Y') }}" class="cohs-app-input" @if($i === 0) required @endif>
                </div>
                <div>
                    <label for="college_{{ $i }}_qual" class="mb-1.5 block text-sm font-medium text-thc-navy">Qualification @if($i === 0)<span class="text-red-600">*</span>@endif</label>
                    <input id="college_{{ $i }}_qual" type="text" name="colleges[{{ $i }}][qualification]" value="{{ old('colleges.'.$i.'.qualification') }}" maxlength="200" class="cohs-app-input" @if($i === 0) required @endif>
                </div>
            </div>
        @endforeach

        <div class="grid gap-5 lg:grid-cols-3">
            <div>
                <label for="licence_number" class="mb-1.5 block text-sm font-medium text-thc-navy">{{ $form['licence_label'] }} <span class="text-red-600">*</span></label>
                <input id="licence_number" type="text" name="licence_number" value="{{ old('licence_number') }}" required maxlength="80" class="cohs-app-input">
            </div>
            <div class="lg:col-span-2">
                <label for="current_employer" class="mb-1.5 block text-sm font-medium text-thc-navy">Name of current employer <span class="text-red-600">*</span></label>
                <input id="current_employer" type="text" name="current_employer" value="{{ old('current_employer') }}" required maxlength="200" class="cohs-app-input">
            </div>
        </div>
    @endif
</div>
