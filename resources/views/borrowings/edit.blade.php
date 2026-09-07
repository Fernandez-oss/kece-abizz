@extends('layouts.app')

@section('title', $title)

@section('content')

<div class="mb-6">

    <a
        href="{{ route('borrowings.show', $borrowing->id) }}"
        class="text-sm font-medium text-[#16213A] hover:text-[#A16207]">
        ← Kembali ke Detail Peminjaman
    </a>

</div>


<div class="max-w-xl border border-[#E5E3DB] bg-white p-6">

    <p class="text-[11px] uppercase tracking-[0.2em] text-[#A16207]">
        Perpanjang Peminjaman
    </p>

    <h1 class="mt-2 font-display text-2xl font-semibold text-[#16213A]">
        {{ $borrowing->book->name }}
    </h1>


    <div class="mt-6 space-y-4">

        <div>

            <p class="text-xs uppercase tracking-wider text-gray-400">
                Peminjam
            </p>

            <p class="mt-1 text-sm text-[#16213A]">
                {{ $borrowing->user->name }}
            </p>

        </div>


        <div>

            <p class="text-xs uppercase tracking-wider text-gray-400">
                Jatuh Tempo Saat Ini
            </p>

            <p class="mt-1 text-sm text-[#16213A]">
                {{ $borrowing->due_date->format('d M Y') }}
            </p>

        </div>

    </div>


    <form
        action="{{ route('borrowings.update', $borrowing->id) }}"
        method="POST"
        class="mt-8">

        @csrf
        @method('PUT')


        <label
            for="due_date"
            class="text-xs uppercase tracking-wider text-gray-400">
            Perpanjang Sampai
        </label>

        <input
            type="date"
            name="due_date"
            id="due_date"
            value="{{ $borrowing->due_date->format('Y-m-d') }}"
            min="{{ now()->format('Y-m-d') }}"
            required
            class="mt-2 block w-full border border-[#E5E3DB] bg-white px-4 py-3 text-sm text-[#16213A] outline-none focus:border-[#16213A]">


        @error('due_date')

            <p class="mt-2 text-sm text-red-600">
                {{ $message }}
            </p>

        @enderror


        <button
            type="submit"
            class="mt-6 bg-[#16213A] px-6 py-3 text-sm font-medium text-white transition hover:bg-[#26324f]">
            Simpan Perpanjangan
        </button>

    </form>

</div>

@endsection