@extends('layouts.app')

@section('title', 'Daftar Tipe Buku')

@section('content')

<div class="mb-8 flex items-end justify-between border-b border-[#E5E3DB] pb-5">
    <div>
        <p class="mb-1 text-[11px] uppercase tracking-[0.2em] text-[#A16207]">Tahun Ajaran 2025/2026</p>
        <h1 class="font-display text-3xl font-semibold text-[#16213A]">Daftar Tipe Buku</h1>
    </div>
    <a href="{{ route('book_types.create') }}" class="bg-[#16213A] px-5 py-2.5 text-sm font-medium text-white transition hover:bg-[#26324f]">
        Tambah Tipe Buku
    </a>
</div>

@if ($bookTypes->isEmpty())

<div class="border border-[#E5E3DB] bg-white p-10 text-center">
    <p class="text-gray-500">
        Belum ada data tipe buku.
    </p>
</div>

@else

<div class="border border-[#E5E3DB] bg-white">
    <table class="w-full text-left text-sm">

        <thead>
            <tr class="border-b border-[#16213A] text-[11px] uppercase tracking-[0.15em] text-[#16213A]">
                <th class="px-5 py-3.5">
                    No.
                </th>

                <th class="px-5 py-3.5">
                    Nama Tipe Buku
                </th>
            </tr>
        </thead>

        <tbody>

            @foreach ($bookTypes as $bookType)

            <tr class="border-b border-[#EFEDE6]">

                <td class="px-5 py-4 text-[#A16207]">
                    {{ $loop->iteration }}
                </td>

                <td class="px-5 py-4 font-medium text-[#16213A]">
                    <a
                        href="{{ route('book_types.show', $bookType->id) }}"
                        class="hover:underline">
                        {{ $bookType->name }}
                    </a>
                </td>

            </tr>

            @endforeach

        </tbody>

    </table>
</div>

@endif

@endsection