<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    <title><?php echo e(config('app.name', 'Perpustakaan Digital SMP Negeri 12 Yogyakarta')); ?></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles & Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen flex flex-col sm:flex-row">
        <!-- Sidebar Desktop -->
        <aside class="hidden lg:block w-64 bg-white border-r">
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('layout.user-navigation', ['desktop' => true]);

$__html = app('livewire')->mount($__name, $__params, 'lw-3015142774-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-h-screen bg-white m-2 border border-gray-100 rounded-md overflow-hidden">
            
            <!-- Mobile Navbar -->
            <div class="lg:hidden border-b p-4 relative z-50">
                <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('layout.user-navigation', ['mobile' => true]);

$__html = app('livewire')->mount($__name, $__params, 'lw-3015142774-1', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
            </div>

            <!-- Page Heading -->
            <?php if(isset($header)): ?>
                <header class="p-4 border-b">
                    <?php echo e($header); ?>

                </header>
            <?php endif; ?>

            <!-- Page Content -->
            <main class="flex-1 p-4 overflow-y-auto">
                <?php echo e($slot); ?>

            </main>
        </div>
    </div>
</body>
</html>
<?php /**PATH D:\matkul\semester 6\proyek mandiri\perpustakaan\resources\views/layouts/user.blade.php ENDPATH**/ ?>