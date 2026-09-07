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

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">

        @foreach ($books as $book)

            <a
                href="{{ route('users.show', ['id' => $book->id]) }}"
                class="group overflow-hidden border border-[#E5E3DB] bg-white transition hover:-translate-y-1 hover:shadow-md">

                {{-- COVER --}}
                <div class="h-64 bg-[#F7F6F1]">

                    @if ($book->cover_image)

                        <img
                            src="{{ asset('cover_images/' . $book->cover_image) }}"
                            alt="Cover {{ $book->name }}"
                            class="h-full w-full object-cover transition duration-300 group-hover:scale-105">

                    @else

                        <div class="flex h-full items-center justify-center text-sm text-gray-400">
                            Tidak ada cover
                        </div>

                    @endif

                </div>


                {{-- DATA BUKU --}}
                <div class="p-5">

                    <p class="mb-1 text-[10px] uppercase tracking-[0.15em] text-[#A16207]">
                        Buku
                    </p>

                    <h2 class="line-clamp-2 text-lg font-semibold text-[#16213A]">
                        {{ $book->name }}
                    </h2>

                    @if ($book->author)
                        <p class="mt-2 text-sm text-gray-500">
                            {{ $book->author->name }}
                        </p>
                    @endif

                    @if ($book->description)
                        <p class="mt-3 line-clamp-3 text-sm leading-6 text-gray-600">
                            {{ $book->description }}
                        </p>
                    @endif

                </div>

            </a>

        @endforeach

    </div>

@endif

@endsection
