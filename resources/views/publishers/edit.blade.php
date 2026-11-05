@extends('layouts.app')

@section('title', $title)

@section('content')

<div class="mb-8 border-b border-[#E5E3DB] pb-5">
    <a
        href="{{ route('publishers.show', ['id' => $publisher->id]) }}"
        class="text-sm text-gray-500 transition hover:text-[#16213A]">
        ← Return to Publisher Details
    </a>

    <p class="mt-6 mb-1 text-[11px] uppercase tracking-[0.2em] text-[#A16207]">
        Library Data
    </p>

    <h1 class="font-display text-3xl font-semibold text-[#16213A]">
        Edit Publisher
    </h1>

    <p class="mt-2 text-sm text-gray-500">
        Update the publisher's information.
    </p>
</div>

@if ($errors->any())
    <div class="mb-6 border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-600">
        <ul class="list-inside list-disc">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="max-w-2xl border border-[#E5E3DB] bg-white p-6">

    <form
        action="{{ route('publishers.update', ['id' => $publisher->id]) }}"
        method="POST">

        @csrf
        @method('PUT')

        <div>
            <label
                for="name"
                class="mb-2 block text-sm font-medium text-[#16213A]">
                Publisher Name
            </label>

            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name', $publisher->name) }}"
                class="w-full border border-[#E5E3DB] bg-[#FAFAF7] px-4 py-3 text-sm outline-none transition focus:border-[#16213A]"
                required>
        </div>

        <div class="mt-6 flex gap-3">
            <button
                type="submit"
                class="bg-[#16213A] px-5 py-3 text-sm font-medium text-white transition hover:bg-[#26324f]">
                Save Changes
            </button>

            <a
                href="{{ route('publishers.show', ['id' => $publisher->id]) }}"
                class="border border-[#E5E3DB] bg-white px-5 py-3 text-sm font-medium text-gray-600 transition hover:bg-gray-50">
                Cancel
            </a>
        </div>

    </form>

</div>

@endsection