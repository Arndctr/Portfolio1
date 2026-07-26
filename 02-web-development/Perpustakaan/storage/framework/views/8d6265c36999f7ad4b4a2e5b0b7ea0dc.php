<div class="bg-white p-6 rounded-2xl shadow-md overflow-x-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Broadcast</h2>
    </div>
    <!--[if BLOCK]><![endif]--><?php if(session()->has('message')): ?>
        <div class="mb-4 px-4 py-2 bg-green-100 text-green-700 rounded">
            <?php echo e(session('message')); ?>

        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <form wire:submit.prevent="store" class="mb-8 bg-gray-50 p-5 rounded-lg border border-gray-200">
        <div class="grid grid-cols-1 gap-4">
            <div>
                <label for="judul" class="block text-sm font-medium text-gray-700">Judul</label>
                <input type="text" id="judul" wire:model="judul"
                    class="mt-1 w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Judul pesan...">
                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['judul'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-600 text-sm mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
            </div>

            <div>
                <label for="isi" class="block text-sm font-medium text-gray-700">Isi Pesan</label>
                <textarea id="isi" wire:model="isi"
                        class="mt-1 w-full border border-gray-300 rounded px-4 py-2 h-28 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Isi pesan..."></textarea>
                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['isi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-600 text-sm mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
            </div>
        </div>

        <div class="mt-4 text-right">
            <button type="submit"
                    wire:loading.attr="disabled"
                    wire:target="store"
                    class="bg-red-400 hover:bg-red-600 text-white px-6 py-2 rounded shadow transition duration-200">
                <span wire:loading.remove wire:target="store">Kirim Pesan</span>
                <span wire:loading wire:target="store">Mengirim...</span>
            </button>

        </div>
    </form>

    <!-- Tabel Broadcast -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-lg border border-gray-300 text-sm text-gray-700 ">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-6 py-3 border-b border-gray-300 text-left font-medium">Judul</th>
                    <th class="px-6 py-3 border-b border-gray-300 text-left font-medium">Isi Pesan</th>
                    <th class="px-6 py-3 border-b border-gray-300 text-left font-medium">Tanggal & Waktu</th> <!-- kolom baru -->
                </tr>
            </thead>
            <tbody>
                <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $broadcast; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 border-b border-gray-200 font-semibold"><?php echo e($item->judul); ?></td>
                        <td class="px-6 py-4 border-b border-gray-200"><?php echo e($item->isi); ?></td>
                        <td class="px-6 py-4 border-b border-gray-200">
                            <?php echo e($item->created_at->format('d M Y H:i')); ?>

                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-center text-gray-500">Belum ada pesan broadcast.</td>
                    </tr>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </tbody>
        </table>
    </div>
</div>
<?php /**PATH D:\matkul\semester 6\proyek mandiri\perpustakaan\resources\views/livewire/admin/broadcast/index.blade.php ENDPATH**/ ?>