@extends('layouts.app')

@section('title', 'Book Detail')

@section('content')

<div class="mb-8 border-b border-[#E5E3DB] pb-5">
    <p class="mb-1 text-[11px] uppercase tracking-[0.2em] text-[#A16207]">
        Library Collection
    </p>

    <h1 class="font-display text-3xl font-semibold text-[#16213A]">
        Book Detail
    </h1>
</div>

<div class="border border-[#E5E3DB] bg-white p-6">

    <div class="flex flex-col gap-8 md:flex-row">

        {{-- Cover --}}
        <div class="shrink-0">
            @if ($book->cover_image)
            <img
                src="{{ asset('cover_images/' . $book->cover_image) }}"
                alt="{{ $book->name }}"
                class="h-80 w-56 border border-[#E5E3DB] object-cover">
            @else
            <div class="flex h-80 w-56 items-center justify-center border border-[#E5E3DB] text-sm text-gray-400">
                No Cover Available
            </div>
            @endif
        </div>

        {{-- Book Information --}}
        <div class="min-w-0 flex-1">

            {{-- Book Title --}}
            <h2 class="mb-6 text-2xl font-semibold text-[#16213A]">
                {{ $book->name }}
            </h2>

            {{-- 2-Column Grid Data --}}
            <div class="grid grid-cols-1 gap-x-10 gap-y-5 md:grid-cols-2">

                {{-- Author --}}
                <div>
                    <p class="text-xs uppercase tracking-wider text-gray-500">
                        Author
                    </p>
                    <p class="mt-1 text-sm text-[#16213A]">
                        {{ $book->author->name ?? '-' }}
                    </p>
                </div>

                {{-- Publisher --}}
                <div>
                    <p class="text-xs uppercase tracking-wider text-gray-500">
                        Publisher
                    </p>
                    <p class="mt-1 text-sm text-[#16213A]">
                        {{ $book->publishers->count() ? $book->publishers->pluck('name')->join(', ') : '-' }}
                    </p>
                </div>

                {{-- Genre --}}
                <div>
                    <p class="text-xs uppercase tracking-wider text-gray-500">
                        Genre
                    </p>
                    <p class="mt-1 text-sm text-[#16213A]">
                        {{ $book->genres->count() ? $book->genres->pluck('name')->join(', ') : '-' }}
                    </p>
                </div>

                {{-- Category --}}
                <div>
                    <p class="text-xs uppercase tracking-wider text-gray-500">
                        Category
                    </p>
                    <p class="mt-1 text-sm text-[#16213A]">
                        {{ $book->categories->count() ? $book->categories->pluck('name')->join(', ') : '-' }}
                    </p>
                </div>

                {{-- Book Type --}}
                <div>
                    <p class="text-xs uppercase tracking-wider text-gray-500">
                        Book Type
                    </p>
                    <p class="mt-1 text-sm text-[#16213A]">
                        {{ $book->bookTypes->count() ? $book->bookTypes->pluck('name')->join(', ') : '-' }}
                    </p>
                </div>

                {{-- Year --}}
                <div>
                    <p class="text-xs uppercase tracking-wider text-gray-500">
                        Year
                    </p>
                    <p class="mt-1 text-sm text-[#16213A]">
                        {{ $book->year ?? '-' }}
                    </p>
                </div>

                {{-- Stock --}}
                <div>
                    <p class="text-xs uppercase tracking-wider text-gray-500">
                        Stock
                    </p>
                    <p class="mt-1 text-sm text-[#16213A]">
                        {{ $book->stock ?? 0 }}
                    </p>
                </div>

                {{-- Created At --}}
                <div>
                    <p class="text-xs uppercase tracking-wider text-gray-500">
                        Date Created
                    </p>
                    <p class="mt-1 text-sm text-[#16213A]">
                        {{ $book->created_at?->format('d M Y, H:i') ?? '-' }}
                    </p>
                </div>

                {{-- Updated At --}}
                <div>
                    <p class="text-xs uppercase tracking-wider text-gray-500">
                        Last Updated
                    </p>
                    <p class="mt-1 text-sm text-[#16213A]">
                        {{ $book->updated_at?->format('d M Y, H:i') ?? '-' }}
                    </p>
                </div>

            </div>

            {{-- Description --}}
            <div class="mt-6 border-t border-[#E5E3DB] pt-5">
                <p class="text-xs uppercase tracking-wider text-gray-500">
                    Description
                </p>

                <p class="mt-2 whitespace-pre-line leading-7 text-[#16213A]">
                    {{ $book->description ?: '-' }}
                </p>
            </div>

            {{-- Action Buttons --}}
            <div class="mt-8 flex flex-wrap gap-3">

                <a
                    href="{{ route('books.index') }}"
                    class="border border-[#16213A] px-5 py-2.5 text-sm font-medium text-[#16213A] transition hover:bg-gray-100">
                    Back
                </a>

                <a
                    href="{{ route('books.edit', $book->id) }}"
                    class="bg-[#16213A] px-5 py-2.5 text-sm font-medium text-white transition hover:bg-[#26324f]">
                    Edit
                </a>

                <form
                    action="{{ route('books.destroy', $book->id) }}"
                    method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this book?')">

                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="bg-red-700 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-red-800">
                        Delete
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection