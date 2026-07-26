<div class="py-4 px-4 lg:px-6 w-full">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Dashboard</h2>

    <!-- Card Summary -->
    <div class="flex flex-wrap md:flex-nowrap gap-4 mb-4">
        @foreach($cardData as $card)
            <div class="w-full md:w-1/3">
                @if (!empty($card['url']))
                    <a href="{{ $card['url'] }}" class="block hover:opacity-90 transition duration-200">
                        <x-card
                            :title="$card['title']"
                            :bgColor="$card['bgColor']"
                            :value="$card['value']"
                            :periode="$card['periode']"
                            :delta="$card['delta']"
                            :icon="$card['icon']"
                        />
                    </a>
                @else
                    <x-card
                        :title="$card['title']"
                        :bgColor="$card['bgColor']"
                        :value="$card['value']"
                        :periode="$card['periode']"
                        :delta="$card['delta']"
                        :icon="$card['icon']"
                    />
                @endif
            </div>
        @endforeach
    </div>


    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
        {{-- Kolom 1: Statistik Pengunjung --}}
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

{{-- Script --}}
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
    const bulanLabels = @json($bulanLabels);
    const kategoriDataSet = @json($kategoriPeminjamanData);

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
</script>