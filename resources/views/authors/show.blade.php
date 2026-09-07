@extends('layouts.app')

@section('title', 'Detail Author')

@section('content')

<div class="mb-8 flex items-end justify-between border-b border-[#E5E3DB] pb-5">
    <div>
        <p class="mb-1 text-[11px] uppercase tracking-[0.2em] text-[#A16207]">
            Koleksi Perpustakaan
        </p>

    <h1 class="font-display text-3xl font-semibold text-[#16213A]">
        Detail Author
    </h1>
</div>

</div>

<div class="border border-[#E5E3DB] bg-white p-6">

<div class="max-w-2xl">

    {{-- Nama Author --}}
    <h2 class="mb-6 text-2xl font-semibold text-[#16213A]">
        {{ $author->name }}
    </h2>

    <div class="space-y-4 text-sm">

        <div>
            <p class="text-xs uppercase tracking-wider text-gray-500">
                Nama Author
            </p>

            <p class="text-[#16213A]">
                {{ $author->name }}
            </p>
        </div>

        <div>
            <p class="text-xs uppercase tracking-wider text-gray-500">
                Data Diinput
            </p>

            <p class="text-[#16213A]">
                {{ $author->created_at?->format('d M Y, H:i') }}
            </p>
        </div>

        <div>
            <p class="text-xs uppercase tracking-wider text-gray-500">
                Terakhir Diupdate
            </p>

            <p class="text-[#16213A]">
                {{ $author->updated_at?->format('d M Y, H:i') }}
            </p>
        </div>

    </div>

    {{-- Tombol --}}
    <div class="mt-8 flex gap-3">

        <a
            href="{{ route('authors.index') }}"
            class="border border-[#16213A] px-5 py-2.5 text-sm font-medium text-[#16213A] hover:bg-gray-100">
            Kembali
        </a>

        <a
            href="{{ route('authors.edit', $author->id) }}"
            class="bg-[#16213A] px-5 py-2.5 text-sm font-medium text-white hover:bg-[#26324f]">
            Edit
        </a>

        <form
            action="{{ route('authors.destroy', $author->id) }}"
            method="POST"
            onsubmit="return confirm('Hapus author ini?')">

            @csrf
            @method('DELETE')

            <button
                type="submit"
                class="bg-red-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-red-800">
                Hapus
            </button>

        </form>

    </div>

</div>

</div>

@endsection
