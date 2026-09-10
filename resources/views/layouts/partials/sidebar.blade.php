<aside class="w-64 bg-[#16213A] min-h-screen text-white flex flex-col justify-between p-4">
    <div>
        <!-- Logo & Title -->
        <div class="mb-8 px-2 flex items-center gap-3">
            <img src="{{ Vite::asset('resources/img/logo.png') }}" alt="OwlPost Logo" class="w-8 h-8 object-contain">
            <div>
                <h2 class="text-xl font-bold tracking-wider text-[#A16207]">OwlPost</h2>
                <p class="text-[10px] text-gray-400">Library Management System</p>
            </div>
        </div>

        <!-- Navigation Links -->
        <nav class="space-y-1">
            @if(Auth::check() && Auth::user()->role === 'admin')
                {{-- ADMIN MENU --}}
                <p class="px-2 text-[10px] uppercase tracking-wider text-gray-400 mb-2">Admin Menu</p>
                <a href="{{ route('admins.index') }}" class="flex items-center gap-3 px-3 py-2 text-sm rounded hover:bg-[#26324f] transition">
                    Dashboard
                </a>
                <a href="{{ route('books.index') }}" class="flex items-center gap-3 px-3 py-2 text-sm rounded hover:bg-[#26324f] transition">
                    Manage Books
                </a>
                <a href="{{ route('categories.index') }}" class="flex items-center gap-3 px-3 py-2 text-sm rounded hover:bg-[#26324f] transition">
                    Categories
                </a>
                <a href="{{ route('authors.index') }}" class="flex items-center gap-3 px-3 py-2 text-sm rounded hover:bg-[#26324f] transition">
                    Authors
                </a>
                <a href="{{ route('borrowings.index') }}" class="flex items-center gap-3 px-3 py-2 text-sm rounded hover:bg-[#26324f] transition">
                    Borrowings
                </a>
            @else
                {{-- USER MENU --}}
                <p class="px-2 text-[10px] uppercase tracking-wider text-gray-400 mb-2">User Menu</p>
                <a href="{{ route('home') }}" class="flex items-center gap-3 px-3 py-2 text-sm rounded hover:bg-[#26324f] transition">
                    Home
                </a>
                <a href="{{ route('search') }}" class="flex items-center gap-3 px-3 py-2 text-sm rounded hover:bg-[#26324f] transition">
                    Search Books
                </a>
                <a href="{{ route('cart.index') }}" class="flex items-center gap-3 px-3 py-2 text-sm rounded hover:bg-[#26324f] transition">
                    Cart
                </a>
                <a href="{{ route('borrowings.user.index') }}" class="flex items-center gap-3 px-3 py-2 text-sm rounded hover:bg-[#26324f] transition">
                    Borrowing History
                </a>
            @endif

            {{-- PROFILE BUTTON --}}
            <div class="pt-4 mt-4 border-t border-gray-700">
                <a href="{{ route('profile.show') }}" class="flex items-center gap-3 px-3 py-2 text-sm rounded text-amber-400 hover:bg-[#26324f] transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span>My Profile</span>
                </a>
            </div>
        </nav>
    </div>

    <!-- Bottom User Info -->
    @auth
    <div class="border-t border-gray-700 pt-4 px-2 flex items-center gap-3">
        <div class="flex-1 overflow-hidden">
            <p class="text-xs text-gray-200 font-medium truncate">{{ Auth::user()->name }}</p>
            <p class="text-[10px] text-gray-400 capitalize">{{ Auth::user()->role ?? 'User' }}</p>
        </div>
    </div>
    @endauth
</aside>