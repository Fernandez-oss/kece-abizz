@extends('layouts.app')

@section('title', $title)

@section('content')

{{-- TOMBOL BACK --}}
<div class="mb-6">
    <a
        href="{{ route('users.index') }}"
        class="inline-flex items-center gap-2 font-serif text-sm font-semibold text-[#222] hover:opacity-75"
    >
        <span class="text-lg">←</span>
        <span>Back to Books</span>
    </a>
</div>

{{-- BOOK DETAIL CARD --}}
<div class="rounded-[20px] bg-[#C1C5C2] p-8 shadow-sm">

    {{-- BAGIAN COVER + INFORMASI --}}
    <div class="grid grid-cols-[180px_1fr] gap-8">

        {{-- COVER BUKU UTAMA --}}
        <div>
            <div class="h-[260px] w-[180px] overflow-hidden rounded-sm bg-[#F7F6F1] shadow-md">
                @if ($book->cover_image)
                    <img
                        src="{{ asset('cover_images/' . $book->cover_image) }}"
                        alt="Cover {{ $book->name }}"
                        class="h-full w-full object-cover"
                    >
                @else
                    <div class="flex h-full items-center justify-center text-center text-xs text-gray-400 p-2">
                        Tidak ada cover
                    </div>
                @endif
            </div>
        </div>

        {{-- INFORMASI BUKU --}}
        <div class="flex flex-col justify-between">
            <div>
                {{-- JUDUL --}}
                <h1 class="font-serif text-2xl font-bold text-[#222]">
                    {{ $book->name }}
                </h1>

                {{-- PENULIS --}}
                @if ($book->author)
                    <p class="mt-1 font-serif text-base text-[#444]">
                        {{ $book->author->name }}
                    </p>
                @endif

                {{-- RATING --}}
                <div class="mt-3 flex items-center gap-2">
                    <span class="text-xl text-black">★</span>
                    <span class="font-serif text-sm font-semibold text-[#222]">4.29</span>
                </div>

                {{-- DESKRIPSI --}}
                @if ($book->description)
                    <p class="mt-4 font-serif text-[13px] leading-relaxed text-[#333]">
                        {{ $book->description }}
                    </p>
                @endif
            </div>

            {{-- INFORMASI METADATA --}}
            <div class="mt-6 space-y-2 font-serif text-xs text-[#222]">
                
                {{-- GENRE / CATEGORY --}}
                @if ($book->genres->isNotEmpty() || $book->categories->isNotEmpty())
                    <div class="grid grid-cols-[90px_1fr]">
                        <span class="font-medium text-[#444]">Genre</span>
                        <span>
                            {{ $book->genres->pluck('name')->merge($book->categories->pluck('name'))->implode(' | ') }}
                        </span>
                    </div>
                @endif

                {{-- PUBLISHER --}}
                @if ($book->publishers->isNotEmpty())
                    <div class="grid grid-cols-[90px_1fr]">
                        <span class="font-medium text-[#444]">Publisher</span>
                        <span>{{ $book->publishers->pluck('name')->implode(', ') }}</span>
                    </div>
                @endif

                {{-- TAHUN TERBIT --}}
                @if ($book->year)
                    <div class="grid grid-cols-[90px_1fr]">
                        <span class="font-medium text-[#444]">Published</span>
                        <span>{{ $book->year }}</span>
                    </div>
                @endif

                {{-- STOK --}}
                <div class="grid grid-cols-[90px_1fr]">
                    <span class="font-medium text-[#444]">Stok</span>
                    <span>{{ $book->stock }} buku tersedia</span>
                </div>

            </div>
        </div>

    </div>

    {{-- BORROW AREA CONTAINER --}}
    <div class="mt-8 rounded-[12px] bg-[#6F8FA6] py-6 text-center shadow-inner">
        <p class="font-serif text-lg font-semibold text-[#111]">
            Available at OwlPost Library
        </p>

        @if ($book->stock > 0)
            <form action="{{ route('cart.store') }}" method="POST" class="mt-3">
                @csrf
                <input type="hidden" name="book_id" value="{{ $book->id }}">
                <button
                    type="submit"
                    class="w-[260px] rounded-full bg-[#E8E8E8] py-2.5 font-serif text-sm font-medium text-[#222] shadow transition hover:bg-white active:scale-95"
                >
                    Borrow this book
                </button>
            </form>
        @else
            <button
                type="button"
                disabled
                class="mt-3 w-[260px] cursor-not-allowed rounded-full bg-gray-300 py-2.5 font-serif text-sm font-medium text-gray-500"
            >
                Stok Habis
            </button>
        @endif
    </div>

    {{-- SECTION: YOU MIGHT ALSO LIKE --}}
    @if(isset($relatedBooks) && $relatedBooks->isNotEmpty())
        <div class="mt-10">
            <h2 class="mb-4 font-serif text-base font-semibold text-[#222]">
                You might also like
            </h2>

            <div class="flex items-start justify-between gap-4">
                @foreach ($relatedBooks as $related)
                    <a
                        href="{{ route('users.show', ['id' => $related->id]) }}"
                        class="group flex flex-col items-start w-[160px]"
                    >
                        {{-- Cover & Container Disamakan 160px x 235px --}}
                        <div class="h-[235px] w-[160px] overflow-hidden rounded-sm bg-[#F7F6F1] shadow-md">
                            @if ($related->cover_image)
                                <img
                                    src="{{ asset('cover_images/' . $related->cover_image) }}"
                                    alt="Cover {{ $related->name }}"
                                    class="h-full w-full object-cover transition duration-300 group-hover:scale-105"
                                >
                            @else
                                <div class="flex h-full w-full items-center justify-center text-center text-xs text-gray-400 p-2">
                                    Tidak ada cover
                                </div>
                            @endif
                        </div>

                        {{-- Teks Diperbesar --}}
                        <div class="mt-2.5 w-full">
                            <h3 class="line-clamp-2 font-serif text-[13px] font-semibold leading-snug text-[#222] group-hover:underline">
                                {{ $related->name }}
                            </h3>

                            @if ($related->author)
                                <p class="mt-0.5 line-clamp-1 font-serif text-[11px] text-[#555]">
                                    {{ $related->author->name }}
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