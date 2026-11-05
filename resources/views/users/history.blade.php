
@extends('layouts.app')

@section('title', $title ?? 'Riwayat Peminjaman')

@section('content')
<div class="min-h-screen bg-[#FFF2E0] p-6 text-[#222]">
    <div class="mx-auto max-w-5xl">

        {{-- HEADER SECTION --}}
        <div class="mb-8 flex justify-center">
            <img
                src="{{ asset('images/History.png') }}"
                alt="History"
                class="h-20 w-auto object-contain"
            >
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

        @if($errors->any())
            <div class="mb-4 rounded-xl border border-red-200 bg-red-100 p-4 font-serif text-xs text-red-700 shadow-sm">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
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
                    class="w-full rounded-full border border-[#7E97A6] bg-[#FFF8EF] py-2.5 pl-5 pr-10 font-serif text-sm text-[#111] placeholder-gray-400 shadow-sm focus:border-[#003565] focus:outline-none"
                >

                <button
                    type="submit"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-[#003565]"
                >
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </button>
            </form>
        </div>

        {{-- BORROWING LIST --}}
        <div class="overflow-hidden rounded-2xl border border-[#7E97A6] bg-[#FFF8EF] p-6 shadow-sm">

            @php
                $selectableCount = $borrowings->where('status', 'borrowed')->count();
            @endphp

            {{-- BULK RETURN FORM --}}
            <form
                id="bulk-return-form"
                action="{{ route('borrowings.return.bulk') }}"
                method="POST"
            >
                @csrf

                {{-- SELECT ALL --}}
                @if($selectableCount > 0)
                    <div class="mb-5 flex flex-wrap items-center justify-between gap-3 border-b border-[#D5C8B5] pb-4">
                        <label class="flex cursor-pointer items-center gap-2 font-serif text-xs font-semibold text-[#333]">
                            <input
                                type="checkbox"
                                id="select-all"
                                class="h-4 w-4 cursor-pointer rounded border-[#7E97A6] accent-[#003565]"
                            >
                            Select All
                        </label>

                        <span class="font-serif text-xs text-[#666]">
                            <span id="selected-count">0</span> selected
                        </span>
                    </div>
                @endif

                <div class="space-y-4">

                    @forelse($borrowings as $item)
                        <div class="flex items-center justify-between gap-4 rounded-xl bg-[#F5EFE0] p-4 shadow-sm">

                            {{-- BOOK INFORMATION --}}
                            <div class="flex min-w-0 items-center gap-4">

                                {{-- CHECKBOX --}}
                                @if($item->status === 'borrowed')
                                    <input
                                        type="checkbox"
                                        name="borrowing_ids[]"
                                        value="{{ $item->id }}"
                                        class="book-checkbox h-4 w-4 shrink-0 cursor-pointer rounded border-[#7E97A6] accent-[#003565]"
                                    >
                                @else
                                    <div class="h-4 w-4 shrink-0"></div>
                                @endif

                                {{-- BOOK COVER --}}
                                <div class="h-16 w-12 shrink-0 overflow-hidden rounded bg-gray-200">
                                    @if(!empty($item->book->cover_image))
                                        <img
                                            src="{{ asset('cover_images/' . $item->book->cover_image) }}"
                                            alt="Cover"
                                            class="h-full w-full object-cover"
                                        >
                                    @else
                                        <div class="flex h-full w-full items-center justify-center text-[10px] text-gray-400">
                                            No Cover
                                        </div>
                                    @endif
                                </div>

                                {{-- BOOK DETAILS --}}
                                <div class="min-w-0">
                                    <h3 class="break-words font-serif text-sm font-bold text-[#111]">
                                        {{ $item->book->title ?? 'Buku Tidak Ditemukan' }}
                                    </h3>

                                    <p class="font-serif text-xs text-[#555]">
                                        Dipinjam:
                                        {{ $item->borrowed_at ? \Carbon\Carbon::parse($item->borrowed_at)->format('d M Y') : '-' }}
                                    </p>

                                    <p class="font-serif text-xs text-[#555]">
                                        Jatuh Tempo:
                                        {{ $item->due_date ? \Carbon\Carbon::parse($item->due_date)->format('d M Y') : '-' }}
                                    </p>
                                </div>
                            </div>

                            {{-- STATUS --}}
                            <div class="shrink-0">
                                @if($item->status === 'borrowed')
                                    <span class="rounded-full bg-[#003565] px-3 py-1 font-serif text-[10px] text-white">
                                        Dipinjam
                                    </span>
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

                {{-- BULK RETURN BUTTON --}}
                @if($selectableCount > 0)
                    <div class="mt-6 border-t border-[#D5C8B5] pt-5">
                        <button
                            type="submit"
                            id="return-selected-button"
                            disabled
                            class="flex w-full items-center justify-center gap-2 rounded-xl bg-[#003565] px-5 py-3 font-serif text-sm font-semibold text-white shadow transition hover:bg-[#002548] disabled:cursor-not-allowed disabled:opacity-40"
                        >
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>

                            <span id="return-button-text">Return Selected Books</span>
                        </button>
                    </div>
                @endif

            </form>
        </div>
    </div>
</div>

{{-- SELECT ALL & COUNT SCRIPT --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectAll = document.getElementById('select-all');
        const checkboxes = document.querySelectorAll('.book-checkbox');
        const selectedCount = document.getElementById('selected-count');
        const returnButton = document.getElementById('return-selected-button');
        const returnButtonText = document.getElementById('return-button-text');
        const returnForm = document.getElementById('bulk-return-form');

        function updateSelection() {
            const checkedBoxes = document.querySelectorAll('.book-checkbox:checked');
            const count = checkedBoxes.length;

            if (selectedCount) {
                selectedCount.textContent = count;
            }

            if (returnButton) {
                returnButton.disabled = count === 0;
            }

            if (returnButtonText) {
                returnButtonText.textContent = count > 0
                    ? `Return Selected Books (${count})`
                    : 'Return Selected Books';
            }

            if (selectAll) {
                selectAll.checked = checkboxes.length > 0 && count === checkboxes.length;
                selectAll.indeterminate = count > 0 && count < checkboxes.length;
            }
        }

        if (selectAll) {
            selectAll.addEventListener('change', function () {
                checkboxes.forEach(function (checkbox) {
                    checkbox.checked = selectAll.checked;
                });

                updateSelection();
            });
        }

        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', updateSelection);
        });

        if (returnForm) {
            returnForm.addEventListener('submit', function (event) {
                const count = document.querySelectorAll('.book-checkbox:checked').length;

                if (count === 0) {
                    event.preventDefault();
                    return;
                }

                if (!confirm(`Ajukan pengembalian ${count} buku yang dipilih?`)) {
                    event.preventDefault();
                }
            });
        }

        updateSelection();
    });
</script>
@endsection
