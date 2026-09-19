<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'header' => 'Dashboard',
    'breadcrumbs' => null,
    'pageHint' => null,
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
    'header' => 'Dashboard',
    'breadcrumbs' => null,
    'pageHint' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $user = auth()->user();
    $soc = \App\Models\School::query()->where('slug', 'soc')->first();
    $cohs = \App\Models\School::query()->where('slug', 'cohs')->first();
    $managesSoc = $soc && $user->managesSchool($soc);
    $parts = array_values(array_filter(preg_split('/\s+/', trim((string) ($user->name ?? ''))) ?: []));
    $initials = strtoupper(
        count($parts) >= 2
            ? mb_substr($parts[0], 0, 1).mb_substr($parts[count($parts) - 1], 0, 1)
            : (mb_substr($parts[0] ?? 'A', 0, 2) ?: 'A'),
    );
    $adminDd = fn (bool $active): string => $active ? 'admin-dropdown-item admin-dropdown-item--active' : 'admin-dropdown-item';
    $isMainDashboard = request()->routeIs('admin.dashboard');
    $isSocCms = request()->routeIs('admin.soc.*') && ! request()->routeIs('admin.soc.media.*');
    $isSocMedia = request()->routeIs('admin.soc.media.*');
    $isNewDownload = request()->routeIs('admin.downloads.create');
    $boundDownload = request()->route('download');
    $isCohsDownloads = request()->routeIs('admin.downloads.*')
        && (request()->query('school') === 'cohs'
            || ($boundDownload instanceof \App\Models\Download && $boundDownload->school?->slug === 'cohs'));
?>

<header
    class="admin-topbar z-20 flex min-h-14 shrink-0 flex-wrap items-center gap-3 border-b border-thc-navy/[0.08] bg-white/80 px-3 py-2 shadow-sm backdrop-blur-md sm:px-4 lg:px-6"
>
    <button
        type="button"
        class="inline-flex rounded-lg p-2 text-thc-navy/90 transition hover:bg-thc-navy/[0.05] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-thc-royal lg:hidden"
        @click="sidebarOpen = true"
        aria-controls="admin-sidebar"
        aria-label="Open sidebar"
    >
        <?php if (isset($component)) { $__componentOriginal5e1d811772e402d480949a6de4558d7a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5e1d811772e402d480949a6de4558d7a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.nav-icon','data' => ['name' => 'bars-3','class' => 'h-6 w-6 text-thc-navy']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.nav-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'bars-3','class' => 'h-6 w-6 text-thc-navy']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5e1d811772e402d480949a6de4558d7a)): ?>
<?php $attributes = $__attributesOriginal5e1d811772e402d480949a6de4558d7a; ?>
<?php unset($__attributesOriginal5e1d811772e402d480949a6de4558d7a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5e1d811772e402d480949a6de4558d7a)): ?>
<?php $component = $__componentOriginal5e1d811772e402d480949a6de4558d7a; ?>
<?php unset($__componentOriginal5e1d811772e402d480949a6de4558d7a); ?>
<?php endif; ?>
    </button>

    <div class="min-w-0 flex-1">
        <?php if(is_array($breadcrumbs) && count($breadcrumbs) > 0): ?>
            <nav class="text-xs text-thc-text/60" aria-label="Breadcrumb">
                <ol class="flex flex-wrap items-center gap-x-1.5 gap-y-1">
                    <?php $__currentLoopData = $breadcrumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $crumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="flex items-center gap-1.5">
                            <?php if($i > 0): ?>
                                <span class="text-thc-navy/25" aria-hidden="true">/</span>
                            <?php endif; ?>
                            <?php if(! empty($crumb['href']) && $i < count($breadcrumbs) - 1): ?>
                                <a href="<?php echo e($crumb['href']); ?>" class="font-medium text-thc-royal hover:underline"><?php echo e($crumb['label']); ?></a>
                            <?php else: ?>
                                <span class="font-semibold text-thc-navy"><?php echo e($crumb['label']); ?></span>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ol>
            </nav>
        <?php endif; ?>
        <div class="<?php echo \Illuminate\Support\Arr::toCssClasses([
            'flex min-w-0 items-center gap-2',
            'mt-0.5' => is_array($breadcrumbs) && count($breadcrumbs) > 0,
        ]); ?>">
            <h1 class="min-w-0 truncate text-base font-semibold text-thc-navy sm:text-lg"><?php echo e($header); ?></h1>
            <?php if(filled($pageHint)): ?>
                <?php if (isset($component)) { $__componentOriginal124b863cdc6175dc37a45f36f07eb26d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal124b863cdc6175dc37a45f36f07eb26d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.page-hint','data' => ['text' => $pageHint]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.page-hint'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($pageHint)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal124b863cdc6175dc37a45f36f07eb26d)): ?>
<?php $attributes = $__attributesOriginal124b863cdc6175dc37a45f36f07eb26d; ?>
<?php unset($__attributesOriginal124b863cdc6175dc37a45f36f07eb26d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal124b863cdc6175dc37a45f36f07eb26d)): ?>
<?php $component = $__componentOriginal124b863cdc6175dc37a45f36f07eb26d; ?>
<?php unset($__componentOriginal124b863cdc6175dc37a45f36f07eb26d); ?>
<?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

    <form action="<?php echo e(route('admin.search')); ?>" method="get" class="hidden max-w-[14rem] flex-1 items-center gap-2 rounded-xl border border-thc-navy/12 bg-white/90 px-2 py-1.5 shadow-sm sm:flex lg:max-w-xs" role="search">
        <?php if (isset($component)) { $__componentOriginal5e1d811772e402d480949a6de4558d7a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5e1d811772e402d480949a6de4558d7a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.nav-icon','data' => ['name' => 'magnifying-glass','class' => 'h-4 w-4 text-thc-text/45']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.nav-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'magnifying-glass','class' => 'h-4 w-4 text-thc-text/45']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5e1d811772e402d480949a6de4558d7a)): ?>
<?php $attributes = $__attributesOriginal5e1d811772e402d480949a6de4558d7a; ?>
<?php unset($__attributesOriginal5e1d811772e402d480949a6de4558d7a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5e1d811772e402d480949a6de4558d7a)): ?>
<?php $component = $__componentOriginal5e1d811772e402d480949a6de4558d7a; ?>
<?php unset($__componentOriginal5e1d811772e402d480949a6de4558d7a); ?>
<?php endif; ?>
        <input
            type="search"
            name="q"
            value="<?php echo e(request()->routeIs('admin.search') ? request('q') : ''); ?>"
            placeholder="<?php echo e(__('Search admin…')); ?>"
            class="min-w-0 flex-1 border-0 bg-transparent text-sm text-thc-navy placeholder:text-thc-text/40 focus:ring-0"
            autocomplete="off"
            aria-label="<?php echo e(__('Search admin')); ?>"
        />
        <kbd class="hidden rounded border border-thc-navy/15 bg-thc-navy/[0.03] px-1.5 py-0.5 text-[10px] font-medium text-thc-text/50 lg:inline">/</kbd>
    </form>

    <div class="ml-auto flex items-center gap-1 sm:gap-2">
        <button
            type="button"
            class="rounded-lg p-2 text-thc-navy/70 transition hover:bg-thc-navy/[0.05] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-thc-royal"
            title="Notifications - coming soon"
            disabled
            aria-disabled="true"
        >
            <?php if (isset($component)) { $__componentOriginal5e1d811772e402d480949a6de4558d7a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5e1d811772e402d480949a6de4558d7a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.nav-icon','data' => ['name' => 'bell','class' => 'h-5 w-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.nav-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'bell','class' => 'h-5 w-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5e1d811772e402d480949a6de4558d7a)): ?>
<?php $attributes = $__attributesOriginal5e1d811772e402d480949a6de4558d7a; ?>
<?php unset($__attributesOriginal5e1d811772e402d480949a6de4558d7a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5e1d811772e402d480949a6de4558d7a)): ?>
<?php $component = $__componentOriginal5e1d811772e402d480949a6de4558d7a; ?>
<?php unset($__componentOriginal5e1d811772e402d480949a6de4558d7a); ?>
<?php endif; ?>
        </button>

        <div class="relative" x-data="{ open: false }" @keydown.escape.window="open = false">
            <button
                type="button"
                class="inline-flex items-center gap-1 rounded-lg border border-thc-navy/10 bg-thc-navy/[0.03] px-2 py-1.5 text-xs font-semibold text-thc-navy transition hover:bg-thc-navy/[0.06] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-thc-royal"
                @click="open = !open"
                aria-haspopup="true"
                :aria-expanded="open.toString()"
            >
                <?php if (isset($component)) { $__componentOriginal5e1d811772e402d480949a6de4558d7a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5e1d811772e402d480949a6de4558d7a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.nav-icon','data' => ['name' => 'plus','class' => 'h-4 w-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.nav-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'plus','class' => 'h-4 w-4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5e1d811772e402d480949a6de4558d7a)): ?>
<?php $attributes = $__attributesOriginal5e1d811772e402d480949a6de4558d7a; ?>
<?php unset($__attributesOriginal5e1d811772e402d480949a6de4558d7a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5e1d811772e402d480949a6de4558d7a)): ?>
<?php $component = $__componentOriginal5e1d811772e402d480949a6de4558d7a; ?>
<?php unset($__componentOriginal5e1d811772e402d480949a6de4558d7a); ?>
<?php endif; ?>
                <span class="hidden sm:inline">Quick</span>
                <?php if (isset($component)) { $__componentOriginal5e1d811772e402d480949a6de4558d7a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5e1d811772e402d480949a6de4558d7a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.nav-icon','data' => ['name' => 'chevron-down','class' => 'h-3.5 w-3.5 opacity-60']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.nav-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'chevron-down','class' => 'h-3.5 w-3.5 opacity-60']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5e1d811772e402d480949a6de4558d7a)): ?>
<?php $attributes = $__attributesOriginal5e1d811772e402d480949a6de4558d7a; ?>
<?php unset($__attributesOriginal5e1d811772e402d480949a6de4558d7a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5e1d811772e402d480949a6de4558d7a)): ?>
<?php $component = $__componentOriginal5e1d811772e402d480949a6de4558d7a; ?>
<?php unset($__componentOriginal5e1d811772e402d480949a6de4558d7a); ?>
<?php endif; ?>
            </button>
            <div
                x-show="open"
                x-cloak
                @click.outside="open = false"
                x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                class="absolute right-0 z-50 mt-2 w-56 origin-top-right rounded-xl border border-thc-navy/10 bg-white py-1 shadow-lg ring-1 ring-black/5"
                role="menu"
            >
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="<?php echo e($adminDd($isMainDashboard)); ?>" role="menuitem" @click="open = false" <?php if($isMainDashboard): ?> aria-current="page" <?php endif; ?>>Main dashboard</a>
                <?php if($managesSoc): ?>
                    <a href="<?php echo e(route('admin.soc.dashboard')); ?>" class="<?php echo e($adminDd($isSocCms)); ?>" role="menuitem" @click="open = false" <?php if($isSocCms): ?> aria-current="page" <?php endif; ?>>SOC dashboard</a>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', App\Models\Download::class)): ?>
                    <a href="<?php echo e(route('admin.downloads.create')); ?>" class="<?php echo e($adminDd($isNewDownload)); ?>" role="menuitem" @click="open = false" <?php if($isNewDownload): ?> aria-current="page" <?php endif; ?>>New download</a>
                <?php endif; ?>
                <?php if($cohs && ($user->hasRole('super_admin') || $user->hasRole('cohs_admin'))): ?>
                    <a href="<?php echo e(route('admin.downloads.index', ['school' => 'cohs'])); ?>" class="<?php echo e($adminDd($isCohsDownloads)); ?>" role="menuitem" @click="open = false" <?php if($isCohsDownloads): ?> aria-current="page" <?php endif; ?>>COHS downloads</a>
                <?php endif; ?>
            </div>
        </div>

        <div class="relative" x-data="{ profileOpen: false }" @keydown.escape.window="profileOpen = false">
            <button
                type="button"
                class="flex items-center gap-2 rounded-full border border-thc-navy/10 bg-white py-1 pl-1 pr-2 shadow-sm transition hover:border-thc-royal/35 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-thc-royal"
                @click="profileOpen = !profileOpen"
                aria-haspopup="true"
                :aria-expanded="profileOpen.toString()"
                aria-label="Account menu"
            >
                <span class="flex h-8 w-8 items-center justify-center rounded-full bg-gradient-to-br from-thc-navy to-thc-royal text-xs font-bold text-white"><?php echo e($initials); ?></span>
                <?php if (isset($component)) { $__componentOriginal5e1d811772e402d480949a6de4558d7a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5e1d811772e402d480949a6de4558d7a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.nav-icon','data' => ['name' => 'chevron-down','class' => 'hidden h-3.5 w-3.5 text-thc-navy/50 sm:block']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.nav-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'chevron-down','class' => 'hidden h-3.5 w-3.5 text-thc-navy/50 sm:block']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5e1d811772e402d480949a6de4558d7a)): ?>
<?php $attributes = $__attributesOriginal5e1d811772e402d480949a6de4558d7a; ?>
<?php unset($__attributesOriginal5e1d811772e402d480949a6de4558d7a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5e1d811772e402d480949a6de4558d7a)): ?>
<?php $component = $__componentOriginal5e1d811772e402d480949a6de4558d7a; ?>
<?php unset($__componentOriginal5e1d811772e402d480949a6de4558d7a); ?>
<?php endif; ?>
            </button>
            <div
                x-show="profileOpen"
                x-cloak
                @click.outside="profileOpen = false"
                x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                class="absolute right-0 z-50 mt-2 w-64 origin-top-right rounded-xl border border-thc-navy/10 bg-white py-1 shadow-lg ring-1 ring-black/5"
                role="menu"
            >
                <p class="border-b border-thc-navy/8 px-3 py-2 text-xs text-thc-text/70">
                    Signed in as<br />
                    <span class="font-semibold text-thc-navy"><?php echo e($user->email); ?></span>
                </p>
                <a href="<?php echo e(route('home')); ?>" class="<?php echo e($adminDd(request()->routeIs('home'))); ?>" role="menuitem" @click="profileOpen = false" <?php if(request()->routeIs('home')): ?> aria-current="page" <?php endif; ?>>Website preview</a>
                <?php if($managesSoc): ?>
                    <a href="<?php echo e(route('admin.soc.dashboard')); ?>" class="<?php echo e($adminDd($isSocCms)); ?>" role="menuitem" @click="profileOpen = false" <?php if($isSocCms): ?> aria-current="page" <?php endif; ?>>Manage SOC</a>
                    <a href="<?php echo e(route('admin.soc.media.index')); ?>" class="<?php echo e($adminDd($isSocMedia)); ?>" role="menuitem" @click="profileOpen = false" <?php if($isSocMedia): ?> aria-current="page" <?php endif; ?>>Media library</a>
                <?php endif; ?>
                <?php if($cohs && ($user->hasRole('super_admin') || $user->hasRole('cohs_admin'))): ?>
                    <a href="<?php echo e(route('admin.downloads.index', ['school' => 'cohs'])); ?>" class="<?php echo e($adminDd($isCohsDownloads)); ?>" role="menuitem" @click="profileOpen = false" <?php if($isCohsDownloads): ?> aria-current="page" <?php endif; ?>>Manage COHS downloads</a>
                    <a href="<?php echo e(route('schools.show', $cohs)); ?>" class="<?php echo e($adminDd(request()->routeIs('schools.show') && request()->route('school')?->is($cohs))); ?>" role="menuitem" rel="noopener" target="_blank" @click="profileOpen = false" <?php if(request()->routeIs('schools.show') && request()->route('school')?->is($cohs)): ?> aria-current="page" <?php endif; ?>>Preview COHS site</a>
                <?php endif; ?>
                <span class="admin-dropdown-item cursor-not-allowed opacity-50" role="menuitem" title="Coming soon">My account</span>
                <span class="admin-dropdown-item cursor-not-allowed opacity-50" role="menuitem" title="Coming soon">Settings</span>
                <div class="my-1 border-t border-thc-navy/8"></div>
                <form method="post" action="<?php echo e(route('logout')); ?>" role="none">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="admin-dropdown-item w-full text-left text-thc-maroon hover:bg-red-50" role="menuitem">Sign out</button>
                </form>
            </div>
        </div>
    </div>
</header>
<?php /**PATH C:\projects\Tenwek Projects\tenwek-college\resources\views/components/admin/topbar.blade.php ENDPATH**/ ?>