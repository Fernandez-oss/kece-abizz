@extends('layouts.app')

@section('title', $title)

@section('content')

<div class="mb-6">

    <a
        href="{{ route('borrowings.index') }}"
        class="text-sm font-medium text-[#16213A] hover:text-[#A16207]">
        ← Back to Borrowing List
    </a>

</div>


@if (session('success'))

<div class="mb-6 border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
    {{ session('success') }}
</div>

@endif


<div class="border border-[#E5E3DB] bg-white">

    <div class="p-6">

        <p class="text-[11px] uppercase tracking-[0.2em] text-[#A16207]">
            Borrowing Details
        </p>

        <h1 class="mt-2 font-display text-3xl font-semibold text-[#16213A]">
            {{ $borrowing->book->name }}
        </h1>


        {{-- DATA --}}
        <div class="mt-8 grid grid-cols-1 gap-x-10 gap-y-6 md:grid-cols-2">

            {{-- BORROWER --}}
            <div>

                <p class="text-xs uppercase tracking-wider text-gray-400">
                    Borrower Name
                </p>

                <p class="mt-1 text-sm text-[#16213A]">
                    {{ $borrowing->user->name }}
                </p>

            </div>


            {{-- BOOK --}}
            <div>

                <p class="text-xs uppercase tracking-wider text-gray-400">
                    Book
                </p>

                <p class="mt-1 text-sm text-[#16213A]">
                    {{ $borrowing->book->name }}
                </p>

            </div>


            {{-- QUANTITY --}}
            <div>

                <p class="text-xs uppercase tracking-wider text-gray-400">
                    Quantity
                </p>

                <p class="mt-1 text-sm text-[#16213A]">
                    1 book
                </p>

            </div>


            {{-- BORROW DATE --}}
            <div>

                <p class="text-xs uppercase tracking-wider text-gray-400">
                    Borrow Date
                </p>

                <p class="mt-1 text-sm text-[#16213A]">
                    {{ $borrowing->borrowed_at->format('d M Y, H:i') }}
                </p>

            </div>


            {{-- DUE DATE --}}
            <div>

                <p class="text-xs uppercase tracking-wider text-gray-400">
                    Due Date
                </p>

                <p class="mt-1 text-sm text-[#16213A]">
                    {{ $borrowing->due_date->format('d M Y') }}
                </p>

            </div>


            {{-- TIME REMAINING --}}
            <div>

                @php
                $today = now()->startOfDay();
                $dueDate = $borrowing->due_date->startOfDay();

                $remainingDays = $today->diffInDays($dueDate, false);
                @endphp

                <p class="text-xs uppercase tracking-wider text-gray-400">
                    Time Remaining
                </p>

                @if ($remainingDays > 0)

                <p class="mt-1 text-sm text-[#16213A]">
                    {{ $remainingDays }} {{ Str::plural('day', $remainingDays) }} left
                </p>

                @elseif ($remainingDays === 0)

                <p class="mt-1 text-sm font-medium text-[#A16207]">
                    Due today
                </p>

                @else

                <p class="mt-1 text-sm font-medium text-red-600">
                    {{ abs($remainingDays) }} {{ Str::plural('day', abs($remainingDays)) }} overdue
                </p>

                @endif

            </div>

        </div>


        {{-- STATUS --}}
        <div class="mt-8 border-t border-[#EFEDE6] pt-6">

            <p class="text-xs uppercase tracking-wider text-gray-400">
                Return Status
            </p>


            @if ($borrowing->status === 'borrowed')

            <div class="mt-3 border border-[#E5E3DB] bg-[#F7F6F1] px-4 py-4">

                <p class="text-sm font-medium text-[#16213A]">
                    Borrowed
                </p>

                <p class="mt-1 text-sm text-gray-500">
                    The user has not requested to return this book yet.
                </p>

            </div>


            @elseif ($borrowing->status === 'return_requested')

            <div class="mt-3 border border-[#A16207] bg-[#FFF9ED] px-4 py-4">

                <p class="text-sm font-medium text-[#A16207]">
                    Pending Confirmation
                </p>

                <p class="mt-1 text-sm text-gray-600">
                    The user has requested to return this book.
                </p>

                @if ($borrowing->returned_at)

                <p class="mt-2 text-xs text-gray-500">
                    Submitted on
                    {{ $borrowing->returned_at->format('d M Y, H:i') }}
                </p>

                @endif

            </div>

            @endif

        </div>


        {{-- ACTION --}}
        <div class="mt-6 flex flex-wrap gap-3">

            {{-- EXTEND --}}
            @if ($borrowing->status === 'borrowed')

            <a
                href="{{ route('borrowings.edit', $borrowing->id) }}"
                class="bg-[#16213A] px-5 py-3 text-sm font-medium text-white transition hover:bg-[#26324f]">
                Extend Borrowing
            </a>

            @endif


            {{-- CONFIRM --}}
            @if ($borrowing->status === 'return_requested')

            <form
                action="{{ route('borrowings.destroy', $borrowing->id) }}"
                method="POST"
                onsubmit="return confirm('Please ensure the book has been received. Confirm return?');">

                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="bg-[#16213A] px-5 py-3 text-sm font-medium text-white transition hover:bg-[#26324f]">
                    Confirm Return
                </button>

            </form>

            @endif

        </div>

    </div>

</div>

@endsection