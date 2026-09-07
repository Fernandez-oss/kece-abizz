@extends('layouts.app')

@section('title', $title)

@section('content')


<div class="mb-8 flex items-end justify-between border-b border-[#E5E3DB] pb-5">
    <div>
        <p class="mb-1 text-[11px] uppercase tracking-[0.2em] text-[#A16207]">Tahun Ajaran 2025/2026</p>
        <h1 class="font-display text-3xl font-semibold text-[#16213A]">Daftar Pengguna</h1>
    </div>
</div>

<div class="border border-[#E5E3DB] bg-white">
    <table class="w-full text-left text-sm">
        <thead>
            <tr class="border-b border-[#16213A] text-[11px] uppercase tracking-[0.15em] text-[#16213A]">
                <th class="w-14 px-5 py-3.5 font-semibold">No.</th>
                <th class="px-5 py-3.5 font-semibold">Foto</th>
                <th class="px-5 py-3.5 font-semibold">Nama</th>
                <th class="px-5 py-3.5 font-semibold">Nomor Telepon</th>
                <th class="px-5 py-3.5 text-right font-semibold">Tindakan</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
            <tr class="border-b border-[#EFEDE6] hover:bg-[#FAF9F5]">

                <td class="px-5 py-4 font-display text-lg text-[#A16207]">
                    {{ $loop->iteration }}
                </td>

                <!-- FOTO PROFIL -->
                <td class="px-5 py-4">
                    @if ($user->profile_image)
                    <img
                        src="{{ asset('profile_images/' . $user->profile_image) }}"
                        alt="Foto {{ $user->name }}"
                        class="w-16 h-16 object-cover border">
                    @else
                    <div class="w-16 h-16 border flex items-center justify-center text-xs text-gray-500">
                        Tidak ada foto
                    </div>
                    @endif
                </td>

                <td class="px-5 py-4 font-medium text-[#16213A]">
                    {{ $user->name }}
                </td>

                <td class="px-5 py-4">
                    {{ $user->phone_number }}
                </td>

                <td class="px-5 py-4">
                    <div class="flex justify-end gap-4 text-xs font-medium">
                        <a href="{{ route('users.show', ['id' => $user->id]) }}"
                            class="text-[#16213A] hover:text-[#A16207]">
                            Lihat
                        </a>

                        <a href="{{ route('users.edit', ['id' => $user->id]) }}"
                            class="text-[#16213A] hover:text-[#A16207]">
                            Ubah
                        </a>

                        <form
                            action="{{ route('users.destroy', ['id' => $user->id]) }}"
                            method="POST"
                            onsubmit="return confirm('Hapus data pengguna ini?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="text-red-700 hover:text-red-900">
                                Hapus
                            </button>
                        </form>
                    </div>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection