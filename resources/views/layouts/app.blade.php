<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#FFF2E0] text-slate-700">

    <div class="flex min-h-screen">

        {{-- Sidebar / Header --}}
        @include('layouts.partials.header')

        {{-- Area Sebelah Kanan --}}
        <div class="flex flex-1 flex-col justify-between min-h-screen">

            {{-- Konten Utama --}}
            <main class="w-full p-5 md:p-8">
                @yield('content')
            </main>

            {{-- Footer --}}
            @include('layouts.partials.footer')

        </div>

    </div>

</body>

</html>