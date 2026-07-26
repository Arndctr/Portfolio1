<div class="py-4 px-4 lg:px-6 w-full">
    <h2 class="text-xl font-semibold text-gray-800 mb-4"> Dashboard</h2>

    <!-- Wrapper untuk Card -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $cardData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e($card['url'] ?? '#'); ?>">
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
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
    </div>

    <!-- Grafik Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
        <!-- Statistik Pengunjung -->
        <div class="space-y-2">
            <h3 class="text-xl font-semibold text-gray-800">Statistik Pengunjung</h3>
            <div class="bg-white p-4 rounded shadow w-full h-[400px]">
                <canvas id="statistikChart" class="!w-full !h-full"></canvas>
            </div>
        </div>

        <!-- Statistik Kategori Buku -->
        <div class="space-y-2">
            <h3 class="text-xl font-semibold text-gray-800">Statistik Kategori Buku</h3>
            <div class="bg-white p-4 rounded shadow w-full h-[400px]">
                <canvas id="kategoriChart" class="!w-full !h-full"></canvas>
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
</script>
<script>
    const kategoriCtx = document.getElementById('kategoriChart').getContext('2d');

    const labels = <?php echo json_encode($kategoriLabels->isEmpty() ? ['Belum Ada Data'] : $kategoriLabels, 15, 512) ?>;
    const dataJumlah = <?php echo json_encode($kategoriJumlah->isEmpty() ? [1] : $kategoriJumlah, 15, 512) ?>;

    const baseColors = [
        '96, 165, 250', '245, 158, 11', '16, 185, 129', '239, 68, 68',
        '139, 92, 246', '244, 114, 182', '255, 99, 132', '54, 162, 235',
        '255, 206, 86', '75, 192, 192'
    ];

    const backgroundColors = dataJumlah.map((_, i) => `rgba(${baseColors[i % baseColors.length]}, 0.4)`);
    const borderColors = dataJumlah.map((_, i) => `rgba(${baseColors[i % baseColors.length]}, 1)`);

    new Chart(kategoriCtx, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                data: dataJumlah,
                backgroundColor: backgroundColors,
                borderColor: borderColors,
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            layout: {
                padding: 0
            },
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: '#374151',
                        font: { weight: 'bold' }
                    }
                }
            }
        }
    });
</script>
<?php /**PATH D:\matkul\semester 6\proyek mandiri\perpustakaan\resources\views/livewire/admin/dashboard/index.blade.php ENDPATH**/ ?>