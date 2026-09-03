<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F7F6F2] text-slate-700">

    <!-- Pembungkus Utama: Sidebar di Kiri, Area Kanan (Konten + Footer) -->
    <div class="flex min-h-screen">

        {{-- 1. Sidebar (Di Kiri) --}}
        @include('layouts.partials.header')

        {{-- 2. Area Sebelah Kanan (Dibungkus Flex Column & min-h-screen agar Footer turun ke bawah) --}}
        <div class="flex flex-1 flex-col justify-between min-h-screen">
            
            {{-- Konten Utama --}}
            <main class="w-full p-5 md:p-8">
                @yield('content')
            </main>

            {{-- Footer (Sekarang dijamin ada di bawah paling dasar area kanan) --}}
            @include('layouts.partials.footer')

        </div>

    </div>

</body>

</html>