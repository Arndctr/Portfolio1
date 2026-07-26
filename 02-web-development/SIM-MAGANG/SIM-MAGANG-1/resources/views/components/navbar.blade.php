<nav class="fixed top-0 left-0 w-full bg-white shadow-sm z-50 border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-6 lg:px-16">
        <div class="flex justify-between items-center h-20">

            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <img src="{{ asset('images/Logo Rumah BUMN.png') }}" class="h-10 md:h-12 w-auto transition-transform duration-300 group-hover:scale-105" alt="Logo">
            </a>

            <div class="hidden md:flex items-center gap-2 lg:gap-4">
                @php
                    $links = [
                        ['label' => 'Home', 'url' => route('home'), 'active' => request()->routeIs('home')],
                        ['label' => 'Informasi', 'url' => route('informasi'), 'active' => request()->routeIs('informasi')],
                        ['label' => 'Divisi', 'url' => route('divisi'), 'active' => request()->routeIs('divisi')],
                        ['label' => 'Alur', 'url' => route('alur'), 'active' => request()->routeIs('alur')],
                        ['label' => 'Kontak', 'url' => route('kontak'), 'active' => request()->routeIs('kontak')],
                    ];
                @endphp

                @foreach($links as $link)
                    <a href="{{ $link['url'] }}" 
                        class="text-sm font-bold px-4 py-2.5 rounded-xl transition-all duration-300 {{ $link['active'] ? 'bg-blue-600 text-white shadow-lg shadow-blue-200' : 'text-gray-500 hover:bg-gray-50 hover:text-blue-600' }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </div>

            <button id="menu-btn" class="md:hidden focus:outline-none p-2 rounded-lg bg-gray-50 text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

        </div>
    </div>

    <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-100 shadow-xl">
        <div class="flex flex-col px-6 py-6 space-y-4">
            @foreach($links as $link)
                <a href="{{ $link['url'] }}" 
                    class="text-base font-bold transition {{ $link['active'] ? 'text-blue-600 bg-blue-50 px-4 py-2 rounded-xl' : 'text-gray-600 px-4 py-2' }}">
                    {{ $link['label'] }}
                </a>
            @endforeach
        </div>
    </div>
</nav>

<script>
    const btn = document.getElementById('menu-btn');
    const menu = document.getElementById('mobile-menu');

    btn.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });
</script>
