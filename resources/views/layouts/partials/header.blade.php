@if (auth()->check() && auth()->user()->role === 'admin')

    {{-- HEADER ADMIN --}}
    <div class="min-h-screen bg-slate-50 flex">

        <header class="flex w-64 flex-col border-r border-[#6688a5] bg-[#7A9BB8] px-4 py-6 text-white shadow-xl min-h-screen">

            <div>

                <a href="{{ route('users.index') }}" class="mb-4 flex items-center gap-4">
                    <p class="flex h-14 w-14 items-center justify-center border border-white text-xl">
                        p
                    </p>

                    <span class="block text-[20px] uppercase tracking-[0.2em] text-white/80">
                        OwlPost
                    </span>
                </a>

                <nav
                    class="mx-auto w-36 h-110 border border-white/10 flex flex-col gap-3 p-3"
                    aria-label="Navigasi admin">

                    <a
                        href="{{ route('users.index') }}"
                        class="rounded-md px-3 py-3 text-center text-xs font-medium text-white/75 transition hover:bg-white/15 hover:text-white">
                        Users
                    </a>

                    <a
                        href="{{ route('books.index') }}"
                        class="rounded-md px-3 py-3 text-center text-xs font-medium text-white/75 transition hover:bg-white/15 hover:text-white">
                        Books
                    </a>

                    <a
                        href="{{ route('authors.index') }}"
                        class="rounded-md px-3 py-3 text-center text-xs font-medium text-white/75 transition hover:bg-white/15 hover:text-white">
                        Authors
                    </a>

                    <a
                        href="{{ route('genres.index') }}"
                        class="rounded-md px-3 py-3 text-center text-xs font-medium text-white/75 transition hover:bg-white/15 hover:text-white">
                        Genres
                    </a>

                    <a
                        href="{{ route('categories.index') }}"
                        class="rounded-md px-3 py-3 text-center text-xs font-medium text-white/75 transition hover:bg-white/15 hover:text-white">
                        Categories
                    </a>

                    <a
                        href="{{ route('book_types.index') }}"
                        class="rounded-md px-3 py-3 text-center text-xs font-medium text-white/75 transition hover:bg-white/15 hover:text-white">
                        Book Types
                    </a>

                </nav>

            </div>

        </header>

    </div>

@else

    {{-- HEADER USER --}}
    <div class="min-h-screen bg-slate-50 flex">

        <header class="flex w-64 flex-col border-r border-[#6688a5] bg-[#7A9BB8] px-4 py-6 text-white shadow-xl min-h-screen">

            <div>

                <a href="{{ route('admins.index') }}" class="mb-4 flex items-center gap-4">
                    <p class="flex h-14 w-14 items-center justify-center border border-white text-xl">
                        p
                    </p>

                    <span class="block text-[20px] uppercase tracking-[0.2em] text-white/80">
                        OwlPost
                    </span>
                </a>

                <nav
                    class="mx-auto w-36 h-110 border border-white/10 flex flex-col gap-3 p-3"
                    aria-label="Navigasi user">

                    <a
                        href=""
                        class="rounded-md px-3 py-3 text-center text-xs font-medium text-white/75 transition hover:bg-white/15 hover:text-white">
                        Home
                    </a>

                    <a
                        href=""
                        class="rounded-md px-3 py-3 text-center text-xs font-medium text-white/75 transition hover:bg-white/15 hover:text-white">
                        Search
                    </a>

                    <a
                        href=""
                        class="rounded-md px-3 py-3 text-center text-xs font-medium text-white/75 transition hover:bg-white/15 hover:text-white">
                        Category
                    </a>

                    <a
                        href=""
                        class="rounded-md px-3 py-3 text-center text-xs font-medium text-white/75 transition hover:bg-white/15 hover:text-white">
                        History
                    </a>

                </nav>

            </div>

        </header>

    </div>

@endif