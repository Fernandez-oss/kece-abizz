@extends('layouts.app')

@section('title', $title)

@section('content')

<div class="mb-6">

    <a
        href="{{ route('borrowings.index') }}"
        class="text-sm font-medium text-[#16213A] hover:text-[#A16207]">
        ← Kembali ke Daftar Peminjaman
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
            Detail Peminjaman
        </p>

        <h1 class="mt-2 font-display text-3xl font-semibold text-[#16213A]">
            {{ $borrowing->book->name }}
        </h1>


        {{-- DATA --}}
        <div class="mt-8 grid grid-cols-1 gap-x-10 gap-y-6 md:grid-cols-2">

            {{-- PEMINJAM --}}
            <div>

                <p class="text-xs uppercase tracking-wider text-gray-400">
                    Nama Peminjam
                </p>

                <p class="mt-1 text-sm text-[#16213A]">
                    {{ $borrowing->user->name }}
                </p>

            </div>


            {{-- BUKU --}}
            <div>

                <p class="text-xs uppercase tracking-wider text-gray-400">
                    Buku
                </p>

                <p class="mt-1 text-sm text-[#16213A]">
                    {{ $borrowing->book->name }}
                </p>

            </div>


            {{-- JUMLAH --}}
            <div>

                <p class="text-xs uppercase tracking-wider text-gray-400">
                    Jumlah
                </p>

                <p class="mt-1 text-sm text-[#16213A]">
                    1 buku
                </p>

            </div>


            {{-- TANGGAL PINJAM --}}
            <div>

                <p class="text-xs uppercase tracking-wider text-gray-400">
                    Tanggal Peminjaman
                </p>

                <p class="mt-1 text-sm text-[#16213A]">
                    {{ $borrowing->borrowed_at->format('d M Y, H:i') }}
                </p>

            </div>


            {{-- JATUH TEMPO --}}
            <div>

                <p class="text-xs uppercase tracking-wider text-gray-400">
                    Jatuh Tempo
                </p>

                <p class="mt-1 text-sm text-[#16213A]">
                    {{ $borrowing->due_date->format('d M Y') }}
                </p>

            </div>


            {{-- SISA WAKTU --}}
            <div>

                @php
                $today = now()->startOfDay();
                $dueDate = $borrowing->due_date->startOfDay();

                $remainingDays = $today->diffInDays($dueDate, false);
                @endphp

                <p class="text-xs uppercase tracking-wider text-gray-400">
                    Sisa Waktu
                </p>

                @if ($remainingDays > 0)

                <p class="mt-1 text-sm text-[#16213A]">
                    {{ $remainingDays }} hari lagi
                </p>

                @elseif ($remainingDays === 0)

                <p class="mt-1 text-sm font-medium text-[#A16207]">
                    Jatuh tempo hari ini
                </p>

                @else

                <p class="mt-1 text-sm font-medium text-red-600">
                    Terlambat {{ abs($remainingDays) }} hari
                </p>

                @endif

            </div>

        </div>


        {{-- STATUS --}}
        <div class="mt-8 border-t border-[#EFEDE6] pt-6">

            <p class="text-xs uppercase tracking-wider text-gray-400">
                Status Pengembalian
            </p>


            @if ($borrowing->status === 'borrowed')

            <div class="mt-3 border border-[#E5E3DB] bg-[#F7F6F1] px-4 py-4">

                <p class="text-sm font-medium text-[#16213A]">
                    Sedang Dipinjam
                </p>

                <p class="mt-1 text-sm text-gray-500">
                    User belum mengajukan pengembalian buku.
                </p>

            </div>


            @elseif ($borrowing->status === 'return_requested')

            <div class="mt-3 border border-[#A16207] bg-[#FFF9ED] px-4 py-4">

                <p class="text-sm font-medium text-[#A16207]">
                    Menunggu Konfirmasi
                </p>

                <p class="mt-1 text-sm text-gray-600">
                    User sudah mengajukan pengembalian.
                </p>

                @if ($borrowing->returned_at)

                <p class="mt-2 text-xs text-gray-500">
                    Diajukan pada
                    {{ $borrowing->returned_at->format('d M Y, H:i') }}
                </p>

                @endif

            </div>

            @endif

        </div>


        {{-- ACTION --}}
        <div class="mt-6 flex flex-wrap gap-3">

            {{-- PERPANJANG --}}
            @if ($borrowing->status === 'borrowed')

            <a
                href="{{ route('borrowings.edit', $borrowing->id) }}"
                class="bg-[#16213A] px-5 py-3 text-sm font-medium text-white transition hover:bg-[#26324f]">
                Perpanjang
            </a>

            @endif


            {{-- KONFIRMASI --}}
            @if ($borrowing->status === 'return_requested')

            <form
                action="{{ route('borrowings.destroy', $borrowing->id) }}"
                method="POST"
                onsubmit="return confirm('Pastikan buku sudah diterima. Konfirmasi pengembalian?');">

                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="bg-[#16213A] px-5 py-3 text-sm font-medium text-white transition hover:bg-[#26324f]">
                    Konfirmasi Pengembalian
                </button>

            </form>

            @endif

        </div>

    </div>

</div>

@endsection