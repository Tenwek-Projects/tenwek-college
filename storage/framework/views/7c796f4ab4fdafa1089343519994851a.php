<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['adminNavGroups' => []]));

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

foreach (array_filter((['adminNavGroups' => []]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $groups = $adminNavGroups;
?>

<aside
    id="admin-sidebar"
    class="admin-sidebar fixed inset-y-0 left-0 z-30 flex max-h-dvh min-h-0 flex-col border-r border-white/[0.08] bg-[var(--admin-sidebar-bg)] text-white/90 shadow-xl transition-[width,transform] duration-200 motion-reduce:transition-none lg:static lg:h-dvh lg:max-h-dvh lg:min-h-0 lg:shrink-0 lg:shadow-none"
    :class="[
        sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0',
        sidebarCollapsed ? 'lg:w-[4.25rem]' : 'lg:w-64',
        'w-64',
    ]"
    aria-label="Admin navigation"
>
    <div class="flex h-14 shrink-0 items-center gap-2 border-b border-white/[0.08] px-3">
        <a
            href="<?php echo e(route('admin.dashboard')); ?>"
            class="flex min-w-0 flex-1 items-center gap-2 rounded-lg px-1 py-1 text-sm font-semibold tracking-tight text-white transition hover:bg-white/[0.06] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-thc-royal"
            @click="closeMobileSidebar()"
        >
            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-thc-royal/25 text-xs font-bold text-white">THC</span>
            <span class="truncate" x-show="!sidebarCollapsed" x-transition.opacity><?php echo e(config('tenwek.name')); ?></span>
        </a>
        <button
            type="button"
            class="hidden rounded-lg p-2 text-white/70 transition hover:bg-white/[0.06] hover:text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-thc-royal lg:inline-flex"
            @click="toggleSidebarCollapse()"
            :aria-expanded="(!sidebarCollapsed).toString()"
            aria-controls="admin-sidebar"
            title="Collapse sidebar"
        >
            <?php if (isset($component)) { $__componentOriginal5e1d811772e402d480949a6de4558d7a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5e1d811772e402d480949a6de4558d7a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.nav-icon','data' => ['name' => 'bars-3-center-left','class' => 'h-5 w-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.nav-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'bars-3-center-left','class' => 'h-5 w-5']); ?>
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
        <button
            type="button"
            class="rounded-lg p-2 text-white/70 transition hover:bg-white/[0.06] hover:text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-thc-royal lg:hidden"
            @click="sidebarOpen = false"
            aria-label="Close sidebar"
        >
            <span class="text-lg leading-none" aria-hidden="true">×</span>
        </button>
    </div>

    <nav class="min-h-0 flex-1 space-y-6 overflow-y-auto overscroll-y-contain px-2 py-4 text-sm" aria-label="Sections">
        <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="space-y-1">
                <p class="admin-sidebar-group-label" x-show="!sidebarCollapsed" x-transition.opacity><?php echo e($group['label']); ?></p>
                <?php $__currentLoopData = $group['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if (isset($component)) { $__componentOriginalb5c2a3aeb2248a2f83cda6ecb1422deb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb5c2a3aeb2248a2f83cda6ecb1422deb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.sidebar-nav-item','data' => ['item' => $item]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.sidebar-nav-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['item' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb5c2a3aeb2248a2f83cda6ecb1422deb)): ?>
<?php $attributes = $__attributesOriginalb5c2a3aeb2248a2f83cda6ecb1422deb; ?>
<?php unset($__attributesOriginalb5c2a3aeb2248a2f83cda6ecb1422deb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb5c2a3aeb2248a2f83cda6ecb1422deb)): ?>
<?php $component = $__componentOriginalb5c2a3aeb2248a2f83cda6ecb1422deb; ?>
<?php unset($__componentOriginalb5c2a3aeb2248a2f83cda6ecb1422deb); ?>
<?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </nav>

    <div class="shrink-0 border-t border-white/[0.08] p-3">
        <div class="flex items-center gap-2 rounded-xl bg-white/[0.04] px-2 py-2 ring-1 ring-inset ring-white/[0.06]">
            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-thc-royal/30 text-xs font-bold text-white" aria-hidden="true">
                <?php echo e(strtoupper(\Illuminate\Support\Str::substr(auth()->user()->name ?? '?', 0, 1))); ?>

            </span>
            <div class="min-w-0 flex-1" x-show="!sidebarCollapsed" x-transition.opacity>
                <p class="truncate text-xs font-semibold text-white"><?php echo e(auth()->user()->name); ?></p>
                <p class="truncate text-[11px] text-white/45"><?php echo e(auth()->user()->email); ?></p>
            </div>
        </div>
    </div>
</aside>
<?php /**PATH C:\projects\Tenwek Projects\tenwek-college\resources\views/components/admin/sidebar.blade.php ENDPATH**/ ?>