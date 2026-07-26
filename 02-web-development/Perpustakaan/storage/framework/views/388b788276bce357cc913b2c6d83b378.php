<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'title',
    'value',
    'periode' => null,
    'delta' => null,
    'icon' => null,
    'bgColor' => '#f43f5e',  // default warna HEX, contoh merah rose-500
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
    'title',
    'value',
    'periode' => null,
    'delta' => null,
    'icon' => null,
    'bgColor' => '#f43f5e',  // default warna HEX, contoh merah rose-500
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<div class="bg-white border border-gray-100 shadow-xs rounded-2xl p-4 w-full h-full">

    <!-- Header: Icon kiri + Judul + Menu titik 3 -->
    <div class="flex justify-between items-center">
        <!-- Icon + Title -->
        <div class="flex items-center gap-2 mr-4">
            <div 
                class="text-white rounded-md p-2 flex items-center justify-center" 
                style="background-color: <?php echo e($bgColor); ?>;"
            >
                <?php if($icon): ?>
                    <?php echo $icon; ?>

                <?php else: ?>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                    </svg>
                <?php endif; ?>
            </div>
            <h5 class="text-gray-800 font-semibold text-base leading-tight">
                <?php echo e($title); ?>

            </h5>
        </div>
    
        <!-- Menu Icon (⋮) -->
        <div class="text-gray-400 cursor-pointer flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 6a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm0 5a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm0 5a1.5 1.5 0 110-3 1.5 1.5 0 010 3z"/>
            </svg>
        </div>
    </div>    

    <!-- Value dan delta -->
    <div class="flex justify-between items-center mt-4">
        <p class="text-4xl font-semibold text-black"><?php echo e($value); ?></p>
        <?php if($delta): ?>
            <span class="text-green-600 text-sm border border-green-500 rounded-md px-2 py-0.5 font-medium">
                +<?php echo e($delta); ?>

            </span>
        <?php endif; ?>
    </div>

    <!-- Periode -->
    <?php if($periode): ?>
        <p class="text-gray-400 text-sm mt-2">pada <?php echo e($periode); ?></p>
    <?php endif; ?>
</div>
<?php /**PATH D:\matkul\semester 6\proyek mandiri\perpustakaan\resources\views/components/card.blade.php ENDPATH**/ ?>