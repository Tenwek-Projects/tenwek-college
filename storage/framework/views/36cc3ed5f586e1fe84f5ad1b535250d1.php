<?php
    $socialRows = 6;
    if (is_array(old('social_label'))) {
        $socialPairs = [];
        for ($i = 0; $i < $socialRows; $i++) {
            $socialPairs[] = [
                'label' => old('social_label.'.$i, ''),
                'url' => old('social_url.'.$i, ''),
            ];
        }
    } else {
        $fromContact = $contact['social_links'] ?? [];
        $socialPairs = array_values($fromContact);
        while (count($socialPairs) < $socialRows) {
            $socialPairs[] = ['label' => '', 'url' => ''];
        }
        $socialPairs = array_slice($socialPairs, 0, $socialRows);
    }

    $phoneNumbersText = old('phone_numbers');
    if ($phoneNumbersText === null) {
        $lines = [];
        foreach ($contactPage['phone_rows'] ?? [] as $row) {
            foreach ($row['numbers'] ?? [] as $num) {
                if (is_array($num) && filled($num['display'] ?? null)) {
                    $lines[] = $num['display'];
                }
            }
        }
        if ($lines === [] && is_array($contact['phones'] ?? null)) {
            $lines = $contact['phones'];
        }
        $phoneNumbersText = implode("\n", $lines);
    }

    $phoneRowLabel = old('phone_row_label', $contactPage['phone_rows'][0]['label'] ?? 'Phone');
?>
<?php if (isset($component)) { $__componentOriginalc8c9fd5d7827a77a31381de67195f0c3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.admin','data' => ['header' => 'COHS - Contact']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.admin'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['header' => 'COHS - Contact']); ?>
    <form method="post" action="<?php echo e(route('admin.cohs.contact.update')); ?>" class="admin-page-narrow">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="admin-card p-6 sm:p-8">
            <div class="admin-form-stack">
                <p class="text-sm leading-relaxed text-thc-text/80">
                    Updates the header top bar, the <a href="<?php echo e(route('schools.show', $cohs)); ?>#contact" class="admin-link" target="_blank" rel="noopener">landing contact band</a>, and the
                    <a href="<?php echo e(route('schools.pages.show', [$cohs, 'contact-us'])); ?>" class="admin-link" target="_blank" rel="noopener">/cohs/contact-us</a> page.
                </p>

                <div class="admin-field-inset">
                    <p class="admin-field-inset-title">Shared contact details</p>
                    <p class="admin-hint !mt-0">Email and phones appear in the header, landing contact band, and contact page.</p>

                    <?php if (isset($component)) { $__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.ui.group','data' => ['label' => 'Office email','for' => 'email','name' => 'email']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Office email','for' => 'email','name' => 'email']); ?>
                        <input type="email" name="email" id="email" value="<?php echo e(old('email', $contactPage['email'] ?? $contact['email'] ?? $topBar['email'] ?? '')); ?>" required class="admin-input">
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b)): ?>
<?php $attributes = $__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b; ?>
<?php unset($__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b)): ?>
<?php $component = $__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b; ?>
<?php unset($__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b); ?>
<?php endif; ?>

                    <?php if (isset($component)) { $__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.ui.group','data' => ['label' => 'Phone numbers','for' => 'phone_numbers','name' => 'phone_numbers','hint' => 'One display number per line. Used on the contact page and landing band. First number also fills the header if header call is left blank.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Phone numbers','for' => 'phone_numbers','name' => 'phone_numbers','hint' => 'One display number per line. Used on the contact page and landing band. First number also fills the header if header call is left blank.']); ?>
                        <textarea name="phone_numbers" id="phone_numbers" rows="4" required class="admin-textarea"><?php echo e($phoneNumbersText); ?></textarea>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b)): ?>
<?php $attributes = $__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b; ?>
<?php unset($__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b)): ?>
<?php $component = $__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b; ?>
<?php unset($__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b); ?>
<?php endif; ?>

                    <?php if (isset($component)) { $__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.ui.group','data' => ['label' => 'Phone section label','for' => 'phone_row_label','name' => 'phone_row_label','hint' => 'Heading above phone links on the contact page (e.g. Phone).']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Phone section label','for' => 'phone_row_label','name' => 'phone_row_label','hint' => 'Heading above phone links on the contact page (e.g. Phone).']); ?>
                        <input type="text" name="phone_row_label" id="phone_row_label" value="<?php echo e($phoneRowLabel); ?>" required class="admin-input">
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b)): ?>
<?php $attributes = $__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b; ?>
<?php unset($__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b)): ?>
<?php $component = $__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b; ?>
<?php unset($__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b); ?>
<?php endif; ?>
                </div>

                <div class="admin-field-inset">
                    <p class="admin-field-inset-title">Header top bar</p>
                    <p class="admin-hint !mt-0">Shown in the COHS site header. Leave call fields blank to use the first phone number above.</p>

                    <?php if (isset($component)) { $__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.ui.group','data' => ['label' => 'Call label','for' => 'call_prefix','name' => 'call_prefix']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Call label','for' => 'call_prefix','name' => 'call_prefix']); ?>
                        <input type="text" name="call_prefix" id="call_prefix" value="<?php echo e(old('call_prefix', $topBar['call_prefix'] ?? 'Call:')); ?>" class="admin-input">
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b)): ?>
<?php $attributes = $__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b; ?>
<?php unset($__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b)): ?>
<?php $component = $__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b; ?>
<?php unset($__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.ui.group','data' => ['label' => 'Call display','for' => 'call_display','name' => 'call_display']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Call display','for' => 'call_display','name' => 'call_display']); ?>
                        <input type="text" name="call_display" id="call_display" value="<?php echo e(old('call_display', $topBar['call_display'] ?? '')); ?>" class="admin-input" placeholder="e.g. 0736 568 177">
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b)): ?>
<?php $attributes = $__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b; ?>
<?php unset($__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b)): ?>
<?php $component = $__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b; ?>
<?php unset($__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.ui.group','data' => ['label' => 'Tel (dialable)','for' => 'call_tel','name' => 'call_tel','hint' => 'E.164 style, e.g. +254736568177']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Tel (dialable)','for' => 'call_tel','name' => 'call_tel','hint' => 'E.164 style, e.g. +254736568177']); ?>
                        <input type="text" name="call_tel" id="call_tel" value="<?php echo e(old('call_tel', $topBar['call_tel'] ?? '')); ?>" class="admin-input" placeholder="+254…">
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b)): ?>
<?php $attributes = $__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b; ?>
<?php unset($__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b)): ?>
<?php $component = $__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b; ?>
<?php unset($__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b); ?>
<?php endif; ?>
                </div>

                <div class="admin-field-inset">
                    <p class="admin-field-inset-title">Landing contact band (/cohs#contact)</p>

                    <?php if (isset($component)) { $__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.ui.group','data' => ['label' => 'Kicker','for' => 'landing_kicker','name' => 'landing_kicker']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Kicker','for' => 'landing_kicker','name' => 'landing_kicker']); ?>
                        <input type="text" name="landing_kicker" id="landing_kicker" value="<?php echo e(old('landing_kicker', $contact['kicker'] ?? '')); ?>" required class="admin-input">
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b)): ?>
<?php $attributes = $__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b; ?>
<?php unset($__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b)): ?>
<?php $component = $__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b; ?>
<?php unset($__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.ui.group','data' => ['label' => 'Location lines','for' => 'landing_location_lines','name' => 'landing_location_lines','hint' => 'One line per row.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Location lines','for' => 'landing_location_lines','name' => 'landing_location_lines','hint' => 'One line per row.']); ?>
                        <textarea name="landing_location_lines" id="landing_location_lines" rows="4" required class="admin-textarea"><?php echo e(old('landing_location_lines', implode("\n", $contact['location_lines'] ?? []))); ?></textarea>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b)): ?>
<?php $attributes = $__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b; ?>
<?php unset($__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b)): ?>
<?php $component = $__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b; ?>
<?php unset($__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.ui.group','data' => ['label' => 'Office hours / apply notes','for' => 'office_hours_lines','name' => 'office_hours_lines','hint' => 'Optional; one line per row (e.g. intakes, application fee).']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Office hours / apply notes','for' => 'office_hours_lines','name' => 'office_hours_lines','hint' => 'Optional; one line per row (e.g. intakes, application fee).']); ?>
                        <textarea name="office_hours_lines" id="office_hours_lines" rows="4" class="admin-textarea"><?php echo e(old('office_hours_lines', implode("\n", $contact['office_hours_lines'] ?? []))); ?></textarea>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b)): ?>
<?php $attributes = $__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b; ?>
<?php unset($__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b)): ?>
<?php $component = $__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b; ?>
<?php unset($__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b); ?>
<?php endif; ?>

                    <div>
                        <p class="admin-label">Social links</p>
                        <p class="admin-hint !mt-0">Optional. Both label and URL required for each link shown.</p>
                        <?php $__currentLoopData = $socialPairs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $pair): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="admin-grid-2 !gap-3 <?php echo e($idx > 0 ? 'mt-3' : 'mt-2'); ?>">
                                <div>
                                    <label class="sr-only" for="social_label_<?php echo e($idx); ?>">Social label <?php echo e($idx + 1); ?></label>
                                    <input type="text" name="social_label[]" id="social_label_<?php echo e($idx); ?>" value="<?php echo e($pair['label'] ?? ''); ?>" class="admin-input" placeholder="Label (e.g. Facebook)" autocomplete="off">
                                </div>
                                <div>
                                    <label class="sr-only" for="social_url_<?php echo e($idx); ?>">Social URL <?php echo e($idx + 1); ?></label>
                                    <input type="url" name="social_url[]" id="social_url_<?php echo e($idx); ?>" value="<?php echo e($pair['url'] ?? ''); ?>" class="admin-input" placeholder="https://…" autocomplete="off">
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                <div class="admin-field-inset">
                    <p class="admin-field-inset-title">Contact page (/cohs/contact-us)</p>

                    <?php if (isset($component)) { $__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.ui.group','data' => ['label' => 'Hero kicker','for' => 'hero_kicker','name' => 'hero_kicker']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Hero kicker','for' => 'hero_kicker','name' => 'hero_kicker']); ?>
                        <input type="text" name="hero_kicker" id="hero_kicker" value="<?php echo e(old('hero_kicker', $contactPage['hero_kicker'] ?? '')); ?>" required class="admin-input">
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b)): ?>
<?php $attributes = $__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b; ?>
<?php unset($__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b)): ?>
<?php $component = $__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b; ?>
<?php unset($__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b); ?>
<?php endif; ?>
                    <div class="admin-grid-2">
                        <?php if (isset($component)) { $__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.ui.group','data' => ['label' => 'Headline','for' => 'headline','name' => 'headline']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Headline','for' => 'headline','name' => 'headline']); ?>
                            <input type="text" name="headline" id="headline" value="<?php echo e(old('headline', $contactPage['headline'] ?? '')); ?>" required class="admin-input">
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b)): ?>
<?php $attributes = $__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b; ?>
<?php unset($__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b)): ?>
<?php $component = $__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b; ?>
<?php unset($__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.ui.group','data' => ['label' => 'Headline accent (italic)','for' => 'headline_accent','name' => 'headline_accent']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Headline accent (italic)','for' => 'headline_accent','name' => 'headline_accent']); ?>
                            <input type="text" name="headline_accent" id="headline_accent" value="<?php echo e(old('headline_accent', $contactPage['headline_accent'] ?? '')); ?>" class="admin-input">
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b)): ?>
<?php $attributes = $__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b; ?>
<?php unset($__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b)): ?>
<?php $component = $__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b; ?>
<?php unset($__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b); ?>
<?php endif; ?>
                    </div>
                    <?php if (isset($component)) { $__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.ui.group','data' => ['label' => 'Lead paragraph','for' => 'lead','name' => 'lead']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Lead paragraph','for' => 'lead','name' => 'lead']); ?>
                        <textarea name="lead" id="lead" rows="2" required class="admin-textarea"><?php echo e(old('lead', $contactPage['lead'] ?? '')); ?></textarea>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b)): ?>
<?php $attributes = $__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b; ?>
<?php unset($__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b)): ?>
<?php $component = $__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b; ?>
<?php unset($__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.ui.group','data' => ['label' => 'Intro (use :email for mailto placeholder)','for' => 'intro','name' => 'intro']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Intro (use :email for mailto placeholder)','for' => 'intro','name' => 'intro']); ?>
                        <textarea name="intro" id="intro" rows="3" required class="admin-textarea"><?php echo e(old('intro', $contactPage['intro'] ?? '')); ?></textarea>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b)): ?>
<?php $attributes = $__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b; ?>
<?php unset($__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b)): ?>
<?php $component = $__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b; ?>
<?php unset($__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.ui.group','data' => ['label' => 'Office title','for' => 'office_title','name' => 'office_title']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Office title','for' => 'office_title','name' => 'office_title']); ?>
                        <input type="text" name="office_title" id="office_title" value="<?php echo e(old('office_title', $contactPage['office_title'] ?? '')); ?>" required class="admin-input">
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b)): ?>
<?php $attributes = $__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b; ?>
<?php unset($__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b)): ?>
<?php $component = $__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b; ?>
<?php unset($__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.ui.group','data' => ['label' => 'Address lines','for' => 'address_lines','name' => 'address_lines','hint' => 'One line per row on the contact page.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Address lines','for' => 'address_lines','name' => 'address_lines','hint' => 'One line per row on the contact page.']); ?>
                        <textarea name="address_lines" id="address_lines" rows="4" required class="admin-textarea"><?php echo e(old('address_lines', implode("\n", $contactPage['address_lines'] ?? []))); ?></textarea>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b)): ?>
<?php $attributes = $__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b; ?>
<?php unset($__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b)): ?>
<?php $component = $__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b; ?>
<?php unset($__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b); ?>
<?php endif; ?>
                </div>

                <?php if (isset($component)) { $__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.ui.group','data' => ['label' => 'Map embed URL','for' => 'map_embed_url','name' => 'map_embed_url','hint' => 'Shown on the contact page. Leave blank to remove a saved override.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.ui.group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Map embed URL','for' => 'map_embed_url','name' => 'map_embed_url','hint' => 'Shown on the contact page. Leave blank to remove a saved override.']); ?>
                    <input type="url" name="map_embed_url" id="map_embed_url" value="<?php echo e(old('map_embed_url', $mapEmbed)); ?>" class="admin-input" placeholder="https://maps.google.com/...">
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b)): ?>
<?php $attributes = $__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b; ?>
<?php unset($__attributesOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b)): ?>
<?php $component = $__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b; ?>
<?php unset($__componentOriginalcbc1441ea237a3f97b8ab4e98f5e0a4b); ?>
<?php endif; ?>
            </div>
            <div class="admin-actions admin-actions-sticky mt-8">
                <div class="admin-actions-primary">
                    <button type="submit" class="admin-btn-primary">Save</button>
                    <a href="<?php echo e(route('admin.cohs.dashboard')); ?>" class="admin-btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </form>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3)): ?>
<?php $attributes = $__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3; ?>
<?php unset($__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc8c9fd5d7827a77a31381de67195f0c3)): ?>
<?php $component = $__componentOriginalc8c9fd5d7827a77a31381de67195f0c3; ?>
<?php unset($__componentOriginalc8c9fd5d7827a77a31381de67195f0c3); ?>
<?php endif; ?>
<?php /**PATH C:\projects\Tenwek Projects\tenwek-college\resources\views/admin/cohs/landing/contact.blade.php ENDPATH**/ ?>