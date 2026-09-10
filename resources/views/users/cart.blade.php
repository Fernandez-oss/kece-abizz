@extends('layouts.app')

@section('title', 'Loan Application')

@section('content')
<div class="min-h-screen bg-[#FFF2E0] p-6 text-[#222]">

    {{-- HEADER SECTION --}}
    <div class="mb-8 flex justify-center">
        <img 
            src="{{ asset('images/loan.png') }}" 
            alt="Loan Application" 
            class="h-20 w-auto object-contain"
        >
    </div>

    {{-- NOTIFIKASI ERROR / SUCCESS (Jika ada) --}}
    @if(session('error'))
        <div class="mx-auto mb-6 max-w-4xl rounded-xl bg-red-100 p-4 font-serif text-xs text-red-700 shadow-sm border border-red-200">
            {{ session('error') }}
        </div>
    @endif

    {{-- MAIN FORM PEMINJAMAN --}}
    <form action="{{ route('borrowings.store') }}" method="POST">
        @csrf

        {{-- MAIN CONTENT GRID --}}
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-12">

            {{-- LEFT COLUMN: SELECTED BOOKS --}}
            <div class="lg:col-span-7">
                <div class="rounded-2xl border border-[#7E97A6] bg-[#FFF8EF] p-6 shadow-sm">
                    {{-- CARD HEADER --}}
                    <div class="-mx-6 -mt-6 mb-6 flex items-center gap-2 rounded-t-2xl bg-[#7E97A6] px-6 py-3.5 text-white shadow-sm">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        <h2 class="font-serif text-base font-semibold tracking-wide">
                            Your Selected Books ({{ $carts->count() ?? 0 }})
                        </h2>
                    </div>

                    {{-- BOOK ITEM LIST --}}
                    <div class="space-y-4">
                        @forelse($carts as $item)
                            <div class="relative flex items-center gap-4 rounded-xl bg-[#F5EFE0] p-4 shadow-sm">
                                {{-- BOOK COVER --}}
                                <div class="h-24 w-16 shrink-0 overflow-hidden rounded bg-gray-200 shadow">
                                    @if(!empty($item->book->cover_image))
                                        <img src="{{ asset('cover_images/' . $item->book->cover_image) }}" alt="{{ $item->book->title ?? $item->book->name }}" class="h-full w-full object-cover">
                                    @else
                                        <div class="flex h-full w-full items-center justify-center text-[10px] text-gray-400">No Cover</div>
                                    @endif
                                </div>

                                {{-- BOOK DETAILS --}}
                                <div class="flex-1">
                                    <h3 class="font-serif text-sm font-bold text-[#111]">
                                        {{ $item->book->title ?? $item->book->name ?? 'Untitled' }}
                                    </h3>
                                    <p class="font-serif text-xs text-[#555]">
                                        {{ $item->book->author->name ?? $item->book->author ?? 'Unknown Author' }}
                                    </p>
                                    
                                    {{-- BADGE STOK / AVAILABILITY --}}
                                    @if(($item->book->stock ?? 0) > 0)
                                        <span class="mt-2 inline-flex items-center gap-1 rounded-full bg-[#82B366] px-2.5 py-0.5 text-[10px] font-medium text-white shadow-sm">
                                            ✓ available
                                        </span>
                                    @else
                                        <span class="mt-2 inline-flex items-center gap-1 rounded-full bg-red-500 px-2.5 py-0.5 text-[10px] font-medium text-white shadow-sm">
                                            ✕ out of stock
                                        </span>
                                    @endif
                                </div>

                                {{-- REMOVE BUTTON (Gunakan Form External agar tidak bentrok dengan Form Checkout) --}}
                                <button 
                                    type="submit" 
                                    form="delete-cart-{{ $item->id }}" 
                                    class="absolute top-3 right-3 flex h-6 w-6 items-center justify-center rounded-full bg-[#8CA3B0] text-xs font-bold text-white transition hover:bg-red-500"
                                >
                                    ✕
                                </button>
                            </div>
                        @empty
                            <div class="py-8 text-center font-serif text-sm text-gray-500">
                                Belum ada buku yang dipilih.
                            </div>
                        @endforelse
                    </div>

                    {{-- BUTTON ADD MORE BOOKS --}}
                    <div class="mt-6">
                        <a href="{{ route('users.index') }}" class="inline-flex items-center gap-2 rounded-full bg-[#7E97A6] px-5 py-2 font-serif text-xs font-semibold text-white shadow transition hover:opacity-90">
                            <span>+</span>
                            <span>Add more books</span>
                        </a>
                    </div>
                </div>
            </div>

            {{-- RIGHT COLUMN: PICKUP & SUMMARY --}}
            <div class="space-y-6 lg:col-span-5">

                {{-- PICKUP INFORMATION CARD --}}
                <div class="rounded-2xl border border-[#7E97A6] bg-[#FFF8EF] p-6 shadow-sm">
                    <div class="-mx-6 -mt-6 mb-5 flex items-center gap-2 rounded-t-2xl bg-[#7E97A6] px-6 py-3.5 text-white shadow-sm">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <h2 class="font-serif text-base font-semibold tracking-wide">
                            Pickup Information
                        </h2>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="mb-1 block font-serif text-xs text-[#555]">Pickup Location</label>
                            <div class="flex items-center justify-between rounded-xl border border-[#B0C0CC] bg-[#F5EFE0] p-3 shadow-sm">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-8 w-8 items-center justify-center rounded bg-[#7E97A6] text-white">
                                        🏢
                                    </div>
                                    <div>
                                        <p class="font-serif text-xs font-bold text-[#111]">OwlPost Library</p>
                                        <p class="font-serif text-[10px] text-[#666]">Mainhattan street 123</p>
                                    </div>
                                </div>
                                <button type="button" class="font-serif text-[10px] text-[#2B547E] underline hover:opacity-75">
                                    Change location
                                </button>
                            </div>
                        </div>

                        <div>
                            <label for="pickup_date" class="mb-1 block font-serif text-xs text-[#555]">Preferred Pickup Dates</label>
                            <input 
                                type="date" 
                                id="pickup_date" 
                                name="pickup_date" 
                                value="{{ date('Y-m-d') }}" 
                                required
                                class="w-full rounded-xl border border-[#B0C0CC] bg-[#F5EFE0] px-3 py-2 font-serif text-xs text-[#222] shadow-sm focus:outline-none"
                            >
                        </div>
                    </div>
                </div>

                {{-- LOAN SUMMARY CARD --}}
                <div class="rounded-2xl border border-[#7E97A6] bg-[#FFF8EF] p-6 shadow-sm">
                    <div class="-mx-6 -mt-6 mb-5 flex items-center gap-2 rounded-t-2xl bg-[#7E97A6] px-6 py-3.5 text-white shadow-sm">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        <h2 class="font-serif text-base font-semibold tracking-wide">
                            Loan Summary
                        </h2>
                    </div>

                    @php
                        $bookCount = $carts->count() ?? 0;
                        $loanDays = $bookCount * 7;
                    @endphp

                    <div class="space-y-3 font-serif text-xs text-[#222]">
                        <div class="flex justify-between">
                            <span>Books</span>
                            <span class="font-semibold">{{ $bookCount }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Loan Period</span>
                            <span class="font-semibold">
                                @if($loanDays > 0)
                                    {{ $loanDays }} days ({{ $bookCount }} {{ Str::plural('week', $bookCount) }})
                                @else
                                    0 days
                                @endif
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span>Pickup</span>
                            <span class="font-semibold text-green-700">Free</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Fees</span>
                            <span class="font-semibold">$0.00</span>
                        </div>

                        <div class="mt-4 flex items-center justify-between rounded-xl bg-[#7E97A6] px-4 py-2.5 font-bold text-white shadow-sm">
                            <span>Total</span>
                            <span>{{ $bookCount }} books</span>
                        </div>
                    </div>
                </div>

                {{-- CONFIRM LOAN BUTTON --}}
                <button 
                    type="submit" 
                    @if($bookCount === 0) disabled @endif
                    class="flex w-full items-center justify-center gap-2 rounded-2xl bg-[#003565] py-3.5 font-serif text-sm font-semibold text-white shadow-lg transition hover:bg-[#002548] active:scale-98 disabled:cursor-not-allowed disabled:opacity-50"
                >
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span>Confirm Loan</span>
                </button>

            </div>

        </div>
    </form>

    {{-- HIDDEN FORMS FOR DELETING CART ITEMS --}}
    @foreach($carts as $item)
        <form id="delete-cart-{{ $item->id }}" action="{{ route('cart.destroy', $item->id) }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    @endforeach

</div>
@endsection