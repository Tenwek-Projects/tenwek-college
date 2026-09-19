<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'label' => null,
    'for' => null,
    'name' => null,
    'hint' => null,
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'label' => null,
    'for' => null,
    'name' => null,
    'hint' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $hasError = $name !== null && $errors->has($name);
?>

<div
    <?php echo e($attributes->class([
        'admin-form-group',
        'admin-field-invalid' => $hasError,
    ])); ?>

>
    <?php if($label !== null && $for !== null): ?>
        <label class="admin-label" for="<?php echo e($for); ?>"><?php echo e($label); ?></label>
    <?php elseif($label !== null): ?>
        <span class="admin-label"><?php echo e($label); ?></span>
    <?php endif; ?>

    <?php if($hint): ?>
        <p class="admin-hint"><?php echo e($hint); ?></p>
    <?php endif; ?>

    <?php echo e($slot); ?>


    <?php if($name !== null): ?>
        <?php $__errorArgs = [$name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="admin-field-error" role="alert"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    <?php endif; ?>
</div>
<?php /**PATH C:\projects\Tenwek Projects\tenwek-college\resources\views/components/admin/ui/group.blade.php ENDPATH**/ ?>