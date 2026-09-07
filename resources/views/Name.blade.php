<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Profil</title>

@vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-[#FFF2E0] h-screen flex overflow-hidden"
    style="font-family: 'Times New Roman', Times, serif;">

<!-- Sidebar -->
<header class="flex w-84.5 h-screen flex-col text-white overflow-hidden">
    <img
        src="{{ Vite::asset('resources/img/login-regist.png') }}"
        alt="Logo Login"
        class="w-full h-full object-cover">
</header>

<!-- Konten Utama -->
<main class="flex-1 h-screen flex items-center justify-center p-6">
    <!-- Ukuran max-w diubah dari max-w-md ke max-w-2xl agar muat 1 baris -->
    <div class="bg-[#FFF2E0] w-full max-w-2xl flex flex-col items-center">

        <!-- Logo -->
        <div class="fixed top-4 right-4 z-10">
            <img
                src="{{ Vite::asset('resources/img/logo.png') }}"
                alt="Logo"
                class="w-30 h-30 object-contain">
        </div>

        <!-- Judul -->
        <h1 class="text-3xl font-bold text-center mb-2">
            Selamat Datang di OwlPost!
        </h1>

        <!-- Deskripsi 1 baris tanpa ubah ukuran font -->
        <p class="text-base text-center mb-6 text-gray-700 whitespace-nowrap">
            Buat profil Anda dan jadikan perjalanan membaca Anda milik Anda sendiri.
        </p>

        <!-- Error -->
        @if ($errors->any())
            <div class="mb-4 text-red-500 text-sm text-center">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Form (diberi max-w-md agar lebar input & tombol tidak terlalu panjang) -->
        <form
            action="{{ route('name.store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="w-full max-w-md">

            @csrf

            <!-- Foto Profil -->
            <div class="mb-6 flex justify-center">
                <input
                    type="file"
                    id="profile_image"
                    name="profile_image"
                    accept="image/*"
                    class="hidden"
                    required>

                <label for="profile_image" class="cursor-pointer">
                    <img
                        src="{{ Vite::asset('resources/img/profile.png') }}"
                        alt="Tambah Foto Profil"
                        class="w-32 h-32 rounded-full object-cover hover:opacity-80 transition">
                </label>
            </div>

            <!-- Nama -->
            <div class="mb-6">
                    <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Masukkan nama Anda"
                    class="w-full border-0 border-b border-gray-400 rounded-none px-0 py-2 text-lg bg-transparent focus:outline-none focus:ring-0 focus:border-[#003665]"
                    required>
            </div>

            <!-- Tombol -->
            <button
                type="submit"
                class="w-full text-lg bg-[#003665] text-white py-3 rounded-md hover:bg-[#00294d] transition">
                Simpan Profil
            </button>

        </form>

    </div>
</main>

</body>

</html>
