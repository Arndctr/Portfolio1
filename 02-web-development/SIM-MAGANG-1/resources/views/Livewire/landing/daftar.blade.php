<div class="min-h-screen bg-slate-50 px-4 py-10 sm:px-6 lg:px-12">
    <div class="max-w-7xl mx-auto">
        {{-- HEADER --}}
        <div class="mx-auto mb-8 max-w-3xl text-center">
            <h1 class="text-3xl font-semibold text-slate-900 md:text-4xl">
                Pendaftaran Magang
            </h1>
            @if($registrationStatus === 'open' && $activeBatch)
                <div class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-green-50 text-green-700 rounded-full text-sm font-bold border border-green-100">
                    <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                    Pendaftaran Sedang Dibuka: {{ $activeBatch->nama_batch }}
                </div>
                <p class="text-gray-500 mt-4 font-medium">
                    Periode Pendaftaran:
                    <span class="text-gray-900 font-bold">{{ $activeBatch->tanggal_mulai->format('d M Y') }}</span>
                    sampai
                    <span class="text-gray-900 font-bold">{{ $activeBatch->tanggal_selesai->format('d M Y') }}</span>
                </p>
                <p class="text-gray-500 mt-2">Lengkapi formulir di bawah ini dengan data yang benar dan valid.</p>
            @elseif($registrationStatus === 'quota_full' && $currentBatch)
                <div class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-red-50 text-red-700 rounded-full text-sm font-bold border border-red-100">
                    <span class="w-2 h-2 bg-red-500 rounded-full"></span>
                    Kuota Penuh: {{ $currentBatch->nama_batch }}
                </div>
                <p class="text-gray-500 mt-4 font-medium">
                    Pendaftaran pada batch ini ditutup karena kuota telah tercapai.
                </p>
                <p class="text-gray-500 mt-2">Silakan tunggu batch berikutnya atau hubungi admin untuk informasi lebih lanjut.</p>
            @elseif($registrationStatus === 'upcoming' && $upcomingBatch)
                <div class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-blue-50 text-blue-700 rounded-full text-sm font-bold border border-blue-100">
                    <span class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></span>
                    Pendaftaran Akan Dibuka: {{ $upcomingBatch->nama_batch }}
                </div>
                <p class="text-gray-500 mt-4 font-medium">
                    Periode Pendaftaran mulai <span class="text-gray-900 font-bold">{{ $upcomingBatch->tanggal_mulai->format('d M Y') }}</span>.
                </p>
                <p class="text-gray-500 mt-2">Pantau halaman ini agar Anda tidak melewatkan jadwal daftar berikutnya.</p>
            @elseif($registrationStatus === 'closed' && $expiredBatch)
                <div class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-gray-100 text-slate-700 rounded-full text-sm font-bold border border-gray-200">
                    <span class="w-2 h-2 bg-slate-400 rounded-full"></span>
                    Pendaftaran Ditutup
                </div>
                <p class="text-gray-500 mt-4 font-medium">
                    Batch terakhir berakhir pada <span class="text-gray-900 font-bold">{{ $expiredBatch->tanggal_selesai->format('d M Y') }}</span>.
                </p>
                <p class="text-gray-500 mt-2">Silakan kembali lagi nanti untuk jadwal pendaftaran selanjutnya.</p>
            @else
                <div class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-gray-100 text-slate-700 rounded-full text-sm font-bold border border-gray-200">
                    <span class="w-2 h-2 bg-slate-400 rounded-full"></span>
                    Informasi Pendaftaran Belum Tersedia
                </div>
                <p class="text-gray-500 mt-4 font-medium">Saat ini belum ada batch pendaftaran yang dapat ditampilkan.</p>
            @endif
        </div>

        {{-- Alerts --}}
        @if(session()->has('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="mb-8 max-w-4xl mx-auto bg-green-50 border-l-4 border-green-500 p-4 rounded-r-xl shadow-md transition-all">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-bold text-green-800">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if(session()->has('error'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="mb-8 max-w-4xl mx-auto bg-red-50 border-l-4 border-red-500 p-4 rounded-r-xl shadow-md transition-all">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-bold text-red-800">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if(!$activeBatch)
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100 flex flex-col md:flex-row items-stretch">
                    <div class="md:w-1/2 bg-slate-900 p-12 flex flex-col justify-center items-center text-center text-white relative overflow-hidden">
                        <div class="absolute -top-10 -right-10 w-40 h-40 bg-slate-700 rounded-full opacity-20"></div>
                        <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-slate-800 rounded-full opacity-20"></div>
                        
                        <div class="relative z-10">
                            <div class="w-24 h-24 bg-white/10 backdrop-blur-md rounded-2xl flex items-center justify-center mx-auto mb-8 shadow-xl">
                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            @if($registrationStatus === 'quota_full' && $currentBatch)
                                <h2 class="mb-4 text-3xl font-semibold leading-tight">Kuota Telah Penuh</h2>
                                <p class="text-slate-200 font-medium leading-relaxed">
                                    Batch <span class="font-bold text-white">{{ $currentBatch->nama_batch }}</span> sudah mencapai kapasitas pendaftar.
                                </p>
                                <p class="text-slate-300 mt-4">Silakan tunggu batch berikutnya atau hubungi admin untuk informasi selanjutnya.</p>
                            @else
                                <h2 class="mb-4 text-3xl font-semibold leading-tight">Pendaftaran Belum Dibuka</h2>
                                <p class="text-slate-200 font-medium leading-relaxed">
                                    Mohon maaf, saat ini kami belum menerima pendaftaran baru.
                                </p>
                                <p class="text-slate-300 mt-4">Silakan pantau informasi terbaru melalui website ini.</p>
                            @endif
                        </div>
                    </div>
                    
                    <div class="md:w-1/2 p-12 flex flex-col justify-center">
                        @if($registrationStatus === 'upcoming' && $upcomingBatch)
                            <div class="space-y-6">
                                <div class="inline-flex items-center rounded-lg bg-blue-50 px-4 py-2 text-xs font-semibold text-blue-700">
                                    Segera Hadir
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 font-medium mb-1">Batch Terdekat:</p>
                                    <h3 class="text-2xl font-bold text-gray-900">{{ $upcomingBatch->nama_batch }}</h3>
                                </div>
                                <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center text-blue-600">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs font-medium text-gray-500">Tanggal Dibuka</p>
                                            <p class="text-lg font-bold text-gray-800">{{ $upcomingBatch->tanggal_mulai->format('d F Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif($registrationStatus === 'quota_full' && $currentBatch)
                            <div class="space-y-6">
                                <div class="inline-flex items-center rounded-lg bg-red-50 px-4 py-2 text-xs font-semibold text-red-700">
                                    Batch Aktif
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 font-medium mb-1">Batch Saat Ini:</p>
                                    <h3 class="text-2xl font-bold text-gray-900">{{ $currentBatch->nama_batch }}</h3>
                                </div>
                                <p class="text-gray-600 leading-relaxed">
                                    Periode pendaftaran: <span class="font-bold text-gray-900">{{ $currentBatch->tanggal_mulai->format('d F Y') }}</span> sampai <span class="font-bold text-gray-900">{{ $currentBatch->tanggal_selesai->format('d F Y') }}</span>.
                                </p>
                            </div>
                        @elseif($expiredBatch)
                            <div class="space-y-6">
                                <div class="inline-flex items-center rounded-lg bg-red-50 px-4 py-2 text-xs font-semibold text-red-700">
                                    Pendaftaran Ditutup
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 font-medium mb-1">Batch Terakhir:</p>
                                    <h3 class="text-2xl font-bold text-gray-900">{{ $expiredBatch->nama_batch }}</h3>
                                </div>
                                <p class="text-gray-600 leading-relaxed">
                                    Pendaftaran untuk batch ini telah berakhir pada <span class="font-bold text-gray-900">{{ $expiredBatch->tanggal_selesai->format('d F Y') }}</span>.
                                </p>
                            </div>
                        @else
                            <div class="space-y-6 text-center md:text-left">
                                <div class="w-16 h-16 bg-yellow-50 text-yellow-500 rounded-2xl flex items-center justify-center mx-auto md:mx-0">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">Belum Ada Informasi</h3>
                                <p class="text-gray-600 leading-relaxed">
                                    Saat ini belum ada informasi pendaftaran terbaru. Silakan cek kembali secara berkala untuk update selanjutnya.
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @else
            <div class="space-y-6">
                <div class="flex flex-col gap-3 rounded-lg border border-slate-200 bg-white p-5 shadow-sm sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-slate-900">Formulir Pendaftaran</h2>
                        <p class="mt-1 text-sm text-slate-500">Isi data dengan lengkap dan benar. Data pendaftar dapat dicek melalui halaman khusus.</p>
                    </div>
                    <a href="{{ route('cek-pendaftar') }}" class="inline-flex items-center justify-center rounded-lg border border-blue-200 bg-blue-50 px-4 py-2.5 text-sm font-semibold text-blue-700 transition hover:bg-blue-100">
                        Cek Data Pendaftar
                    </a>
                </div>
                {{-- FORM PENDAFTARAN --}}
                <div>
                    <form wire:submit.prevent="simpan" method="POST" enctype="multipart/form-data" class="space-y-8">
                        @csrf
                        <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
                            @if($errors->has('pendaftaran_duplikat'))
                                <div class="bg-red-50 border-l-4 border-red-500 p-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-bold text-red-700">
                                                {{ $errors->first('pendaftaran_duplikat') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="border-b border-slate-200 bg-slate-50 px-6 py-4">
                                <h3 class="text-base font-semibold text-slate-900">Informasi Pribadi</h3>
                            </div>
                            <div class="space-y-6 p-6">
                                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                                        <input type="text" wire:model.live.debounce.500ms="nama" placeholder="Masukkan nama lengkap" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                                        @error('nama') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-1">Email Aktif <span class="text-red-500">*</span></label>
                                        <input type="email" wire:model.live.debounce.500ms="email" placeholder="contoh@email.com" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                                        @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nomor WhatsApp <span class="text-red-500">*</span></label>
                                        <input type="text" wire:model.live.debounce.500ms="whatsapp" placeholder="08123456789" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                                        <p class="text-[10px] text-gray-400 mt-1">Gunakan format angka saja (10-15 digit)</p>
                                        @error('whatsapp') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-1">Sosial Media <span class="text-red-500">*</span></label>
                                        <input type="text" wire:model.live.debounce.500ms="sosial_media" placeholder="Username Instagram/TikTok" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                                        <p class="text-[10px] text-gray-400 mt-1">Tidak diprivat, diutamakan Instagram</p>
                                        @error('sosial_media') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-semibold text-gray-700 mb-1">Usaha/Bisnis yang dimiliki <span class="text-gray-400 font-normal">(Opsional)</span></label>
                                        <input type="text" wire:model.live.debounce.500ms="usaha_bisnis" placeholder="Nama usaha atau deskripsi singkat" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                                        <p class="text-[10px] text-gray-400 mt-1">Kosongkan jika tidak ada</p>
                                        @error('usaha_bisnis') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>
                                    <div wire:key="container-foto">
                                        <label class="block text-sm font-semibold text-gray-700 mb-1">Foto Formal <span class="text-red-500">*</span></label>
                                        <div 
                                            x-data="{ isUploading: false, progress: 0 }"
                                            x-on:livewire-upload-start="isUploading = true"
                                            x-on:livewire-upload-finish="isUploading = false"
                                            x-on:livewire-upload-error="isUploading = false"
                                            x-on:livewire-upload-progress="progress = $event.detail.progress"
                                        >
                                            <input type="file" 
                                                wire:model.live="foto" 
                                                wire:key="upload-foto" 
                                                accept="image/jpeg,image/png,.jpg,.jpeg,.png"
                                                class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition">
                                            
                                            <div x-show="isUploading" class="mt-2">
                                                <div class="w-full bg-gray-200 rounded-full h-1.5">
                                                    <div class="bg-blue-600 h-1.5 rounded-full transition-all duration-300" :style="`width: ${progress}%`"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-[10px] text-gray-400 mt-1">JPG, PNG, max 2MB</p>
                                        @error('foto') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                        
                                        @if ($fotoPreview)
                                            <div class="mt-2 relative inline-block">
                                                <img src="{{ $fotoPreview }}" class="w-24 h-24 object-cover rounded-lg border shadow-sm">
                                                <div class="absolute -top-2 -right-2 bg-blue-600 text-white rounded-full p-1 shadow-md">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="border-y border-slate-200 bg-slate-50 px-6 py-4">
                                <h3 class="text-base font-semibold text-slate-900">Pendidikan & Program Magang</h3>
                            </div>
                            <div class="space-y-6 p-6">
                                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-1">Asal Perguruan Tinggi <span class="text-red-500">*</span></label>
                                        <input type="text" wire:model.live.debounce.500ms="universitas" placeholder="Nama universitas" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                                        @error('universitas') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-1">Program Studi <span class="text-red-500">*</span></label>
                                        <input type="text" wire:model.live.debounce.500ms="prodi" placeholder="Contoh: Teknik Informatika" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                                        @error('prodi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-1">Program Magang <span class="text-red-500">*</span></label>
                                        <select wire:model.live="jenis_magang" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition font-medium">
                                            <option value="">Pilih Program</option>
                                            <option value="Magang Mandiri">Magang Mandiri</option>
                                            <option value="MBKM">MBKM</option>
                                            <option value="Konversi">Konversi</option>
                                            <option value="Lainnya">Lainnya</option>
                                        </select>
                                        @if($jenis_magang === 'Lainnya')
                                            <input type="text" wire:model="jenis_magang_lainnya" placeholder="Sebutkan program lainnya" class="w-full border border-gray-300 rounded-lg px-4 py-2 mt-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                                        @endif
                                        @error('jenis_magang') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                        @error('jenis_magang_lainnya') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-1">Durasi Magang <span class="text-red-500">*</span></label>
                                        <select wire:model.live="durasi_magang" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition font-medium">
                                            <option value="">Pilih Durasi</option>
                                            <option value="3 Bulan">3 Bulan</option>
                                            <option value="4 Bulan">4 Bulan</option>
                                            <option value="5 Bulan">5 Bulan</option>
                                            <option value="6 Bulan">6 Bulan</option>
                                            <option value="Lainnya">Lainnya (Isi Sendiri)</option>
                                        </select>
                                        @if($durasi_magang === 'Lainnya')
                                            <input type="text" wire:model="durasi_magang_lainnya" placeholder="Sebutkan durasi lainnya" class="w-full border border-gray-300 rounded-lg px-4 py-2 mt-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                                        @endif
                                        @error('durasi_magang') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                        @error('durasi_magang_lainnya') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4">
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-1">Pilihan Divisi 1 <span class="text-red-500">*</span></label>
                                        <select wire:model="divisi1" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition font-medium">
                                            <option value="">Pilih Divisi Utama</option>
                                            @foreach($divisiList as $div)
                                                <option value="{{ $div->id }}">{{ $div->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('divisi1') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>
                                    @if(count($divisiList) > 1)
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">Pilihan Divisi 2 <span class="text-gray-400 font-normal">(Opsional)</span></label>
                                            <select wire:model="divisi2" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition font-medium">
                                                <option value="">Pilih jika ada alternatif</option>
                                                @foreach($divisiList as $div)
                                                    <option value="{{ $div->id }}" {{ $divisi1 == $div->id ? 'disabled' : '' }}>{{ $div->nama }}</option>
                                                @endforeach
                                            </select>
                                            @error('divisi2') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                        </div>
                                    @endif
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4">
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-1">Periode Mulai <span class="text-red-500">*</span></label>
                                        <input type="date" wire:model="periode_mulai" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                                        @error('periode_mulai') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-1">Periode Selesai <span class="text-red-500">*</span></label>
                                        <input type="date" wire:model="periode_selesai" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                                        @error('periode_selesai') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="border-y border-slate-200 bg-slate-50 px-6 py-4">
                                <h3 class="text-base font-semibold text-slate-900">Dokumen Pendukung</h3>
                            </div>
                            <div class="space-y-6 p-6">
                                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                                    <div wire:key="container-cv">
                                        <label class="block text-sm font-semibold text-gray-700 mb-1">Upload CV (PDF) <span class="text-red-500">*</span></label>
                                        <div 
                                            x-data="{ isUploading: false, progress: 0 }"
                                            x-on:livewire-upload-start="isUploading = true"
                                            x-on:livewire-upload-finish="isUploading = false"
                                            x-on:livewire-upload-error="isUploading = false"
                                            x-on:livewire-upload-progress="progress = $event.detail.progress"
                                        >
                                            <input type="file" 
                                                wire:model.live="cv" 
                                                wire:key="upload-cv" 
                                                accept=".pdf,application/pdf"
                                                class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition">
                                            
                                            <div x-show="isUploading" class="mt-2">
                                                <div class="w-full bg-gray-200 rounded-full h-1.5">
                                                    <div class="bg-blue-600 h-1.5 rounded-full transition-all duration-300" :style="`width: ${progress}%`"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-[10px] text-gray-400 mt-1">PDF, max 5MB</p>
                                        @error('cv') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                        
                                        @if ($cv && !is_string($cv))
                                            <div class="mt-2 flex items-center gap-3 p-3 bg-slate-50 rounded-xl border border-slate-200">
                                                <div class="bg-red-100 p-2 rounded-lg">
                                                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                                <div class="overflow-hidden">
                                                    <p class="text-sm font-bold text-slate-700 truncate">{{ $cv->getClientOriginalName() }}</p>
                                                    <p class="text-[10px] text-slate-500">{{ round($cv->getSize() / 1024, 2) }} KB</p>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div wire:key="container-khs">
                                        <label class="block text-sm font-semibold text-gray-700 mb-1">Upload KHS (PDF) <span class="text-red-500">*</span></label>
                                        <div 
                                            x-data="{ isUploading: false, progress: 0 }"
                                            x-on:livewire-upload-start="isUploading = true"
                                            x-on:livewire-upload-finish="isUploading = false"
                                            x-on:livewire-upload-error="isUploading = false"
                                            x-on:livewire-upload-progress="progress = $event.detail.progress"
                                        >
                                            <input type="file" 
                                                wire:model.live="khs" 
                                                wire:key="upload-khs" 
                                                accept=".pdf,application/pdf"
                                                class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition">
                                            
                                            <div x-show="isUploading" class="mt-2">
                                                <div class="w-full bg-gray-200 rounded-full h-1.5">
                                                    <div class="bg-blue-600 h-1.5 rounded-full transition-all duration-300" :style="`width: ${progress}%`"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-[10px] text-gray-400 mt-1">PDF Kartu Hasil Studi, max 5MB</p>
                                        @error('khs') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror

                                        @if ($khs && !is_string($khs))
                                            <div class="mt-2 flex items-center gap-3 p-3 bg-slate-50 rounded-xl border border-slate-200">
                                                <div class="bg-red-100 p-2 rounded-lg">
                                                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                                <div class="overflow-hidden">
                                                    <p class="text-sm font-bold text-slate-700 truncate">{{ $khs->getClientOriginalName() }}</p>
                                                    <p class="text-[10px] text-slate-500">{{ round($khs->getSize() / 1024, 2) }} KB</p>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div wire:key="container-bukti-follow">
                                        <label class="block text-sm font-semibold text-gray-700 mb-1">Screenshot Follow IG <span class="text-red-500">*</span></label>
                                        <div 
                                            x-data="{ isUploading: false, progress: 0 }"
                                            x-on:livewire-upload-start="isUploading = true"
                                            x-on:livewire-upload-finish="isUploading = false"
                                            x-on:livewire-upload-error="isUploading = false"
                                            x-on:livewire-upload-progress="progress = $event.detail.progress"
                                        >
                                            <input type="file" 
                                                wire:model.live="bukti_follow" 
                                                wire:key="upload-bukti-follow" 
                                                accept="image/jpeg,image/png,.jpg,.jpeg,.png"
                                                class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition">
                                            
                                            <div x-show="isUploading" class="mt-2">
                                                <div class="w-full bg-gray-200 rounded-full h-1.5">
                                                    <div class="bg-blue-600 h-1.5 rounded-full transition-all duration-300" :style="`width: ${progress}%`"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-[10px] text-gray-400 mt-1">Screenshot follow @rumahbumn.yogyakarta, JPG/PNG, max 2MB</p>
                                        @error('bukti_follow') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror

                                        @if ($buktiFollowPreview)
                                            <div class="mt-2 relative inline-block">
                                                <img src="{{ $buktiFollowPreview }}" class="w-24 h-24 object-cover rounded-lg border shadow-sm">
                                                <div class="absolute -top-2 -right-2 bg-blue-600 text-white rounded-full p-1 shadow-md">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-1">Link Portofolio <span class="text-gray-400 font-normal">(Opsional)</span></label>
                                        <input type="text" wire:model.live.debounce.500ms="portfolio" placeholder="https://behance.net/username" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                                        <p class="text-[10px] text-gray-400 mt-1">Link Google Drive, Behance, GitHub, dll</p>
                                        @error('portfolio') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-end border-t border-slate-200 bg-slate-50 p-6">
                                <button type="submit" 
                                    wire:loading.attr="disabled"
                                    onclick="return confirm('Apakah Anda yakin data yang diisi sudah benar?')"
                                    class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 disabled:cursor-wait disabled:opacity-70">
                                    <span wire:loading.remove>Kirim Pendaftaran</span>
                                    <span wire:loading class="flex items-center gap-2">
                                        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                        Sedang Mengirim...
                                    </span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif
         </div>
</div>
