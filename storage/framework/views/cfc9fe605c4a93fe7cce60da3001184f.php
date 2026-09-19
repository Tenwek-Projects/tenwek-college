<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['item', 'depth' => 0]));

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

foreach (array_filter((['item', 'depth' => 0]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $type = $item['type'] ?? 'link';
?>

<?php if($type === 'branch'): ?>
    <?php
        $branchActive = \App\Support\Admin\AdminNav::anyChildActive($item['children']);
    ?>
    <details class="admin-sidebar-details group/branch" <?php if($branchActive): ?> open <?php endif; ?>>
        <summary
            class="admin-sidebar-branch <?php echo e($branchActive ? 'admin-sidebar-link-active' : ''); ?>"
            title="<?php echo e($item['label']); ?>"
        >
            <?php if (isset($component)) { $__componentOriginal5e1d811772e402d480949a6de4558d7a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5e1d811772e402d480949a6de4558d7a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.nav-icon','data' => ['name' => $item['icon'],'class' => 'h-5 w-5 shrink-0 opacity-90']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.nav-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item['icon']),'class' => 'h-5 w-5 shrink-0 opacity-90']); ?>
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
            <span class="min-w-0 flex-1 truncate text-left font-medium" x-show="!sidebarCollapsed" x-transition.opacity><?php echo e($item['label']); ?></span>
            <?php if (isset($component)) { $__componentOriginal5e1d811772e402d480949a6de4558d7a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5e1d811772e402d480949a6de4558d7a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.nav-icon','data' => ['name' => 'chevron-down','class' => 'admin-sidebar-chevron h-4 w-4 shrink-0 opacity-60 transition-transform duration-200','xShow' => '!sidebarCollapsed']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.nav-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'chevron-down','class' => 'admin-sidebar-chevron h-4 w-4 shrink-0 opacity-60 transition-transform duration-200','x-show' => '!sidebarCollapsed']); ?>
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
        </summary>
        <div class="ml-2 space-y-0.5 border-l border-white/[0.08] pl-2 pt-0.5">
            <?php $__currentLoopData = $item['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if (isset($component)) { $__componentOriginalb5c2a3aeb2248a2f83cda6ecb1422deb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb5c2a3aeb2248a2f83cda6ecb1422deb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.sidebar-nav-item','data' => ['item' => $child,'depth' => $depth + 1]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.sidebar-nav-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['item' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($child),'depth' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($depth + 1)]); ?>
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
    </details>
<?php elseif($type === 'disabled'): ?>
    <span
        class="admin-sidebar-link admin-sidebar-link-disabled"
        title="<?php echo e($item['title'] ?? ''); ?>"
        role="button"
        tabindex="0"
    >
        <?php if (isset($component)) { $__componentOriginal5e1d811772e402d480949a6de4558d7a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5e1d811772e402d480949a6de4558d7a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.nav-icon','data' => ['name' => $item['icon'],'class' => 'h-5 w-5 shrink-0 opacity-50']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.nav-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item['icon']),'class' => 'h-5 w-5 shrink-0 opacity-50']); ?>
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
        <span class="min-w-0 flex-1 truncate" x-show="!sidebarCollapsed" x-transition.opacity><?php echo e($item['label']); ?></span>
        <span class="admin-sidebar-soon-pill" x-show="!sidebarCollapsed" x-transition.opacity>Soon</span>
    </span>
<?php else: ?>
    <?php
        $active = \App\Support\Admin\AdminNav::isActive($item);
        $external = ! empty($item['external']);
    ?>
    <a
        href="<?php echo e($item['href']); ?>"
        <?php if($external): ?> target="_blank" rel="noopener noreferrer" <?php endif; ?>
        @click="closeMobileSidebar()"
        class="admin-sidebar-link <?php echo e($active ? 'admin-sidebar-link-active' : ''); ?>"
        <?php if($active): ?> aria-current="page" <?php endif; ?>
        title="<?php echo e($item['label']); ?>"
    >
        <?php if (isset($component)) { $__componentOriginal5e1d811772e402d480949a6de4558d7a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5e1d811772e402d480949a6de4558d7a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.nav-icon','data' => ['name' => $item['icon'],'class' => 'h-5 w-5 shrink-0 opacity-90']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.nav-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item['icon']),'class' => 'h-5 w-5 shrink-0 opacity-90']); ?>
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
        <span class="min-w-0 flex-1 truncate font-medium" x-show="!sidebarCollapsed" x-transition.opacity><?php echo e($item['label']); ?></span>
        <?php if($external): ?>
            <?php if (isset($component)) { $__componentOriginal5e1d811772e402d480949a6de4558d7a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5e1d811772e402d480949a6de4558d7a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.nav-icon','data' => ['name' => 'arrow-top-right-on-square','class' => 'h-3.5 w-3.5 shrink-0 opacity-40','xShow' => '!sidebarCollapsed']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.nav-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'arrow-top-right-on-square','class' => 'h-3.5 w-3.5 shrink-0 opacity-40','x-show' => '!sidebarCollapsed']); ?>
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
        <?php endif; ?>
    </a>
<?php endif; ?>
<?php /**PATH C:\projects\Tenwek Projects\tenwek-college\resources\views/components/admin/sidebar-nav-item.blade.php ENDPATH**/ ?>