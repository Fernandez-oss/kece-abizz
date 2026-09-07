<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#FFF2E0] min-h-screen flex" style="font-family: 'Times New Roman', Times, serif;">

    <!-- Header / Sidebar dipindah ke dalam body -->
    <header class="flex w-84.5 h-screen flex-col text-white overflow-hidden">
        <!-- Menggunakan asset() helper Laravel -->
        <img src="{{ Vite::asset('resources/img/login-regist.png') }}" alt="Logo Login" class="w-full h-full object-cover">
    </header>

    <!-- Konten Utama Login -->
    <main class="flex-1 flex items-center justify-center">
        <div class="bg-[#FFF2E0] w-full max-w-md p-8">

            <div class="fixed top-4 right-4 z-10">
                <img
                    src="{{ Vite::asset('resources/img/logo.png') }}"
                    alt="Logo"
                    class="w-30 h-30 object-contain"
                >
            </div>

            <h1 class="text-3xl font-bold text-center mb-6">
                Log In
            </h1>

            @if ($errors->any())
                <div class="mb-4 text-red-500 text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login.process') }}" method="POST">
                @csrf

                <!-- Username -->
                <div class="mb-4 mx-4">
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Masukkan username"
                        class="w-full border-0 border-b border-gray-400 rounded-none px-0 py-2 text-lg focus:outline-none focus:ring-0 focus:border-[#003665]"
                        required
                    >
                </div>

                <!-- Password -->
                <div class="mb-6 mx-4">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Masukkan password"
                        class="w-full border-0 border-b border-gray-400 rounded-none px-0 py-2 text-lg focus:outline-none focus:ring-0 focus:border-[#003665]"
                        required
                    >
                </div>

                <!-- Tombol Login -->
                <button
                    type="submit"
                    class="w-[calc(100%-2rem)] text-lg mx-4 bg-[#003665] text-white py-3 rounded-md hover:bg-[#003665]"
                >
                    Login
                </button>
            </form>

            <p class="text-center text-sm text-gray-600 mt-6">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-blue-600 hover:underline">
                    Register
                </a>
            </p>

        </div>
    </main>

</body>
</html>