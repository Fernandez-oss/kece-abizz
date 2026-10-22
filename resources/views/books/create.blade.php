@extends('layouts.app')

@section('title', 'Add Book')

@section('content')

<div class="mb-8 border-b border-[#E5E3DB] pb-5">
    <p class="mb-1 text-[11px] uppercase tracking-[0.2em] text-[#A16207]">
        Library Collection
    </p>

    <h1 class="font-display text-3xl font-semibold text-[#16213A]">
        Add Book
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

<form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- Book Name -->
    <div class="mb-5">
        <label for="name" class="mb-2 block text-sm font-medium text-[#16213A]">
            Book Title / Name
        </label>
        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name') }}"
            class="w-full border border-[#E5E3DB] bg-white px-4 py-3 focus:border-[#16213A] focus:outline-none"
            required>
    </div>

    <!-- Author -->
    <div class="mb-5">
        <label for="author_id" class="mb-2 block text-sm font-medium text-[#16213A]">
            Author
        </label>
        <select
            name="author_id"
            id="author_id"
            class="w-full border border-[#E5E3DB] bg-white px-4 py-3 focus:border-[#16213A] focus:outline-none"
            required>
            <option value="">-- Select Author --</option>
            @foreach ($authors as $author)
            <option
                value="{{ $author->id }}"
                {{ old('author_id') == $author->id ? 'selected' : '' }}>
                {{ $author->name }}
            </option>
            @endforeach
        </select>
    </div>

    <!-- Publisher -->
    <div class="mb-5">
        <label class="mb-2 block text-sm font-medium text-[#16213A]">
            Publisher
        </label>
        <div class="w-full border border-[#E5E3DB] bg-white p-4">
            <div class="space-y-2">
                @foreach ($publishers as $publisher)
                <label class="flex items-center gap-2 text-sm text-[#16213A]">
                    <input
                        type="checkbox"
                        name="publisher_ids[]"
                        value="{{ $publisher->id }}"
                        {{ is_array(old('publisher_ids')) && in_array($publisher->id, old('publisher_ids')) ? 'checked' : '' }}
                        class="rounded border-gray-300">
                    {{ $publisher->name }}
                </label>
                @endforeach
            </div>
            @error('publisher_ids')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <!-- Genre -->
    <div class="mb-5">
        <label class="mb-2 block text-sm font-medium text-[#16213A]">
            Genre
        </label>
        <div class="w-full border border-[#E5E3DB] bg-white p-4">
            <div class="space-y-2">
                @foreach ($genres as $genre)
                <label class="flex items-center gap-2 text-sm text-[#16213A]">
                    <input
                        type="checkbox"
                        name="genre_ids[]"
                        value="{{ $genre->id }}"
                        {{ is_array(old('genre_ids')) && in_array($genre->id, old('genre_ids')) ? 'checked' : '' }}
                        class="rounded border-gray-300">
                    {{ $genre->name }}
                </label>
                @endforeach
            </div>
            @error('genre_ids')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <!-- Category -->
    <div class="mb-5">
        <label class="mb-2 block text-sm font-medium text-[#16213A]">
            Category
        </label>
        <div class="w-full border border-[#E5E3DB] bg-white p-4">
            <div class="space-y-2">
                @foreach ($categories as $category)
                <label class="flex items-center gap-2 text-sm text-[#16213A]">
                    <input
                        type="checkbox"
                        name="category_ids[]"
                        value="{{ $category->id }}"
                        {{ is_array(old('category_ids')) && in_array($category->id, old('category_ids')) ? 'checked' : '' }}
                        class="rounded border-gray-300">
                    {{ $category->name }}
                </label>
                @endforeach
            </div>
            @error('category_ids')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <!-- Book Type -->
    <div class="mb-5">
        <label class="mb-2 block text-sm font-medium text-[#16213A]">
            Book Type
        </label>
        <div class="w-full border border-[#E5E3DB] bg-white p-4">
            <div class="space-y-2">
                @foreach ($bookTypes as $bookType)
                <label class="flex items-center gap-2 text-sm text-[#16213A]">
                    <input
                        type="checkbox"
                        name="book_type_ids[]"
                        value="{{ $bookType->id }}"
                        {{ is_array(old('book_type_ids')) && in_array($bookType->id, old('book_type_ids')) ? 'checked' : '' }}
                        class="rounded border-gray-300">
                    {{ $bookType->name }}
                </label>
                @endforeach
            </div>
            @error('book_type_ids')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <!-- Cover -->
    <div class="mb-5">
        <label for="cover_image" class="mb-2 block text-sm font-medium text-[#16213A]">
            Book Cover
        </label>
        <input
            type="file"
            id="cover_image"
            name="cover_image"
            accept="image/*"
            class="w-full border border-[#E5E3DB] bg-white px-4 py-3"
            required>
    </div>

    <!-- Year -->
    <div class="mb-5">
        <label for="year" class="mb-2 block text-sm font-medium text-[#16213A]">
            Publication Year
        </label>
        <input
            type="number"
            id="year"
            name="year"
            value="{{ old('year') }}"
            class="w-full border border-[#E5E3DB] bg-white px-4 py-3 focus:border-[#16213A] focus:outline-none"
            required>
    </div>

    <!-- Stock -->
    <div class="mb-5">
        <label for="stock" class="mb-2 block text-sm font-medium text-[#16213A]">
            Stock
        </label>
        <input
            type="number"
            id="stock"
            name="stock"
            value="{{ old('stock') }}"
            min="0"
            class="w-full border border-[#E5E3DB] bg-white px-4 py-3 focus:border-[#16213A] focus:outline-none"
            required>
    </div>

    <!-- Description -->
    <div class="mb-6">
        <label for="description" class="mb-2 block text-sm font-medium text-[#16213A]">
            Description
        </label>
        <textarea
            id="description"
            name="description"
            rows="5"
            class="w-full border border-[#E5E3DB] bg-white px-4 py-3 focus:border-[#16213A] focus:outline-none"
            required>{{ old('description') }}</textarea>
    </div>

    <!-- Action Buttons -->
    <div class="flex gap-3">
        <a
            href="{{ route('books.index') }}"
            class="border border-[#16213A] px-5 py-2.5 text-sm font-medium text-[#16213A] hover:bg-gray-100">
            Back
        </a>
        <button
            type="submit"
            class="bg-[#16213A] px-5 py-2.5 text-sm font-medium text-white hover:bg-[#26324f]">
            Save
        </button>
    </div>
</form>

@endsection