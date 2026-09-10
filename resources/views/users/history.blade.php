@extends('layouts.app')

@section('title', $title ?? 'Riwayat Peminjaman')

@section('content')
<div class="min-h-screen bg-[#FFF2E0] p-6 text-[#222]">
    <div class="mx-auto max-w-5xl">
        {{-- HEADER SECTION --}}
        <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="font-serif text-2xl font-bold text-[#003565]">History</h1>
                <p class="mt-1 font-serif text-sm text-[#666]">Track your borrowing activity</p>
            </div>
        </div>

        {{-- ALERT MESSAGES --}}
        @if(session('success'))
            <div class="mb-4 rounded-xl border border-green-200 bg-green-100 p-4 font-serif text-xs text-green-700 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 rounded-xl border border-red-200 bg-red-100 p-4 font-serif text-xs text-red-700 shadow-sm">
                {{ session('error') }}
            </div>
        @endif

        {{-- SEARCH BAR --}}
        <div class="mx-auto mb-8 max-w-xl">
            <form action="{{ route('borrowings.user.index') }}" method="GET" class="relative">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}"
                    placeholder="Search by book title..." 
                    class="w-full rounded-full border border-[#7E97A6] bg-[#FFF8EF] py-2.5 pl-5 pr-10 font-serif text-sm text-[#111] placeholder-gray-400 focus:border-[#003565] focus:outline-none shadow-sm"
                >
                <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-[#003565]">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </button>
            </form>
        </div>

        {{-- BORROWING LIST --}}
        <div class="overflow-hidden rounded-2xl border border-[#7E97A6] bg-[#FFF8EF] p-6 shadow-sm">
            <div class="space-y-4">
                @forelse($borrowings as $item)
                    <div class="flex items-center justify-between rounded-xl bg-[#F5EFE0] p-4 shadow-sm">
                        <div class="flex items-center gap-4">
                            <div class="h-16 w-12 shrink-0 overflow-hidden rounded bg-gray-200">
                                @if(!empty($item->book->cover_image))
                                    <img src="{{ asset('cover_images/' . $item->book->cover_image) }}" alt="Cover" class="h-full w-full object-cover">
                                @else
                                    <div class="flex h-full w-full items-center justify-center text-[10px] text-gray-400">No Cover</div>
                                @endif
                            </div>
                            <div>
                                <h3 class="font-serif text-sm font-bold text-[#111]">{{ $item->book->title ?? 'Buku Tidak Ditemukan' }}</h3>
                                <p class="font-serif text-xs text-[#555]">
                                    Dipinjam: {{ $item->borrowed_at ? \Carbon\Carbon::parse($item->borrowed_at)->format('d M Y') : '-' }}
                                </p>
                                <p class="font-serif text-xs text-[#555]">
                                    Jatuh Tempo: {{ $item->due_date ? \Carbon\Carbon::parse($item->due_date)->format('d M Y') : '-' }}
                                </p>
                            </div>
                        </div>

                        <div>
                            @if($item->status === 'borrowed')
                                <form action="{{ route('borrowings.return', $item->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="rounded-lg bg-[#003565] px-4 py-2 font-serif text-xs text-white hover:bg-[#002548] transition">
                                        Kembalikan Buku
                                    </button>
                                </form>
                            @elseif($item->status === 'return_requested')
                                <span class="rounded-full bg-yellow-500 px-3 py-1 font-serif text-[10px] text-white">
                                    Menunggu Konfirmasi
                                </span>
                            @else
                                <span class="rounded-full bg-green-600 px-3 py-1 font-serif text-[10px] text-white">
                                    Dikembalikan
                                </span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="py-8 text-center font-serif text-sm text-gray-500">
                        Belum ada riwayat peminjaman buku.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection