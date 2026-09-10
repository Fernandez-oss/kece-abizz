@extends('layouts.app')

@section('title', 'Edit Category')

@section('content')

<div class="mb-8 border-b border-[#E5E3DB] pb-5">
    <p class="mb-1 text-[11px] uppercase tracking-[0.2em] text-[#A16207]">
        Library Collection
    </p>

    <h1 class="font-display text-3xl font-semibold text-[#16213A]">
        Edit Category
    </h1>
</div>

@if ($errors->any())

<div class="mb-6 border border-red-300 bg-red-50 p-4 text-sm text-red-700">
    <ul class="list-disc pl-5">

        @foreach ($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

    </ul>
</div>

@endif

<form
    action="{{ route('categories.update', $category->id) }}"
    method="POST">

    @csrf
    @method('PUT')

    <div class="mb-6">

        <label
            for="name"
            class="mb-2 block text-sm font-medium text-[#16213A]">
            Category Name
        </label>

        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name', $category->name) }}"
            class="w-full border border-[#E5E3DB] bg-white px-4 py-3 focus:border-[#16213A] focus:outline-none"
            required>

    </div>

    <div class="flex gap-3">

        <a
            href="{{ route('categories.show', $category->id) }}"
            class="border border-[#16213A] px-5 py-2.5 text-sm font-medium text-[#16213A] hover:bg-gray-100">
            Back
        </a>

        <button
            type="submit"
            class="bg-[#16213A] px-5 py-2.5 text-sm font-medium text-white hover:bg-[#26324f]">
            Save Changes
        </button>

    </div>

</form>

@endsection