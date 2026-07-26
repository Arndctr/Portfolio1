<div class="bg-white p-6 rounded-2xl shadow-md space-y-6">
    @if (session()->has('message'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 text-sm rounded">
            {{ session('message') }}
        </div>
    @endif

    <!-- Judul dan Tombol Pengingat -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
        <h2 class="text-xl font-semibold text-gray-800">Daftar Peminjaman</h2>

        <!-- Tombol dan Catatan -->
        <div class="w-full sm:w-52 text-center">
            <button wire:click="kirimSemuaPengingat"
                class="bg-red-500 hover:bg-red-600 text-white text-sm px-4 py-2 rounded-md shadow-sm transition w-full">
                Pengingat
            </button>
            <p class="mt-1 text-xs text-gray-500 italic whitespace-nowrap">
                *Broadcast pengingat &lt; 3 hari
            </p>
        </div>
    </div>

    <!-- Input Pencarian -->
    <div class="w-full">
        <input 
            type="text" 
            wire:model.live.debounce.300ms="search" 
            placeholder="Cari nama anggota..." 
            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:outline-none focus:border-blue-500 shadow-sm">
    </div>

    <!-- Filter Status -->
    <div class="flex justify-start mt-2">
        <div class="relative w-36">
            <select wire:model.live="filterStatus"
                class="w-full appearance-none border border-gray-300 rounded-md px-4 py-2 pr-8 text-sm shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none bg-white">
                <option value="">Semua Status</option>
                <option value="booking">Booking</option>
                <option value="dipinjam">Dipinjam</option>
                <option value="dikembalikan">Dikembalikan</option>
            </select>
        </div>
    </div>

    <!-- Modal -->
    @if($showModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 backdrop-blur-sm">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-lg sm:max-w-md p-6">
            <h2 class="text-xl font-semibold mb-4">{{ $isEdit ? 'Edit Peminjaman' : 'Tambah Peminjaman' }}</h2>

            <div class="space-y-4 text-sm text-gray-600">
                <div>
                    <label for="anggota_id" class="block text-black text-xs mb-1">Anggota</label>
                    <select wire:model="anggota_id" id="anggota_id" class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:ring focus:ring-blue-100 focus:outline-none">
                        <option value="" disabled>Pilih anggota</option>
                        @foreach ($anggotaList as $anggota)
                            <option value="{{ $anggota->id }}">{{ $anggota->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="buku_id" class="block text-black text-xs mb-1">Buku</label>
                    <select wire:model="buku_id" id="buku_id" class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:ring focus:ring-blue-100 focus:outline-none">
                        <option value="" disabled>Pilih buku</option>
                        @foreach ($bukuList as $buku)
                            <option value="{{ $buku->id }}">{{ $buku->judul }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex space-x-2">
                    <div class="w-1/2">
                        <label for="tanggal_pinjam" class="block text-black text-xs mb-1">Tanggal Pinjam</label>
                        <input type="date" wire:model="tanggal_pinjam" id="tanggal_pinjam"
                            class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:ring focus:ring-blue-100 focus:outline-none">
                    </div>
                    <div class="w-1/2">
                        <label for="tanggal_kembali" class="block text-black text-xs mb-1">Tanggal Kembali (saat ini)</label>
                        <input type="date" value="{{ now()->format('Y-m-d') }}" readonly
                            class="w-full bg-gray-100 border border-gray-200 rounded-md p-2 text-gray-600">
                    </div>
                </div>

                <div>
                    <label for="status" class="block text-black text-xs mb-1">Status</label>
                    <select wire:model="status" id="status"
                        class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:ring focus:ring-blue-100 focus:outline-none">
                        <option value="" disabled selected></option>
                        <option value="booking">booking</option>
                        <option value="dipinjam">dipinjam</option>
                        <option value="dikembalikan">dikembalikan</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Tabel -->
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left text-gray-700 border border-gray-200 rounded-lg overflow-hidden">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 font-semibold">No</th>
                    <th class="px-4 py-3 font-semibold">Anggota</th>
                    <th class="px-4 py-3 font-semibold">Judul Buku</th>
                    <th class="px-4 py-3 font-semibold">Tanggal Pinjam</th>
                    <th class="px-4 py-3 font-semibold">Tanggal Kembali</th>
                    <th class="px-4 py-3 font-semibold">Status</th>
                    <th class="px-4 py-3 text-center font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if($listPeminjaman && $listPeminjaman->isNotEmpty())
                    @foreach($listPeminjaman as $index => $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $index + 1 }}</td>
                            <td class="px-4 py-2">{{ $item->anggota->nama }}</td>
                            <td class="px-4 py-2">{{ $item->buku->judul }}</td>
                            <td class="px-4 py-2">{{ $item->tanggal_pinjam }}</td>
                            <td class="px-4 py-2">{{ $item->tanggal_kembali }}</td>
                            <td class="px-4 py-2">
                                <span class="px-2 py-1 rounded-full text-xs 
                                    @if(strtolower($item->status) == 'booking') bg-yellow-200 text-yellow-800 
                                    @elseif(strtolower($item->status) == 'dipinjam') bg-green-200 text-green-800 
                                    @elseif(strtolower($item->status) == 'dikembalikan') bg-blue-200 text-blue-800 
                                    @endif">
                                    {{ $item->status }}
                                </span>
                            </td>
                            <td class="px-4 py-2 text-center space-y-1">
                                @php
                                    $now = now();
                                    $tanggalKembali = \Carbon\Carbon::parse($item->tanggal_kembali);
                                    $diffInDays = $now->diffInDays($tanggalKembali, false);
                                @endphp

                                @if (strtolower($item->status) === 'booking')
                                    <button wire:click="setujui({{ $item->id }})"
                                        class="px-2 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded text-xs">
                                        Setujui
                                    </button>
                                @elseif (strtolower($item->status) === 'dipinjam')
                                    <button wire:click="kembalikan({{ $item->id }})"
                                        class="px-2 py-1 bg-green-500 hover:bg-green-600 text-white rounded text-xs">
                                        Dikembalikan
                                    </button>
                                @else
                                    <span class="text-green-600 text-xs">Sudah dikembalikan</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7" class="text-center text-gray-500 py-4">Belum ada data peminjaman.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
