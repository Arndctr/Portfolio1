<div>

{{-- ================= HERO ================= --}}
<section class="px-6 md:px-12 lg:px-20 py-20 bg-white text-center">
    <div class="max-w-4xl mx-auto">

        <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl 
                font-bold leading-tight tracking-tight text-gray-900">
            
            Bangun Karier Lewat 
            <span class="text-blue-700 inline-block">
                Program Magang
            </span>
            <br>
            yang Relevan dan Berdampak

        </h1>

        <p class="mt-6 text-gray-600 text-base sm:text-lg">
            Platform resmi program magang Rumah BUMN Yogyakarta.
            Kembangkan keterampilan dan pengalaman profesional Anda.
        </p>

        <div class="mt-8 flex flex-col sm:flex-row 
                    justify-center items-center gap-4">

            <a href="/daftar"
               class="px-6 py-3 bg-yellow-400 rounded-md font-medium
                      hover:bg-yellow-500 transition duration-200">
                Daftar Sekarang
            </a>

            <a href="/informasi"
               class="px-6 py-3 border border-black rounded-md
                      hover:bg-black hover:text-white
                      transition duration-200">
                Pelajari Lebih Lanjut
            </a>

        </div>

    </div>
</section>

<section class="px-6 md:px-12 lg:px-20 py-8 bg-linear-to-b from-blue-600 via-blue-700 to-blue-800">
    <div class="max-w-7xl mx-auto">
        <div class="mb-10 text-center">
            <h2 class="mt-4 text-3xl md:text-4xl font-extrabold  text-yellow-400">Timeline Seleksi Magang</h2>
            <p class="mt-6 text-white max-w-2xl mx-auto">Lihat tahapan seleksi dan tanggal penting program magang secara ringkas agar Anda dapat mempersiapkan diri dengan baik.</p>
        </div>

        @if($batch)
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($batch->timeline_steps as $step)
            <div class="rounded-3xl bg-white/10 p-6
                hover:bg-white/20 hover:-translate-y-1
                transition duration-300 text-center">
                
                <p class="text-xs uppercase tracking-[0.2em] text-yellow-400 font-semibold">
                    {{ $step['title'] }}
                </p>

                <p class="mt-4 text-lg font-semibold text-white">
                    {{ $step['date'] }}
                </p>

            </div>
        @endforeach
    </div>
@else
    <div class="rounded-3xl border border-slate-200 bg-white p-10 text-center shadow-sm">
        <p class="text-slate-700 font-medium">
            Informasi batch belum tersedia. Silakan hubungi admin untuk detail periode seleksi.
        </p>
    </div>
@endif
    </div>
</section>



<section class="bg-white border-b border-slate-100 py-16 px-4 sm:px-6 lg:px-12">
  <div class="max-w-7xl mx-auto">

    {{-- ── Heading ── --}}
    <div class="text-center mb-12">
      <span class="inline-flex items-center gap-1.5 bg-blue-50 text-blue-600 text-xs font-semibold
                   tracking-widest uppercase px-4 py-1.5 rounded-full border border-blue-100 mb-4">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/>
        </svg>
        Panduan Pendaftaran
      </span>
      <h2 class="text-2xl sm:text-3xl font-semibold text-slate-900 mb-2">
        Alur Pendaftaran Magang
      </h2>
      <p class="text-slate-500 text-sm sm:text-base max-w-lg mx-auto">
        Ikuti langkah pendaftaran magang dengan mudah dan cepat.
      </p>
    </div>

    {{-- ── Steps — Desktop (3 kolom) ── --}}
    <div class="hidden md:grid md:grid-cols-3 gap-6 relative">

      {{-- Garis penghubung step 1 → 2 --}}
      <div class="absolute top-[2.6rem] left-[calc(33.33%-2px)] w-[calc(33.33%+4px)]
                  border-t-2 border-dashed border-blue-200 z-0 pointer-events-none"></div>
      {{-- Garis penghubung step 2 → 3 --}}
      <div class="absolute top-[2.6rem] left-[calc(66.66%-2px)] w-[calc(33.33%+4px)]
                  border-t-2 border-dashed border-blue-200 z-0 pointer-events-none"></div>

      {{-- ── STEP 1 ── --}}
      <div class="group relative z-10 flex flex-col items-center text-center
                  bg-white border border-slate-200 rounded-2xl shadow-sm p-8
                  transition duration-300 hover:-translate-y-1 hover:shadow-md hover:border-blue-200">
        {{-- Badge nomor --}}
        <span class="absolute -top-3 left-1/2 -translate-x-1/2
                     w-6 h-6 rounded-full bg-blue-600 text-white text-[11px] font-bold
                     flex items-center justify-center shadow">
          1
        </span>
        {{-- Icon --}}
        <div class="w-20 h-20 rounded-2xl bg-blue-50 border border-blue-100
                    flex items-center justify-center mb-5 shadow-sm
                    group-hover:bg-blue-600 group-hover:border-blue-600 transition duration-300">
          <svg class="w-9 h-9 text-blue-600 group-hover:text-white transition duration-300"
               fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M15.042 21.672 13.684 16.6m0 0-2.51 2.225.569-9.47 5.227 7.917-3.286-.672Z
                 M12 2.25V4.5m5.834.166-1.591 1.591M20.25 10.5H18
                 M7.757 14.743l-1.59 1.59M6 10.5H3.75
                 m4.007-4.243-1.59-1.59"/>
          </svg>
        </div>
        <h3 class="text-base font-semibold text-slate-900 mb-2">Klik Tombol Daftar</h3>
        <p class="text-slate-500 text-sm leading-relaxed">
          Tombol <span class="font-semibold text-blue-600">Daftar</span> tersedia di halaman
          Beranda, Divisi Magang, dan Alur Magang untuk memudahkan peserta memulai
          proses pendaftaran.
        </p>
        <span class="mt-5 inline-flex items-center gap-1.5 text-[11px] font-semibold
                     text-blue-600 bg-blue-50 border border-blue-100 rounded-full px-3 py-1">
          <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span>
          Langkah 1
        </span>
      </div>

      {{-- ── STEP 2 ── --}}
      <div class="group relative z-10 flex flex-col items-center text-center
                  bg-white border border-slate-200 rounded-2xl shadow-sm p-8
                  transition duration-300 hover:-translate-y-1 hover:shadow-md hover:border-blue-200">
        <span class="absolute -top-3 left-1/2 -translate-x-1/2
                     w-6 h-6 rounded-full bg-blue-600 text-white text-[11px] font-bold
                     flex items-center justify-center shadow">
          2
        </span>
        <div class="w-20 h-20 rounded-2xl bg-blue-50 border border-blue-100
                    flex items-center justify-center mb-5 shadow-sm
                    group-hover:bg-blue-600 group-hover:border-blue-600 transition duration-300">
          <svg class="w-9 h-9 text-blue-600 group-hover:text-white transition duration-300"
               fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M9 12h3.75M9 15h3.75M9 18h3.75
                 m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192
                 a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664
                 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664
                 m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586
                 m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25
                 m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25
                 c0 .621.504 1.125 1.125 1.125h9.75
                 c.621 0 1.125-.504 1.125-1.125V9.375
                 c0-.621-.504-1.125-1.125-1.125H8.25Z
                 M6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z"/>
          </svg>
        </div>
        <h3 class="text-base font-semibold text-slate-900 mb-2">Isi Formulir Lengkap</h3>
        <p class="text-slate-500 text-sm leading-relaxed">
          Lengkapi seluruh <span class="font-semibold text-blue-600">data diri</span> pada
          formulir pendaftaran online sesuai informasi yang diminta dengan benar dan lengkap.
        </p>
        <span class="mt-5 inline-flex items-center gap-1.5 text-[11px] font-semibold
                     text-blue-600 bg-blue-50 border border-blue-100 rounded-full px-3 py-1">
          <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span>
          Langkah 2
        </span>
      </div>

      {{-- ── STEP 3 ── --}}
      <div class="group relative z-10 flex flex-col items-center text-center
                  bg-white border border-slate-200 rounded-2xl shadow-sm p-8
                  transition duration-300 hover:-translate-y-1 hover:shadow-md hover:border-blue-200">
        <span class="absolute -top-3 left-1/2 -translate-x-1/2
                     w-6 h-6 rounded-full bg-blue-600 text-white text-[11px] font-bold
                     flex items-center justify-center shadow">
          3
        </span>
        <div class="w-20 h-20 rounded-2xl bg-blue-50 border border-blue-100
                    flex items-center justify-center mb-5 shadow-sm
                    group-hover:bg-blue-600 group-hover:border-blue-600 transition duration-300">
          <svg class="w-9 h-9 text-blue-600 group-hover:text-white transition duration-300"
               fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/>
          </svg>
        </div>
        <h3 class="text-base font-semibold text-slate-900 mb-2">Cek Data Pendaftar</h3>
        <p class="text-slate-500 text-sm leading-relaxed">
          Setelah mengirim formulir, tekan tombol
          <span class="font-semibold text-blue-600">Cek Data Pendaftar</span>
          untuk melihat daftar peserta yang sudah berhasil mendaftar.
        </p>
        <span class="mt-5 inline-flex items-center gap-1.5 text-[11px] font-semibold
                     text-blue-600 bg-blue-50 border border-blue-100 rounded-full px-3 py-1">
          <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span>
          Langkah 3
        </span>
      </div>

    </div>{{-- end desktop grid --}}

    {{-- ── Steps — Mobile (vertikal) ── --}}
    <div class="flex flex-col gap-4 md:hidden relative">

      {{-- Garis kiri vertikal --}}
      <div class="absolute left-[2.35rem] top-14 bottom-14
                  w-0.5 border-l-2 border-dashed border-blue-200 z-0"></div>

      {{-- STEP 1 mobile --}}
      <div class="relative z-10 flex items-start gap-4
                  bg-white border border-slate-200 rounded-2xl shadow-sm p-5
                  transition duration-300 hover:shadow-md hover:border-blue-200">
        <div class="shrink-0 w-[4.75rem] flex flex-col items-center gap-1.5">
          <div class="w-[4.75rem] h-[4.75rem] rounded-xl bg-blue-50 border border-blue-100
                      flex items-center justify-center shadow-sm">
            <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor"
                 stroke-width="1.7" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M15.042 21.672 13.684 16.6m0 0-2.51 2.225.569-9.47 5.227 7.917-3.286-.672Z
                   M12 2.25V4.5m5.834.166-1.591 1.591M20.25 10.5H18
                   M7.757 14.743l-1.59 1.59M6 10.5H3.75m4.007-4.243-1.59-1.59"/>
            </svg>
          </div>
          <span class="w-5 h-5 rounded-full bg-blue-600 text-white text-[10px] font-bold
                       flex items-center justify-center shadow">1</span>
        </div>
        <div class="flex-1 pt-1">
          <h3 class="text-sm font-semibold text-slate-900 mb-1">Klik Tombol Daftar</h3>
          <p class="text-slate-500 text-xs leading-relaxed">
            Tombol <span class="font-semibold text-blue-600">Daftar</span> tersedia di halaman
            Beranda, Divisi Magang, dan Alur Magang.
          </p>
        </div>
      </div>

      {{-- STEP 2 mobile --}}
      <div class="relative z-10 flex items-start gap-4
                  bg-white border border-slate-200 rounded-2xl shadow-sm p-5
                  transition duration-300 hover:shadow-md hover:border-blue-200">
        <div class="shrink-0 w-[4.75rem] flex flex-col items-center gap-1.5">
          <div class="w-[4.75rem] h-[4.75rem] rounded-xl bg-blue-50 border border-blue-100
                      flex items-center justify-center shadow-sm">
            <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor"
                 stroke-width="1.7" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M9 12h3.75M9 15h3.75M9 18h3.75
                   m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108
                   c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08
                   m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5
                   a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664
                   m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586
                   m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25
                   m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25
                   c0 .621.504 1.125 1.125 1.125h9.75
                   c.621 0 1.125-.504 1.125-1.125V9.375
                   c0-.621-.504-1.125-1.125-1.125H8.25Z"/>
            </svg>
          </div>
          <span class="w-5 h-5 rounded-full bg-blue-600 text-white text-[10px] font-bold
                       flex items-center justify-center shadow">2</span>
        </div>
        <div class="flex-1 pt-1">
          <h3 class="text-sm font-semibold text-slate-900 mb-1">Isi Formulir Lengkap</h3>
          <p class="text-slate-500 text-xs leading-relaxed">
            Lengkapi seluruh <span class="font-semibold text-blue-600">data diri</span> pada
            formulir pendaftaran online sesuai informasi yang diminta.
          </p>
        </div>
      </div>

      {{-- STEP 3 mobile --}}
      <div class="relative z-10 flex items-start gap-4
                  bg-white border border-slate-200 rounded-2xl shadow-sm p-5
                  transition duration-300 hover:shadow-md hover:border-blue-200">
        <div class="shrink-0 w-[4.75rem] flex flex-col items-center gap-1.5">
          <div class="w-[4.75rem] h-[4.75rem] rounded-xl bg-blue-50 border border-blue-100
                      flex items-center justify-center shadow-sm">
            <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor"
                 stroke-width="1.7" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/>
            </svg>
          </div>
          <span class="w-5 h-5 rounded-full bg-blue-600 text-white text-[10px] font-bold
                       flex items-center justify-center shadow">3</span>
        </div>
        <div class="flex-1 pt-1">
          <h3 class="text-sm font-semibold text-slate-900 mb-1">Cek Data Pendaftar</h3>
          <p class="text-slate-500 text-xs leading-relaxed">
            Tekan tombol <span class="font-semibold text-blue-600">Cek Data Pendaftar</span>
            untuk melihat daftar peserta yang sudah mendaftar.
          </p>
        </div>
      </div>

    </div>{{-- end mobile --}}

  </div>
</section>



<section class="px-6 md:px-12 lg:px-20 py-16 bg-slate-50">
    <div class="max-w-6xl mx-auto">

        <div class="text-center mb-14">
            <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900">Mengapa Bergabung?</h2>
            <p class="mt-3 text-slate-600 text-lg max-w-2xl mx-auto">Program magang dirancang untuk menghadirkan pengalaman praktis dan dukungan profesional di lingkungan BUMN.</p>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 text-center">
            <div class="rounded-3xl border border-slate-200 p-8 bg-slate-50 shadow-sm hover:shadow-md transition">
                <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-blue-600 text-white mb-5">
                    <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M13 16h-1v-4h-1m1-4h.01"/><path d="M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z"/></svg>
                </div>
                <h3 class="text-xl font-semibold text-slate-900 mb-3">Proses Transparan</h3>
                <p class="text-slate-600">Semua tahapan pendaftaran dan seleksi ditampilkan jelas, sehingga peserta dapat merencanakan setiap langkah dengan mudah.</p>
            </div>
            <div class="rounded-3xl border border-slate-200 p-8 bg-slate-50 shadow-sm hover:shadow-md transition">
                <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-blue-600 text-white mb-5">
                    <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 11l3 3L22 4"/><path d="M21 12v6a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2h11"/></svg>
                </div>
                <h3 class="text-xl font-semibold text-slate-900 mb-3">Dukungan Profesional</h3>
                <p class="text-slate-600">Dapatkan pengalaman langsung bekerja di lingkungan BUMN dengan bimbingan yang terstruktur.</p>
            </div>
            <div class="rounded-3xl border border-slate-200 p-8 bg-slate-50 shadow-sm hover:shadow-md transition">
                <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-blue-600 text-white mb-5">
                    <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 17v.01M15 17v.01M7 21h10a2 2 0 002-2V7.5L14.5 2H7a2 2 0 00-2 2v15a2 2 0 002 2z"/></svg>
                </div>
                <h3 class="text-xl font-semibold text-slate-900 mb-3">Peningkatan Portofolio</h3>
                <p class="text-slate-600">Bangun portofolio yang lebih kuat dengan pengalaman kerja nyata dan dokumentasi profesional.</p>
            </div>
        </div>
    </div>
</section>


{{-- ================= CTA + STAT ================= --}}
<section class="px-6 md:px-12 lg:px-20 py-20 
                bg-linear-to-b from-blue-600 via-blue-700 to-blue-800 
                text-white">

    <div class="max-w-6xl mx-auto">

        <div class="grid md:grid-cols-2 gap-12 items-center">

            <div>
                <h2 class="text-3xl md:text-4xl lg:text-5xl 
                           font-bold text-yellow-400">
                    Siap Memulai Perjalanan Magang Anda?
                </h2>
            </div>

            <div>
                <p class="text-gray-200 text-base md:text-lg">
                    Bergabunglah dan kembangkan potensi Anda
                    bersama lingkungan BUMN profesional.
                </p>

                <div class="mt-6 flex flex-col sm:flex-row gap-4">

                    <a href="/daftar"
                       class="px-6 py-3 bg-yellow-400 text-black 
                              rounded-md font-medium
                              hover:bg-yellow-500
                              transition duration-200 text-center">
                        Daftar Sekarang
                    </a>

                    <a href="/kontak"
                       class="px-6 py-3 border border-white rounded-md
                              hover:bg-white hover:text-blue-700
                              transition duration-200 text-center">
                        Hubungi Kami
                    </a>

                </div>
            </div>

        </div>

        {{-- STATISTIK --}}
        <div class="mt-20 grid sm:grid-cols-2 lg:grid-cols-3 gap-8 text-center">

            <div class="bg-white/10 p-10 rounded-xl">
                <h3 class="text-4xl font-bold text-yellow-400">100+</h3>
                <p class="mt-2 text-sm uppercase tracking-wide">
                    Alumni Magang
                </p>
            </div>

            <div class="bg-white/10 p-10 rounded-xl">
                <h3 class="text-4xl font-bold text-yellow-400">3 – 6</h3>
                <p class="mt-2 text-sm uppercase tracking-wide">
                    Bulan Program
                </p>
            </div>

            <div class="bg-white/10 p-10 rounded-xl">
                <h3 class="text-4xl font-bold text-yellow-400">20+</h3>
                <p class="mt-2 text-sm uppercase tracking-wide">
                    BUMN Partner
                </p>
            </div>

        </div>

    </div>
</section>


<section class="bg-white py-12 border-t border-b border-gray-100">
    <div class="max-w-6xl mx-auto px-6">

        <div class="flex flex-wrap justify-center items-center gap-12 md:gap-24">

            {{-- Danantara --}}
            <div class="flex items-center justify-center">
                <img src="{{ asset('images/logo Danantra.png') }}"
                     alt="Danantara"
                     loading="lazy"
                     decoding="async"
                     class="h-20 md:h-24 w-auto object-contain 
                            opacity-90 hover:opacity-100 
                            transition duration-300">
            </div>

            {{-- BRI --}}
            <div class="flex items-center justify-center">
                <img src="{{ asset('images/Logo bri.png') }}"
                     alt="BRI"
                     loading="lazy"
                     decoding="async"
                     class="h-20 md:h-28 w-auto object-contain 
                            opacity-90 hover:opacity-100 
                            transition duration-300">
            </div>

            {{-- Rumah BUMN --}}
            <div class="flex items-center justify-center">
                <img src="{{ asset('images/Logo Rumah BUMN.png') }}"
                     alt="Rumah BUMN"
                     loading="lazy"
                     decoding="async"
                     class="h-20 md:h-26 w-auto object-contain 
                            opacity-90 hover:opacity-100 
                            transition duration-300">
            </div>

        </div>

    </div>
</section>


{{-- ================= FAQ FULL ================= --}}
<section class="px-6 md:px-12 lg:px-20 py-16 
                bg-linear-to-b from-blue-800 via-blue-700 to-blue-500 
                text-white">

    <div class="max-w-6xl mx-auto">

        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-yellow-400 mb-4">
                FAQ
            </h2>
            <p class="text-base md:text-lg text-gray-200">
                Temukan jawaban atas pertanyaan umum seputar program magang 
                dan proses pendaftarannya.
            </p>
        </div>

        {{-- Grid FAQ --}}
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8 text-center">

            {{-- Item 1 --}}
            <div class="bg-white/10 p-6 rounded-xl 
                        hover:bg-white/20 hover:-translate-y-1
                        transition duration-300">

                <img src="{{ asset('images/work.svg') }}"
                     alt=""
                     loading="lazy"
                     decoding="async"
                     class="mx-auto h-10 mb-4">

                <h4 class="font-semibold text-yellow-400 mb-2">
                    Siapa yang bisa mendaftar magang?
                </h4>

                <p class="text-sm text-gray-200">
                    Program terbuka bagi mahasiswa dan lulusan 
                    yang memenuhi persyaratan administrasi.
                </p>
            </div>

            {{-- Item 2 --}}
            <div class="bg-white/10 p-6 rounded-xl 
                        hover:bg-white/20 hover:-translate-y-1
                        transition duration-300">

                <img src="{{ asset('images/interests.svg') }}"
                     alt=""
                     loading="lazy"
                     decoding="async"
                     class="mx-auto h-10 mb-4">

                <h4 class="font-semibold text-yellow-400 mb-2">
                    Bagaimana cara mendaftar?
                </h4>

                <p class="text-sm text-gray-200">
                    Pendaftaran dilakukan secara online 
                    melalui website resmi SIM Magang.
                </p>
            </div>

            {{-- Item 3 --}}
            <div class="bg-white/10 p-6 rounded-xl 
                        hover:bg-white/20 hover:-translate-y-1
                        transition duration-300">

                <img src="{{ asset('images/docs.svg') }}"
                     alt=""
                     loading="lazy"
                     decoding="async"
                     class="mx-auto h-10 mb-4">

                <h4 class="font-semibold text-yellow-400 mb-2">
                    Dokumen apa saja yang diperlukan?
                </h4>

                <p class="text-sm text-gray-200">
                    CV, surat pengantar kampus, dan 
                    dokumen pendukung lainnya.
                </p>
            </div>

            {{-- Item 4 --}}
            <div class="bg-white/10 p-6 rounded-xl 
                        hover:bg-white/20 hover:-translate-y-1
                        transition duration-300">

                <img src="{{ asset('images/time.svg') }}"
                     alt=""
                     loading="lazy"
                     decoding="async"
                     class="mx-auto h-10 mb-4">

                <h4 class="font-semibold text-yellow-400 mb-2">
                    Berapa lama durasi magang?
                </h4>

                <p class="text-sm text-gray-200">
                    Program berlangsung selama 3–6 bulan 
                    sesuai periode yang tersedia.
                </p>
            </div>

            {{-- Item 5 --}}
            <div class="bg-white/10 p-6 rounded-xl 
                        hover:bg-white/20 hover:-translate-y-1
                        transition duration-300">

                <img src="{{ asset('images/dashboard.svg') }}"
                     alt=""
                     loading="lazy"
                     decoding="async"
                     class="mx-auto h-10 mb-4">

                <h4 class="font-semibold text-yellow-400 mb-2">
                    Apakah bisa memilih divisi?
                </h4>

                <p class="text-sm text-gray-200">
                    Ya, peserta dapat memilih divisi 
                    sesuai minat dan kebutuhan program.
                </p>
            </div>

            {{-- Item 6 --}}
            <div class="bg-white/10 p-6 rounded-xl 
                        hover:bg-white/20 hover:-translate-y-1
                        transition duration-300">

                <img src="{{ asset('images/call (2).svg') }}"
                     alt=""
                     loading="lazy"
                     decoding="async"
                     class="mx-auto h-10 mb-4">

                <h4 class="font-semibold text-yellow-400 mb-2">
                    Siapa yang dapat dihubungi jika ada kendala?
                </h4>

                <p class="text-sm text-gray-200">
                    Silakan hubungi admin Rumah BUMN 
                    melalui halaman kontak resmi.
                </p>
            </div>

        </div>

        <div class="text-center mt-16">
            <p class="text-lg font-semibold mb-2">
                Masih memiliki pertanyaan?
            </p>
            <p class="text-gray-200 mb-6">
                Tim kami siap membantu Anda.
            </p>

            <a href="/kontak"
               class="inline-block px-8 py-3 bg-yellow-400 text-black 
                      rounded-md font-medium
                      hover:bg-yellow-500
                      transition duration-200">
                Kontak
            </a>
        </div>

    </div>
</section>

</div>
