<div class="space-y-8 rounded-2xl border border-thc-navy/10 bg-white p-6 shadow-sm sm:p-8">
    <h2 class="font-serif text-2xl font-semibold text-thc-navy">Essay questions</h2>
    <p class="text-sm leading-relaxed text-thc-text/80">The paper form asks for handwritten essays. Type your answers here so the office receives a complete online application.</p>

    <div>
        <label for="essay_christian" class="mb-1.5 block text-sm font-medium text-thc-navy">1. Describe when and how you became a Christian and what has happened since. <span class="text-red-600">*</span></label>
        <textarea id="essay_christian" name="essay_christian" required minlength="40" maxlength="10000" class="cohs-app-input min-h-[8rem]">{{ old('essay_christian') }}</textarea>
    </div>
    <div>
        <label for="essay_vocation" class="mb-1.5 block text-sm font-medium text-thc-navy">2. {{ $form['essay_vocation'] }} <span class="text-red-600">*</span></label>
        <textarea id="essay_vocation" name="essay_vocation" required minlength="40" maxlength="10000" class="cohs-app-input min-h-[8rem]">{{ old('essay_vocation') }}</textarea>
    </div>
    <div>
        <label for="essay_witness" class="mb-1.5 block text-sm font-medium text-thc-navy">3. {{ $form['essay_witness'] }} <span class="text-red-600">*</span></label>
        <textarea id="essay_witness" name="essay_witness" required minlength="40" maxlength="10000" class="cohs-app-input min-h-[8rem]">{{ old('essay_witness') }}</textarea>
    </div>
    <div>
        <label for="essay_family" class="mb-1.5 block text-sm font-medium text-thc-navy">4. Write an essay on your family and community. <span class="text-red-600">*</span></label>
        <textarea id="essay_family" name="essay_family" required minlength="40" maxlength="10000" class="cohs-app-input min-h-[8rem]">{{ old('essay_family') }}</textarea>
    </div>
    <div>
        <label for="essay_fees" class="mb-1.5 block text-sm font-medium text-thc-navy">5. Who will help pay for your school fees? What is their source of income? <span class="text-red-600">*</span></label>
        <textarea id="essay_fees" name="essay_fees" required minlength="20" maxlength="10000" class="cohs-app-input">{{ old('essay_fees') }}</textarea>
    </div>
    <div>
        <label for="essay_how_known" class="mb-1.5 block text-sm font-medium text-thc-navy">6. How did you get to know about Tenwek Hospital College, School of Health Sciences? <span class="text-red-600">*</span></label>
        <textarea id="essay_how_known" name="essay_how_known" required minlength="10" maxlength="5000" class="cohs-app-input">{{ old('essay_how_known') }}</textarea>
    </div>
</div>
