<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ config('app.name', 'Perpustakaan Digital SMP Negeri 12 Yogyakarta') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen flex flex-col sm:flex-row">
        <!-- Sidebar Desktop -->
        <aside class="hidden lg:block w-64 bg-white border-r">
            <livewire:layout.user-navigation desktop />
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-h-screen bg-white m-2 border border-gray-100 rounded-md overflow-hidden">
            
            <!-- Mobile Navbar -->
            <div class="lg:hidden border-b p-4 relative z-50">
                <livewire:layout.user-navigation mobile />
            </div>

            <!-- Page Heading -->
            @isset($header)
                <header class="p-4 border-b">
                    {{ $header }}
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-1 p-4 overflow-y-auto">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
