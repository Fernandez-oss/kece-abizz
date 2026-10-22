@extends('layouts.app')

@section('title', $title)

@section('content')

<div class="mb-8 border-b border-[#E5E3DB] pb-5">
    <p class="mb-1 text-[11px] uppercase tracking-[0.2em] text-[#A16207]">
        Academic Year 2025/2026
    </p>

    <h1 class="font-display text-3xl font-semibold text-[#16213A]">
        Add Category
    </h1>
</div>

<div class="max-w-2xl border border-[#E5E3DB] bg-white p-6">

    <form action="{{ route('categories.store') }}" method="POST">

        @csrf

        <div class="mb-6">
            <label
                for="name"
                class="mb-2 block text-sm font-medium text-[#16213A]">
                Category Name
            </label>

            <input
                type="text"
                name="name"
                id="name"
                value="{{ old('name') }}"
                placeholder="Enter category name"
                class="w-full border border-[#E5E3DB] px-4 py-3 text-sm outline-none transition focus:border-[#A16207]"
                required
            >

            @error('name')
                <p class="mt-2 text-xs text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div class="flex items-center justify-between">

            <a
                href="{{ route('categories.index') }}"
                class="text-sm font-medium text-[#16213A] hover:text-[#A16207]">
                Back
            </a>

            <button
                type="submit"
                class="bg-[#16213A] px-5 py-2.5 text-sm font-medium text-white transition hover:bg-[#26324f]">
                Save Category
            </button>

        </div>

    </form>

</div>

@endsection