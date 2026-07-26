<div class="bg-white p-6 rounded-2xl shadow-md overflow-x-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Daftar Peminjaman</h2>
        <!-- <button wire:click="openModal" class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium py-2 px-4 rounded-lg">
            + Tambah Peminjaman
        </button> -->
    </div>

    <!--[if BLOCK]><![endif]--><?php if($showModal): ?>
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 backdrop-blur-sm">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-lg sm:max-w-md p-6">
            <h2 class="text-xl font-semibold mb-4"><?php echo e($isEdit ? 'Edit Peminjaman' : 'Tambah Peminjaman'); ?></h2>

            <div class="space-y-4 text-sm text-gray-600">
                <div>
                    <label for="anggota_id" class="block text-black text-xs mb-1">Anggota</label>
                    <select wire:model="anggota_id" id="anggota_id" class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:ring focus:ring-blue-100 focus:outline-none">
                        <option value="" disabled>Pilih anggota</option>
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $anggotaList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $anggota): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($anggota->id); ?>"><?php echo e($anggota->nama); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                    </select>
                </div>

                <div>
                    <label for="buku_id" class="block text-black text-xs mb-1">Buku</label>
                    <select wire:model="buku_id" id="buku_id" class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:ring focus:ring-blue-100 focus:outline-none">
                        <option value="" disabled>Pilih buku</option>
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $bukuList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $buku): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($buku->id); ?>"><?php echo e($buku->judul); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                    </select>
                </div>

                <div class="flex space-x-2">
                    <div class="w-1/2">
                        <label for="tanggal_pinjam" class="block text-black text-xs mb-1">Tanggal Pinjam</label>
                        <input type="date" wire:model="tanggal_pinjam" id="tanggal_pinjam"
                            class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:ring focus:ring-blue-100 focus:outline-none">
                    </div>
                    <div class="w-1/2">
                        <label for="tanggal_kembali" class="block text-black text-xs mb-1">Tanggal Kembali (saat ini)</label>
                        <input type="date" value="<?php echo e(now()->format('Y-m-d')); ?>" readonly
                            class="w-full bg-gray-100 border border-gray-200 rounded-md p-2 text-gray-600">
                    </div>
                </div>

                <div>
                    <label for="status" class="block text-black text-xs mb-1">Status</label>
                    <select wire:model="status" id="status"
                        class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:ring focus:ring-blue-100 focus:outline-none">
                        <option value="" disabled selected></option>
                        <option value="booking">booking</option>
                        <option value="dipinjam">dipinjam</option>
                        <option value="dikembalikan">dikembalikan</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end space-x-2 mt-6">
                <button wire:click="closeModal" class="bg-gray-100 border border-gray-300 hover:bg-gray-300 text-gray-700 py-2 px-4 rounded-md shadow-sm transition duration-150 ease-in-out transform hover:scale-105">
                    Batal
                </button>

                <!--[if BLOCK]><![endif]--><?php if($isEdit): ?>
                    <button wire:click="update" class="bg-yellow-400 hover:bg-yellow-500 text-white py-2 px-4 rounded-md shadow-sm transition duration-150 ease-in-out transform hover:scale-105">
                        Update
                    </button>
                <?php else: ?>
                    <button wire:click="store" class="bg-blue-500 border border-blue-600 hover:bg-blue-600 text-white py-2 px-4 rounded-md shadow-sm transition duration-150 ease-in-out transform hover:scale-105">
                        Simpan
                    </button>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </div>
        </div>
    </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left text-gray-700 border border-gray-200 rounded-lg overflow-hidden">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 font-semibold">No</th>
                    <th class="px-4 py-3 font-semibold">Anggota</th>
                    <th class="px-4 py-3 font-semibold">Judul Buku</th>
                    <th class="px-4 py-3 font-semibold">Tanggal Pinjam</th>
                    <th class="px-4 py-3 font-semibold">Tanggal Kembali</th>
                    <th class="px-4 py-3 font-semibold">Status</th>
                </tr>
            </thead>
            <tbody>
                <!--[if BLOCK]><![endif]--><?php if($listPeminjaman && $listPeminjaman->isNotEmpty()): ?>
                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $listPeminjaman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2"><?php echo e($index + 1); ?></td>
                            <td class="px-4 py-2"><?php echo e($item->anggota->nama); ?></td>
                            <td class="px-4 py-2"><?php echo e($item->buku->judul); ?></td>
                            <td class="px-4 py-2"><?php echo e($item->tanggal_pinjam); ?></td>
                            <td class="px-4 py-2"><?php echo e($item->tanggal_kembali); ?></td>
                            <td class="px-4 py-2">
                                <span class="px-2 py-1 rounded-full text-xs 
                                    <?php if(strtolower($item->status) == 'booking'): ?> bg-yellow-200 text-yellow-800 
                                    <?php elseif(strtolower($item->status) == 'dipinjam'): ?> bg-green-200 text-green-800 
                                    <?php elseif(strtolower($item->status) == 'dikembalikan'): ?> bg-blue-200 text-blue-800 
                                    <?php endif; ?>">
                                    <?php echo e($item->status); ?>

                                </span>
                            </td>
                            


                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center text-gray-500 py-4">Belum ada data peminjaman.</td>
                    </tr>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </tbody>
        </table>
    </div>
</div><?php /**PATH D:\matkul\semester 6\proyek mandiri\perpustakaan\resources\views/livewire/user/peminjaman/index.blade.php ENDPATH**/ ?>