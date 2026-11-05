<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akses Ditolak - Owl Post</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#F3F6F8] flex items-center justify-center px-6">

    <div class="w-full max-w-lg text-center">

        <div class="mb-6 flex justify-center">
            <img
                src="{{ asset('images/owl.png') }}"
                alt="Owl Post"
                class="h-24 w-auto object-contain"
            >
        </div>

        <div class="rounded-3xl bg-white p-10 shadow-lg border border-[#DCE5EA]">

            <p class="text-7xl font-extrabold text-[#93ABBB]">
                403
            </p>

            <h1 class="mt-4 text-2xl font-bold text-gray-800">
                Akses Ditolak!
            </h1>

            <p class="mt-3 text-gray-500 leading-relaxed">
                Maaf, kamu tidak memiliki izin untuk mengakses halaman ini.
                Silakan kembali ke halaman yang sesuai dengan akunmu.
            </p>

            <div class="mt-8 flex flex-col sm:flex-row justify-center gap-3">

                @auth
                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}"
                           class="rounded-xl bg-[#93ABBB] px-6 py-3 font-semibold text-white hover:bg-[#7E97A6] transition">
                            Kembali ke Dashboard
                        </a>
                    @else
                        <a href="{{ route('users.index') }}"
                           class="rounded-xl bg-[#93ABBB] px-6 py-3 font-semibold text-white hover:bg-[#7E97A6] transition">
                            Kembali ke Beranda
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}"
                       class="rounded-xl bg-[#93ABBB] px-6 py-3 font-semibold text-white hover:bg-[#7E97A6] transition">
                        Login
                    </a>
                @endauth

                <button onclick="history.back()"
                        class="rounded-xl border border-[#93ABBB] px-6 py-3 font-semibold text-[#7E97A6] hover:bg-gray-50 transition">
                    Kembali
                </button>

            </div>
        </div>

        <p class="mt-6 text-sm text-gray-400">
            © {{ date('Y') }} Owl Post — School Library System
        </p>

    </div>

</body>
</html>
