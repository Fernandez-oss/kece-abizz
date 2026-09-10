@extends('layouts.app')

@section('title', 'Book Type Details')

@section('content')

<div class="mb-8 flex items-end justify-between border-b border-[#E5E3DB] pb-5">
    <div>
        <p class="mb-1 text-[11px] uppercase tracking-[0.2em] text-[#A16207]">
            Library Collection
        </p>

        <h1 class="font-display text-3xl font-semibold text-[#16213A]">
            Book Type Details
        </h1>
    </div>
</div>

<div class="border border-[#E5E3DB] bg-white p-6">

    <div class="max-w-2xl">

        <h2 class="mb-6 text-2xl font-semibold text-[#16213A]">
            {{ $bookType->name }}
        </h2>

        <div class="space-y-4 text-sm">

            <div>
                <p class="text-xs uppercase tracking-wider text-gray-500">
                    Book Type Name
                </p>

                <p class="text-[#16213A]">
                    {{ $bookType->name }}
                </p>
            </div>

            <div>
                <p class="text-xs uppercase tracking-wider text-gray-500">
                    Created At
                </p>

                <p class="text-[#16213A]">
                    {{ $bookType->created_at?->format('d M Y, H:i') }}
                </p>
            </div>

            <div>
                <p class="text-xs uppercase tracking-wider text-gray-500">
                    Last Updated
                </p>

                <p class="text-[#16213A]">
                    {{ $bookType->updated_at?->format('d M Y, H:i') }}
                </p>
            </div>

        </div>

        <div class="mt-8 flex gap-3">

            <a
                href="{{ route('book_types.index') }}"
                class="border border-[#16213A] px-5 py-2.5 text-sm font-medium text-[#16213A] hover:bg-gray-100">
                Back
            </a>

            <a
                href="{{ route('book_types.edit', $bookType->id) }}"
                class="bg-[#16213A] px-5 py-2.5 text-sm font-medium text-white hover:bg-[#26324f]">
                Edit
            </a>

            <form
                action="{{ route('book_types.destroy', $bookType->id) }}"
                method="POST"
                onsubmit="return confirm('Delete this book type?')">

                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="bg-red-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-red-800">
                    Delete
                </button>

            </form>

        </div>

    </div>

</div>

@endsection