@if (auth()->check() && auth()->user()->role === 'admin')

    {{-- SIDEBAR ADMIN --}}
    <aside class="sticky top-0 flex h-screen w-64 shrink-0 flex-col justify-between border-r border-[#7E97A6] bg-[#93ABBB] px-4 py-6 text-white shadow-xl">
        <div>
            {{-- LOGO --}}
            <a href="{{ route('admins.index') }}" class="mb-6 flex justify-center">
                <img src="{{ asset('images/owl.png') }}" alt="OwlPost Logo" class="h-16 w-auto object-contain">
            </a>

            {{-- NAVIGATION CONTAINER --}}
            <nav class="mx-auto flex h-[460px] w-48 flex-col justify-between rounded-[10px] border border-white/10 bg-[#7E97A6] p-3" aria-label="Navigasi admin">
                <div class="flex flex-col gap-2">
                    <a href="{{ route('admins.index') }}" class="rounded-md px-3 py-2.5 text-center text-xs font-medium text-[#352D2A] transition hover:bg-[#003565]/60 hover:text-white">
                        Users
                    </a>
                    <a href="{{ route('books.index') }}" class="rounded-md px-3 py-2.5 text-center text-xs font-medium text-[#352D2A] transition hover:bg-[#003565]/60 hover:text-white">
                        Books
                    </a>
                    <a href="{{ route('authors.index') }}" class="rounded-md px-3 py-2.5 text-center text-xs font-medium text-[#352D2A] transition hover:bg-[#003565]/60 hover:text-white">
                        Authors
                    </a>
                    <a href="{{ route('genres.index') }}" class="rounded-md px-3 py-2.5 text-center text-xs font-medium text-[#352D2A] transition hover:bg-[#003565]/60 hover:text-white">
                        Genres
                    </a>
                    <a href="{{ route('categories.index') }}" class="rounded-md px-3 py-2.5 text-center text-xs font-medium text-[#352D2A] transition hover:bg-[#003565]/60 hover:text-white">
                        Categories
                    </a>
                    <a href="{{ route('book_types.index') }}" class="rounded-md px-3 py-2.5 text-center text-xs font-medium text-[#352D2A] transition hover:bg-[#003565]/60 hover:text-white">
                        Book Types
                    </a>
                    <a href="{{ route('publishers.index') }}" class="rounded-md px-3 py-2.5 text-center text-xs font-medium text-[#352D2A] transition hover:bg-[#003565]/60 hover:text-white">
                        Publishers
                    </a>
                    <a href="{{ route('borrowings.index') }}" class="rounded-md px-3 py-2.5 text-center text-xs font-medium text-[#352D2A] transition hover:bg-[#003565]/60 hover:text-white">
                        Borrowings
                    </a>
                </div>

                {{-- PROFILE BUTTON --}}
                <a href="{{ route('name') }}" class="flex items-center justify-center gap-2 rounded-full bg-[#003565]/40 py-2.5 text-xs font-medium text-white transition hover:bg-[#003565]">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Profile
                </a>
            </nav>
        </div>

        {{-- FOOTER SIDEBAR --}}
        <div class="mt-4 text-center font-serif text-[10px] text-[#2D3748]">
            <p>© 2026 Owl Post. All rights reserved.</p>
            <p class="mt-0.5 text-[9px] opacity-80">Created by Team Fany, Fernandez, Grachia & Rebeca - 2026</p>
        </div>
    </aside>

@else

    {{-- SIDEBAR USER --}}
    <aside class="sticky top-0 flex h-screen w-64 shrink-0 flex-col justify-between border-r border-[#7E97A6] bg-[#93ABBB] px-4 py-6 text-white shadow-xl">
        <div>
            {{-- LOGO --}}
            <a href="{{ route('users.index') }}" class="mb-6 flex justify-center">
                <img src="{{ asset('images/owl.png') }}" alt="OwlPost Logo" class="h-16 w-auto object-contain">
            </a>

            {{-- NAVIGATION CONTAINER --}}
            <nav class="mx-auto flex h-[420px] w-48 flex-col justify-between rounded-[10px] border border-white/10 bg-[#7E97A6] p-3" aria-label="Navigasi user">
                <div class="flex flex-col gap-2">
                    <a href="{{ route('users.index') }}" class="flex items-center justify-center gap-2 rounded-md px-3 py-2.5 text-xs font-medium text-[#352D2A] transition hover:bg-[#003565]/60 hover:text-white">
                        Home
                    </a>
                    <a href="{{ route('search') }}" class="flex items-center justify-center gap-2 rounded-md px-3 py-2.5 text-xs font-medium text-[#352D2A] transition hover:bg-[#003565]/60 hover:text-white">
                        Search
                    </a>
                    <a href="{{ route('category') }}" class="flex items-center justify-center gap-2 rounded-md px-3 py-2.5 text-xs font-medium text-[#352D2A] transition hover:bg-[#003565]/60 hover:text-white">
                        Category
                    </a>
                    <a href="{{ route('cart.index') }}" class="flex items-center justify-center gap-2 rounded-md px-3 py-2.5 text-xs font-medium text-[#352D2A] transition hover:bg-[#003565]/60 hover:text-white">
                        Cart
                    </a>
                    <a href="{{ route('borrowings.user.index') }}" class="flex items-center justify-center gap-2 rounded-md px-3 py-2.5 text-xs font-medium text-[#352D2A] transition hover:bg-[#003565]/60 hover:text-white">
                        History
                    </a>
                </div>

                {{-- PROFILE BUTTON --}}
                <a href="{{ route('name') }}" class="flex items-center justify-center gap-2 rounded-full bg-[#003565]/40 py-2.5 text-xs font-medium text-black transition hover:bg-[#003565]">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Profile
                </a>
            </nav>
        </div>

        {{-- FOOTER SIDEBAR --}}
        <div class="mt-4 text-center font-serif text-[10px] text-[#2D3748]">
            <p>© 2026 Owl Post. All rights reserved.</p>
            <p class="mt-0.5 text-[9px] opacity-80">Created by Team Fany, Fernandez, Grachia & Rebeca - 2026</p>
        </div>
    </aside>

@endif