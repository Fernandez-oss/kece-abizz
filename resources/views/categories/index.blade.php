@extends('layouts.app')

@section('title', 'Daftar Category')

@section('content')

<div class="mb-8 flex items-end justify-between border-b border-[#E5E3DB] pb-5">
    <div>
        <p class="mb-1 text-[11px] uppercase tracking-[0.2em] text-[#A16207]">Tahun Ajaran 2025/2026</p>
        <h1 class="font-display text-3xl font-semibold text-[#16213A]">Daftar Kategori</h1>
    </div>
    <a href="{{ route('categories.create') }}" class="bg-[#16213A] px-5 py-2.5 text-sm font-medium text-white transition hover:bg-[#26324f]">
        Tambah Kategory
    </a>
</div>

@if ($categories->isEmpty())

<div class="border border-[#E5E3DB] bg-white p-10 text-center">
    <p class="text-gray-500">
        Belum ada data category.
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
                    Nama Category
                </th>
            </tr>
        </thead>

        <tbody>

            @foreach ($categories as $category)

            <tr class="border-b border-[#EFEDE6]">

                <td class="px-5 py-4 text-[#A16207]">
                    {{ $loop->iteration }}
                </td>

                <td class="px-5 py-4 font-medium text-[#16213A]">
                    <a
                        href="{{ route('categories.show', $category->id) }}"
                        class="hover:underline">
                        {{ $category->name }}
                    </a>
                </td>

            </tr>

            @endforeach

        </tbody>

    </table>
</div>

@endif

@endsection