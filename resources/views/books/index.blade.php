@extends('layouts.app')

@section('title', 'Book List')

@section('content')

<div class="mb-8 flex items-end justify-between border-b border-[#E5E3DB] pb-5">
    <div>
        <p class="mb-1 text-[11px] uppercase tracking-[0.2em] text-[#A16207]">Academic Year 2025/2026</p>
        <h1 class="font-display text-3xl font-semibold text-[#16213A]">Book List</h1>
    </div>
    <a href="{{ route('books.create') }}" class="bg-[#16213A] px-5 py-2.5 text-sm font-medium text-white transition hover:bg-[#26324f]">
        Add Book
    </a>
</div>

@if ($books->isEmpty())

<div class="border border-[#E5E3DB] bg-white p-10 text-center">
    <p class="text-gray-500">
        No book data available.
    </p>
</div>

@else

<div class="border border-[#E5E3DB] bg-white">
    <table class="w-full text-left text-sm">

        <thead>
            <tr class="border-b border-[#16213A] text-[11px] uppercase tracking-[0.15em] text-[#16213A]">
                <th class="px-5 py-3.5">No.</th>
                <th class="px-5 py-3.5">Cover</th>
                <th class="px-5 py-3.5">Name</th>
                <th class="px-5 py-3.5">Year</th>
                <th class="px-5 py-3.5">Stock</th>
                <th class="px-5 py-3.5">Description</th>
            </tr>
        </thead>

        <tbody>

            @foreach ($books as $book)

            <tr class="border-b border-[#EFEDE6]">

                {{-- Automatic row numbering for paginated results --}}
                <td class="px-5 py-4 text-[#A16207]">
                    {{ ($books->currentPage() - 1) * $books->perPage() + $loop->iteration }}
                </td>

                <td class="px-5 py-4">
                    @if ($book->cover_image)
                    <img
                        src="{{ asset('cover_images/' . $book->cover_image) }}"
                        alt="{{ $book->name }}"
                        class="h-20 w-14 object-cover border">
                    @else
                    <div class="h-20 w-14 border flex items-center justify-center text-xs text-gray-400">
                        N/A
                    </div>
                    @endif
                </td>

                <td class="px-5 py-4 font-medium text-[#16213A]">
                    <a
                        href="{{ route('books.show', $book->id) }}"
                        class="hover:underline">
                        {{ $book->name }}
                    </a>
                </td>

                <td class="px-5 py-4">
                    {{ $book->year }}
                </td>

                <td class="px-5 py-4">
                    {{ $book->stock }}
                </td>

                <td class="px-5 py-4">
                    <p class="max-w-xs truncate">
                        {{ $book->description }}
                    </p>
                </td>

            </tr>

            @endforeach

        </tbody>

    </table>
</div>

{{-- Pagination Links --}}
<div class="mt-6 px-2">
    {{ $books->links() }}
</div>

@endif

@endsection