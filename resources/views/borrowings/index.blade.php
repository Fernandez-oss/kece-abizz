@extends('layouts.app')

@section('title', $title)

@section('content')

<div class="mb-6">

    <p class="text-[11px] uppercase tracking-[0.2em] text-[#A16207]">
        Peminjaman
    </p>

    <h1 class="mt-2 font-display text-3xl font-semibold text-[#16213A]">
        Daftar Peminjaman
    </h1>

    <p class="mt-2 text-sm text-gray-500">
        Kelola dan konfirmasi pengembalian buku.
    </p>

</div>


@if (session('success'))

    <div class="mb-6 border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
        {{ session('success') }}
    </div>

@endif


@if ($borrowings->count() > 0)

    <div class="overflow-hidden border border-[#E5E3DB] bg-white">

        {{-- HEADER --}}
        <div class="grid grid-cols-5 border-b border-[#E5E3DB] bg-[#F7F6F1] px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">

            <div>
                Nama Peminjam
            </div>

            <div>
                Buku
            </div>

            <div>
                Jumlah
            </div>

            <div>
                Sisa Waktu
            </div>

            <div>
                Status
            </div>

        </div>


        {{-- DATA --}}
        @foreach ($borrowings as $borrowing)

            @php
                $today = now()->startOfDay();
                $dueDate = $borrowing->due_date->startOfDay();

                $remainingDays = $today->diffInDays($dueDate, false);
            @endphp


            <a
                href="{{ route('borrowings.show', $borrowing->id) }}"
                class="grid grid-cols-5 items-center border-b border-[#EFEDE6] px-6 py-5 transition hover:bg-[#FAF9F5]">

                {{-- NAMA --}}
                <div>

                    <p class="text-sm font-medium text-[#16213A]">
                        {{ $borrowing->user->name }}
                    </p>

                </div>


                {{-- BUKU --}}
                <div>

                    <p class="text-sm text-[#16213A]">
                        {{ $borrowing->book->name }}
                    </p>

                </div>


                {{-- JUMLAH --}}
                <div>

                    <p class="text-sm text-[#16213A]">
                        1
                    </p>

                </div>


                {{-- SISA WAKTU --}}
                <div>

                    @if ($borrowing->status === 'return_requested')

                        <p class="text-sm text-gray-400">
                            -
                        </p>

                    @elseif ($remainingDays > 0)

                        <p class="text-sm text-[#16213A]">
                            {{ $remainingDays }} hari lagi
                        </p>

                    @elseif ($remainingDays === 0)

                        <p class="text-sm font-medium text-[#A16207]">
                            Jatuh tempo hari ini
                        </p>

                    @else

                        <p class="text-sm font-medium text-red-600">
                            Terlambat {{ abs($remainingDays) }} hari
                        </p>

                    @endif

                </div>


                {{-- STATUS --}}
                <div>

                    @if ($borrowing->status === 'borrowed')

                        <span class="inline-block border border-[#E5E3DB] px-3 py-1 text-xs text-gray-600">
                            Sedang Dipinjam
                        </span>

                    @elseif ($borrowing->status === 'return_requested')

                        <span class="inline-block border border-[#A16207] bg-[#FFF9ED] px-3 py-1 text-xs font-medium text-[#A16207]">
                            Menunggu Konfirmasi
                        </span>

                    @endif

                </div>

            </a>

        @endforeach

    </div>

@else

    <div class="border border-[#E5E3DB] bg-white px-6 py-12 text-center">

        <p class="text-sm text-gray-500">
            Belum ada peminjaman.
        </p>

    </div>

@endif

@endsection