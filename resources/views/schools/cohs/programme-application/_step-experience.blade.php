<div class="space-y-8 rounded-2xl border border-thc-navy/10 bg-white p-6 shadow-sm sm:p-8">
    <h2 class="font-serif text-2xl font-semibold text-thc-navy">Work, leadership, and references</h2>

    @if($form['family'] === \App\Support\CohsProgrammeApplicationCatalog::FAMILY_PRE_SERVICE)
        <div>
            <label for="organizations" class="mb-1.5 block text-sm font-medium text-thc-navy">What organisations have you been a member of?</label>
            <textarea id="organizations" name="organizations" maxlength="2000" class="cohs-app-input">{{ old('organizations') }}</textarea>
        </div>
        <div>
            <label for="leadership_positions" class="mb-1.5 block text-sm font-medium text-thc-navy">What positions of leadership in church or school have you held?</label>
            <textarea id="leadership_positions" name="leadership_positions" maxlength="2000" class="cohs-app-input">{{ old('leadership_positions') }}</textarea>
        </div>
        <div class="grid gap-5 lg:grid-cols-3">
            <div>
                <span class="mb-1.5 block text-sm font-medium text-thc-navy">Have you taken any courses since KCSE? <span class="text-red-600">*</span></span>
                <div class="mt-2 flex gap-4">
                    <label class="inline-flex items-center gap-2 text-sm"><input type="radio" name="post_kcse_courses" value="yes" class="text-thc-royal" @checked(old('post_kcse_courses') === 'yes') required> Yes</label>
                    <label class="inline-flex items-center gap-2 text-sm"><input type="radio" name="post_kcse_courses" value="no" class="text-thc-royal" @checked(old('post_kcse_courses', 'no') === 'no')> No</label>
                </div>
            </div>
            <div class="lg:col-span-2">
                <label for="post_kcse_explain" class="mb-1.5 block text-sm font-medium text-thc-navy">If yes, explain</label>
                <textarea id="post_kcse_explain" name="post_kcse_explain" maxlength="2000" class="cohs-app-input">{{ old('post_kcse_explain') }}</textarea>
            </div>
        </div>
        <div>
            <label for="work_reference" class="mb-1.5 block text-sm font-medium text-thc-navy">If you have worked anywhere, give reference, address, and length of time</label>
            <textarea id="work_reference" name="work_reference" maxlength="2000" class="cohs-app-input">{{ old('work_reference') }}</textarea>
        </div>
        <div>
            <label for="nursing_experience" class="mb-1.5 block text-sm font-medium text-thc-navy">Any nursing experience (hospital or health centre, address, length of time)</label>
            <textarea id="nursing_experience" name="nursing_experience" maxlength="2000" class="cohs-app-input">{{ old('nursing_experience') }}</textarea>
        </div>
    @else
        <h3 class="font-serif text-lg font-semibold text-thc-navy">Former employers</h3>
        @foreach(range(0, 2) as $i)
            <div class="grid gap-5 lg:grid-cols-3">
                <div>
                    <label for="emp_{{ $i }}_name" class="mb-1.5 block text-sm font-medium text-thc-navy">Name</label>
                    <input id="emp_{{ $i }}_name" type="text" name="former_employers[{{ $i }}][name]" value="{{ old('former_employers.'.$i.'.name') }}" maxlength="200" class="cohs-app-input">
                </div>
                <div>
                    <label for="emp_{{ $i }}_address" class="mb-1.5 block text-sm font-medium text-thc-navy">Address</label>
                    <input id="emp_{{ $i }}_address" type="text" name="former_employers[{{ $i }}][address]" value="{{ old('former_employers.'.$i.'.address') }}" maxlength="500" class="cohs-app-input">
                </div>
                <div>
                    <label for="emp_{{ $i }}_duration" class="mb-1.5 block text-sm font-medium text-thc-navy">Duration</label>
                    <input id="emp_{{ $i }}_duration" type="text" name="former_employers[{{ $i }}][duration]" value="{{ old('former_employers.'.$i.'.duration') }}" maxlength="120" class="cohs-app-input">
                </div>
            </div>
        @endforeach
        <div>
            <label for="leadership_positions" class="mb-1.5 block text-sm font-medium text-thc-navy">Positions of leadership in church or in your workplace</label>
            <textarea id="leadership_positions" name="leadership_positions" maxlength="2000" class="cohs-app-input" placeholder="List a, b, and c if you wish">{{ old('leadership_positions') }}</textarea>
        </div>
    @endif

    <h3 class="font-serif text-lg font-semibold text-thc-navy">References</h3>
    <p class="text-sm text-thc-text/75">Give people from whom we can request references. They should not be relatives.</p>

    <div class="grid gap-5 lg:grid-cols-3">
        <div>
            <label for="ref_pastor_name" class="mb-1.5 block text-sm font-medium text-thc-navy">Pastor of your church — name <span class="text-red-600">*</span></label>
            <input id="ref_pastor_name" type="text" name="ref_pastor_name" value="{{ old('ref_pastor_name') }}" required maxlength="200" class="cohs-app-input">
        </div>
        <div>
            <label for="ref_pastor_address" class="mb-1.5 block text-sm font-medium text-thc-navy">Address <span class="text-red-600">*</span></label>
            <input id="ref_pastor_address" type="text" name="ref_pastor_address" value="{{ old('ref_pastor_address') }}" required maxlength="500" class="cohs-app-input">
        </div>
        <div>
            <label for="ref_pastor_mobile" class="mb-1.5 block text-sm font-medium text-thc-navy">Tel. / mobile <span class="text-red-600">*</span></label>
            <input id="ref_pastor_mobile" type="text" name="ref_pastor_mobile" value="{{ old('ref_pastor_mobile') }}" required maxlength="40" class="cohs-app-input">
        </div>
        <div>
            <label for="ref_leader_name" class="mb-1.5 block text-sm font-medium text-thc-navy">Another church leader (not a relative) <span class="text-red-600">*</span></label>
            <input id="ref_leader_name" type="text" name="ref_leader_name" value="{{ old('ref_leader_name') }}" required maxlength="200" class="cohs-app-input">
        </div>
        <div>
            <label for="ref_leader_address" class="mb-1.5 block text-sm font-medium text-thc-navy">Address <span class="text-red-600">*</span></label>
            <input id="ref_leader_address" type="text" name="ref_leader_address" value="{{ old('ref_leader_address') }}" required maxlength="500" class="cohs-app-input">
        </div>
        <div>
            <label for="ref_leader_mobile" class="mb-1.5 block text-sm font-medium text-thc-navy">Tel. / mobile <span class="text-red-600">*</span></label>
            <input id="ref_leader_mobile" type="text" name="ref_leader_mobile" value="{{ old('ref_leader_mobile') }}" required maxlength="40" class="cohs-app-input">
        </div>
        <div>
            <label for="ref_friend_name" class="mb-1.5 block text-sm font-medium text-thc-navy">Person who has known you more than five years <span class="text-red-600">*</span></label>
            <input id="ref_friend_name" type="text" name="ref_friend_name" value="{{ old('ref_friend_name') }}" required maxlength="200" class="cohs-app-input">
        </div>
        <div>
            <label for="ref_friend_address" class="mb-1.5 block text-sm font-medium text-thc-navy">Address <span class="text-red-600">*</span></label>
            <input id="ref_friend_address" type="text" name="ref_friend_address" value="{{ old('ref_friend_address') }}" required maxlength="500" class="cohs-app-input">
        </div>
        <div>
            <label for="ref_friend_mobile" class="mb-1.5 block text-sm font-medium text-thc-navy">Tel. / mobile <span class="text-red-600">*</span></label>
            <input id="ref_friend_mobile" type="text" name="ref_friend_mobile" value="{{ old('ref_friend_mobile') }}" required maxlength="40" class="cohs-app-input">
        </div>
    </div>
</div>
