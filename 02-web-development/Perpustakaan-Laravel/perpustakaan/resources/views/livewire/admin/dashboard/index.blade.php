<div class="py-4 px-4 lg:px-6 w-full">
    <h2 class="text-xl font-semibold text-gray-800 mb-4"> Dashboard</h2>

    <!-- Wrapper untuk Card -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
        @foreach($cardData as $card)
            <a href="{{ $card['url'] ?? '#' }}">
                <x-card
                    :title="$card['title']"
                    :bgColor="$card['bgColor']"
                    :value="$card['value']"
                    :periode="$card['periode']"
                    :delta="$card['delta']"
                    :icon="$card['icon']"
                />
            </a>
        @endforeach
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
            labels: @json($bulanLabels),
            datasets: [
                {
                    label: '{{ $tahunSebelumnya }}',
                    data: @json($jumlahPengunjungTahunLalu),
                    borderColor: '#60A5FA',
                    backgroundColor: 'rgba(96, 165, 250, 0.2)',
                    borderWidth: 2,
                    fill: true,
                    pointRadius: 4,
                    tension: 0.4
                },
                {
                    label: '{{ $tahunSekarang }}',
                    data: @json($jumlahPengunjungTahunIni),
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

    const labels = @json($kategoriLabels->isEmpty() ? ['Belum Ada Data'] : $kategoriLabels);
    const dataJumlah = @json($kategoriJumlah->isEmpty() ? [1] : $kategoriJumlah);

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
