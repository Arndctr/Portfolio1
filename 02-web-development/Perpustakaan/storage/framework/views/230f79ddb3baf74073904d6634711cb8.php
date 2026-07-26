<div class="py-4 px-4 lg:px-6 w-full">
    <h2 class="text-xl font-semibold text-gray-800 mb-6">Profil Pengguna</h2>

     
    <div class="bg-white p-6 rounded-lg shadow mb-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Keanggotaan</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-3 gap-x-6 text-sm text-gray-700">
            <div><span class="font-medium">Nama:</span> <?php echo e(auth()->user()->name); ?></div>
            <div><span class="font-medium">No. Anggota:</span> <?php echo e(auth()->user()->anggota->nis ?? auth()->user()->anggota->nip ?? '-'); ?></div>
        </div>
    </div>

    
    <!--[if BLOCK]><![endif]--><?php if(session('force_fill_email')): ?>
        <div class="p-4 mb-4 rounded-md bg-red-50 border border-red-300 text-red-800 text-sm">
            Silakan lengkapi alamat email Anda sebelum melanjutkan.
        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-gray-800 mb-1">Informasi Profil</h3>
            <p class="text-sm text-gray-600 mb-4">
                Perbarui nama dan email Anda agar informasi akun tetap akurat.
            </p>
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('admin.profile.update-profile-information-form', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-2671437758-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
        </div>

        
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-gray-800 mb-1">Keamanan</h3>
            <p class="text-sm text-gray-600 mb-4">
                Gunakan password yang kuat dan rutin diperbarui untuk menjaga keamanan akun.
            </p>
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('admin.profile.update-password-form', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-2671437758-1', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
        </div>
    </div>

    
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-lg font-semibold text-gray-800 mb-1">Hapus Akun</h3>
        <p class="text-sm text-gray-600 mb-4">
            Menghapus akun akan menghapus seluruh data Anda secara permanen.
        </p>
        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('admin.profile.delete-user-form', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-2671437758-2', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
    </div>
</div>
<?php /**PATH D:\matkul\semester 6\proyek mandiri\perpustakaan\resources\views/livewire/admin/profile/index.blade.php ENDPATH**/ ?>