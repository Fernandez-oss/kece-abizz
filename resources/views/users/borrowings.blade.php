@extends('layouts.app')

@section('title', $title)

@section('content')

<div class="mb-6">

    <p class="text-[11px] uppercase tracking-[0.2em] text-[#A16207]">
        Peminjaman
    </p>

    <h1 class="mt-2 font-display text-3xl font-semibold text-[#16213A]">
        Riwayat Peminjaman
    </h1>

</div>


@if (session('success'))

<div class="mb-6 border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
    {{ session('success') }}
</div>

@endif


@if ($borrowings->count() > 0)

<div class="space-y-3">

    @foreach ($borrowings as $borrowing)

    <div class="border border-[#E5E3DB] bg-white p-5">

        <div class="flex items-center justify-between gap-4">

            <div>

                <p class="text-sm font-medium text-[#16213A]">
                    {{ $borrowing->book->name }}
                </p>

                <p class="mt-1 text-xs text-gray-400">
                    Dipinjam {{ $borrowing->borrowed_at->format('d M Y') }}
                </p>

            </div>


            <div class="text-right">

                <p class="text-xs uppercase tracking-wider text-gray-400">
                    Status
                </p>

                @if ($borrowing->status === 'borrowed')

                <p class="mt-1 text-sm text-[#16213A]">
                    Sedang Dipinjam
                </p>

                @elseif ($borrowing->status === 'return_requested')

                <p class="mt-1 text-sm font-medium text-[#A16207]">
                    Menunggu Konfirmasi Admin
                </p>

                @endif

            </div>

        </div>


        @if ($borrowing->status === 'borrowed')

        <form
            action="{{ route('borrowings.return', $borrowing->id) }}"
            method="POST"
            class="mt-5"
            onsubmit="return confirm('Apakah kamu sudah mengembalikan buku ini?');">

            @csrf

            <button
                type="submit"
                class="border border-[#16213A] px-5 py-2 text-sm font-medium text-[#16213A] transition hover:bg-[#16213A] hover:text-white">
                Kembalikan Buku
            </button>

        </form>

        @elseif ($borrowing->status === 'return_requested')

        <div class="mt-5 border border-[#E5E3DB] bg-[#F7F6F1] px-4 py-3">

            <p class="text-sm text-gray-500">
                Pengembalian sudah diajukan. Menunggu konfirmasi admin.
            </p>

        </div>

        @endif

    </div>

    @endforeach
</div>

@else

<div class="border border-[#E5E3DB] bg-white px-6 py-12 text-center">

    <p class="text-sm text-gray-500">
        Kamu belum memiliki riwayat peminjaman.
    </p>

</div>

@endif

@endsection