<div class="bg-white p-6 rounded-2xl shadow-md overflow-x-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Daftar Peminjaman</h2>
        <!-- <button wire:click="openModal" class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium py-2 px-4 rounded-lg">
            + Tambah Peminjaman
        </button> -->
    </div>

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

            <div class="flex justify-end space-x-2 mt-6">
                <button wire:click="closeModal" class="bg-gray-100 border border-gray-300 hover:bg-gray-300 text-gray-700 py-2 px-4 rounded-md shadow-sm transition duration-150 ease-in-out transform hover:scale-105">
                    Batal
                </button>

                @if($isEdit)
                    <button wire:click="update" class="bg-yellow-400 hover:bg-yellow-500 text-white py-2 px-4 rounded-md shadow-sm transition duration-150 ease-in-out transform hover:scale-105">
                        Update
                    </button>
                @else
                    <button wire:click="store" class="bg-blue-500 border border-blue-600 hover:bg-blue-600 text-white py-2 px-4 rounded-md shadow-sm transition duration-150 ease-in-out transform hover:scale-105">
                        Simpan
                    </button>
                @endif
            </div>
        </div>
    </div>
    @endif

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