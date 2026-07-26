<nav x-data="{ open: false, anggotaOpen: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto flex items-center justify-between px-4 py-3 sm:py-4">

        <!-- Sidebar Desktop -->
        <aside class="hidden lg:flex min-h-screen bg-gray-50 w-64 flex-col fixed inset-y-0 left-0 p-4 border-r overflow-auto z-40">
            <!-- Logo -->
            <div class="h-16 flex items-center justify-center border-b mb-4">
                <a href="<?php echo e(route('admin.dashboard')); ?>">
                    <?php if (isset($component)) { $__componentOriginal8892e718f3d0d7a916180885c6f012e7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8892e718f3d0d7a916180885c6f012e7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.application-logo','data' => ['class' => 'h-9 w-auto text-gray-800']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('application-logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'h-9 w-auto text-gray-800']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8892e718f3d0d7a916180885c6f012e7)): ?>
<?php $attributes = $__attributesOriginal8892e718f3d0d7a916180885c6f012e7; ?>
<?php unset($__attributesOriginal8892e718f3d0d7a916180885c6f012e7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8892e718f3d0d7a916180885c6f012e7)): ?>
<?php $component = $__componentOriginal8892e718f3d0d7a916180885c6f012e7; ?>
<?php unset($__componentOriginal8892e718f3d0d7a916180885c6f012e7); ?>
<?php endif; ?>
                </a>
            </div>

            <nav class="flex-grow space-y-2">
                <?php if (isset($component)) { $__componentOriginalc295f12dca9d42f28a259237a5724830 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc295f12dca9d42f28a259237a5724830 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav-link','data' => ['href' => route('admin.dashboard'),'active' => request()->routeIs('admin.dashboard'),'class' => 'flex items-center transition-all']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.dashboard')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('admin.dashboard')),'class' => 'flex items-center transition-all']); ?>
                    <?php if (isset($component)) { $__componentOriginalab5a3274c8304fdbf412b1944751c00e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalab5a3274c8304fdbf412b1944751c00e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon.dashboard-icon','data' => ['class' => 'w-5 h-5 mr-2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon.dashboard-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5 mr-2']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalab5a3274c8304fdbf412b1944751c00e)): ?>
<?php $attributes = $__attributesOriginalab5a3274c8304fdbf412b1944751c00e; ?>
<?php unset($__attributesOriginalab5a3274c8304fdbf412b1944751c00e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalab5a3274c8304fdbf412b1944751c00e)): ?>
<?php $component = $__componentOriginalab5a3274c8304fdbf412b1944751c00e; ?>
<?php unset($__componentOriginalab5a3274c8304fdbf412b1944751c00e); ?>
<?php endif; ?>
                    <span class="ml-4">Dashboard</span>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc295f12dca9d42f28a259237a5724830)): ?>
<?php $attributes = $__attributesOriginalc295f12dca9d42f28a259237a5724830; ?>
<?php unset($__attributesOriginalc295f12dca9d42f28a259237a5724830); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc295f12dca9d42f28a259237a5724830)): ?>
<?php $component = $__componentOriginalc295f12dca9d42f28a259237a5724830; ?>
<?php unset($__componentOriginalc295f12dca9d42f28a259237a5724830); ?>
<?php endif; ?>

                <!-- Dropdown Anggota -->
                <div>
                    <button @click="anggotaOpen = !anggotaOpen"
                        class="flex items-center w-full px-4 py-2 hover:bg-gray-100 rounded-md transition">
                        <?php if (isset($component)) { $__componentOriginal218c5c64b059a605cc15629404be144b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal218c5c64b059a605cc15629404be144b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon.user','data' => ['class' => 'w-5 h-5 mr-2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon.user'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5 mr-2']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal218c5c64b059a605cc15629404be144b)): ?>
<?php $attributes = $__attributesOriginal218c5c64b059a605cc15629404be144b; ?>
<?php unset($__attributesOriginal218c5c64b059a605cc15629404be144b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal218c5c64b059a605cc15629404be144b)): ?>
<?php $component = $__componentOriginal218c5c64b059a605cc15629404be144b; ?>
<?php unset($__componentOriginal218c5c64b059a605cc15629404be144b); ?>
<?php endif; ?>
                        <span class="flex-1 text-left ml-4">Anggota</span>
                        <svg class="w-4 h-4 transform transition-transform duration-200" :class="{ 'rotate-180': anggotaOpen }"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="anggotaOpen" x-transition class="ml-8 space-y-1">
                        <?php if (isset($component)) { $__componentOriginalc295f12dca9d42f28a259237a5724830 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc295f12dca9d42f28a259237a5724830 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav-link','data' => ['href' => route('anggota.guru'),'active' => request()->routeIs('anggota.guru'),'class' => 'flex items-center']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('anggota.guru')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('anggota.guru')),'class' => 'flex items-center']); ?>
                            <span>Guru</span>
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc295f12dca9d42f28a259237a5724830)): ?>
<?php $attributes = $__attributesOriginalc295f12dca9d42f28a259237a5724830; ?>
<?php unset($__attributesOriginalc295f12dca9d42f28a259237a5724830); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc295f12dca9d42f28a259237a5724830)): ?>
<?php $component = $__componentOriginalc295f12dca9d42f28a259237a5724830; ?>
<?php unset($__componentOriginalc295f12dca9d42f28a259237a5724830); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginalc295f12dca9d42f28a259237a5724830 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc295f12dca9d42f28a259237a5724830 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav-link','data' => ['href' => route('anggota.siswa'),'active' => request()->routeIs('anggota.siswa'),'class' => 'flex items-center']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('anggota.siswa')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('anggota.siswa')),'class' => 'flex items-center']); ?>
                            <span>Siswa</span>
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc295f12dca9d42f28a259237a5724830)): ?>
<?php $attributes = $__attributesOriginalc295f12dca9d42f28a259237a5724830; ?>
<?php unset($__attributesOriginalc295f12dca9d42f28a259237a5724830); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc295f12dca9d42f28a259237a5724830)): ?>
<?php $component = $__componentOriginalc295f12dca9d42f28a259237a5724830; ?>
<?php unset($__componentOriginalc295f12dca9d42f28a259237a5724830); ?>
<?php endif; ?>
                    </div>
                </div>

                <?php if (isset($component)) { $__componentOriginalc295f12dca9d42f28a259237a5724830 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc295f12dca9d42f28a259237a5724830 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav-link','data' => ['href' => route('admin.buku.index'),'active' => request()->routeIs('admin.buku.*'),'class' => 'flex items-center']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.buku.index')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('admin.buku.*')),'class' => 'flex items-center']); ?>
                    <?php if (isset($component)) { $__componentOriginal39ba4ac878ceeed5a4f4cfe9bf770e4f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal39ba4ac878ceeed5a4f4cfe9bf770e4f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon.book','data' => ['class' => 'w-5 h-5 mr-2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon.book'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5 mr-2']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal39ba4ac878ceeed5a4f4cfe9bf770e4f)): ?>
<?php $attributes = $__attributesOriginal39ba4ac878ceeed5a4f4cfe9bf770e4f; ?>
<?php unset($__attributesOriginal39ba4ac878ceeed5a4f4cfe9bf770e4f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal39ba4ac878ceeed5a4f4cfe9bf770e4f)): ?>
<?php $component = $__componentOriginal39ba4ac878ceeed5a4f4cfe9bf770e4f; ?>
<?php unset($__componentOriginal39ba4ac878ceeed5a4f4cfe9bf770e4f); ?>
<?php endif; ?>
                    <span class="ml-4">Buku</span>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc295f12dca9d42f28a259237a5724830)): ?>
<?php $attributes = $__attributesOriginalc295f12dca9d42f28a259237a5724830; ?>
<?php unset($__attributesOriginalc295f12dca9d42f28a259237a5724830); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc295f12dca9d42f28a259237a5724830)): ?>
<?php $component = $__componentOriginalc295f12dca9d42f28a259237a5724830; ?>
<?php unset($__componentOriginalc295f12dca9d42f28a259237a5724830); ?>
<?php endif; ?>

                <?php if (isset($component)) { $__componentOriginalc295f12dca9d42f28a259237a5724830 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc295f12dca9d42f28a259237a5724830 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav-link','data' => ['href' => route('admin.peminjaman.index'),'active' => request()->routeIs('admin.peminjaman.*'),'class' => 'flex items-center']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.peminjaman.index')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('admin.peminjaman.*')),'class' => 'flex items-center']); ?>
                    <?php if (isset($component)) { $__componentOriginal78401f3e2385b5fdffa95e016607311b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal78401f3e2385b5fdffa95e016607311b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon.calendar','data' => ['class' => 'w-5 h-5 mr-2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon.calendar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5 mr-2']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal78401f3e2385b5fdffa95e016607311b)): ?>
<?php $attributes = $__attributesOriginal78401f3e2385b5fdffa95e016607311b; ?>
<?php unset($__attributesOriginal78401f3e2385b5fdffa95e016607311b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal78401f3e2385b5fdffa95e016607311b)): ?>
<?php $component = $__componentOriginal78401f3e2385b5fdffa95e016607311b; ?>
<?php unset($__componentOriginal78401f3e2385b5fdffa95e016607311b); ?>
<?php endif; ?>
                    <span class="ml-4">Peminjaman</span>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc295f12dca9d42f28a259237a5724830)): ?>
<?php $attributes = $__attributesOriginalc295f12dca9d42f28a259237a5724830; ?>
<?php unset($__attributesOriginalc295f12dca9d42f28a259237a5724830); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc295f12dca9d42f28a259237a5724830)): ?>
<?php $component = $__componentOriginalc295f12dca9d42f28a259237a5724830; ?>
<?php unset($__componentOriginalc295f12dca9d42f28a259237a5724830); ?>
<?php endif; ?>

                <?php if (isset($component)) { $__componentOriginalc295f12dca9d42f28a259237a5724830 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc295f12dca9d42f28a259237a5724830 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav-link','data' => ['href' => route('admin.broadcast.index'),'active' => request()->routeIs('admin.broadcast.*'),'class' => 'flex items-center']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.broadcast.index')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('admin.broadcast.*')),'class' => 'flex items-center']); ?>
                    <?php if (isset($component)) { $__componentOriginaldd0978db3281e769965f3de7382f5715 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldd0978db3281e769965f3de7382f5715 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon.megaphone','data' => ['class' => 'w-5 h-5 mr-2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon.megaphone'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5 mr-2']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldd0978db3281e769965f3de7382f5715)): ?>
<?php $attributes = $__attributesOriginaldd0978db3281e769965f3de7382f5715; ?>
<?php unset($__attributesOriginaldd0978db3281e769965f3de7382f5715); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldd0978db3281e769965f3de7382f5715)): ?>
<?php $component = $__componentOriginaldd0978db3281e769965f3de7382f5715; ?>
<?php unset($__componentOriginaldd0978db3281e769965f3de7382f5715); ?>
<?php endif; ?>
                    <span class="ml-4">Broadcast</span>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc295f12dca9d42f28a259237a5724830)): ?>
<?php $attributes = $__attributesOriginalc295f12dca9d42f28a259237a5724830; ?>
<?php unset($__attributesOriginalc295f12dca9d42f28a259237a5724830); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc295f12dca9d42f28a259237a5724830)): ?>
<?php $component = $__componentOriginalc295f12dca9d42f28a259237a5724830; ?>
<?php unset($__componentOriginalc295f12dca9d42f28a259237a5724830); ?>
<?php endif; ?>
            </nav>

            <!-- Profile & Logout -->
            <div class="pt-4 border-t">
                <?php if (isset($component)) { $__componentOriginaldf8083d4a852c446488d8d384bbc7cbe = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown','data' => ['align' => 'left','width' => '48','position' => 'top']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['align' => 'left','width' => '48','position' => 'top']); ?>
                     <?php $__env->slot('trigger', null, []); ?> 
                        <div class="flex items-center text-base cursor-pointer">
                            <?php if (isset($component)) { $__componentOriginal218c5c64b059a605cc15629404be144b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal218c5c64b059a605cc15629404be144b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon.user','data' => ['class' => 'w-5 h-5 mr-2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon.user'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5 mr-2']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal218c5c64b059a605cc15629404be144b)): ?>
<?php $attributes = $__attributesOriginal218c5c64b059a605cc15629404be144b; ?>
<?php unset($__attributesOriginal218c5c64b059a605cc15629404be144b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal218c5c64b059a605cc15629404be144b)): ?>
<?php $component = $__componentOriginal218c5c64b059a605cc15629404be144b; ?>
<?php unset($__componentOriginal218c5c64b059a605cc15629404be144b); ?>
<?php endif; ?>
                            <span class="ml-4" x-text="<?php echo \Illuminate\Support\Js::from(auth()->user()->name)->toHtml() ?>"></span>
                            <svg class="w-4 h-4 ml-4 transform transition-transform duration-200" :class="{ 'rotate-180': anggotaOpen }"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                     <?php $__env->endSlot(); ?>
                     <?php $__env->slot('content', null, []); ?> 
                        <?php if (isset($component)) { $__componentOriginal68cb1971a2b92c9735f83359058f7108 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal68cb1971a2b92c9735f83359058f7108 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown-link','data' => ['href' => route('admin.profile'),'wire:navigate' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dropdown-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.profile')),'wire:navigate' => true]); ?>Profile <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $attributes = $__attributesOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__attributesOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $component = $__componentOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__componentOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit"
                                class="block w-full text-right px-4 py-2 text-sm text-red-500 hover:text-red-700 hover:bg-gray-100 transition">
                                Log Out
                            </button>
                        </form>
                     <?php $__env->endSlot(); ?>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe)): ?>
<?php $attributes = $__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe; ?>
<?php unset($__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldf8083d4a852c446488d8d384bbc7cbe)): ?>
<?php $component = $__componentOriginaldf8083d4a852c446488d8d384bbc7cbe; ?>
<?php unset($__componentOriginaldf8083d4a852c446488d8d384bbc7cbe); ?>
<?php endif; ?>
            </div>
        </aside>

        <!-- Mobile Navbar -->
        <div class="flex items-center justify-between w-full lg:hidden">
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-lg font-semibold text-gray-800">
                <?php if (isset($component)) { $__componentOriginal8892e718f3d0d7a916180885c6f012e7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8892e718f3d0d7a916180885c6f012e7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.application-logo','data' => ['class' => 'h-8 w-auto inline-block']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('application-logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'h-8 w-auto inline-block']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8892e718f3d0d7a916180885c6f012e7)): ?>
<?php $attributes = $__attributesOriginal8892e718f3d0d7a916180885c6f012e7; ?>
<?php unset($__attributesOriginal8892e718f3d0d7a916180885c6f012e7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8892e718f3d0d7a916180885c6f012e7)): ?>
<?php $component = $__componentOriginal8892e718f3d0d7a916180885c6f012e7; ?>
<?php unset($__componentOriginal8892e718f3d0d7a916180885c6f012e7); ?>
<?php endif; ?>
            </a>
            <button @click="open = !open" class="text-black focus:outline-none">
                <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Mobile Dropdown Menu -->
        <div x-show="open" x-transition class="absolute right-4 top-20 w-64 bg-white rounded-lg shadow-lg z-50 border lg:hidden">
            <div class="px-4 py-3 space-y-2">
                <a href="<?php echo e(route('admin.dashboard')); ?>"
                    class="block px-3 py-2 rounded hover:bg-gray-100 transition <?php echo e(request()->routeIs('admin.dashboard') ? 'font-semibold bg-gray-200' : ''); ?>">
                    Dashboard
                </a>

                <button @click="anggotaOpen = !anggotaOpen"
                    class="flex items-center w-full px-3 py-2 text-left hover:bg-gray-100 rounded transition">
                    <span>Anggota</span>
                    <svg class="w-4 h-4 ml-auto transform transition-transform duration-200"
                        :class="{ 'rotate-180': anggotaOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="anggotaOpen" x-transition class="pl-4 space-y-1">
                    <a href="<?php echo e(route('anggota.guru')); ?>"
                        class="block px-3 py-2 rounded hover:bg-gray-100 <?php echo e(request()->routeIs('anggota.guru') ? 'font-semibold bg-gray-200' : ''); ?>">
                        Guru
                    </a>
                    <a href="<?php echo e(route('anggota.siswa')); ?>"
                        class="block px-3 py-2 rounded hover:bg-gray-100 <?php echo e(request()->routeIs('anggota.siswa') ? 'font-semibold bg-gray-200' : ''); ?>">
                        Siswa
                    </a>
                </div>

                <a href="<?php echo e(route('admin.buku.index')); ?>"
                    class="block px-3 py-2 rounded hover:bg-gray-100 <?php echo e(request()->routeIs('admin.buku.*') ? 'font-bold bg-gray-200' : ''); ?>">
                    Buku
                </a>
                <a href="<?php echo e(route('admin.peminjaman.index')); ?>"
                    class="block px-3 py-2 rounded hover:bg-gray-100 <?php echo e(request()->routeIs('admin.peminjaman.*') ? 'font-bold bg-gray-200' : ''); ?>">
                    Peminjaman
                </a>
                <a href="<?php echo e(route('admin.broadcast.index')); ?>"
                    class="block px-3 py-2 rounded hover:bg-gray-100 <?php echo e(request()->routeIs('admin.broadcast.*') ? 'font-bold bg-gray-200' : ''); ?>">
                    Broadcast
                </a>

                <div class="border-t pt-3">
                    <a href="<?php echo e(route('admin.profile')); ?>"
                        class="block px-3 py-2 rounded hover:bg-gray-100">Profile</a>
                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit"
                            class="block w-full px-3 py-2 text-left text-red-500 hover:text-red-700 hover:bg-gray-100 rounded transition">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav><?php /**PATH D:\matkul\semester 6\proyek mandiri\perpustakaan\resources\views\livewire/layout/navigation.blade.php ENDPATH**/ ?>