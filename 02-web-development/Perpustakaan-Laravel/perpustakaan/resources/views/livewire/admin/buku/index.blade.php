<div class="bg-white p-6 rounded-2xl shadow-md max-w-full">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 gap-4 sm:gap-0">
        <h2 class="text-lg sm:text-xl font-semibold text-gray-800">Daftar Buku</h2>
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6">
            <button wire:click="openModal"
                class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium py-2 px-3 sm:px-4 rounded-lg text-center">
                    + Tambah Buku
            </button>
        </div>
    </div>

    <!-- Filter dan Cari -->
    <div class="flex flex-col gap-4 mb-6">

        <!-- Input Pencarian -->
        <div>
            <input type="text" wire:model.live.debounce.300ms="search"
                placeholder="Cari judul buku..."
                class="w-full px-3 py-2 text-sm bg-gray-50 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Filter Kategori dan Tahun -->
        <div class="flex flex-col sm:flex-row gap-4">
            <!-- Kategori -->
            <div class="w-full sm:w-1/2">
                <select wire:model.live="filterKategori"
                    class="w-full px-3 py-2 text-sm bg-gray-50 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="semua">Semua Kategori</option>
                    @foreach($kategoriList as $kat)
                        <option value="{{ $kat }}">{{ $kat }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Tahun Terbit -->
            <div class="w-full sm:w-1/2">
                <select wire:model.live="filterTahun"
                    class="w-full px-3 py-2 text-sm bg-gray-50 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="semua">Semua Tahun</option>
                    @foreach($tahunList as $tahun)
                        <option value="{{ $tahun }}">{{ $tahun }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    @if($showModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 backdrop-blur-sm">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-lg sm:max-w-md max-h-[90vh] overflow-y-auto p-6 mx-4">
            <h2 class="text-xl font-semibold mb-4">{{ $isEdit ? 'Edit Buku' : 'Tambah Buku' }}</h2>

            <div class="space-y-4 text-sm text-gray-600">
                <!-- Cover Buku -->
                <div>
                    <label for="cover" class="block text-black text-xs mb-1">Cover Buku <span class="text-red-500">*</span></label>
                    <input type="file" wire:model="cover" id="cover"
                        class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:ring focus:ring-blue-100 focus:outline-none">
                    @error('cover') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror

                    @if ($isEdit && $existingCover && !$cover)
                        <div class="mt-2">
                            <p class="text-xs text-gray-500 mb-1">Cover saat ini:</p>
                            <img src="{{ asset('storage/' . $existingCover) }}" alt="Cover lama"
                                class="w-32 h-48 object-cover rounded-md border">
                        </div>
                    @endif

                    @if ($cover)
                        <div class="mt-2">
                            <p class="text-xs text-gray-500 mb-1">Preview cover baru:</p>
                            <img src="{{ $cover->temporaryUrl() }}" alt="Preview Cover"
                                class="w-32 h-48 object-cover rounded-md border">
                        </div>
                    @endif
                </div>

                <!-- Judul -->
                <div>
                    <label for="judul" class="block text-black text-xs mb-1">Judul <span class="text-red-500">*</span></label>
                    <input type="text" wire:model="judul" id="judul"
                        class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:border-blue-500 focus:ring focus:ring-blue-100 focus:outline-none text-sm" />
                    @error('judul') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="deskripsi" class="block text-black text-xs mb-1">Deskripsi Buku</label>
                    <textarea wire:model="deskripsi" id="deskripsi"
                        class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:border-blue-500 focus:ring focus:ring-blue-100 focus:outline-none text-sm"
                        rows="3" style="resize: none;"></textarea>
                    @error('deskripsi') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Kategori -->
                <div>
                    <label for="kategori" class="block text-black text-xs mb-1">Kategori <span class="text-red-500">*</span></label>
                    <select wire:model="kategori" id="kategori"
                        class="w-full text-black border border-gray-100 shadow-sm rounded-md p-2 focus:ring focus:ring-blue-100 focus:outline-none">
                        <option value="" disabled selected>Pilih kategori</option>
                        <option value="Fiksi">Fiksi</option>
                        <option value="Non-Fiksi">Non-Fiksi</option>
                        <option value="Biografi">Biografi</option>
                        <option value="Teknologi">Teknologi</option>
                        <option value="Sejarah">Sejarah</option>
                        <option value="Pendidikan">Pendidikan</option>
                        <option value="Komik">Komik</option>
                        <option value="Sains">Sains</option>
                        <option value="Agama">Agama</option>
                        <option value="Sosial">Sosial</option>
                    </select>
                    @error('kategori') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Penulis & Penerbit -->
                <div class="flex flex-wrap sm:flex-nowrap space-x-0 sm:space-x-2">
                    <div class="w-full sm:w-1/2">
                        <label for="penulis" class="block text-black text-xs mb-1">Penulis <span class="text-red-500">*</span></label>
                        <input type="text" wire:model="penulis" id="penulis"
                            class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:ring focus:ring-blue-100 focus:outline-none">
                        @error('penulis') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="w-full sm:w-1/2">
                        <label for="penerbit" class="block text-black text-xs mb-1">Penerbit <span class="text-red-500">*</span></label>
                        <input type="text" wire:model="penerbit" id="penerbit"
                            class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:ring focus:ring-blue-100 focus:outline-none">
                        @error('penerbit') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Tahun Terbit & ISBN -->
                <div class="flex flex-wrap sm:flex-nowrap space-x-0 sm:space-x-2">
                    <div class="w-full sm:w-1/2">
                        <label for="tahun_terbit" class="block text-black text-xs mb-1">Tahun Terbit <span class="text-red-500">*</span></label>
                        <select wire:model="tahun_terbit" id="tahun_terbit"
                            class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:ring focus:ring-blue-100 focus:outline-none">
                            <option value="" disabled selected>Pilih tahun</option>
                            @for ($year = date('Y'); $year >= 1900; $year--)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endfor
                        </select>
                        @error('tahun_terbit') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="w-full sm:w-1/2">
                        <label for="isbn" class="block text-black text-xs mb-1">ISBN <span class="text-red-500">*</span></label>
                        <input type="text" wire:model="isbn" id="isbn"
                            class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:ring focus:ring-blue-100 focus:outline-none">
                        @error('isbn') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Jumlah stok & Lokasi rak -->
                <div class="flex flex-wrap sm:flex-nowrap space-x-0 sm:space-x-2">
                    <div class="w-full sm:w-1/2">
                        <label for="jumlah_stok" class="block text-black text-xs mb-1">Jumlah Stok <span class="text-red-500">*</span></label>
                        <input type="number" id="jumlah_stok" wire:model="jumlah_stok"
                            class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:border-blue-500 focus:ring focus:ring-blue-100 focus:outline-none text-sm" />
                        @error('jumlah_stok') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="w-full sm:w-1/2">
                        <label for="lokasi_rak" class="block text-black text-xs mb-1">Lokasi Rak <span class="text-red-500">*</span></label>
                        <input type="text" id="lokasi_rak" wire:model="lokasi_rak"
                            class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:border-blue-500 focus:ring focus:ring-blue-100 focus:outline-none text-sm" />
                        @error('lokasi_rak') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
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
                        Update Buku
                    </button>
                @else
                    <button wire:click.prevent="store"
                        type='submit' class="bg-blue-500 border border-blue-600 hover:bg-blue-600 text-white py-2 px-4 rounded-md shadow-sm transition duration-150 ease-in-out transform hover:scale-105">
                        Simpan Buku
                    </button>
                @endif
            </div>
        </div>
    </div>
    @endif

    <!-- Tabel Daftar Buku -->
    <div class="w-full rounded-lg border border-gray-200 shadow-sm overflow-visible">
        <div class="w-full overflow-x-auto rounded-lg">
            <table class="min-w-[1000px] w-full text-sm text-left text-gray-700">
                <thead class="border-b border-gray-200">
                    <tr>
                        <th class="px-4 py-3 font-semibold text-center">No</th>
                        <th class="px-4 py-3 font-semibold text-center">Judul Buku</th>
                        <th class="px-4 py-3 font-semibold text-center">Deskripsi</th>
                        <th class="px-4 py-3 font-semibold cursor-pointer select-none" wire:click="sortBy('kategori')">
                            <div class="flex items-center justify-center gap-1 text-sm">
                                Kategori
                                <svg class="w-3 h-3 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                    @if ($sortField === 'kategori' && $sortDirection === 'asc')
                                        <path d="M5 12l5-5 5 5H5z" /> {{-- Panah naik --}}
                                    @elseif ($sortField === 'kategori' && $sortDirection === 'desc')
                                        <path d="M5 8l5 5 5-5H5z" /> {{-- Panah turun --}}
                                    @else
                                        <path d="M5 8l5 5 5-5H5z" /> {{-- Default: panah turun --}}
                                    @endif
                                </svg>
                            </div>
                        </th>
                        <th class="px-4 py-3 font-semibold text-center">Penulis</th>
                        <th class="px-4 py-3 font-semibold text-center">Penerbit</th>
                        <th class="px-4 py-3 font-semibold text-center">Tahun</th>
                        <th class="px-4 py-3 font-semibold text-center">ISBN</th>
                        <th class="px-4 py-3 font-semibold text-center">Jumlah Stok</th>
                        <th class="px-4 py-3 font-semibold text-center">Lokasi Rak</th>
                        <th class="px-4 py-3 text-center font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @if($buku->isEmpty())
                        <tr>
                            <td colspan="11" class="text-center py-6 text-red-500 ">
                                Tidak ada data buku ditemukan.
                            </td>
                        </tr>
                    @else
                    @foreach($buku as $index => $item)
                    <tr wire:key="buku-{{ $item->id }}">
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 text-center">{{ $index + 1 }}</td>

                            <td class="px-4 py-2">{{ $item->judul }}</td>
                            <td class="px-4 py-2">{{ Str::limit($item->deskripsi, 100, '...') }}</td>

                            <td class="px-4 py-2 text-center">
                                @switch($item->kategori)
                                    @case('Fiksi')
                                        <span class="inline-block px-3 py-1 text-green-700 bg-green-200 border border-green-500 rounded-full text-xs font-semibold">
                                            Fiksi
                                        </span>
                                        @break
                                    @case('Non-Fiksi')
                                        <span class="inline-block px-3 py-1 text-blue-700 bg-blue-200 border border-blue-500 rounded-full text-xs font-semibold">
                                            Non-Fiksi
                                        </span>
                                        @break
                                    @case('Biografi')
                                        <span class="inline-block px-3 py-1 text-yellow-700 bg-yellow-200 border border-yellow-500 rounded-full text-xs font-semibold">
                                            Biografi
                                        </span>
                                        @break
                                    @case('Teknologi')
                                        <span class="inline-block px-3 py-1 text-purple-700 bg-purple-200 border border-purple-500 rounded-full text-xs font-semibold">
                                            Teknologi
                                        </span>
                                        @break
                                    @case('Sejarah')
                                        <span class="inline-block px-3 py-1 text-pink-700 bg-pink-200 border border-pink-500 rounded-full text-xs font-semibold">
                                            Sejarah
                                        </span>
                                        @break
                                    @case('Pendidikan')
                                        <span class="inline-block px-3 py-1 text-indigo-700 bg-indigo-200 border border-indigo-500 rounded-full text-xs font-semibold">
                                            Pendidikan
                                        </span>
                                        @break
                                    @case('Komik')
                                        <span class="inline-block px-3 py-1 text-orange-700 bg-orange-200 border border-orange-500 rounded-full text-xs font-semibold">
                                            Komik
                                        </span>
                                        @break
                                    @case('Sains')
                                        <span class="inline-block px-3 py-1 text-teal-700 bg-teal-200 border border-teal-500 rounded-full text-xs font-semibold">
                                            Sains
                                        </span>
                                        @break
                                    @case('Agama')
                                        <span class="inline-block px-3 py-1 text-gray-700 bg-gray-200 border border-gray-500 rounded-full text-xs font-semibold">
                                            Agama
                                        </span>
                                        @break
                                    @case('Sosial')
                                        <span class="inline-block px-3 py-1 text-red-700 bg-red-200 border border-red-500 rounded-full text-xs font-semibold">
                                            Sosial
                                        </span>
                                        @break
                                    @default
                                        <span>{{ $item->kategori }}</span>
                                @endswitch
                            </td>

                            <td class="px-4 py-2 text-center">{{ $item->penulis }}</td>
                            <td class="px-4 py-2 text-center">{{ $item->penerbit }}</td>

                            @php
                                $tahunSekarang = date('Y');
                                $selisih = $tahunSekarang - $item->tahun_terbit;
                            @endphp
                            <td class="px-4 py-2 text-center">
                                @if($selisih <= 5)
                                    <span class="inline-block px-3 py-1 text-green-700 bg-green-200 border border-green-500 rounded-full text-xs font-semibold">
                                        {{ $item->tahun_terbit }}
                                    </span>
                                @elseif($selisih <= 10)
                                    <span class="inline-block px-3 py-1 text-yellow-700 bg-yellow-200 border border-yellow-500 rounded-full text-xs font-semibold">
                                        {{ $item->tahun_terbit }}
                                    </span>
                                @else
                                    <span class="inline-block px-3 py-1 text-red-700 bg-red-200 border border-red-500 rounded-full text-xs font-semibold">
                                        {{ $item->tahun_terbit }}
                                    </span>
                                @endif
                            </td>

                            <td class="px-4 py-2 text-center">{{ $item->isbn }}</td>

                            <td class="px-4 py-2 text-center">
                                @if($item->jumlah_stok == 0)
                                    <span class="inline-block px-3 py-1 text-red-700 bg-red-200 border border-red-500 rounded-full text-xs font-semibold">
                                        {{ $item->jumlah_stok }}
                                    </span>
                                @elseif($item->jumlah_stok <= 10)
                                    <span class="inline-block px-3 py-1 text-yellow-700 bg-yellow-200 border border-yellow-500 rounded-full text-xs font-semibold">
                                        {{ $item->jumlah_stok }}
                                    </span>
                                @else
                                    <span class="inline-block px-3 py-1 text-green-700 bg-green-200 border border-green-500 rounded-full text-xs font-semibold">
                                        {{ $item->jumlah_stok }}
                                    </span>
                                @endif
                            </td>

                            <td class="px-4 py-2 text-center">{{ $item->lokasi_rak }}</td>
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
</div>