<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto flex items-center justify-between px-4 py-3 lg:py-4">

        <!-- Sidebar Desktop (lg ke atas) -->
        <aside class="hidden lg:flex min-h-screen bg-gray-50 w-64 flex-col fixed inset-y-0 left-0 p-4 border-r overflow-auto z-40">
            <!-- Logo -->
            <div class="h-16 flex items-center justify-center border-b mb-4">
                <a href="{{ route('user.dashboard') }}">
                    <x-application-logo class="h-9 w-auto text-gray-800" />
                </a>
            </div>

            <nav class="flex-grow space-y-2">
                <x-nav-link :href="route('user.dashboard')" :active="request()->routeIs('user.dashboard')" class="flex items-center">
                    <x-icon.dashboard-icon class="w-5 h-5 mr-2" />
                    <span class="ml-4">Dashboard</span>
                </x-nav-link>

                <x-nav-link :href="route('user.buku.index')" :active="request()->routeIs('user.buku.*')" class="flex items-center">
                    <x-icon.book class="w-5 h-5 mr-2" />
                    <span class="ml-4">Buku</span>
                </x-nav-link>

                <x-nav-link :href="route('user.peminjaman.index')" :active="request()->routeIs('user.peminjaman.*')" class="flex items-center">
                    <x-icon.calendar class="w-5 h-5 mr-2" />
                    <span class="ml-4">Peminjaman</span>
                </x-nav-link>
            </nav>

            <!-- Profile & Logout -->
            <div class="pt-4 border-t">
                <x-dropdown align="left" width="48" position="top">
                    <x-slot name="trigger">
                        <div class="flex items-center text-base cursor-pointer">
                            <x-icon.user class="w-5 h-5 mr-2" />
                            <span class="ml-4">{{ auth()->user()->name }}</span>
                            <svg class="w-4 h-4 ml-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('user.profile')" wire:navigate>Profile</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="block w-full text-right px-4 py-2 text-sm text-red-500 hover:text-red-700 hover:bg-gray-100 transition">
                                Log Out
                            </button>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </aside>

        <!-- Mobile Navbar (md ke bawah) -->
        <div class="flex items-center justify-between w-full lg:hidden">
            <a href="{{ route('user.dashboard') }}" class="text-lg font-semibold text-gray-800">
                <x-application-logo class="h-8 w-auto inline-block" />
            </a>
            <button @click="open = !open" class="text-black focus:outline-none">
                <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Mobile Dropdown Menu -->
        <div x-show="open" x-transition class="absolute right-4 top-20 w-64 bg-white rounded-lg shadow-lg z-50 border lg:hidden">
            <div class="px-4 py-3 space-y-2">
                <a href="{{ route('user.dashboard') }}"
                    class="block px-3 py-2 rounded hover:bg-gray-100 transition {{ request()->routeIs('user.dashboard') ? 'font-semibold bg-gray-200' : '' }}">
                    Dashboard
                </a>
                <a href="{{ route('user.buku.index') }}"
                    class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('user.buku.*') ? 'font-bold bg-gray-200' : '' }}">
                    Buku
                </a>
                <a href="{{ route('user.peminjaman.index') }}"
                    class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('user.peminjaman.*') ? 'font-bold bg-gray-200' : '' }}">
                    Peminjaman
                </a>
                <div class="border-t pt-3">
                    <a href="{{ route('user.profile') }}" class="block px-3 py-2 rounded hover:bg-gray-100">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="block w-full px-3 py-2 text-left text-red-500 hover:text-red-700 hover:bg-gray-100 rounded transition">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
