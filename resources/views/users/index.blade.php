@extends('layouts.app')

@section('title', $title)

@section('content')

<div class="mb-8 border-b border-[#E5E3DB] pb-5">
    <p class="mb-1 text-[11px] uppercase tracking-[0.2em] text-[#A16207]">
        Tahun Ajaran 2025/2026
    </p>

    <h1 class="font-display text-3xl font-semibold text-[#16213A]">
        Daftar Buku
    </h1>

    <p class="mt-2 text-sm text-gray-500">
        Pilih buku yang ingin kamu lihat.
    </p>
</div>


@if ($books->isEmpty())

    <div class="border border-[#E5E3DB] bg-white px-6 py-12 text-center">
        <p class="font-medium text-[#16213A]">
            Belum ada buku yang tersedia.
        </p>
    </div>

@else

    <div class="rounded-[15px] bg-[#C1C5C2] px-5 py-3">

    {{-- JUDUL SECTION --}}
    <div class="mb-2 flex items-center gap-1">
        <span class="text-[14px]">🔥</span>

        <h2 class="font-serif text-[13px] text-[#222]">
            Most Borrowed
        </h2>
    </div>


    {{-- DAFTAR BUKU --}}
    <div class="flex gap-10">

        @foreach ($books as $book)

            <a
                href="{{ route('users.show', ['id' => $book->id]) }}"
                class="group min-w-0"
            >

                {{-- COVER --}}
                <div class="h-[115px] w-[76px] bg-[#F7F6F1]">

                    @if ($book->cover_image)

                        <img
                            src="{{ asset('cover_images/' . $book->cover_image) }}"
                            alt="Cover {{ $book->name }}"
                            class="h-full w-full object-cover transition duration-300 group-hover:scale-105"
                        >

                    @else

                        <div class="flex h-full w-full items-center justify-center text-center text-[8px] text-gray-400">
                            Tidak ada cover
                        </div>

                    @endif

                </div>


                {{-- DATA BUKU --}}
                <div class="mt-1 w-[76px]">

                    {{-- JUDUL --}}
                    <h3 class="line-clamp-2 font-serif text-[9px] leading-[1.25] text-[#222]">
                        {{ $book->name }}
                    </h3>


                    {{-- AUTHOR --}}
                    @if ($book->author)

                        <p class="mt-[2px] line-clamp-2 font-serif text-[7px] leading-[1.2] text-[#777]">
                            {{ $book->author->name }}
                        </p>

                    @endif

                </div>

            </a>

        @endforeach

    </div>

</div>
@endif

@endsection
