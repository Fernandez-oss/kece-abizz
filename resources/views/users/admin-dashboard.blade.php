
@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

<div class="mb-8 border-b border-[#E5E3DB] pb-5">
    <p class="mb-1 text-[11px] uppercase tracking-[0.2em] text-[#A16207]">
        Owl Post Library Management
    </p>
    <h1 class="font-display text-3xl font-semibold text-[#16213A]">
        Admin Dashboard
    </h1>
    <p class="mt-2 text-sm text-gray-500">
        Welcome back, Administrator.
    </p>
</div>

{{-- STATISTICS --}}
<div class="mb-8 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">

    <div class="border border-[#E5E3DB] bg-white p-6">
        <p class="text-xs uppercase tracking-wider text-gray-500">Total Books</p>
        <h2 class="mt-3 font-display text-3xl font-semibold text-[#16213A]">
            {{ $totalBooks }}
        </h2>
    </div>

    <div class="border border-[#E5E3DB] bg-white p-6">
        <p class="text-xs uppercase tracking-wider text-gray-500">Total Users</p>
        <h2 class="mt-3 font-display text-3xl font-semibold text-[#16213A]">
            {{ $totalUsers }}
        </h2>
    </div>

    <div class="border border-[#E5E3DB] bg-white p-6">
        <p class="text-xs uppercase tracking-wider text-gray-500">Active Borrowings</p>
        <h2 class="mt-3 font-display text-3xl font-semibold text-[#16213A]">
            {{ $activeBorrowings }}
        </h2>
    </div>

    <div class="border border-[#E5E3DB] bg-white p-6">
        <p class="text-xs uppercase tracking-wider text-gray-500">Return Requests</p>
        <h2 class="mt-3 font-display text-3xl font-semibold text-[#A16207]">
            {{ $returnRequests }}
        </h2>
    </div>

</div>

{{-- OVERDUE BORROWINGS --}}
<div class="border border-[#E5E3DB] bg-white">

    <div class="flex items-center justify-between border-b border-[#E5E3DB] p-5">
        <div>
            <h2 class="font-display text-xl font-semibold text-[#16213A]">
                Overdue Borrowings
            </h2>
            <p class="mt-1 text-xs text-gray-500">
                Books that have passed their due date.
            </p>
        </div>

        <a href="{{ route('borrowings.overdue') }}"
            class="text-xs font-semibold text-[#A16207] hover:underline">
            View All →
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead>
                <tr class="border-b border-[#16213A] text-[11px] uppercase tracking-wider text-[#16213A]">
                    <th class="px-5 py-4">No.</th>
                    <th class="px-5 py-4">User</th>
                    <th class="px-5 py-4">Book</th>
                    <th class="px-5 py-4">Due Date</th>
                    <th class="px-5 py-4">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($overdueBorrowings as $borrowing)
                    <tr class="border-b border-[#EFEDE6] hover:bg-[#FAF9F5]">
                        <td class="px-5 py-4 text-[#A16207]">
                            {{ $loop->iteration }}
                        </td>

                        <td class="px-5 py-4 text-[#16213A]">
                            {{ $borrowing->user->name ?? '-' }}
                        </td>

                        <td class="px-5 py-4">
                            {{ $borrowing->book->name ?? '-' }}
                        </td>

                        <td class="px-5 py-4 text-red-700">
                            {{ \Carbon\Carbon::parse($borrowing->due_date)->format('d M Y') }}
                        </td>

                        <td class="px-5 py-4">
                            <a href="{{ route('borrowings.show', $borrowing->id) }}"
                                class="text-xs font-semibold text-[#A16207] hover:underline">
                                View
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-5 py-8 text-center text-gray-500">
                            No overdue borrowings.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection
