@extends('layouts.app')

@section('title', 'Search Books')

@section('content')
<div class="min-h-screen bg-[#FFF8EF] p-8 text-[#222]">
    {{-- HEADER SEARCH --}}
    <div class="mb-8 flex items-center justify-center gap-3">
        <svg class="h-10 w-10 text-[#003565]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
        </svg>
        <div class="text-center">
            <h1 class="font-serif text-3xl font-bold tracking-wide text-[#003565]">Search</h1>
            <p class="font-serif text-xs text-[#666]">Look for the books</p>
        </div>
    </div>

    {{-- FORM PENCARIAN --}}
    <form action="{{ route('search') }}" method="GET" class="mx-auto mb-6 max-w-4xl">
        <div class="flex items-center gap-3">
            <div class="relative flex-1">
                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </span>
                <input 
                    type="text" 
                    name="q" 
                    value="{{ request('q') }}"
                    placeholder="What would you like to read?" 
                    class="w-full rounded-full border border-[#7E97A6] bg-[#FFF8EF] py-3 pl-12 pr-4 font-serif text-sm text-[#111] placeholder-gray-400 focus:border-[#003565] focus:outline-none shadow-sm"
                >
            </div>
            <button type="submit" class="flex items-center gap-2 rounded-full bg-[#003565] px-6 py-3 font-serif text-sm text-white shadow transition hover:bg-[#002548]">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                Search Book
            </button>
        </div>
    </form>

    {{-- KONTEN UTAMA & SIDEBAR POPULAR SEARCH --}}
    <div class="mx-auto grid max-w-5xl grid-cols-1 gap-8 md:grid-cols-4">
        
        {{-- AREA HASIL / TAMPILAN AWAL --}}
        <div class="md:col-span-3">
            @if(request('q'))
                <h2 class="mb-4 font-serif text-lg font-bold text-[#003565]">Search Results for "{{ request('q') }}"</h2>
                <div class="grid grid-cols-2 gap-4 sm:grid-cols-3">
                    @forelse($books as $book)
                        <div class="rounded-xl border border-[#7E97A6] bg-[#FFF8EF] p-4 text-center shadow-sm">
                            <div class="mb-3 h-40 w-full overflow-hidden rounded bg-gray-200">
                                @if($book->cover_image)
                                    <img src="{{ asset('cover_images/' . $book->cover_image) }}" class="h-full w-full object-cover">
                                @else
                                    <div class="flex h-full items-center justify-center text-xs text-gray-400">No Cover</div>
                                @endif
                            </div>
                            <h3 class="font-serif text-sm font-bold text-[#111]">{{ $book->title }}</h3>
                            <p class="font-serif text-xs text-gray-600">{{ $book->author->name ?? 'Unknown' }}</p>
                        </div>
                    @empty
                        <div class="col-span-full py-12 text-center font-serif text-gray-500">
                            No books found matching your search.
                        </div>
                    @endforelse
                </div>
            @else
                {{-- DISPLAY SAAT BELUM CARI APAPUN --}}
                <div class="flex flex-col items-center justify-center py-12 text-center">
                    <div class="mb-4 text-[#7E97A6]">
                        <svg class="mx-auto h-24 w-24 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h2 class="font-serif text-2xl font-bold text-[#003565]">Explore the Collections</h2>
                    <p class="mt-2 max-w-sm font-serif text-sm text-[#555]">
                        Find a story waiting for you.<br>Search by title, author, or genre to get started.
                    </p>
                </div>
            @endif
        </div>

        {{-- SIDEBAR POPULAR SEARCH --}}
        <div class="rounded-2xl border border-[#7E97A6] bg-[#FFF8EF] p-4 shadow-sm">
            <div class="mb-4 flex items-center gap-2 rounded-lg bg-[#003565] px-3 py-2 text-white">
                <svg class="h-4 w-4 fill-current text-yellow-400" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
                <span class="font-serif text-xs font-bold uppercase tracking-wider">Popular Search</span>
            </div>
            <ul class="divide-y divide-[#7E97A6]/30 font-serif text-xs">
                <li class="py-2.5"><a href="{{ route('search', ['q' => 'The Little Prince']) }}" class="hover:text-[#003565]"><span class="mr-2 font-bold text-gray-500">01</span> The Little Prince</a></li>
                <li class="py-2.5"><a href="{{ route('search', ['q' => 'Harry Potter']) }}" class="hover:text-[#003565]"><span class="mr-2 font-bold text-gray-500">02</span> Harry Potter</a></li>
                <li class="py-2.5"><a href="{{ route('search', ['q' => 'The Alchemist']) }}" class="hover:text-[#003565]"><span class="mr-2 font-bold text-gray-500">03</span> The Alchemist</a></li>
                <li class="py-2.5"><a href="{{ route('search', ['q' => 'How to be Rich']) }}" class="hover:text-[#003565]"><span class="mr-2 font-bold text-gray-500">04</span> How to be Rich</a></li>
                <li class="py-2.5"><a href="{{ route('search', ['q' => 'TKA']) }}" class="hover:text-[#003565]"><span class="mr-2 font-bold text-gray-500">05</span> TKA</a></li>
            </ul>
        </div>

    </div>
</div>
@endsection