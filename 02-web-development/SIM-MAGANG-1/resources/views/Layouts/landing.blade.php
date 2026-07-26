<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sistem Informasi Magang</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet" />

    @vite(['resources/css/landing.css', 'resources/js/app.js'])
    @if(request()->routeIs('daftar', 'cek-pendaftar'))
        @livewireStyles
    @endif
    
</head>
<body class="bg-white font-sans antialiased">

    {{-- Navbar --}}
    @include('components.navbar')

    {{-- Content --}}
    <main class="pt-16">
        {{ $slot ?? '' }}
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('components.footer')

    @if(request()->routeIs('daftar', 'cek-pendaftar'))
        @livewireScripts
    @endif
</body>
</html>
