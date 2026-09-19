<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['seo']));

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

foreach (array_filter((['seo']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<title><?php echo e($seo['title']); ?></title>
<meta name="description" content="<?php echo e($seo['description']); ?>">
<?php if(!empty($seo['keywords'])): ?>
    <meta name="keywords" content="<?php echo e(is_array($seo['keywords']) ? implode(', ', $seo['keywords']) : $seo['keywords']); ?>">
<?php endif; ?>
<meta name="robots" content="<?php echo e($seo['robots']); ?>">
<link rel="canonical" href="<?php echo e($seo['canonical']); ?>">

<meta property="og:type" content="<?php echo e($seo['og']['type']); ?>">
<meta property="og:title" content="<?php echo e($seo['og']['title']); ?>">
<meta property="og:description" content="<?php echo e($seo['og']['description']); ?>">
<meta property="og:image" content="<?php echo e($seo['og']['image']); ?>">
<meta property="og:url" content="<?php echo e($seo['og']['url']); ?>">
<meta property="og:site_name" content="<?php echo e($seo['og']['site_name']); ?>">
<meta property="og:locale" content="<?php echo e($seo['og']['locale']); ?>">

<meta name="twitter:card" content="<?php echo e($seo['twitter']['card']); ?>">
<meta name="twitter:title" content="<?php echo e($seo['twitter']['title']); ?>">
<meta name="twitter:description" content="<?php echo e($seo['twitter']['description']); ?>">
<meta name="twitter:image" content="<?php echo e($seo['twitter']['image']); ?>">

<?php if(config('tenwek.geo.latitude') && config('tenwek.geo.longitude')): ?>
    <meta name="geo.region" content="<?php echo e(config('tenwek.address.country')); ?>">
    <meta name="geo.placename" content="<?php echo e(config('tenwek.address.locality')); ?>">
    <meta name="geo.position" content="<?php echo e(config('tenwek.geo.latitude')); ?>;<?php echo e(config('tenwek.geo.longitude')); ?>">
    <meta name="ICBM" content="<?php echo e(config('tenwek.geo.latitude')); ?>, <?php echo e(config('tenwek.geo.longitude')); ?>">
<?php endif; ?>

<?php $__currentLoopData = $seo['json_ld']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $block): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <script type="application/ld+json"><?php echo json_encode($block, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR); ?></script>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH C:\projects\Tenwek Projects\tenwek-college\resources\views/components/seo.blade.php ENDPATH**/ ?>