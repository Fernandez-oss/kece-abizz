@extends('layouts.app')

@section('title', $title)

@section('content')

<div class="mb-6">

    <p class="text-[11px] uppercase tracking-[0.2em] text-[#A16207]">
        Peminjaman
    </p>

    <h1 class="mt-2 font-display text-3xl font-semibold text-[#16213A]">
        Keranjang Peminjaman
    </h1>

</div>

@if (session('success'))
    <div class="mb-6 border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="mb-6 border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-600">
        {{ session('error') }}
    </div>
@endif


@if ($carts->count() > 0)

    <div class="space-y-3">

        @foreach ($carts as $cart)

            <div class="flex items-center justify-between border border-[#E5E3DB] bg-white p-5">

                <div class="flex items-center gap-4">

                    <div class="h-20 w-14 bg-[#F7F6F1]">

                        @if ($cart->book->cover_image)

                            <img
                                src="{{ asset('cover_images/' . $cart->book->cover_image) }}"
                                alt="Cover {{ $cart->book->name }}"
                                class="h-full w-full object-cover">

                        @endif

                    </div>

                    <div>

                        <p class="text-sm font-medium text-[#16213A]">
                            {{ $cart->book->name }}
                        </p>

                        <p class="mt-1 text-xs text-gray-400">
                            Stok tersedia: {{ $cart->book->stock }}
                        </p>

                    </div>

                </div>


                <form
                    action="{{ route('cart.destroy', $cart->id) }}"
                    method="POST">

                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="text-sm text-red-500 hover:text-red-700">
                        Hapus
                    </button>

                </form>

            </div>

        @endforeach

    </div>


    <div class="mt-8 border border-[#E5E3DB] bg-white p-6">

        <form
            action="{{ route('borrowings.checkout') }}"
            method="POST">

            @csrf

            <label
                for="days"
                class="text-xs uppercase tracking-wider text-gray-400">
                Lama Peminjaman
            </label>

            <select
                name="days"
                id="days"
                required
                class="mt-2 block w-full border border-[#E5E3DB] bg-white px-4 py-3 text-sm text-[#16213A] outline-none focus:border-[#16213A]">

                <option value="7">7 hari</option>
                <option value="1">1 hari</option>
                <option value="2">2 hari</option>
                <option value="3">3 hari</option>
                <option value="4">4 hari</option>
                <option value="5">5 hari</option>
                <option value="6">6 hari</option>
                <option value="8">8 hari</option>
                <option value="9">9 hari</option>
                <option value="10">10 hari</option>
                <option value="11">11 hari</option>
                <option value="12">12 hari</option>
                <option value="13">13 hari</option>
                <option value="14">14 hari</option>

            </select>

            <p class="mt-2 text-xs text-gray-400">
                Maksimal lama peminjaman adalah 14 hari.
            </p>

            <button
                type="submit"
                class="mt-6 bg-[#16213A] px-6 py-3 text-sm font-medium text-white transition hover:bg-[#26324f]">
                Pinjam Semua
            </button>

        </form>

    </div>


@else

    <div class="border border-[#E5E3DB] bg-white px-6 py-12 text-center">

        <p class="text-sm text-gray-500">
            Keranjang masih kosong.
        </p>

    </div>

@endif

@endsection