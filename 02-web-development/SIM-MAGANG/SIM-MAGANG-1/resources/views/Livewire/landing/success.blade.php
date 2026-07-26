<div class="min-h-[80vh] flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl w-full text-center space-y-8 bg-white p-10 rounded-3xl shadow-xl border border-gray-100">
        <div class="relative">
            <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-green-50 animate-bounce">
                <svg class="h-12 w-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <div class="absolute -top-4 -right-4 w-12 h-12 bg-blue-50 rounded-full blur-xl opacity-50 animate-pulse"></div>
            <div class="absolute -bottom-4 -left-4 w-16 h-16 bg-green-50 rounded-full blur-xl opacity-50 animate-pulse"></div>
        </div>

        <div class="space-y-4">
            <h2 class="text-4xl font-extrabold text-gray-900 tracking-tight">
                Pendaftaran Berhasil!
            </h2>
            <p class="text-lg text-gray-600 leading-relaxed max-w-lg mx-auto">
                Terima kasih telah melakukan pendaftaran magang di <span class="text-blue-600 font-bold">Rumah BUMN Yogyakarta</span>. 
                Data pendaftaran Anda telah berhasil dikirim dan akan segera diproses oleh tim admin kami.
            </p>
            <div class="bg-blue-50 rounded-2xl p-6 border border-blue-100/50 mt-6">
                <p class="text-sm text-blue-800 font-medium">
                    Silakan menunggu informasi selanjutnya sesuai dengan jadwal seleksi yang berlaku melalui email atau WhatsApp yang telah Anda daftarkan.
                </p>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-8">
            <a href="{{ route('cek-pendaftar') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 border border-transparent text-base font-bold rounded-2xl text-white bg-blue-600 hover:bg-blue-700 shadow-lg shadow-blue-200 transition-all transform hover:-translate-y-1">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                Lihat Data Pendaftar
            </a>
            <a href="{{ route('home') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 border border-gray-200 text-base font-bold rounded-2xl text-gray-600 bg-white hover:bg-gray-50 transition-all transform hover:-translate-y-1">
                Kembali ke Beranda
            </a>
        </div>

        <div class="pt-6 border-t border-gray-50 mt-8">
            <p class="text-xs text-gray-400 font-medium uppercase tracking-widest">
                Sistem Informasi Manajemen Magang © {{ date('Y') }}
            </p>
        </div>
    </div>
</div>
