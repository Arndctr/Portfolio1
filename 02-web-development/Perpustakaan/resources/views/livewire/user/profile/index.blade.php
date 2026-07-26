<div class="py-4 px-4 lg:px-6 w-full">
    <h2 class="text-xl font-semibold text-gray-800 mb-6">Profil Pengguna</h2>

     {{-- Informasi Keanggotaan --}}
    <div class="bg-white p-6 rounded-lg shadow mb-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Keanggotaan</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-3 gap-x-6 text-sm text-gray-700">
            <div><span class="font-medium">Nama:</span> {{ auth()->user()->name }}</div>
            <div><span class="font-medium">NIM/NIP:</span> {{ auth()->user()->anggota->nis ?? auth()->user()->anggota->nip ?? '-' }}</div>
            <div><span class="font-medium">Email:</span> {{ auth()->user()->email ?? '-' }}</div>
            <div><span class="font-medium">Kelas:</span> {{ auth()->user()->anggota->kelas ?? '-' }}</div>
            <div>
                <span class="font-medium">Jenis Kelamin:</span>
                @php
                    $jk = auth()->user()->anggota->jenis_kelamin ?? null;
                @endphp
                {{ $jk === 'L' ? 'Laki-laki' : ($jk === 'P' ? 'Perempuan' : '-') }}
            </div>
        </div>
    </div>


    {{-- Notifikasi Email Belum Diisi --}}
    @if (session('force_fill_email'))
        <div class="p-4 mb-4 rounded-md bg-red-50 border border-red-300 text-red-800 text-sm">
            Silakan lengkapi alamat email Anda sebelum melanjutkan.
        </div>
    @endif

    {{-- Grid 2 Kolom --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        {{-- Informasi Profil --}}
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-gray-800 mb-1">Informasi Profil</h3>
            <p class="text-sm text-gray-600 mb-4">
                Perbarui nama dan email Anda agar informasi akun tetap akurat.
            </p>
            <livewire:user.profile.update-profile-information-form />
        </div>

        {{-- Keamanan: Ubah Password --}}
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-gray-800 mb-1">Keamanan</h3>
            <p class="text-sm text-gray-600 mb-4">
                Gunakan password yang kuat dan rutin diperbarui untuk menjaga keamanan akun.
            </p>
            <livewire:user.profile.update-password-form />
        </div>
    </div>
</div>
