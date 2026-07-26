<!-- Wrapper tengah halaman -->
<div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-gray-100 via-white to-gray-200 px-4 font-sans">
  <!-- Kontainer utama -->
  <div class="flex w-full max-w-4xl shadow-2xl rounded-2xl overflow-hidden transition-all duration-300 ease-in-out border border-gray-200">

    <!-- Kiri: Form Ganti Password -->
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
        <form wire:submit.prevent="updatePassword" class="space-y-5 text-sm">
        <!-- Password Baru -->
        <div>
            <x-input-label for="new_password" :value="('Password Baru')" />
            <div class="relative">
            <input
                id="new_password"
                type="password"
                wire:model="new_password"
                class="block mt-1 w-full text-sm pr-10 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                name="new_password"
                required
                autocomplete="new-password"
            />

            <button type="button" onclick="togglePassword('new_password', 'eyeIcon1')"
                class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500">
                <svg id="eyeIcon1" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
            </button>
            </div>
            <x-input-error :messages="$errors->get('new_password')" class="mt-1 text-xs" />
        </div>

        <!-- Konfirmasi Password -->
        <div>
            <x-input-label for="confirm_password" :value="('Konfirmasi Password')" />
            <div class="relative">
            <input
                id="confirm_password"
                type="password"
                wire:model="confirm_password"
                class="block mt-1 w-full text-sm pr-10 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                name="confirm_password"
                required
                autocomplete="new-password"
            />

            <button type="button" onclick="togglePassword('confirm_password', 'eyeIcon2')"
                class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500">
                <svg id="eyeIcon2" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
            </button>
            </div>
            <x-input-error :messages="$errors->get('confirm_password')" class="mt-1 text-xs" />
        </div>

        <!-- Tombol Simpan -->
        <div class="pt-2">
            <x-primary-button class="w-full text-sm transition-all">Simpan Password</x-primary-button>
        </div>
        </form>

        <!-- Script toggle -->
        <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            input.type = input.type === 'password' ? 'text' : 'password';
            // Optional: toggle icon style or SVG
        }
        </script>

    </div>

    <!-- Kanan: Gambar dan teks -->
    <div class="hidden md:flex md:w-1/2 p-8 items-center bg-blue-200 justify-center relative overflow-hidden rounded-r-2xl">
      <div class="absolute inset-0 bg-black/10 backdrop-blur-sm z-0"></div>
      <div class="relative z-10 text-center space-y-4">
        <img src="/images/library_07.png" alt="Gambar Perpustakaan"
             class="w-64 h-auto object-contain mx-auto mb-4 drop-shadow-xl rounded-xl transition-all duration-500" />
        <h2 class="text-lg font-semibold">Halo, {{ auth()->user()->name ?? 'Pengguna' }}!</h2>
        <p class="text-sm text-indigo-100">Silakan buat password baru untuk mulai menggunakan sistem perpustakaan.</p>
      </div>
    </div>

  </div>
</div>
