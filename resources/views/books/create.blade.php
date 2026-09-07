@extends('layouts.app')

@section('title', 'Tambah Buku')

@section('content')

<div class="mb-8 border-b border-[#E5E3DB] pb-5">
    <p class="mb-1 text-[11px] uppercase tracking-[0.2em] text-[#A16207]">
        Koleksi Perpustakaan
    </p>

    <h1 class="font-display text-3xl font-semibold text-[#16213A]">
        Tambah Buku
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

    <!-- Nama -->
    <div class="mb-5">
        <label for="name" class="mb-2 block text-sm font-medium text-[#16213A]">
            Nama Buku
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

            <option value="">-- Pilih Author --</option>

            @foreach ($authors as $author)
            <option
                value="{{ $author->id }}"
                {{ old('author_id') == $author->id ? 'selected' : '' }}>
                {{ $author->name }}
            </option>
            @endforeach

        </select>
    </div>

    {{-- Publisher --}}
    <div class="mb-5">
        <label for="publisher_id" class="mb-2 block text-sm font-medium text-[#16213A]">
            Publisher
        </label>

        <select
            name="publisher_id"
            id="publisher_id"
            class="w-full border border-[#E5E3DB] bg-white px-4 py-3 focus:border-[#16213A] focus:outline-none"
            required>

            <option value="">-- Pilih Publisher --</option>

            @foreach ($publishers as $publisher)
            <option
                value="{{ $publisher->id }}"
                {{ old('publisher_id') == $publisher->id ? 'selected' : '' }}>
                {{ $publisher->name }}
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
            name="genre_id"
            id="genre_id"
            class="w-full border border-[#E5E3DB] bg-white px-4 py-3 focus:border-[#16213A] focus:outline-none"
            required>

            <option value="">-- Pilih Genre --</option>

            @foreach ($genres as $genre)
            <option
                value="{{ $genre->id }}"
                {{ old('genre_id') == $genre->id ? 'selected' : '' }}>
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
            name="category_id"
            id="category_id"
            class="w-full border border-[#E5E3DB] bg-white px-4 py-3 focus:border-[#16213A] focus:outline-none"
            required>

            <option value="">-- Pilih Category --</option>

            @foreach ($categories as $category)
            <option
                value="{{ $category->id }}"
                {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
            name="book_type_id"
            id="book_type_id"
            class="w-full border border-[#E5E3DB] bg-white px-4 py-3 focus:border-[#16213A] focus:outline-none"
            required>

            <option value="">-- Pilih Tipe Buku --</option>

            @foreach ($bookTypes as $bookType)
            <option
                value="{{ $bookType->id }}"
                {{ old('book_type_id') == $bookType->id ? 'selected' : '' }}>
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

        <input
            type="file"
            id="cover_image"
            name="cover_image"
            accept="image/*"
            class="w-full border border-[#E5E3DB] bg-white px-4 py-3"
            required>
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
            value="{{ old('year') }}"
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
            value="{{ old('stock') }}"
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
            required>{{ old('description') }}</textarea>
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
            Simpan
        </button>

    </div>

</form>

@endsection