@extends('layouts.app')

@section('title', $title)

@section('content')

<div class="mb-8 border-b border-[#E5E3DB] pb-5">
    <a
        href="{{ route('publishers.index') }}"
        class="text-sm text-gray-500 transition hover:text-[#16213A]">
        ← Kembali ke Publisher
    </a>

    <p class="mt-6 mb-1 text-[11px] uppercase tracking-[0.2em] text-[#A16207]">
        Detail Publisher
    </p>

    <h1 class="font-display text-3xl font-semibold text-[#16213A]">
        {{ $publisher->name }}
    </h1>
</div>

@if (session('success'))
    <div class="mb-6 border border-green-200 bg-green-50 px-5 py-4 text-sm text-green-700">
        {{ session('success') }}
    </div>
@endif

<div class="max-w-2xl border border-[#E5E3DB] bg-white p-6">

    <div>
        <p class="text-[10px] uppercase tracking-[0.15em] text-[#A16207]">
            Nama Publisher
        </p>

        <p class="mt-2 text-2xl font-semibold text-[#16213A]">
            {{ $publisher->name }}
        </p>
    </div>

    <div class="mt-6 border-t border-[#E5E3DB] pt-5">
        <p class="text-sm text-gray-500">
            ID Publisher
        </p>

        <p class="mt-1 text-sm font-medium text-[#16213A]">
            #{{ $publisher->id }}
        </p>
    </div>

    <div class="mt-6 border-t border-[#E5E3DB] pt-5">
        <p class="text-sm text-gray-500">
            Ditambahkan
        </p>

        <p class="mt-1 text-sm font-medium text-[#16213A]">
            {{ $publisher->created_at->format('d M Y H:i') }}
        </p>
    </div>

    <div class="mt-8 flex flex-wrap gap-3">

        <a
            href="{{ route('publishers.edit', ['id' => $publisher->id]) }}"
            class="bg-[#16213A] px-5 py-3 text-sm font-medium text-white transition hover:bg-[#26324f]">
            Edit Publisher
        </a>

        <form
            action="{{ route('publishers.destroy', ['id' => $publisher->id]) }}"
            method="POST"
            onsubmit="return confirm('Yakin ingin menghapus publisher ini?')">
            @csrf
            @method('DELETE')

            <button
                type="submit"
                class="border border-red-200 bg-red-50 px-5 py-3 text-sm font-medium text-red-600 transition hover:bg-red-100">
                Hapus Publisher
            </button>
        </form>

    </div>

</div>

@endsection