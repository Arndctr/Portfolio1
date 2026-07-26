<!-- Wrapper tengah halaman -->
<div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-gray-100 via-white to-gray-200 px-4 font-sans">
  <!-- Kontainer utama -->
  <div class="flex w-full max-w-4xl shadow-2xl rounded-2xl overflow-hidden transition-all duration-300 ease-in-out border border-gray-200">

    <!-- Kiri: Form Verifikasi Email -->
    <div class="w-full md:w-1/2 p-6 sm:p-12 bg-white flex flex-col justify-center">
      <!-- Logo -->
      <div class="mb-6 flex justify-center">
        <img src="/images/logo_smp12yk.png" alt="Logo" style="height: 65px; width: auto;" class="object-contain drop-shadow-md transition duration-300 hover:scale-105" />
      </div>

      <!-- Notifikasi sukses -->
      @if ($message)
        <div class="mb-4 px-4 py-3 rounded-xl bg-green-50 text-green-700 text-sm">
          {{ $message }}
        </div>
      @endif

      <!-- Form -->
      <form wire:submit.prevent="resendVerificationEmail" class="space-y-5 text-sm">
        <!-- Email -->
        <div>
          <x-input-label for="email" :value="('Email Anda')" />
          <x-text-input wire:model="email" id="email" type="email"
            class="block mt-1 w-full text-sm" required autocomplete="email" />
          <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs" />
        </div>

        <!-- Info -->
        <p class="text-sm text-gray-600">
          Cek inbox Anda untuk tautan verifikasi. Belum menerima email? Klik tombol di bawah untuk mengirim ulang.
        </p>

        <!-- Tombol -->
        <div class="pt-2">
          <x-primary-button class="w-full text-sm transition-all">Kirim Ulang Email Verifikasi</x-primary-button>
        </div>
      </form>
    </div>

    <!-- Kanan: Gambar & teks -->
    <div class="hidden md:flex md:w-1/2 p-8 items-center bg-blue-200 justify-center relative overflow-hidden rounded-r-2xl">
      <div class="absolute inset-0 bg-black/10 backdrop-blur-sm z-0"></div>
      <div class="relative z-10 text-center space-y-4">
        <img
          src="/images/library_07.png"
          alt="Gambar Verifikasi"
          class="w-64 h-auto object-contain mx-auto mb-4 drop-shadow-xl rounded-xl transition-all duration-500"
        />
        <h2 class="text-lg font-semibold">Verifikasi Email Anda</h2>
        <p class="text-sm text-indigo-100">Kami ingin memastikan bahwa ini benar-benar Anda. Yuk cek email sekarang!</p>
      </div>
    </div>

  </div>
</div>
