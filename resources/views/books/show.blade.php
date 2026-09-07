@extends('layouts.app')

@section('title', 'Detail Buku')

@section('content')

<div class="mb-8 flex items-end justify-between border-b border-[#E5E3DB] pb-5">
    <div>
        <p class="mb-1 text-[11px] uppercase tracking-[0.2em] text-[#A16207]">
            Koleksi Perpustakaan
        </p>

        <h1 class="font-display text-3xl font-semibold text-[#16213A]">
            Detail Buku
        </h1>
    </div>
</div>

<div class="border border-[#E5E3DB] bg-white p-6">

    <div class="flex gap-8">

        {{-- Cover --}}
        <div>
            @if ($book->cover_image)
                <img
                    src="{{ asset('cover_images/' . $book->cover_image) }}"
                    alt="{{ $book->name }}"
                    class="h-80 w-56 border object-cover">
            @else
                <div class="flex h-80 w-56 items-center justify-center border text-gray-400">
                    Tidak ada cover
                </div>
            @endif
        </div>

        {{-- Data Buku --}}
        <div class="flex-1">

            {{-- Nama Buku --}}
            <h2 class="mb-6 text-2xl font-semibold text-[#16213A]">
                {{ $book->name }}
            </h2>

            <div class="space-y-4 text-sm">

                {{-- Author --}}
                <div>
                    <p class="text-xs uppercase tracking-wider text-gray-500">
                        Author
                    </p>
                    <p class="text-[#16213A]">
                        {{ $book->author->name ?? '-' }}
                    </p>
                </div>

                {{-- Genre --}}
                <div>
                    <p class="text-xs uppercase tracking-wider text-gray-500">
                        Genre
                    </p>
                    <p class="text-[#16213A]">
                        {{ $book->genre->name ?? '-' }}
                    </p>
                </div>

                {{-- Category --}}
                <div>
                    <p class="text-xs uppercase tracking-wider text-gray-500">
                        Category
                    </p>
                    <p class="text-[#16213A]">
                        {{ $book->category->name ?? '-' }}
                    </p>
                </div>

                {{-- Tipe Buku --}}
                <div>
                    <p class="text-xs uppercase tracking-wider text-gray-500">
                        Tipe Buku
                    </p>
                    <p class="text-[#16213A]">
                        {{ $book->bookType->name ?? '-' }}
                    </p>
                </div>

                {{-- Tahun --}}
                <div>
                    <p class="text-xs uppercase tracking-wider text-gray-500">
                        Tahun
                    </p>
                    <p class="text-[#16213A]">
                        {{ $book->year }}
                    </p>
                </div>

                {{-- Stok --}}
                <div>
                    <p class="text-xs uppercase tracking-wider text-gray-500">
                        Stok
                    </p>
                    <p class="text-[#16213A]">
                        {{ $book->stock }}
                    </p>
                </div>

                {{-- Deskripsi --}}
                <div>
                    <p class="text-xs uppercase tracking-wider text-gray-500">
                        Deskripsi
                    </p>

                    <p class="whitespace-pre-line leading-7 text-[#16213A]">
                        {{ $book->description }}
                    </p>
                </div>

                {{-- Data Diinput --}}
                <div>
                    <p class="text-xs uppercase tracking-wider text-gray-500">
                        Data Diinput
                    </p>

                    <p class="text-[#16213A]">
                        {{ $book->created_at?->format('d M Y, H:i') }}
                    </p>
                </div>

                {{-- Terakhir Diupdate --}}
                <div>
                    <p class="text-xs uppercase tracking-wider text-gray-500">
                        Terakhir Diupdate
                    </p>

                    <p class="text-[#16213A]">
                        {{ $book->updated_at?->format('d M Y, H:i') }}
                    </p>
                </div>

            </div>

            {{-- Tombol --}}
            <div class="mt-8 flex gap-3">

                <a
                    href="{{ route('books.index') }}"
                    class="border border-[#16213A] px-5 py-2.5 text-sm font-medium text-[#16213A] hover:bg-gray-100">
                    Kembali
                </a>

                <a
                    href="{{ route('books.edit', $book->id) }}"
                    class="bg-[#16213A] px-5 py-2.5 text-sm font-medium text-white hover:bg-[#26324f]">
                    Edit
                </a>

                <form
                    action="{{ route('books.destroy', $book->id) }}"
                    method="POST"
                    onsubmit="return confirm('Hapus buku ini?')">

                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="bg-red-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-red-800">
                        Hapus
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection