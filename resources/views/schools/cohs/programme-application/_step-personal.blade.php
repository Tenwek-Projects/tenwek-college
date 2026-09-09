<div class="space-y-8 rounded-2xl border border-thc-navy/10 bg-white p-6 shadow-sm sm:p-8">
    <h2 class="font-serif text-2xl font-semibold text-thc-navy">Personal and family</h2>

    @if($form['family'] === \App\Support\CohsProgrammeApplicationCatalog::FAMILY_PRE_SERVICE)
        <div class="grid gap-5 lg:grid-cols-3">
            <div>
                <span class="mb-1.5 block text-sm font-medium text-thc-navy">Have you applied to our school before? <span class="text-red-600">*</span></span>
                <div class="mt-2 flex gap-4">
                    <label class="inline-flex items-center gap-2 text-sm"><input type="radio" name="applied_before" value="yes" class="text-thc-royal" @checked(old('applied_before') === 'yes') required> Yes</label>
                    <label class="inline-flex items-center gap-2 text-sm"><input type="radio" name="applied_before" value="no" class="text-thc-royal" @checked(old('applied_before', 'no') === 'no')> No</label>
                </div>
            </div>
            <div>
                <label for="applied_when" class="mb-1.5 block text-sm font-medium text-thc-navy">When?</label>
                <input id="applied_when" type="text" name="applied_when" value="{{ old('applied_when') }}" maxlength="120" class="cohs-app-input">
            </div>
            <div>
                <span class="mb-1.5 block text-sm font-medium text-thc-navy">Did you come to interview?</span>
                <div class="mt-2 flex gap-4">
                    <label class="inline-flex items-center gap-2 text-sm"><input type="radio" name="came_to_interview" value="yes" class="text-thc-royal" @checked(old('came_to_interview') === 'yes')> Yes</label>
                    <label class="inline-flex items-center gap-2 text-sm"><input type="radio" name="came_to_interview" value="no" class="text-thc-royal" @checked(old('came_to_interview') === 'no')> No</label>
                </div>
            </div>
        </div>
    @endif

    <div class="grid gap-5 lg:grid-cols-3">
        <div class="lg:col-span-2">
            <label for="full_name" class="mb-1.5 block text-sm font-medium text-thc-navy">Full name (block letters) <span class="text-red-600">*</span></label>
            <input id="full_name" type="text" name="full_name" value="{{ old('full_name') }}" required maxlength="200" autocomplete="name" class="cohs-app-input">
        </div>
        <div>
            <label for="id_number" class="mb-1.5 block text-sm font-medium text-thc-navy">ID number <span class="text-red-600">*</span></label>
            <input id="id_number" type="text" name="id_number" value="{{ old('id_number') }}" required maxlength="64" class="cohs-app-input">
        </div>
        <div class="lg:col-span-2">
            <label for="postal_address" class="mb-1.5 block text-sm font-medium text-thc-navy">Present postal address <span class="text-red-600">*</span></label>
            <input id="postal_address" type="text" name="postal_address" value="{{ old('postal_address') }}" required maxlength="500" class="cohs-app-input">
        </div>
        <div>
            <label for="mobile" class="mb-1.5 block text-sm font-medium text-thc-navy">Mobile no. <span class="text-red-600">*</span></label>
            <input id="mobile" type="text" name="mobile" value="{{ old('mobile') }}" required maxlength="40" autocomplete="tel" class="cohs-app-input">
        </div>
        <div>
            <label for="email" class="mb-1.5 block text-sm font-medium text-thc-navy">Email <span class="text-red-600">*</span></label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required maxlength="255" autocomplete="email" class="cohs-app-input">
        </div>
        <div>
            <label for="county" class="mb-1.5 block text-sm font-medium text-thc-navy">County <span class="text-red-600">*</span></label>
            <select id="county" name="county" required class="cohs-app-input">
                <option value="">Select county</option>
                @foreach($counties as $c)
                    <option value="{{ $c }}" @selected(old('county') === $c)>{{ $c }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="nationality" class="mb-1.5 block text-sm font-medium text-thc-navy">Nationality <span class="text-red-600">*</span></label>
            <input id="nationality" type="text" name="nationality" value="{{ old('nationality', 'Kenyan') }}" required maxlength="120" class="cohs-app-input">
        </div>
        <div>
            <label for="date_of_birth" class="mb-1.5 block text-sm font-medium text-thc-navy">Date of birth <span class="text-red-600">*</span></label>
            <input id="date_of_birth" type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" required class="cohs-app-input">
        </div>
        <div>
            <label for="age" class="mb-1.5 block text-sm font-medium text-thc-navy">Age</label>
            <input id="age" type="number" name="age" value="{{ old('age') }}" min="15" max="99" class="cohs-app-input">
        </div>
        <div>
            <span class="mb-1.5 block text-sm font-medium text-thc-navy">Sex <span class="text-red-600">*</span></span>
            <div class="mt-2 flex gap-4">
                <label class="inline-flex items-center gap-2 text-sm"><input type="radio" name="sex" value="female" class="text-thc-royal" x-model="gender" @checked(old('sex') === 'female') required> Female</label>
                <label class="inline-flex items-center gap-2 text-sm"><input type="radio" name="sex" value="male" class="text-thc-royal" x-model="gender" @checked(old('sex') === 'male')> Male</label>
            </div>
        </div>
        <div>
            <label for="marital_status" class="mb-1.5 block text-sm font-medium text-thc-navy">Marital status <span class="text-red-600">*</span></label>
            <select id="marital_status" name="marital_status" required class="cohs-app-input" x-model="maritalStatus">
                <option value="">Select</option>
                @foreach(['married' => 'Married', 'single' => 'Single', 'widowed' => 'Widowed', 'divorced' => 'Divorced'] as $val => $lab)
                    <option value="{{ $val }}" @selected(old('marital_status') === $val)>{{ $lab }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="grid gap-5 lg:grid-cols-3" x-show="maritalStatus === 'married'" x-cloak>
        <div>
            <label for="spouse_name" class="mb-1.5 block text-sm font-medium text-thc-navy">Name of spouse <span class="text-red-600">*</span></label>
            <input id="spouse_name" type="text" name="spouse_name" value="{{ old('spouse_name') }}" maxlength="200" class="cohs-app-input" :required="maritalStatus === 'married'">
        </div>
        <div>
            <label for="children_count" class="mb-1.5 block text-sm font-medium text-thc-navy">Number of children <span class="text-red-600">*</span></label>
            <input id="children_count" type="number" name="children_count" value="{{ old('children_count') }}" min="0" max="30" class="cohs-app-input" :required="maritalStatus === 'married'">
        </div>
        <div>
            <label for="children_ages" class="mb-1.5 block text-sm font-medium text-thc-navy">Ages of children</label>
            <input id="children_ages" type="text" name="children_ages" value="{{ old('children_ages') }}" maxlength="200" class="cohs-app-input">
        </div>
        <div class="lg:col-span-2">
            <label for="spouse_address" class="mb-1.5 block text-sm font-medium text-thc-navy">Address of spouse</label>
            <input id="spouse_address" type="text" name="spouse_address" value="{{ old('spouse_address') }}" maxlength="500" class="cohs-app-input">
        </div>
        <div>
            <label for="spouse_occupation" class="mb-1.5 block text-sm font-medium text-thc-navy">Occupation of spouse</label>
            <input id="spouse_occupation" type="text" name="spouse_occupation" value="{{ old('spouse_occupation') }}" maxlength="200" class="cohs-app-input">
        </div>
    </div>

    <div class="grid gap-5 lg:grid-cols-3">
        <div class="lg:col-span-2">
            <label for="church_name" class="mb-1.5 block text-sm font-medium text-thc-navy">Name of local church <span class="text-red-600">*</span></label>
            <input id="church_name" type="text" name="church_name" value="{{ old('church_name') }}" required maxlength="200" class="cohs-app-input">
        </div>
        <div>
            <label for="denomination" class="mb-1.5 block text-sm font-medium text-thc-navy">Denomination <span class="text-red-600">*</span></label>
            <input id="denomination" type="text" name="denomination" value="{{ old('denomination') }}" required maxlength="200" class="cohs-app-input">
        </div>
    </div>

    <h3 class="font-serif text-lg font-semibold text-thc-navy">Father</h3>
    <div class="grid gap-5 lg:grid-cols-3">
        <div>
            <label for="father_name" class="mb-1.5 block text-sm font-medium text-thc-navy">Name <span class="text-red-600">*</span></label>
            <input id="father_name" type="text" name="father_name" value="{{ old('father_name') }}" required maxlength="200" class="cohs-app-input">
        </div>
        <div>
            <span class="mb-1.5 block text-sm font-medium text-thc-navy">Living? <span class="text-red-600">*</span></span>
            <div class="mt-2 flex gap-4">
                <label class="inline-flex items-center gap-2 text-sm"><input type="radio" name="father_living" value="yes" class="text-thc-royal" @checked(old('father_living') === 'yes') required> Yes</label>
                <label class="inline-flex items-center gap-2 text-sm"><input type="radio" name="father_living" value="no" class="text-thc-royal" @checked(old('father_living') === 'no')> No</label>
            </div>
        </div>
        <div>
            <label for="father_occupation" class="mb-1.5 block text-sm font-medium text-thc-navy">Occupation</label>
            <input id="father_occupation" type="text" name="father_occupation" value="{{ old('father_occupation') }}" maxlength="200" class="cohs-app-input">
        </div>
        <div class="lg:col-span-2">
            <label for="father_address" class="mb-1.5 block text-sm font-medium text-thc-navy">Address</label>
            <input id="father_address" type="text" name="father_address" value="{{ old('father_address') }}" maxlength="500" class="cohs-app-input">
        </div>
        <div>
            <label for="father_mobile" class="mb-1.5 block text-sm font-medium text-thc-navy">Mobile no.</label>
            <input id="father_mobile" type="text" name="father_mobile" value="{{ old('father_mobile') }}" maxlength="40" class="cohs-app-input">
        </div>
    </div>

    <h3 class="font-serif text-lg font-semibold text-thc-navy">Mother</h3>
    <div class="grid gap-5 lg:grid-cols-3">
        <div>
            <label for="mother_name" class="mb-1.5 block text-sm font-medium text-thc-navy">Name <span class="text-red-600">*</span></label>
            <input id="mother_name" type="text" name="mother_name" value="{{ old('mother_name') }}" required maxlength="200" class="cohs-app-input">
        </div>
        <div>
            <span class="mb-1.5 block text-sm font-medium text-thc-navy">Living? <span class="text-red-600">*</span></span>
            <div class="mt-2 flex gap-4">
                <label class="inline-flex items-center gap-2 text-sm"><input type="radio" name="mother_living" value="yes" class="text-thc-royal" @checked(old('mother_living') === 'yes') required> Yes</label>
                <label class="inline-flex items-center gap-2 text-sm"><input type="radio" name="mother_living" value="no" class="text-thc-royal" @checked(old('mother_living') === 'no')> No</label>
            </div>
        </div>
        <div>
            <label for="mother_occupation" class="mb-1.5 block text-sm font-medium text-thc-navy">Occupation</label>
            <input id="mother_occupation" type="text" name="mother_occupation" value="{{ old('mother_occupation') }}" maxlength="200" class="cohs-app-input">
        </div>
        <div class="lg:col-span-2">
            <label for="mother_address" class="mb-1.5 block text-sm font-medium text-thc-navy">Address</label>
            <input id="mother_address" type="text" name="mother_address" value="{{ old('mother_address') }}" maxlength="500" class="cohs-app-input">
        </div>
        <div>
            <label for="mother_mobile" class="mb-1.5 block text-sm font-medium text-thc-navy">Mobile no.</label>
            <input id="mother_mobile" type="text" name="mother_mobile" value="{{ old('mother_mobile') }}" maxlength="40" class="cohs-app-input">
        </div>
    </div>

    <h3 class="font-serif text-lg font-semibold text-thc-navy">Guardian (if applicable)</h3>
    <div class="grid gap-5 lg:grid-cols-3">
        <div>
            <label for="guardian_relation" class="mb-1.5 block text-sm font-medium text-thc-navy">Relation</label>
            <input id="guardian_relation" type="text" name="guardian_relation" value="{{ old('guardian_relation') }}" maxlength="120" class="cohs-app-input">
        </div>
        <div>
            <label for="guardian_name" class="mb-1.5 block text-sm font-medium text-thc-navy">Name</label>
            <input id="guardian_name" type="text" name="guardian_name" value="{{ old('guardian_name') }}" maxlength="200" class="cohs-app-input">
        </div>
        <div>
            <label for="guardian_occupation" class="mb-1.5 block text-sm font-medium text-thc-navy">Occupation</label>
            <input id="guardian_occupation" type="text" name="guardian_occupation" value="{{ old('guardian_occupation') }}" maxlength="200" class="cohs-app-input">
        </div>
        <div class="lg:col-span-2">
            <label for="guardian_address" class="mb-1.5 block text-sm font-medium text-thc-navy">Address</label>
            <input id="guardian_address" type="text" name="guardian_address" value="{{ old('guardian_address') }}" maxlength="500" class="cohs-app-input">
        </div>
        <div>
            <label for="guardian_mobile" class="mb-1.5 block text-sm font-medium text-thc-navy">Mobile no.</label>
            <input id="guardian_mobile" type="text" name="guardian_mobile" value="{{ old('guardian_mobile') }}" maxlength="40" class="cohs-app-input">
        </div>
    </div>
</div>
