@extends('layouts.app')

@section('title', $title ?? 'Search')

@section('content')
<div class="relative min-h-screen overflow-hidden bg-[#FFF2E0] p-8 text-[#222]">

    {{-- BACKGROUND DECORATION --}}
    <div class="min-h-screen bg-[#FFF2E0] p-8 text-[#222]">

    <div class="relative z-10">

        {{-- HEADER SECTION --}}
        <div class="mb-8 flex justify-center">
            <img
                src="{{ asset('images/Search.png') }}"
                alt="Search"
                class="h-20 w-auto object-contain"
            >
        </div>

        {{-- FORM PENCARIAN --}}
        <form action="{{ route('search') }}" method="GET" class="mx-auto mb-6 max-w-4xl">
            <div class="flex items-center gap-3">
                <div class="relative flex-1">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </span>

                    <input
                        type="text"
                        name="q"
                        value="{{ request('q') }}"
                        placeholder="Search by book, author, genre, or category..."
                        class="w-full rounded-full border border-[#7E97A6] bg-[#FFF8EF] py-3 pl-12 pr-4 font-serif text-sm text-[#111] placeholder-gray-400 shadow-sm focus:border-[#003565] focus:outline-none"
                    >
                </div>

                <button
                    type="submit"
                    class="flex items-center gap-2 rounded-full bg-[#003565] px-6 py-3 font-serif text-sm text-white shadow transition hover:bg-[#002548]"
                >
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Search Book
                </button>
            </div>
        </form>

        {{-- KONTEN UTAMA --}}
        <div class="mx-auto grid max-w-5xl grid-cols-1 gap-8 md:grid-cols-4">

            {{-- AREA HASIL PENCARIAN --}}
            <div class="rounded-[15px] border border-[#C1C5C2] bg-[#F7F6F1] p-6 shadow-sm md:col-span-3">

                @if(request('q'))

                    {{-- JUDUL HASIL PENCARIAN --}}
                    <div class="mb-5">
                        <h2 class="font-serif text-lg font-bold text-[#003565]">
                            Search Results for "{{ request('q') }}"
                        </h2>

                        <p class="mt-1 text-xs text-gray-500">
                            Found {{ $books->total() }} book(s)
                        </p>
                    </div>

                    {{-- GRID BUKU --}}
                    <div class="grid grid-cols-2 gap-x-6 gap-y-8 rounded-xl bg-[#C1C5C2]/40 p-5 sm:grid-cols-3">

                        @forelse($books as $book)

                            <a
                                href="{{ route('users.show', ['id' => $book->id]) }}"
                                class="group flex w-full flex-col items-start"
                            >
                                {{-- COVER BUKU --}}
                                <div class="h-[235px] w-[160px] max-w-full overflow-hidden rounded-sm bg-[#F7F6F1] shadow-md">
                                    @if ($book->cover_image)
                                        <img
                                            src="{{ asset('cover_images/' . $book->cover_image) }}"
                                            alt="Cover {{ $book->name }}"
                                            class="h-full w-full object-cover transition duration-300 group-hover:scale-105"
                                        >
                                    @else
                                        <div class="flex h-full w-full items-center justify-center p-2 text-center text-xs text-gray-400">
                                            Tidak ada cover
                                        </div>
                                    @endif
                                </div>

                                {{-- JUDUL DAN AUTHOR --}}
                                <div class="mt-2.5 w-[160px] max-w-full">
                                    <h3 class="line-clamp-2 font-serif text-[15px] font-semibold leading-snug text-[#222] group-hover:underline">
                                        {{ $book->name }}
                                    </h3>

                                    @if ($book->author)
                                        <p class="mt-1 line-clamp-1 font-serif text-[13px] text-[#555]">
                                            {{ $book->author->name }}
                                        </p>
                                    @endif

                                    {{-- GENRE --}}
                                    <p class="mt-1 line-clamp-1 text-xs text-[#666]">
                                        {{ $book->genres->pluck('name')->join(', ') ?: 'No Genre' }}
                                    </p>

                                    {{-- CATEGORY --}}
                                    <p class="line-clamp-1 text-xs text-[#666]">
                                        {{ $book->categories->pluck('name')->join(', ') ?: 'No Category' }}
                                    </p>
                                </div>
                            </a>

                        @empty

                            <div class="col-span-full py-12 text-center">
                                <p class="font-serif text-lg text-[#555]">
                                    Buku tidak ditemukan.
                                </p>
                                <p class="mt-1 text-sm text-[#777]">
                                    Coba gunakan kata kunci pencarian lainnya.
                                </p>
                            </div>

                        @endforelse

                    </div>

                    {{-- PAGINATION --}}
                    <div class="mt-6">
                        {{ $books->links() }}
                    </div>

                @else

                    {{-- DISPLAY SAAT BELUM MENCARI --}}
                    <div class="flex flex-col items-center justify-center rounded-xl bg-[#C1C5C2]/40 py-12 text-center">

                        <div class="mb-4 text-[#7E97A6]">
                            <img
                                src="{{ asset('images/SearchDecoration.png') }}"
                                alt="Search Decoration"
                                class="h-60 w-auto object-contain"
                            >
                        </div>

                        <h2 class="font-serif text-2xl font-bold text-black">
                            Explore the Collections
                        </h2>

                        {{-- DECORATIVE LINE --}}
                        <div class="mx-auto mt-3 flex w-full max-w-xs items-center justify-center">
                            <div class="h-px flex-1 bg-[#7E97A6]/40"></div>
                            <span class="mx-3 font-serif text-lg text-[#CFC4AE]">♢</span>
                            <div class="h-px flex-1 bg-[#7E97A6]/40"></div>
                        </div>

                        <p class="mt-2 max-w-sm font-serif text-sm text-[#555]">
                            Find a story waiting for you.<br>
                            Search by book title, author, genre, or category to get started.
                        </p>

                        {{-- DECORATIVE LINE --}}
                        <div class="mx-auto mt-3 flex w-full max-w-xs items-center justify-center">
                            <div class="h-px flex-1 bg-[#7E97A6]/40"></div>
                            <span class="mx-3 font-serif text-lg text-[#CFC4AE]">♢</span>
                            <div class="h-px flex-1 bg-[#7E97A6]/40"></div>
                        </div>

                    </div>

                @endif

            </div>

            {{-- SIDEBAR POPULAR SEARCH --}}
            <div class="h-fit rounded-[15px] border border-[#C1C5C2] bg-[#F7F6F1] p-5 shadow-sm">

                <div class="mb-4 flex items-center gap-2 rounded-lg bg-[#003565] px-3 py-2 text-white">

                    <svg class="h-4 w-4 fill-current text-yellow-400" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>

                    <span class="font-serif text-xs font-bold uppercase tracking-wider">
                        Popular Search
                    </span>

                </div>

                <ul class="divide-y divide-[#7E97A6]/30 font-serif text-xs">

                    <li class="py-2.5">
                        <a href="{{ route('search', ['q' => 'The Little Prince']) }}" class="transition hover:text-[#003565]">
                            <span class="mr-2 font-bold text-gray-500">01</span>
                            The Little Prince
                        </a>
                    </li>

                    <li class="py-2.5">
                        <a href="{{ route('search', ['q' => 'Harry Potter']) }}" class="transition hover:text-[#003565]">
                            <span class="mr-2 font-bold text-gray-500">02</span>
                            Harry Potter
                        </a>
                    </li>

                    <li class="py-2.5">
                        <a href="{{ route('search', ['q' => 'The Alchemist']) }}" class="transition hover:text-[#003565]">
                            <span class="mr-2 font-bold text-gray-500">03</span>
                            The Alchemist
                        </a>
                    </li>

                    <li class="py-2.5">
                        <a href="{{ route('search', ['q' => 'How to be Rich']) }}" class="transition hover:text-[#003565]">
                            <span class="mr-2 font-bold text-gray-500">04</span>
                            How to be Rich
                        </a>
                    </li>

                    <li class="py-2.5">
                        <a href="{{ route('search', ['q' => 'TKA']) }}" class="transition hover:text-[#003565]">
                            <span class="mr-2 font-bold text-gray-500">05</span>
                            TKA
                        </a>
                    </li>

                </ul>

            </div>

        </div>


</div>
@endsection
