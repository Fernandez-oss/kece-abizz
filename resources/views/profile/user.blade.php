@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <div class="flex items-center justify-between border-b border-[#E5E3DB] pb-5">
        <div>
            <p class="text-[11px] uppercase tracking-[0.2em] text-[#A16207]">Member Account</p>
            <h1 class="font-display text-3xl font-semibold text-[#16213A]">My Profile</h1>
        </div>
        <span class="px-3 py-1 bg-amber-100 text-[#A16207] text-xs font-semibold rounded-full uppercase">
            {{ Auth::user()->role ?? 'User' }}
        </span>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Account Information Form --}}
    <div class="bg-white border border-[#E5E3DB] p-6 shadow-sm">
        <h2 class="text-lg font-semibold text-[#16213A] mb-4">Account Information</h2>
        
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Profile Picture Upload -->
            <div class="flex flex-col items-center sm:flex-row sm:items-center gap-4 mb-6 pb-4 border-b border-gray-100">
                <div class="relative">
                    <img id="avatar-preview" 
                         src="{{ $user->profile_image ? asset('profile_images/' . $user->profile_image) : Vite::asset('resources/img/profile.png') }}" 
                         alt="Profile Picture" 
                         class="w-24 h-24 rounded-full object-cover border-2 border-[#16213A]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Profile Picture</label>
                    <input type="file" 
                           name="profile_image" 
                           id="profile_image" 
                           accept="image/*" 
                           onchange="previewImage(event)" 
                           class="text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-[#16213A] file:text-white hover:file:bg-[#26324f]">
                    <p class="text-[11px] text-gray-400 mt-1">Allowed formats: JPG, JPEG, PNG. Max size: 2MB</p>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Full Name / Username</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-[#16213A]">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-[#16213A]">
            </div>

            <button type="submit" class="bg-[#16213A] text-white px-5 py-2 text-sm font-medium hover:bg-[#26324f]">
                Save Changes
            </button>
        </form>
    </div>

    {{-- Password Update Form --}}
    <div class="bg-white border border-[#E5E3DB] p-6 shadow-sm">
        <h2 class="text-lg font-semibold text-[#16213A] mb-4">Change Password</h2>
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

<!-- Script Image Preview -->
<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('avatar-preview');
            output.src = reader.result;
        };
        if(event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        }
    }
</script>
@endsection