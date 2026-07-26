<div x-data="{ open: false, active: '#beranda' }" class="sticky top-0 z-50 w-full bg-white shadow-md">
  <!-- Header -->
  <div class="flex items-center justify-between px-4 py-3 md:px-6 md:py-2">
    <!-- Navigasi Kiri -->
    <div class="flex items-center">
      <img src="/images/logo_smp12yk.png" alt="Logo SMPN 12 Yogyakarta" class="h-10 w-auto mr-4" />
      <div class="hidden md:flex items-center space-x-8 text-sm text-black ml-6">
        <a href="#beranda" :class="{ 'font-bold': active === '#beranda' }" @click="active = '#beranda'" class="transition">Beranda</a>
        <a href="#statistik" :class="{ 'font-bold': active === '#statistik' }" @click="active = '#statistik'" class="transition">Statistik</a>
        <a href="#informasi" :class="{ 'font-bold': active === '#informasi' }" @click="active = '#informasi'" class="transition">Informasi</a>
        <a href="#berita" :class="{ 'font-bold': active === '#berita' }" @click="active = '#berita'" class="transition">Berita</a>
        <a href="#kontak" :class="{ 'font-bold': active === '#kontak' }" @click="active = '#kontak'" class="transition">Kontak</a>
      </div>
    </div>

    <!-- Navigasi Kanan -->
    <div class="flex items-center ml-auto">
      <!-- Hamburger -->
      <button @click="open = !open" class="md:hidden text-black mr-4 z-50 relative cursor-pointer">
        <!-- Hamburger Icon -->
        <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-black transition" fill="none"
             viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        <!-- Close Icon -->
        <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-black transition" fill="none"
             viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>

      <!-- Login -->
      <a href="{{ route('login') }}"
         class="rounded-md px-8 py-2 text-white bg-red-400 hover:bg-red-500 transition text-sm">
        Login
      </a>
    </div>
  </div>

  <!-- Dropdown Mobile -->
  <div x-show="open" x-transition
       class="absolute right-4 top-16 w-64 bg-white rounded-lg shadow-lg z-40 border px-4 py-3 space-y-2 text-black md:hidden">
    <a href="#beranda" @click="active = '#beranda'; open = false"
       :class="{ 'font-bold': active === '#beranda' }" class="block transition hover:bg-gray-100 px-2 py-1 rounded">
      Beranda
    </a>
        <a href="#statistik" @click="active = '#statistik'; open = false"
       :class="{ 'font-bold': active === '#statistik' }" class="block transition hover:bg-gray-100 px-2 py-1 rounded">
      Statistik
    </a>
    <a href="#informasi" @click="active = '#informasi'; open = false"
       :class="{ 'font-bold': active === '#informasi' }" class="block transition hover:bg-gray-100 px-2 py-1 rounded">
      Tentang
    </a>
    <a href="#berita" @click="active = '#berita'; open = false"
       :class="{ 'font-bold': active === '#berita' }" class="block transition hover:bg-gray-100 px-2 py-1 rounded">
      Berita
    </a>
    <a href="#kontak" @click="active = '#kontak'; open = false"
       :class="{ 'font-bold': active === '#kontak' }" class="block transition hover:bg-gray-100 px-2 py-1 rounded">
      Kontak
    </a>
  </div>
</div>
