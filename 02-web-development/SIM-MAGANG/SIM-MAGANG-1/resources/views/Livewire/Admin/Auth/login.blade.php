<div class="fixed inset-0 min-h-screen w-full flex items-center justify-center bg-gradient-to-br from-blue-700 via-blue-800 to-indigo-900 px-4 py-12 overflow-y-auto z-[9999]">

    <div class="w-full max-w-md relative z-10 my-auto">

        <!-- Login Card -->
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-white/20">
            <div class="p-8 sm:p-10">
                <!-- Logo -->
                <div class="text-center mb-8">
                    <img src="{{ asset('images/Logo Rumah BUMN.png') }}" class="h-16 mx-auto mb-4" alt="Logo">
                    
                    <p class="text-sm text-gray-500 mt-1 leading-relaxed">
                        Selamat datang kembali <span class="font-medium text-gray-700">Admin</span>! 
                        Silakan masuk ke akun Anda.
                    </p>
                </div>

                @if (session()->has('error'))
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-xl mb-6 flex items-center gap-3 animate-pulse">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                        <span class="text-sm font-medium">{{ session('error') }}</span>
                    </div>
                @endif

                <form wire:submit.prevent="login" class="space-y-6">
                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">Alamat Email</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                            </div>
                            <input
                                type="email"
                                wire:model="email"
                                placeholder="nama@email.com"
                                class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-2xl text-gray-900 text-sm focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white outline-none transition-all duration-200">
                        </div>
                        @error('email') <span class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">Password</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <input
                                type="password"
                                wire:model="password"
                                placeholder="••••••••"
                                class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-2xl text-gray-900 text-sm focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white outline-none transition-all duration-200">
                        </div>
                        @error('password') <span class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Button -->
                    <button
                        type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-2xl font-bold shadow-lg shadow-blue-500/30 hover:shadow-blue-500/40 hover:-translate-y-0.5 active:scale-[0.98] transition-all duration-200">
                        Masuk ke Dashboard
                    </button>
                </form>
            </div>
        </div>

        <!-- Back -->
        <div class="text-center mt-8">
            <a href="/" class="inline-flex items-center gap-2 text-sm text-white/70 hover:text-white font-medium transition-colors duration-200 group">
                <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Beranda
            </a>
        </div>

    </div>

</div>