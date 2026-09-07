<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#FFF2E0] min-h-screen flex"
    style="font-family: 'Times New Roman', Times, serif;">

    <!-- Sidebar Kiri -->
    <header class="flex w-84.5 h-screen flex-col text-white overflow-hidden">
        <img
            src="{{ Vite::asset('resources/img/login-regist.png') }}"
            alt="Logo Register"
            class="w-full h-full object-cover">
    </header>

    <!-- Konten Utama Register -->
    <main class="flex-1 flex items-center justify-center">

        <div class="bg-[#FFF2E0] w-full max-w-md p-8">

            <!-- Logo kanan atas -->
            <div class="fixed top-4 right-4 z-10">
                <img
                    src="{{ Vite::asset('resources/img/logo.png') }}"
                    alt="Logo"
                    class="w-30 h-30 object-contain">
            </div>

            <!-- Judul -->
            <h1 class="text-3xl font-bold text-center mb-6">
                Register
            </h1>

            <form action="{{ route('register.store') }}" method="POST">
                @csrf

                <!-- Email -->
                <div class="mb-4 mx-4">
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Masukkan email"
                        class="w-full border-0 border-b border-gray-400 rounded-none px-0 py-2 text-lg focus:outline-none focus:ring-0 focus:border-[#003665]"
                        required>

                    @error('email')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <!-- Nomor HP -->
                <div class="mb-4 mx-4">
                    <input
                        type="text"
                        id="phone_number"
                        name="phone_number"
                        value="{{ old('phone') }}"
                        placeholder="Masukkan nomor hp"
                        class="w-full border-0 border-b border-gray-400 rounded-none px-0 py-2 text-lg focus:outline-none focus:ring-0 focus:border-[#003665]"
                        required>

                    @error('phone')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-4 mx-4">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Minimal 6 karakter"
                        minlength="6"
                        class="w-full border-0 border-b border-gray-400 rounded-none px-0 py-2 text-lg focus:outline-none focus:ring-0 focus:border-[#003665]"
                        required>

                    @error('password')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <!-- Konfirmasi Password -->
                <div class="mb-6 mx-4">
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="Konfirmasi password"
                        minlength="6"
                        class="w-full border-0 border-b border-gray-400 rounded-none px-0 py-2 text-lg focus:outline-none focus:ring-0 focus:border-[#003665]"
                        required>

                    @error('password_confirmation')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <!-- Tombol Register -->
                <button
                    type="submit"
                    class="w-[calc(100%-2rem)] text-lg mx-4 bg-[#003665] text-white py-3 rounded-md hover:bg-[#003665]">
                    Register
                </button>
            </form>

            <!-- Link Login -->
            <p class="text-center text-sm text-gray-600 mt-6">
                Sudah punya akun?

                <a
                    href="{{ route('login') }}"
                    class="text-blue-600 hover:underline">
                    Login
                </a>
            </p>

        </div>

    </main>

</body>

</html>