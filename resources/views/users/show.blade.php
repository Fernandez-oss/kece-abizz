@extends('layouts.app')

@section('title', $title)

@section('content')

<div class="mb-6">
    <a
        href="{{ route('users.index') }}"
        class="text-sm font-medium text-[#16213A] hover:text-[#A16207]">
        ← Kembali ke Daftar Buku
    </a>
</div>


<div class="border border-[#E5E3DB] bg-white">

    <div class="grid grid-cols-1 gap-8 p-6 md:grid-cols-3">

        {{-- COVER --}}
        <div class="md:col-span-1">

            <div class="aspect-[3/4] bg-[#F7F6F1]">

                @if ($book->cover_image)

                <img
                    src="{{ asset('cover_images/' . $book->cover_image) }}"
                    alt="Cover {{ $book->name }}"
                    class="h-full w-full object-cover">

                @else

                <div class="flex h-full items-center justify-center text-sm text-gray-400">
                    Tidak ada cover
                </div>

                @endif

            </div>

        </div>


        {{-- INFORMASI BUKU --}}
        <div class="md:col-span-2">

            <p class="mb-2 text-[11px] uppercase tracking-[0.2em] text-[#A16207]">
                Detail Buku
            </p>

            <h1 class="font-display text-3xl font-semibold text-[#16213A]">
                {{ $book->name }}
            </h1>


            {{-- DATA BUKU --}}
            <div class="mt-6 grid grid-cols-1 gap-x-10 gap-y-5 md:grid-cols-2">

                {{-- PENULIS --}}
                @if ($book->author)

                <div>
                    <p class="text-xs uppercase tracking-wider text-gray-400">
                        Penulis
                    </p>

                    <p class="mt-1 text-sm text-[#16213A]">
                        {{ $book->author->name }}
                    </p>
                </div>

                @endif


                {{-- PUBLISHER --}}
                @if ($book->publisher)

                <div>
                    <p class="text-xs uppercase tracking-wider text-gray-400">
                        Publisher
                    </p>

                    <p class="mt-1 text-sm text-[#16213A]">
                        {{ $book->publisher->name }}
                    </p>
                </div>

                @endif


                {{-- GENRE --}}
                @if ($book->genre)

                <div>
                    <p class="text-xs uppercase tracking-wider text-gray-400">
                        Genre
                    </p>

                    <p class="mt-1 text-sm text-[#16213A]">
                        {{ $book->genre->name }}
                    </p>
                </div>

                @endif


                {{-- KATEGORI --}}
                @if ($book->category)

                <div>
                    <p class="text-xs uppercase tracking-wider text-gray-400">
                        Kategori
                    </p>

                    <p class="mt-1 text-sm text-[#16213A]">
                        {{ $book->category->name }}
                    </p>
                </div>

                @endif


                {{-- TIPE BUKU --}}
                @if ($book->bookType)

                <div>
                    <p class="text-xs uppercase tracking-wider text-gray-400">
                        Tipe Buku
                    </p>

                    <p class="mt-1 text-sm text-[#16213A]">
                        {{ $book->bookType->name }}
                    </p>
                </div>

                @endif


                {{-- TAHUN --}}
                @if ($book->year)

                <div>
                    <p class="text-xs uppercase tracking-wider text-gray-400">
                        Tahun Terbit
                    </p>

                    <p class="mt-1 text-sm text-[#16213A]">
                        {{ $book->year }}
                    </p>
                </div>

                @endif


                {{-- STOK --}}
                <div>
                    <p class="text-xs uppercase tracking-wider text-gray-400">
                        Stok
                    </p>

                    <p class="mt-1 text-sm text-[#16213A]">
                        {{ $book->stock }} buku tersedia
                    </p>
                </div>

            </div>


            {{-- DESKRIPSI --}}
            @if ($book->description)

            <div class="mt-8 border-t border-[#EFEDE6] pt-6">

                <p class="text-xs uppercase tracking-wider text-gray-400">
                    Deskripsi
                </p>

                <p class="mt-2 whitespace-pre-line text-sm leading-7 text-gray-600">
                    {{ $book->description }}
                </p>

            </div>

            @endif


            {{-- PESAN BUKU --}}
            <div class="mt-8">

                @if ($book->stock > 0)

                <form action="{{ route('cart.store') }}" method="POST">
                    @csrf

                    <input
                        type="hidden"
                        name="book_id"
                        value="{{ $book->id }}">

                    <button
                        type="submit"
                        class="bg-[#16213A] px-6 py-3 text-sm font-medium text-white transition hover:bg-[#26324f]">
                        Tambah ke Keranjang
                    </button>
                </form>

                @else

                <button
                    type="button"
                    disabled
                    class="cursor-not-allowed bg-gray-300 px-6 py-3 text-sm font-medium text-gray-500">
                    Stok Habis
                </button>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection