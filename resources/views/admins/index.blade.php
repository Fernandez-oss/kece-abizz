@extends('layouts.app')

@section('title', $title)

@section('content')


<div class="mb-8 flex items-end justify-between border-b border-[#E5E3DB] pb-5">
    <div>
        <p class="mb-1 text-[11px] uppercase tracking-[0.2em] text-[#A16207]">Academic Year 2025/2026</p>
        <h1 class="font-display text-3xl font-semibold text-[#16213A]">User List</h1>
    </div>
</div>

<div class="border border-[#E5E3DB] bg-white">
    <table class="w-full text-left text-sm">
        <thead>
            <tr class="border-b border-[#16213A] text-[11px] uppercase tracking-[0.15em] text-[#16213A]">
                <th class="w-14 px-5 py-3.5 font-semibold">No.</th>
                <th class="px-5 py-3.5 font-semibold">Photo</th>
                <th class="px-5 py-3.5 font-semibold">Name</th>
                <th class="px-5 py-3.5 font-semibold">Phone Number</th>
                <th class="px-5 py-3.5 text-right font-semibold">Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
            <tr class="border-b border-[#EFEDE6] hover:bg-[#FAF9F5]">

                <td class="px-5 py-4 font-display text-lg text-[#A16207]">
                    {{ $loop->iteration }}
                </td>

                <!-- PROFILE PHOTO -->
                <td class="px-5 py-4">
                    @if ($user->profile_image)
                    <img
                        src="{{ asset('profile_images/' . $user->profile_image) }}"
                        alt="Photo of {{ $user->name }}"
                        class="w-16 h-16 object-cover border">
                    @else
                    <div class="w-16 h-16 border flex items-center justify-center text-xs text-gray-500">
                        No photo
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
                            View
                        </a>

                        <a href="{{ route('users.edit', ['id' => $user->id]) }}"
                            class="text-[#16213A] hover:text-[#A16207]">
                            Edit
                        </a>

                        <form
                            action="{{ route('users.destroy', ['id' => $user->id]) }}"
                            method="POST"
                            onsubmit="return confirm('Delete this user?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="text-red-700 hover:text-red-900">
                                Delete
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