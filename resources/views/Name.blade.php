<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Profile - OwlPost</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#FFF2E0] h-screen flex overflow-hidden" style="font-family: 'Times New Roman', Times, serif;">

    <!-- Left Banner Header -->
    <header class="flex w-84.5 h-screen flex-col text-white overflow-hidden">
        <img
            src="{{ Vite::asset('resources/img/login-regist.png') }}"
            alt="Login Banner"
            class="w-full h-full object-cover">
    </header>

    <!-- Main Content -->
    <main class="flex-1 h-screen flex items-center justify-center p-6">
        <div class="bg-[#FFF2E0] w-full max-w-2xl flex flex-col items-center">

            <!-- Top Right Logo -->
            <div class="fixed top-4 right-4 z-10">
                <img
                    src="{{ Vite::asset('resources/img/logo.png') }}"
                    alt="OwlPost Logo"
                    class="w-30 h-30 object-contain">
            </div>

            <!-- Title -->
            <h1 class="text-3xl font-bold text-center mb-2">
                Welcome to OwlPost!
            </h1>

            <!-- Description -->
            <p class="text-base text-center mb-6 text-gray-700 whitespace-nowrap">
                Create your profile and make your reading journey truly your own.
            </p>

            <!-- Error Notification -->
            @if ($errors->any())
                <div class="mb-4 text-red-500 text-sm text-center">
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- Profile Setup Form -->
            <form
                action="{{ route('name.store') }}"
                method="POST"
                enctype="multipart/form-data"
                class="w-full max-w-md">

                @csrf

                <!-- Profile Picture Upload -->
                <div class="mb-6 flex justify-center">
                    <input
                        type="file"
                        id="profile_image"
                        name="profile_image"
                        accept="image/*"
                        class="hidden"
                        onchange="previewImage(event)"
                        required>

                    <label for="profile_image" class="cursor-pointer">
                        <img
                            id="avatar-preview"
                            src="{{ Vite::asset('resources/img/profile.png') }}"
                            alt="Add Profile Picture"
                            class="w-32 h-32 rounded-full object-cover border-2 border-[#003665] hover:opacity-80 transition">
                    </label>
                </div>

                <!-- Full Name Input -->
                <div class="mb-6">
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Enter your full name"
                        class="w-full border-0 border-b border-gray-400 rounded-none px-0 py-2 text-lg bg-transparent focus:outline-none focus:ring-0 focus:border-[#003665]"
                        required>
                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    class="w-full text-lg bg-[#003665] text-white py-3 rounded-md hover:bg-[#00294d] transition">
                    Save Profile
                </button>

            </form>

        </div>
    </main>

    <!-- Image Preview Script -->
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

</body>
</html>