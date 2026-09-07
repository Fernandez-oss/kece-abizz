@extends('layouts.app')

@section('title', 'Edit Buku')

@section('content')

<div class="mb-8 border-b border-[#E5E3DB] pb-5">
    <p class="mb-1 text-[11px] uppercase tracking-[0.2em] text-[#A16207]">
        Koleksi Perpustakaan
    </p>

    <h1 class="font-display text-3xl font-semibold text-[#16213A]">
        Edit Buku
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
    action="{{ route('books.update', $book->id) }}"
    method="POST"
    enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <!-- Nama -->
    <div class="mb-5">
        <label for="name" class="mb-2 block text-sm font-medium text-[#16213A]">
            Nama Buku
        </label>

        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name', $book->name) }}"
            class="w-full border border-[#E5E3DB] bg-white px-4 py-3 focus:border-[#16213A] focus:outline-none"
            required>
    </div>

    <!-- Author -->
    <div class="mb-5">
        <label for="author_id" class="mb-2 block text-sm font-medium text-[#16213A]">
            Author
        </label>

        <select
            id="author_id"
            name="author_id"
            class="w-full border border-[#E5E3DB] bg-white px-4 py-3 focus:border-[#16213A] focus:outline-none"
            required>

            <option value="">-- Pilih Author --</option>

            @foreach ($authors as $author)
                <option
                    value="{{ $author->id }}"
                    {{ old('author_id', $book->author_id) == $author->id ? 'selected' : '' }}>
                    {{ $author->name }}
                </option>
            @endforeach

        </select>
    </div>

    <!-- Genre -->
    <div class="mb-5">
        <label for="genre_id" class="mb-2 block text-sm font-medium text-[#16213A]">
            Genre
        </label>

        <select
            id="genre_id"
            name="genre_id"
            class="w-full border border-[#E5E3DB] bg-white px-4 py-3 focus:border-[#16213A] focus:outline-none"
            required>

            <option value="">-- Pilih Genre --</option>

            @foreach ($genres as $genre)
                <option
                    value="{{ $genre->id }}"
                    {{ old('genre_id', $book->genre_id) == $genre->id ? 'selected' : '' }}>
                    {{ $genre->name }}
                </option>
            @endforeach

        </select>
    </div>

    <!-- Category -->
    <div class="mb-5">
        <label for="category_id" class="mb-2 block text-sm font-medium text-[#16213A]">
            Category
        </label>

        <select
            id="category_id"
            name="category_id"
            class="w-full border border-[#E5E3DB] bg-white px-4 py-3 focus:border-[#16213A] focus:outline-none"
            required>

            <option value="">-- Pilih Category --</option>

            @foreach ($categories as $category)
                <option
                    value="{{ $category->id }}"
                    {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach

        </select>
    </div>

    <!-- Tipe Buku -->
    <div class="mb-5">
        <label for="book_type_id" class="mb-2 block text-sm font-medium text-[#16213A]">
            Tipe Buku
        </label>

        <select
            id="book_type_id"
            name="book_type_id"
            class="w-full border border-[#E5E3DB] bg-white px-4 py-3 focus:border-[#16213A] focus:outline-none"
            required>

            <option value="">-- Pilih Tipe Buku --</option>

            @foreach ($bookTypes as $bookType)
                <option
                    value="{{ $bookType->id }}"
                    {{ old('book_type_id', $book->book_type_id) == $bookType->id ? 'selected' : '' }}>
                    {{ $bookType->name }}
                </option>
            @endforeach

        </select>
    </div>

    <!-- Cover -->
    <div class="mb-5">
        <label for="cover_image" class="mb-2 block text-sm font-medium text-[#16213A]">
            Cover Buku
        </label>

        @if ($book->cover_image)
            <div class="mb-3">
                <img
                    src="{{ asset('cover_images/' . $book->cover_image) }}"
                    alt="{{ $book->name }}"
                    class="h-40 w-28 border object-cover">
            </div>
        @endif

        <input
            type="file"
            id="cover_image"
            name="cover_image"
            accept="image/*"
            class="w-full border border-[#E5E3DB] bg-white px-4 py-3">
    </div>

    <!-- Tahun -->
    <div class="mb-5">
        <label for="year" class="mb-2 block text-sm font-medium text-[#16213A]">
            Tahun Terbit
        </label>

        <input
            type="number"
            id="year"
            name="year"
            value="{{ old('year', $book->year) }}"
            class="w-full border border-[#E5E3DB] bg-white px-4 py-3 focus:border-[#16213A] focus:outline-none"
            required>
    </div>

    <!-- Stok -->
    <div class="mb-5">
        <label for="stock" class="mb-2 block text-sm font-medium text-[#16213A]">
            Stok
        </label>

        <input
            type="number"
            id="stock"
            name="stock"
            value="{{ old('stock', $book->stock) }}"
            min="0"
            class="w-full border border-[#E5E3DB] bg-white px-4 py-3 focus:border-[#16213A] focus:outline-none"
            required>
    </div>

    <!-- Deskripsi -->
    <div class="mb-6">
        <label for="description" class="mb-2 block text-sm font-medium text-[#16213A]">
            Deskripsi
        </label>

        <textarea
            id="description"
            name="description"
            rows="5"
            class="w-full border border-[#E5E3DB] bg-white px-4 py-3 focus:border-[#16213A] focus:outline-none"
            required>{{ old('description', $book->description) }}</textarea>
    </div>

    <!-- Tombol -->
    <div class="flex gap-3">

        <a
            href="{{ route('books.index') }}"
            class="border border-[#16213A] px-5 py-2.5 text-sm font-medium text-[#16213A] hover:bg-gray-100">
            Kembali
        </a>

        <button
            type="submit"
            class="bg-[#16213A] px-5 py-2.5 text-sm font-medium text-white hover:bg-[#26324f]">
            Simpan Perubahan
        </button>

    </div>

</form>

@endsection