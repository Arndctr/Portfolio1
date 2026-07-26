<div class="p-6 space-y-6 max-w-7xl mx-auto">
    <!-- Judul & Filter -->
    <div class="bg-white shadow-md rounded-xl p-6 space-y-4">
        <h2 class="text-2xl font-semibold text-gray-800">Daftar Buku</h2>

        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
            <!-- Filter Kategori (kiri) -->
            <div class="w-full sm:w-1/2">
                <label class="block mb-1 text-sm font-medium text-gray-600">Kategori</label>
                <select wire:model.live="kategori"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="semua">Semua Kategori</option>
                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $kategoriList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($kat); ?>"><?php echo e($kat); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                </select>
            </div>

            <!-- Pencarian (kanan) -->
            <div class="w-full sm:w-1/2">
                <label class="block mb-1 text-sm font-medium text-gray-600">Cari Judul</label>
                <input type="text" wire:model.live.debounce.300ms="search"
                    placeholder="Contoh: Laskar Pelangi"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>

        <!-- Flash Message -->
        <!--[if BLOCK]><![endif]--><?php if(session()->has('message')): ?>
            <div class="p-3 rounded bg-green-100 text-green-700">
                <?php echo e(session('message')); ?>

            </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        <?php if(session()->has('error')): ?>
            <div class="p-3 rounded bg-red-100 text-red-700">
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    </div>

    <!-- Grid Daftar Buku -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-4 hover:shadow-md transition-shadow duration-300 max-w-md mx-auto">
                <div class="flex gap-4">
                    
                    <!--[if BLOCK]><![endif]--><?php if($item->cover): ?>
                        <div class="w-[140px] h-[200px] flex-shrink-0 overflow-hidden rounded-md">
                            <!--[if BLOCK]><![endif]--><?php if($item->cover && file_exists(public_path('storage/' . $item->cover))): ?>
                                <img 
                                    src="<?php echo e(asset('storage/' . $item->cover)); ?>" 
                                    alt="Cover Buku <?php echo e($item->judul); ?>" 
                                    class="w-full h-full object-cover rounded-md" 
                                    loading="lazy">
                            <?php else: ?>
                                <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-400 text-sm rounded-md">
                                    Tidak ada cover
                                </div>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                    <?php else: ?>
                        <div class="w-[140px] h-[200px] bg-gray-100 rounded-md flex items-center justify-center text-gray-400 text-sm">
                            Tidak ada cover
                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                    
                    <div class="flex flex-col justify-between flex-1 overflow-hidden">
                        <div>
                            
                            <h3 class="text-lg font-bold text-black truncate" title="<?php echo e($item->judul); ?>">
                                <?php echo e($item->judul); ?>

                            </h3>

                            
                            <span class="inline-block mt-1 mb-2 px-3 py-0.5 text-xs font-medium bg-green-100 text-green-700 rounded-full border border-green-300">
                                <?php echo e($item->kategori); ?>

                            </span>

                            
                            <p class="text-sm text-gray-500 mb-3 line-clamp-3 break-words">
                                <?php echo e($item->deskripsi); ?>

                            </p>
                        </div>

                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 text-sm text-gray-700">
                            <div class="space-y-1 overflow-hidden">
                                <p class="truncate"><span class="font-sm">Penulis:</span> <?php echo e($item->penulis); ?></p>
                                <p class="truncate"><span class="font-sm">Penerbit:</span> <?php echo e($item->penerbit); ?></p>
                                <p><span class="font-sm">Tahun:</span> <?php echo e($item->tahun_terbit); ?></p>
                            </div>
                            <div class="space-y-1 overflow-hidden">
                                <p class="truncate"><span class="font-sm">ISBN:</span> <?php echo e($item->isbn); ?></p>
                                <p><span class="font-sm">Stok:</span> <?php echo e($item->jumlah_stok); ?></p>
                                <p><span class="font-sm">Rak:</span> <?php echo e($item->lokasi_rak); ?></p>
                            </div>
                        </div>
                        
                        
                        <div class="mt-4">
                            <button wire:click="pinjam(<?php echo e($item->id); ?>)"
                                    class="w-full text-center bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg transition-colors duration-200 disabled:opacity-50"
                                    <?php if($item->jumlah_stok == 0): ?> disabled <?php endif; ?>>
                                <?php echo e($item->jumlah_stok > 0 ? 'Pinjam Buku' : 'Stok Habis'); ?>

                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-span-full text-center py-20 text-gray-500">
                <p class="text-lg font-medium">Tidak ada buku ditemukan.</p>
                <p class="text-sm text-gray-400">Silakan coba kategori lain atau ubah kata kunci pencarian.</p>
            </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    </div>
</div>
<?php /**PATH D:\matkul\semester 6\proyek mandiri\perpustakaan\resources\views/livewire/user/buku/index.blade.php ENDPATH**/ ?>