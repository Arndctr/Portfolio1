<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - SIM Magang</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet" />
    
    @vite(['resources/css/admin.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-slate-50 text-slate-900 font-sans antialiased">
    @auth('admin')
        <div x-data="{ sidebarOpen: false }" class="flex min-h-screen">

            {{-- Overlay gelap saat sidebar terbuka di mobile --}}
            <div
                x-show="sidebarOpen"
                x-cloak
                @click="sidebarOpen = false"
                class="fixed inset-0 bg-slate-900/50 z-40 lg:hidden"
            ></div>

            <!-- Sidebar -->
            <aside
                :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
                class="fixed top-0 left-0 h-screen w-64 bg-white border-r border-slate-200 z-50 transition-transform duration-300 ease-in-out overflow-y-auto lg:translate-x-0"
            >
                <div class="p-6 flex flex-col h-full">
                    <div class="mb-10 flex items-center justify-between gap-3 px-2">
                        <img src="{{ asset('images/Logo Rumah BUMN.png') }}" class="h-10 w-auto" alt="Logo">
                        <button @click="sidebarOpen = false" class="lg:hidden p-1 rounded-md text-slate-400 hover:text-slate-600 hover:bg-slate-100">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>

                    <nav class="flex-1 space-y-1">
                        <a href="{{ route('admin.dashboard') }}" 
                            class="flex items-center gap-3 rounded-lg px-3.5 py-2.5 text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                            Dashboard
                        </a>
                        <a href="{{ route('admin.peserta.index') }}" 
                            class="flex items-center gap-3 rounded-lg px-3.5 py-2.5 text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.peserta.*') ? 'bg-blue-600 text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            Data Peserta
                        </a>
                        <a href="{{ route('admin.batch.index') }}" 
                            class="flex items-center gap-3 rounded-lg px-3.5 py-2.5 text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.batch.*') ? 'bg-blue-600 text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            Atur Batch
                        </a>
                    </nav>

                    <div class="pt-6 border-t border-slate-100">
                        <div class="flex items-center gap-3 mb-4 px-4">
                            <div class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 font-semibold text-xs">
                                {{ substr(Auth::guard('admin')->user()->username, 0, 1) }}
                            </div>
                            <span class="truncate text-sm font-medium text-slate-700">{{ Auth::guard('admin')->user()->username }}</span>
                        </div>
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="flex w-full items-center gap-3 rounded-lg bg-red-50 px-3.5 py-2.5 text-sm font-medium text-red-600 transition hover:bg-red-100">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </aside>

            {{-- Wrapper konten: di desktop geser kanan sejauh lebar sidebar (w-64 = 16rem) --}}
            <div class="flex-1 flex flex-col min-w-0 lg:ml-64">

                {{-- Topbar mobile --}}
                <header class="lg:hidden sticky top-0 z-30 flex items-center gap-3 bg-white border-b border-slate-200 px-4 py-3">
                    <button @click="sidebarOpen = true" class="p-2 rounded-lg text-slate-500 hover:bg-slate-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <img src="{{ asset('images/Logo Rumah BUMN.png') }}" class="h-7 w-auto" alt="Logo">
                </header>

                <!-- Content Area -->
                <main class="relative flex-1 overflow-x-hidden py-8">
                    {{ $slot }}
                </main>
            </div>

        </div>
    @else
        <main>
            {{ $slot }}
        </main>
    @endauth

    <style>[x-cloak] { display: none !important; }</style>

    @livewireScripts
</body>
</html>
