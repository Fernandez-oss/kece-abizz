@extends('layouts.app')

@section('title', $title ?? 'Categories')

@section('content')

<div class="min-h-screen bg-[#FFF2E0] p-8 text-[#222]">

     {{-- HEADER SECTION --}}
    <div class="mb-8 flex justify-center">
        <img 
            src="{{ asset('images/Categories.png') }}" 
            alt="Categories" 
            class="h-20 w-auto object-contain"
        >
    </div>


    {{-- FORM SEARCH CATEGORY --}}
    <form
        action="{{ route('category') }}"
        method="GET"
        class="mx-auto mb-6 max-w-4xl"
    >
        <div class="flex items-center gap-3">

            <div class="relative flex-1">

                {{-- Search Icon --}}
                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500">
                    <svg
                        class="h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                        />
                    </svg>
                </span>

                <input
                    type="text"
                    name="q"
                    value="{{ request('q') }}"
                    placeholder="What kind of book you like to read?"
                    class="w-full rounded-full border border-[#7E97A6] bg-[#FFF8EF] py-3 pl-12 pr-4 font-serif text-sm text-[#111] placeholder-gray-400 focus:border-[#003565] focus:outline-none shadow-sm"
                >

            </div>

            <button
                type="submit"
                class="flex items-center gap-2 rounded-full bg-[#003565] px-6 py-3 font-serif text-sm text-white shadow transition hover:bg-[#002548]"
            >
                <svg
                    class="h-4 w-4"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                    />
                </svg>

                Search Categories
            </button>

        </div>
    </form>


    {{-- JUDUL CATEGORY --}}
    <div class="mb-8 text-center">

        <h2 class="font-serif text-2xl font-bold text-[#000000]">
            Book Categories
        </h2>

        {{-- Decorative Line --}}
        <div class="mx-auto mt-3 flex max-w-xs items-center justify-center">

            <div class="h-px flex-1 bg-[#7E97A6]/40"></div>

            <span class="mx-3 font-serif text-lg text-[#CFC4AE]">
                ♢
            </span>

            <div class="h-px flex-1 bg-[#7E97A6]/40"></div>

        </div>

        <p class="mt-3 font-serif text-lg text-[#222]">
            Explore by your interest
        </p>

        <p class="font-serif text-sm leading-6 text-[#555]">
            Find something you'll<br>
            love to read.
        </p>
        

    </div>


    {{-- CATEGORY CARDS --}}
    <div class="mx-auto grid max-w-3xl grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">

        @forelse ($categories as $category)

            <a
                href="#"
                class="group rounded-xl border border-[#7E97A6]/40 bg-[#E2DED4] p-4 text-center shadow-sm transition hover:-translate-y-1 hover:shadow-md"
            >

                {{-- CATEGORY NAME --}}
                <h3 class="font-serif text-lg font-normal text-[#222]">
                    {{ $category->name }}
                </h3>


                {{-- Decorative Line --}}
                <div class="mx-auto mt-2 flex max-w-28 items-center justify-center">

                    <div class="h-px flex-1 bg-[#CFC4AE]"></div>

                    <span class="mx-2 font-serif text-sm text-[#CFC4AE]">
                        ♢
                    </span>

                    <div class="h-px flex-1 bg-[#CFC4AE]"></div>

                </div>


                {{-- JUMLAH BUKU --}}
                <div class="mt-3 flex items-center justify-between">

                    <span class="flex-1 font-serif text-xs text-[#888]">
                        {{ $category->books()->count() }} books
                    </span>

                    <span class="font-serif text-lg text-[#111] transition group-hover:translate-x-1">
                        →
                    </span>

                </div>

            </a>

        @empty

            <div class="col-span-full py-12 text-center font-serif text-gray-500">
                No categories available.
            </div>

        @endforelse

    </div>

</div>

@endsection