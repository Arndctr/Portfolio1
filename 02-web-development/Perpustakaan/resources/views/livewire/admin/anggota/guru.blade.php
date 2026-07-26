<div class="space-y-6">
    <div class="bg-white p-6 rounded-2xl shadow-md overflow-x-auto">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 gap-4 sm:gap-0">
            <h2 class="text-lg sm:text-xl font-semibold text-gray-800">Daftar Guru</h2>
            <div class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto">
                <button wire:click="exportGuru"
                class="bg-green-500 hover:bg-green-600 text-white text-sm font-medium py-2 px-3 sm:px-4 rounded-lg text-center">
                    Export Excel
                </button>
                <button wire:click="openModal"
                        class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium py-2 px-3 sm:px-4 rounded-lg text-center">
                    + Tambah Guru
                </button>
            </div>
        </div>

        <!-- Filter dan Pencarian -->
        <div class="flex flex-col gap-4 mb-6">
            <div class="w-full">
                <input type="text" wire:model.live.debounce.300ms="search"
                    placeholder="Cari nama guru..."
                    class="w-full px-4 py-2 text-sm bg-gray-50 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div class="w-full sm:w-1/3">
                <select wire:model.live="filterStatus"
                    class="w-full px-3 py-2 text-sm bg-gray-50 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="semua">Semua Status</option>
                    <option value="active">Aktif</option>
                    <option value="inactive">Tidak Aktif</option>
                </select>
            </div>
        </div>

        
        @if($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 backdrop-blur-sm">
            <div class="bg-white rounded-xl shadow-lg w-full max-w-lg p-6 max-h-[90vh] overflow-y-auto">
                <h2 class="text-xl font-semibold mb-4">{{ $isEdit ? 'Edit Guru' : 'Tambah Guru' }}</h2>

                {{-- Validasi Error --}}
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-sm">
                        <strong class="font-medium">Terdapat kesalahan input:</strong>
                        <ul class="list-disc list-inside mt-2 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="space-y-4 text-sm text-gray-600">
                    <!-- Nama -->
                    <div>
                        <label for="nama" class="block text-black text-xs mb-1">Nama Lengkap</label>
                        <input type="text" wire:model="nama" id="nama"
                            class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:border-blue-500 focus:ring focus:ring-blue-100 focus:outline-none text-sm" />
                    </div>
                
                    <!-- Status & NIP dalam satu baris -->
                    <div class="flex gap-4">
                        <!-- Status -->
                        <div class="w-1/2">
                            <label for="status" class="block text-black text-xs mb-1">Status</label>
                            <select wire:model="status" id="status"
                                class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:border-blue-500 focus:ring focus:ring-blue-100 focus:outline-none text-sm">
                                <option value="">-- Pilih Status --</option>
                                <option value="active">Aktif</option>
                                <option value="inactive">Tidak Aktif</option>
                            </select>
                        </div>

                        <!-- NIP -->
                        <div class="w-1/2">
                            <label for="nip" class="block text-black text-xs mb-1">Nomor Induk Pegawai (NIP)</label>
                            <input type="text" wire:model="nip" id="nip"
                                class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:border-blue-500 focus:ring focus:ring-blue-100 focus:outline-none text-sm" />
                        </div>
                    </div>

                    <!-- Jenis Kelamin & Nomor Telepon dalam satu baris -->
                    <div class="flex gap-4">
                        <!-- Jenis Kelamin -->
                        <div class="w-1/2">
                            <label for="jenis_kelamin" class="block text-black text-xs mb-1">Jenis Kelamin</label>
                            <select wire:model="jenis_kelamin" id="jenis_kelamin"
                                class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:border-blue-500 focus:ring focus:ring-blue-100 focus:outline-none text-sm">
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>

                        <!-- Nomor Telepon -->
                        <div class="w-1/2">
                            <label for="no_telp" class="block text-black text-xs mb-1">Nomor Telepon</label>
                            <input type="text" wire:model="no_telp" id="no_telp"
                                class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:border-blue-500 focus:ring focus:ring-blue-100 focus:outline-none text-sm" />
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label for="alamat" class="block text-black text-xs mb-1">Alamat</label>
                        <textarea wire:model="alamat" id="alamat" rows="3"
                            class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:border-blue-500 focus:ring focus:ring-blue-100 focus:outline-none text-sm"></textarea>
                    </div>
                

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-black text-xs mb-1">Email</label>
                        <input type="email" wire:model="email" id="email"
                            class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:border-blue-500 focus:ring focus:ring-blue-100 focus:outline-none text-sm" />
                    </div>
                </div>              

                <div class="flex justify-end space-x-2 mt-6">
                    <button wire:click="closeModal"
                        class="bg-gray-100 border border-gray-300 hover:bg-gray-300 text-gray-700 py-2 px-4 rounded-md shadow-sm transition duration-150 ease-in-out transform hover:scale-105">
                        Batal
                    </button>
                
                    @if($isEdit)
                        <button wire:click="update"
                            class="bg-yellow-400 hover:bg-yellow-500 text-white py-2 px-4 rounded-md shadow-sm transition duration-150 ease-in-out transform hover:scale-105">
                            Update Guru
                        </button>
                    @else
                        <button wire:click.prevent="store"
                            type="submit" class="bg-blue-500 border border-blue-600 hover:bg-blue-600 text-white py-2 px-4 rounded-md shadow-sm transition duration-150 ease-in-out transform hover:scale-105">
                            Simpan Guru
                        </button>
                    @endif
                </div>            
            </div>
        </div>
        @endif

        <!-- Tabel Daftar Guru -->
        <table class="min-w-full text-sm text-left text-gray-700 border border-gray-200 rounded-lg overflow-hidden">
            <thead class="bg-gray-50">
            <tr class="text-center">
                <th class="px-4 py-3 font-semibold">No</th>

                <!-- Kolom Nama dengan panah -->
                <th class="px-4 py-3 font-semibold cursor-pointer select-none" wire:click="sortBy('nama')">
                    <div class="flex items-center justify-center gap-1 text-sm">
                        Nama
                        <svg class="w-3 h-3 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                            @if ($sortField === 'nama' && $sortDirection === 'asc')
                                <path d="M5 12l5-5 5 5H5z" /> {{-- Panah naik --}}
                            @elseif ($sortField === 'nama' && $sortDirection === 'desc')
                                <path d="M5 8l5 5 5-5H5z" /> {{-- Panah turun --}}
                            @else
                                <path d="M5 8l5 5 5-5H5z" /> {{-- Default: panah turun --}}
                            @endif
                        </svg>
                    </div>
                </th>

                <!-- Kolom Status dengan panah -->
                <th class="px-4 py-3 font-semibold cursor-pointer select-none" wire:click="sortBy('status')">
                    <div class="flex items-center justify-center gap-1 text-sm">
                        Status
                        <svg class="w-3 h-3 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                            @if ($sortField === 'status' && $sortDirection === 'asc')
                                <path d="M5 12l5-5 5 5H5z" />
                            @elseif ($sortField === 'status' && $sortDirection === 'desc')
                                <path d="M5 8l5 5 5-5H5z" />
                            @else
                                <path d="M5 8l5 5 5-5H5z" />
                            @endif
                        </svg>
                    </div>
                </th>

                <th class="px-4 py-3 font-semibold">NIP</th>
                <th class="px-4 py-3 font-semibold">Jenis Kelamin</th>
                <th class="px-4 py-3 font-semibold">Alamat</th>
                <th class="px-4 py-3 font-semibold">Nomor Telepon</th>
                <th class="px-4 py-3 font-semibold">Email</th>
                <th class="px-4 py-3 text-center font-semibold">Aksi</th>
            </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-100">
                @if($anggota->isEmpty())
                        <tr>
                            <td colspan="11" class="text-center py-6 text-red-500 ">
                                Tidak ada data guru ditemukan.
                            </td>
                        </tr>
                    @else
                @foreach($anggota as $index => $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $index + 1 }}</td>
                        <td class="px-4 py-2">{{ $item->nama }}</td>
                        <td class="px-4 py-2 whitespace-nowrap">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-semibold border
                                {{ $item->status == 'active' 
                                    ? 'text-green-700 bg-green-200 border-green-500' 
                                    : 'text-red-700 bg-red-200 border-red-500' }}">
                                {{ $item->status == 'active' ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </td>
                        <td class="px-4 py-2">{{ $item->nis_nip }}</td>
                        <td class="px-4 py-2 text-center">
                            @if($item->jenis_kelamin == 'L')
                                <span class="inline-block px-3 py-1 text-blue-700 bg-blue-200 border border-blue-500 rounded-full text-xs font-semibold">
                                    Laki-laki
                                </span>
                            @else
                                <span class="inline-block px-3 py-1 text-pink-700 bg-pink-200 border border-pink-500 rounded-full text-xs font-semibold">
                                    Perempuan
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-2">{{ \Illuminate\Support\Str::limit($item->alamat, 100) }}</td>
                        <td class="px-4 py-2">{{ $item->no_telp }}</td>
                        <td class="px-4 py-2">{{ $item->email ?? '-' }}</td>
                        <td class="px-4 py-2 text-center">
                            <div class="flex flex-col items-center space-y-2 md:flex-row md:justify-center md:space-y-0 md:space-x-2">
                                <button wire:click="edit({{ $item->id }})" class="px-3 py-1 bg-yellow-400 hover:bg-yellow-500 text-white rounded-md shadow text-xs">
                                    Edit
                                </button>
                                <button wire:click="delete({{ $item->id }})" class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded-md shadow text-xs">
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach

                
                @endif
            </tbody>
        </table>


    </div>
</div>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    window.addEventListener('confirm-delete', event => {
        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: 'Yakin ingin menghapus data ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e3342f',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if(result.isConfirmed) {
                Livewire.emit('deleteConfirmed');
            }
        });
    });
</script>
