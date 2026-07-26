<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['active']));

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

foreach (array_filter((['active']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
    $classes = ($active ?? false)
        ? 'block w-full text-left bg-white border border-gray-100 text-gray-900 font-semibold px-4 py-2 rounded-md shadow-sm'
        : 'block w-full text-left text-gray-900 hover:bg-gray-100 border-l border-transparent hover:text-gray-900 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out px-4 py-2 rounded-md';
?>

<a <?php echo e($attributes->merge(['class' => $classes])); ?>>
    <?php echo e($slot); ?>

</a>
<?php /**PATH D:\matkul\semester 6\proyek mandiri\perpustakaan\resources\views/components/nav-link.blade.php ENDPATH**/ ?>