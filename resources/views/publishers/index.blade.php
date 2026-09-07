@extends('layouts.app')

@section('title', $title)

@section('content')

<div class="mb-8 border-b border-[#E5E3DB] pb-5">
    <p class="mb-1 text-[11px] uppercase tracking-[0.2em] text-[#A16207]">
        Data Perpustakaan
    </p>

    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <h1 class="font-display text-3xl font-semibold text-[#16213A]">
                Publisher
            </h1>

            <p class="mt-2 text-sm text-gray-500">
                Daftar publisher buku perpustakaan.
            </p>
        </div>

        <a
            href="{{ route('publishers.create') }}"
            class="inline-flex w-fit bg-[#16213A] px-5 py-3 text-sm font-medium text-white transition hover:bg-[#26324f]">
            + Tambah Publisher
        </a>
    </div>
</div>

@if (session('success'))
    <div class="mb-6 border border-green-200 bg-green-50 px-5 py-4 text-sm text-green-700">
        {{ session('success') }}
    </div>
@endif

@if ($publishers->isEmpty())
    <div class="border border-[#E5E3DB] bg-white px-6 py-12 text-center">
        <p class="font-medium text-[#16213A]">
            Belum ada publisher.
        </p>

        <p class="mt-2 text-sm text-gray-500">
            Tambahkan publisher untuk mulai mengelola data.
        </p>
    </div>
@else
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($publishers as $publisher)
            <a
                href="{{ route('publishers.show', ['id' => $publisher->id]) }}"
                class="group border border-[#E5E3DB] bg-white p-6 transition hover:-translate-y-1 hover:shadow-md">

                <p class="text-[10px] uppercase tracking-[0.15em] text-[#A16207]">
                    Publisher
                </p>

                <h2 class="mt-2 text-xl font-semibold text-[#16213A]">
                    {{ $publisher->name }}
                </h2>

                <p class="mt-4 text-sm text-gray-400 transition group-hover:text-gray-600">
                    Klik untuk melihat detail →
                </p>
            </a>
        @endforeach
    </div>
@endif

@endsection