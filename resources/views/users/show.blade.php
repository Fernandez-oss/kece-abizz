@extends('layouts.app')

@section('title', $title)

@section('content')

<div class="mb-6">
    <a
        href="{{ route('users.index') }}"
        class="text-sm font-medium text-[#16213A] hover:text-[#A16207]">
        ← Back to Books
    </a>
</div>


{{-- BOOK DETAIL CARD --}}
<div class="rounded-[15px] border border-[#C1C5C2] bg-[#C1C5C2]">

    <div class="p-8">

        {{-- BAGIAN COVER + INFORMASI --}}
        <div class="grid grid-cols-[140px_1fr] gap-6">

            {{-- COVER --}}
            <div>
                <div class="h-[194px] w-[132px] bg-[#F7F6F1]">

                    @if ($book->cover_image)

                        <img
                            src="{{ asset('cover_images/' . $book->cover_image) }}"
                            alt="Cover {{ $book->name }}"
                            class="h-full w-full object-cover"
                        >

                    @else

                        <div class="flex h-full items-center justify-center text-center text-xs text-gray-400">
                            Tidak ada cover
                        </div>

                    @endif

                </div>
            </div>


            {{-- INFORMASI BUKU --}}
            <div>

                {{-- JUDUL --}}
                <h1 class="font-serif text-[18px] leading-tight text-[#222]">
                    {{ $book->name }}
                </h1>


                {{-- PENULIS --}}
                @if ($book->author)

                    <p class="mt-1 font-serif text-[14px] text-[#222]">
                        {{ $book->author->name }}
                    </p>

                @endif


                {{-- RATING --}}
                <div class="mt-3 flex items-center gap-2">

                    <span class="text-[20px] text-black">
                        ★
                    </span>

                    <span class="font-serif text-[13px] text-[#222]">
                        4.29
                    </span>

                </div>


                {{-- DESKRIPSI --}}
                @if ($book->description)

                    <p class="mt-3 font-serif text-[9px] leading-[1.45] text-[#222]">
                        {{ $book->description }}
                    </p>

                @endif

            </div>

        </div>


        {{-- INFORMASI TAMBAHAN --}}
        <div class="mt-4 ml-[10px] font-serif text-[12px] text-[#222]">

            {{-- GENRE --}}
            @if ($book->genre)

                <div class="mb-2 grid grid-cols-[66px_1fr]">

                    <span>
                        Genre
                    </span>

                    <span>
                        {{ $book->genre->name }}

                        @if ($book->category)
                            | {{ $book->category->name }}
                        @endif
                    </span>

                </div>

            @endif


            {{-- PUBLISHER --}}
            @if ($book->publisher)

                <div class="mb-2 grid grid-cols-[66px_1fr]">

                    <span>
                        Publisher
                    </span>

                    <span>
                        {{ $book->publisher->name }}
                    </span>

                </div>

            @endif


            {{-- TAHUN --}}
            @if ($book->year)

                <div class="mb-2 grid grid-cols-[66px_1fr]">

                    <span>
                        Published
                    </span>

                    <span>
                        {{ $book->year }}
                    </span>

                </div>

            @endif


            {{-- TIPE BUKU --}}
            @if ($book->bookType)

                <div class="mb-2 grid grid-cols-[66px_1fr]">

                    <span>
                        Tipe
                    </span>

                    <span>
                        {{ $book->bookType->name }}
                    </span>

                </div>

            @endif


            {{-- STOK --}}
            <div class="grid grid-cols-[66px_1fr]">

                <span>
                    Stok
                </span>

                <span>
                    {{ $book->stock }} buku tersedia
                </span>

            </div>

        </div>


        {{-- BORROW AREA --}}
        <div class="mt-5 rounded-[10px] bg-[#6F8FA6] px-5 py-3 text-center">

            <p class="font-serif text-[16px] text-[#111]">
                Available at OwlPost Library
            </p>


            @if ($book->stock > 0)

                <form
                    action="{{ route('cart.store') }}"
                    method="POST"
                    class="mt-2"
                >

                    @csrf

                    <input
                        type="hidden"
                        name="book_id"
                        value="{{ $book->id }}"
                    >

                    <button
                        type="submit"
                        class="w-[205px] rounded-[10px] bg-[#E8E8E8] px-5 py-2 font-serif text-[14px] text-[#222] transition hover:bg-white"
                    >
                        Borrow this book
                    </button>

                </form>

            @else

                <button
                    type="button"
                    disabled
                    class="mt-2 w-[205px] cursor-not-allowed rounded-[10px] bg-gray-300 px-5 py-2 font-serif text-[14px] text-gray-500"
                >
                    Stok Habis
                </button>

            @endif

        </div>

    </div>

</div>

@endsection