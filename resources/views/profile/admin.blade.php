@extends('layouts.app')

@section('title', 'Administrator Profile')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <div class="flex items-center justify-between border-b border-[#E5E3DB] pb-5">
        <div>
            <p class="text-[11px] uppercase tracking-[0.2em] text-[#A16207]">Full Access Granted</p>
            <h1 class="font-display text-3xl font-semibold text-[#16213A]">Administrator Profile</h1>
        </div>
        <span class="px-3 py-1 bg-red-100 text-red-700 text-xs font-bold rounded-full uppercase tracking-wider">
            Admin
        </span>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- ADMIN ACCOUNT SETTINGS --}}
    <div class="bg-white border border-[#E5E3DB] p-6 shadow-sm">
        <h2 class="text-lg font-semibold text-[#16213A] mb-4">Admin Account Settings</h2>
        <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Admin Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-[#16213A]">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Admin Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-[#16213A]">
            </div>

            <button type="submit" class="bg-[#16213A] text-white px-5 py-2 text-sm font-medium hover:bg-[#26324f]">
                Update Admin Profile
            </button>
        </form>
    </div>

    {{-- ADMIN ACCOUNT SECURITY --}}
    <div class="bg-white border border-[#E5E3DB] p-6 shadow-sm">
        <h2 class="text-lg font-semibold text-[#16213A] mb-4">Account Security</h2>
        <form action="{{ route('profile.update-password') }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
                <input type="password" name="current_password" class="w-full border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-[#16213A]">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                <input type="password" name="password" class="w-full border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-[#16213A]">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                <input type="password" name="password_confirmation" class="w-full border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-[#16213A]">
            </div>

            <button type="submit" class="bg-[#A16207] text-white px-5 py-2 text-sm font-medium hover:bg-[#854d0e]">
                Update Password
            </button>
        </form>
    </div>

</div>
@endsection