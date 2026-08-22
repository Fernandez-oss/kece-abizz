<header class="bg-[#16213A] text-white">
    <div class="mx-auto flex max-w-5xl items-center justify-between px-6 py-5">
        <a href="{{ route('users.index') }}" class="flex items-center gap-3">
            <span>
                <span class="font-display block text-lg font-semibold leading-none">Sistem Perpustakaan Sekolah</span>
                <span class="text-[11px] uppercase tracking-[0.2em] text-white/50">Menyediakan Akses ke Berbagai Sumber Belajar</span>
            </span>
        </a>
        <nav class="hidden gap-8 text-sm md:flex">
            <a href="{{ route('users.index') }}" class="text-white/55 hover:text-white">Pengguna</a>
            <a href="{{ route('books.index') }}" class="text-white/55 hover:text-white">Buku</a>
        </nav>
    </div>
    <div class="h-0.5 bg-[#A16207]"></div>
</header>