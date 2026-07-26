<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Perpustakaan Digital SMP 12 Yogyakarta</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

  <style>[x-cloak] { display: none !important; }</style>
</head>

<body class="font-sans antialiased text-gray-800">
  <header class="sticky top-0 z-50 bg-white shadow-md px-4 py-3 md:px-8 md:py-3" x-data="{ open: false, active: '#hero' }">
    <div class="flex items-center justify-between w-full">
      <div class="flex items-center space-x-4">
        <img src="/images/logo_smp12yk.png" class="h-12 w-auto" alt="Logo SMPN 12 Yogyakarta" loading="lazy" />
      </div>

      <nav class="hidden md:flex space-x-6 text-sm text-gray-700">
        <template x-for="item in ['#beranda', '#statistik', '#informasi', '#kontak']">
          <a :href="item" :class="{ 'font-bold text-blue-800': active === item }" @click="active = item" class="transition hover:text-blue-600 capitalize" x-text="item.replace('#','')"></a>
        </template>
      </nav>

      <div class="flex items-center space-x-4">
        <button @click="open = !open" class="md:hidden focus:outline-none" aria-label="Toggle Menu">
          <svg x-show="!open" x-cloak xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
          <svg x-show="open" x-cloak xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>

        <a href="<?php echo e(route('login')); ?>" class="rounded px-4 py-2 bg-blue-500 text-white hover:bg-blue-700 text-sm transition">
          Login
        </a>
      </div>
    </div>

    <div x-show="open" x-transition x-cloak class="md:hidden mt-2 space-y-1 px-4 pb-4 border-t border-gray-200 bg-white">
      <template x-for="item in ['#beranda', '#statistik', '#informasi', '#kontak']">
        <a :href="item" @click="active = item; open = false" :class="{ 'font-bold text-blue-800': active === item }" class="block py-2 px-3 rounded hover:bg-gray-100 transition capitalize" x-text="item.replace('#','')"></a>
      </template>
    </div>
  </header>

  <section id="beranda" class="relative bg-white py-24 min-h-[500px]">
    <div class="absolute bottom-0 left-0 w-full h-12 bg-gradient-to-b from-transparent to-gray-200 pointer-events-none"></div>
    <div class="mx-auto px-6 lg:px-16 flex flex-col lg:flex-row items-start relative z-10">
      <div class="w-full lg:w-2/3 text-center lg:text-left px-10 lg:pr-2 lg:mr-2 space-y-10 order-2 lg:order-1">
        <h1 class="text-4xl md:text-5xl lg:text-7xl font-bold leading-tight text-blue-800">
          Sistem Informasi Perpustakaan<br class="hidden md:block">SMP Negeri 12 Yogyakarta
        </h1>
        <p class="text-gray-600 max-w-2xl mx-auto lg:mx-0 text-lg lg:text-xl">
          Selamat datang di platform digital kami yang menyediakan berbagai layanan informasi dan peminjaman buku secara daring untuk mendukung kegiatan belajar siswa dan guru.
        </p>
      </div>
      <div class="w-full lg:w-1/3 mb-8 lg:mb-0 flex justify-center lg:justify-end order-1 lg:order-2">
        <img src="/images/perpus_4.png" alt="Ilustrasi Perpustakaan"
          class="max-w-[300px] sm:max-w-[400px] lg:max-w-[540px] h-auto object-contain"
          loading="lazy" />
      </div>
    </div>
  </section>


  <section class="relative z-10 px-16 py-2 bg-gray-200 min-h-[250px]">
    <div class="absolute bottom-0 left-0 w-full h-14 bg-gradient-to-b from-transparent to-white pointer-events-none"></div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-4 w-full">
      <?php $__currentLoopData = $cardData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if (isset($component)) { $__componentOriginal53747ceb358d30c0105769f8471417f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal53747ceb358d30c0105769f8471417f6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => ['title' => $card['title'],'value' => $card['value'],'periode' => $card['periode'] ?? null,'delta' => $card['delta'] ?? null,'icon' => $card['icon'] ?? null,'bgColor' => $card['bgColor'] ?? '#f43f5e']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($card['title']),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($card['value']),'periode' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($card['periode'] ?? null),'delta' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($card['delta'] ?? null),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($card['icon'] ?? null),'bgColor' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($card['bgColor'] ?? '#f43f5e')]); ?>
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
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </section>

  <section id="statistik" class="relative z-10 px-6 md:px-20 py-20 bg-white text-gray-800">
    <div class="max-w-6xl mx-auto">
      <div class="relative mb-6">
        <h2 class="text-4xl font-bold text-blue-800 inline-block relative">
          <span class="absolute -bottom-1 left-0 w-16 h-1 bg-blue-800 rounded-full"></span>
          Statistik
        </h2>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Grafik Pengunjung -->
        <div class="bg-gray-100 shadow-lg rounded-lg p-6 h-[400px] flex flex-col justify-center">
          <h3 class="text-lg font-semibold text-center text-gray-700 mb-2">Statistik Pengunjung</h3>
          <div class="h-full flex items-center justify-center">
            <canvas id="statistikChart"></canvas>
          </div>
        </div>

        <!-- Grafik Buku per Kategori -->
        <div class="bg-gray-100 shadow-lg rounded-lg p-6 h-[400px] flex flex-col justify-center">
          <h3 class="text-lg font-semibold text-center text-gray-700 mb-2">Koleksi Buku</h3>
          <div class="h-full flex items-center justify-center">
            <canvas id="kategoriChart"></canvas>
          </div>
        </div>
      </div>

    </div>
  </section>


  <section id="informasi" class="relative z-10 px-10 py-12 bg-gradient-to-b from-gray-200 via-white to-gray-200 text-gray-800 scroll-mt-24">
    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
      <div class="overflow-hidden rounded-lg shadow-md transform transition duration-500 hover:scale-105">
        <img src="images/gedungsmpn12ykasli.jpg" alt="Gedung SMPN 12 Yogyakarta" class="w-full h-auto object-cover" loading="lazy" />
      </div>
      <div>
        <h2 class="text-4xl font-bold text-blue-800 mb-6 text-center md:text-left relative inline-block">
          Informasi Perpustakaan Digital
          <span class="block w-16 h-1 bg-blue-800 mt-2 rounded-full"></span>
        </h2>
        <p class="text-base leading-relaxed mb-4 text-justify">
          Perpustakaan merupakan jantung literasi dan pembelajaran di sekolah. SMP Negeri 12 Yogyakarta menghadirkan Perpustakaan Digital sebagai inovasi untuk mendukung kebutuhan belajar siswa dan guru secara fleksibel, modern, dan inklusif.
        </p>
        <p class="text-base leading-relaxed mb-4 text-justify">
          Jam Operasional: 08.00 - 16.00 WIB
        </p>
      </div>
    </div>
  </section>


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
            backgroundColor: 'rgba(96, 165, 250, 0.1)',
            borderWidth: 2,
            fill: true,
            tension: 0.4
          },
          {
            label: '<?php echo e($tahunSekarang); ?>',
            data: <?php echo json_encode($jumlahPengunjungTahunIni, 15, 512) ?>,
            borderColor: '#EF4444',
            backgroundColor: 'rgba(239, 68, 68, 0.1)',
            borderWidth: 2,
            fill: true,
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
          }
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
  function forceKategoriResize(chartInstance, canvasId) {
    const canvas = document.getElementById(canvasId);
    if (!canvas || !chartInstance) return;

    // Resize otomatis ketika ukuran kontainer berubah
    const observer = new ResizeObserver(() => {
      chartInstance.resize();
    });
    observer.observe(canvas.parentElement);

    // Resize juga saat window di-resize atau zoom
    window.addEventListener('resize', () => {
      chartInstance.resize();
    });
  }

  const kategoriCtx = document.getElementById('kategoriChart').getContext('2d');

  // Data dari backend
  const labels = <?php echo json_encode($kategoriLabels->isEmpty() ? ['Belum Ada Data'] : $kategoriLabels, 15, 512) ?>;
  const dataJumlah = <?php echo json_encode($kategoriJumlah->isEmpty() ? [1] : $kategoriJumlah, 15, 512) ?>;

  // Warna dasar RGB
  const baseColors = [
    '96, 165, 250',    // biru muda
    '245, 158, 11',    // oranye terang
    '16, 185, 129',    // hijau toska
    '239, 68, 68',     // merah terang
    '139, 92, 246',    // ungu gelap
    '244, 114, 182',   // pink cerah
    '255, 99, 132',    // merah muda
    '54, 162, 235',    // biru klasik
    '255, 206, 86',    // kuning cerah
    '75, 192, 192'     // hijau laut
  ];

  // Generate warna transparan untuk isi dan solid untuk outline
  const backgroundColors = dataJumlah.map((_, i) => `rgba(${baseColors[i % baseColors.length]}, 0.3)`);
  const borderColors = dataJumlah.map((_, i) => `rgba(${baseColors[i % baseColors.length]}, 1)`);

  // Inisialisasi Chart
  const kategoriChart = new Chart(kategoriCtx, {
    type: 'doughnut',
    data: {
      labels: labels,
      datasets: [{
        data: dataJumlah,
        backgroundColor: backgroundColors, // isi transparan
        borderColor: borderColors,         // outline solid
        borderWidth: 2
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          position: 'bottom',
          labels: {
            font: { weight: 'bold' },
            color: '#374151'
          }
        }
      }
    }
  });

  // Aktifkan auto resize
  forceKategoriResize(kategoriChart, 'kategoriChart');
</script>

  <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>


<footer id="kontak" class="bg-blue-800 text-white px-6 md:px-20 py-10 border-t border-blue-700 shadow-2xl">
  <div class="w-full flex flex-col md:flex-row justify-between px-0 md:px-0 ...">

    <div class="md:w-1/2 text-left mb-8 md:mb-0">
      <h3 class="text-xl font-bold mb-3">SMP Negeri 12 Yogyakarta</h3>
      <p class="text-sm mb-1">Jalan Tentara Pelajar No.9, Yogyakarta 55272</p>
      <p class="text-sm mb-1">Telp: (0274) 563012</p>
      <p class="text-sm">
        Website:
        <a href="https://smpn12jogja.sch.id" target="_blank" class="underline hover:text-gray-200">
          smpn12jogja.sch.id
        </a>
      </p>
    </div>

    <div class="md:w-1/2 text-left md:text-right">
      <h3 class="text-xl font-bold mb-3">Ikuti Kami</h3>
      <ul class="space-y-2 text-sm">
        <li>
          <a href="https://www.instagram.com/smpn12jogja" target="_blank" class="hover:text-gray-200 transition">
            Instagram: @smpn12jogja
          </a>
        </li>
        <li>
          <a href="https://www.facebook.com/smpn12jogja" target="_blank" class="hover:text-gray-200 transition">
            Facebook: SMPN 12 Jogja
          </a>
          </li>
        <li>
          <a href="mailto:smpn12jogja@gmail.com" class="hover:text-gray-200 transition">
            Email: smpn12jogja@gmail.com
          </a>
        </li>
      </ul>
    </div>

  </div>

  <!-- Copyright -->
  <div class="mt-10 border-t border-white pt-4 text-center text-sm text-white">
    &copy; <?php echo e(date('Y')); ?> Perpustakaan Digital SMP Negeri 12 Yogyakarta. All rights reserved.
  </div>
</footer>
</body>
</html>
<?php /**PATH D:\matkul\semester 6\proyek mandiri\perpustakaan\resources\views/pages/welcome.blade.php ENDPATH**/ ?>