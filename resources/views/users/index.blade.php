@extends('layouts.app')

@section('title', $title)

@section('content')

<div class="space-y-6">

    {{-- 1. BANNER HEADER --}}
    <div class="w-full overflow-hidden rounded-[15px]">
        <img 
            src="{{ asset('images/header.png') }}" 
            alt="Welcome To Owl Post" 
            class="w-full h-auto object-cover"
        >
    </div>

    {{-- 2. SECTION: MOST BORROWED (🔥) --}}
    @if(isset($mostBorrowed) && $mostBorrowed->isNotEmpty())
        <div class="rounded-[15px] bg-[#C1C5C2] px-6 py-6">
            <div class="mb-4 flex items-center gap-2">
                <span class="text-lg">🔥</span>
                <h2 class="font-serif text-base font-semibold text-[#222]">
                    Most Borrowed
                </h2>
            </div>

            <div class="flex items-start justify-between gap-4">
                @foreach ($mostBorrowed as $book)
                    <a
                        href="{{ route('users.show', ['id' => $book->id]) }}"
                        class="group flex flex-col items-start w-[160px]"
                    >
                        {{-- Cover Diperbesar Menjadi 160px x 235px --}}
                        <div class="h-[235px] w-[160px] overflow-hidden rounded-sm bg-[#F7F6F1] shadow-md">
                            @if ($book->cover_image)
                                <img
                                    src="{{ asset('cover_images/' . $book->cover_image) }}"
                                    alt="Cover {{ $book->name }}"
                                    class="h-full w-full object-cover transition duration-300 group-hover:scale-105"
                                >
                            @else
                                <div class="flex h-full w-full items-center justify-center text-center text-xs text-gray-400 p-2">
                                    Tidak ada cover
                                </div>
                            @endif
                        </div>

                        {{-- Teks Judul & Author Diperbesar --}}
                        <div class="mt-2.5 w-full">
                            <h3 class="line-clamp-2 font-serif text-[15px] font-semibold leading-snug text-[#222] group-hover:underline">
                                {{ $book->name }}
                            </h3>

                            @if ($book->author)
                                <p class="mt-1 line-clamp-1 font-serif text-[13px] text-[#555]">
                                    {{ $book->author->name }}
                                </p>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    {{-- 3. SECTION: READER'S FAVORITES (❤️) --}}
    @if(isset($favoriteBooks) && $favoriteBooks->isNotEmpty())
        <div class="rounded-[15px] bg-[#C1C5C2] px-6 py-6">
            <div class="mb-4 flex items-center gap-2">
                <span class="text-lg">❤️</span>
                <h2 class="font-serif text-base font-semibold text-[#222]">
                    Reader's Favorites
                </h2>
            </div>

            <div class="flex items-start justify-between gap-4">
                @foreach ($favoriteBooks as $book)
                    <a
                        href="{{ route('users.show', ['id' => $book->id]) }}"
                        class="group flex flex-col items-start w-[160px]"
                    >
                        <div class="h-[235px] w-[160px] overflow-hidden rounded-sm bg-[#F7F6F1] shadow-md">
                            @if ($book->cover_image)
                                <img
                                    src="{{ asset('cover_images/' . $book->cover_image) }}"
                                    alt="Cover {{ $book->name }}"
                                    class="h-full w-full object-cover transition duration-300 group-hover:scale-105"
                                >
                            @else
                                <div class="flex h-full w-full items-center justify-center text-center text-xs text-gray-400 p-2">
                                    Tidak ada cover
                                </div>
                            @endif
                        </div>

                        <div class="mt-2.5 w-full">
                            <h3 class="line-clamp-2 font-serif text-[15px] font-semibold leading-snug text-[#222] group-hover:underline">
                                {{ $book->name }}
                            </h3>

                            @if ($book->author)
                                <p class="mt-1 line-clamp-1 font-serif text-[13px] text-[#555]">
                                    {{ $book->author->name }}
                                </p>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    {{-- 4. SECTION: NEW ARRIVALS (🆕) --}}
    @if(isset($newArrivals) && $newArrivals->isNotEmpty())
        <div class="rounded-[15px] bg-[#C1C5C2] px-6 py-6">
            <div class="mb-4 flex items-center gap-2">
                <span class="text-lg">🆕</span>
                <h2 class="font-serif text-base font-semibold text-[#222]">
                    New Arrivals
                </h2>
            </div>

            <div class="flex items-start justify-between gap-4">
                @foreach ($newArrivals as $book)
                    <a
                        href="{{ route('users.show', ['id' => $book->id]) }}"
                        class="group flex flex-col items-start w-[160px]"
                    >
                        <div class="h-[235px] w-[160px] overflow-hidden rounded-sm bg-[#F7F6F1] shadow-md">
                            @if ($book->cover_image)
                                <img
                                    src="{{ asset('cover_images/' . $book->cover_image) }}"
                                    alt="Cover {{ $book->name }}"
                                    class="h-full w-full object-cover transition duration-300 group-hover:scale-105"
                                >
                            @else
                                <div class="flex h-full w-full items-center justify-center text-center text-xs text-gray-400 p-2">
                                    Tidak ada cover
                                </div>
                            @endif
                        </div>

                        <div class="mt-2.5 w-full">
                            <h3 class="line-clamp-2 font-serif text-[15px] font-semibold leading-snug text-[#222] group-hover:underline">
                                {{ $book->name }}
                            </h3>

                            @if ($book->author)
                                <p class="mt-1 line-clamp-1 font-serif text-[13px] text-[#555]">
                                    {{ $book->author->name }}
                                </p>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

</div>

@endsection