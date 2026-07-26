<div class="py-4 px-4 lg:px-6 w-full">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Dashboard</h2>

    <!-- Card Summary -->
    <div class="flex flex-wrap md:flex-nowrap gap-4 mb-4">
        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $cardData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="w-full md:w-1/3">
                <!--[if BLOCK]><![endif]--><?php if(!empty($card['url'])): ?>
                    <a href="<?php echo e($card['url']); ?>" class="block hover:opacity-90 transition duration-200">
                        <?php if (isset($component)) { $__componentOriginal53747ceb358d30c0105769f8471417f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal53747ceb358d30c0105769f8471417f6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => ['title' => $card['title'],'bgColor' => $card['bgColor'],'value' => $card['value'],'periode' => $card['periode'],'delta' => $card['delta'],'icon' => $card['icon']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($card['title']),'bgColor' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($card['bgColor']),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($card['value']),'periode' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($card['periode']),'delta' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($card['delta']),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($card['icon'])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal53747ceb358d30c0105769f8471417f6)): ?>
<?php $attributes = $__attributesOriginal53747ceb358d30c0105769f8471417f6; ?>
<?php unset($__attributesOriginal53747ceb358d30c0105769f8471417f6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal53747ceb358d30c0105769f8471417f6)): ?>
<?php $component = $__componentOriginal53747ceb358d30c0105769f8471417f6; ?>
<?php unset($__componentOriginal53747ceb358d30c0105769f8471417f6); ?>
<?php endif; ?>
                    </a>
                <?php else: ?>
                    <?php if (isset($component)) { $__componentOriginal53747ceb358d30c0105769f8471417f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal53747ceb358d30c0105769f8471417f6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => ['title' => $card['title'],'bgColor' => $card['bgColor'],'value' => $card['value'],'periode' => $card['periode'],'delta' => $card['delta'],'icon' => $card['icon']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($card['title']),'bgColor' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($card['bgColor']),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($card['value']),'periode' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($card['periode']),'delta' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($card['delta']),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($card['icon'])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal53747ceb358d30c0105769f8471417f6)): ?>
<?php $attributes = $__attributesOriginal53747ceb358d30c0105769f8471417f6; ?>
<?php unset($__attributesOriginal53747ceb358d30c0105769f8471417f6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal53747ceb358d30c0105769f8471417f6)): ?>
<?php $component = $__componentOriginal53747ceb358d30c0105769f8471417f6; ?>
<?php unset($__componentOriginal53747ceb358d30c0105769f8471417f6); ?>
<?php endif; ?>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
    </div>


    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
        
        <div class="space-y-2">
            <h3 class="text-xl font-semibold text-gray-800">Statistik Pengunjung</h3>
            <div class="bg-white p-4 rounded shadow w-full h-[400px]">
                <canvas id="statistikChart" class="w-full h-full"></canvas>
            </div>
        </div>

        <!-- Kolom 2: Riwayat Peminjaman Berdasarkan Kategori -->
        <div class="space-y-2">
            <h3 class="text-xl font-semibold text-gray-800">Riwayat Peminjaman Berdasarkan Kategori</h3>
            <div class="bg-white p-4 rounded shadow w-full h-[400px]">
                <canvas id="kategoriLineChart" class="w-full h-full"></canvas>
            </div>
        </div>
    </div> 
</div>


<script>
    const ctx = document.getElementById('statistikChart').getContext('2d');
    const statistikChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($bulanLabels, 15, 512) ?>,
            datasets: [
                {
                    label: '<?php echo e($tahunSebelumnya); ?>',
                    data: <?php echo json_encode($jumlahPengunjungTahunLalu, 15, 512) ?>,
                    borderColor: '#60A5FA',
                    backgroundColor: 'rgba(96, 165, 250, 0.2)',
                    borderWidth: 2,
                    fill: true,
                    pointRadius: 4,
                    tension: 0.4
                },
                {
                    label: '<?php echo e($tahunSekarang); ?>',
                    data: <?php echo json_encode($jumlahPengunjungTahunIni, 15, 512) ?>,
                    borderColor: '#FB7185',
                    backgroundColor: 'rgba(251, 113, 133, 0.2)',
                    borderWidth: 2,
                    fill: true,
                    pointRadius: 4,
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false, // Penting agar CSS height bekerja
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: '#374151',
                        font: { weight: 'bold' }
                    }
                },
                tooltip: {
                    mode: 'index',
                    intersect: false
                }
            },
            interaction: {
                mode: 'nearest',
                intersect: false
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { color: '#6B7280' },
                    grid: { color: '#E5E7EB' }
                },
                x: {
                    ticks: { color: '#6B7280' },
                    grid: { display: false }
                }
            }
        }
    });
</script>
<script>
    const kategoriLineCtx = document.getElementById('kategoriLineChart').getContext('2d');
    const bulanLabels = <?php echo json_encode($bulanLabels, 15, 512) ?>;
    const kategoriDataSet = <?php echo json_encode($kategoriPeminjamanData, 15, 512) ?>;

    const warnaDasar = [
        '255, 99, 132',
        '54, 162, 235',
        '255, 206, 86',
        '75, 192, 192',
        '153, 102, 255',
        '255, 159, 64',
        '16, 185, 129',
        '239, 68, 68'
    ];

    const kategoriLineData = {
        labels: bulanLabels,
        datasets: kategoriDataSet.map((item, idx) => ({
            label: item.kategori,
            data: item.data,
            borderColor: `rgba(${warnaDasar[idx % warnaDasar.length]}, 1)`,
            backgroundColor: `rgba(${warnaDasar[idx % warnaDasar.length]}, 0.2)`,
            borderWidth: 2,
            pointRadius: 4,
            tension: 0.4,
            fill: true
        }))
    };

    new Chart(kategoriLineCtx, {
        type: 'line',
        data: kategoriLineData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: '#374151',
                        font: { weight: 'bold' }
                    }
                },
                tooltip: {
                    mode: 'index',
                    intersect: false
                }
            },
            interaction: {
                mode: 'nearest',
                intersect: false
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { color: '#6B7280' },
                    grid: { color: '#E5E7EB' }
                },
                x: {
                    ticks: { color: '#6B7280' },
                    grid: { display: false }
                }
            }
        }
    });
</script><?php /**PATH D:\matkul\semester 6\proyek mandiri\perpustakaan\resources\views/livewire/user/dashboard/index.blade.php ENDPATH**/ ?>