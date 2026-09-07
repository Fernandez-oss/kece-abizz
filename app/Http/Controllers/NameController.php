<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NameController extends Controller
{
    public function create()
    {
        return view('name');
    }

    public function store(Request $request)
    {
        // 1. Validasi input nama dan gambar
        $request->validate([
            'name' => 'required|string|max:255',
            'profile_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // 2. Ambil data user yang sedang aktif login dari database berdasarkan ID
        $user = User::findOrFail(Auth::id());

        // 3. Masukkan nama
        $user->name = $request->name;

        // 4. Olah dan simpan foto profil
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filename = time() . '_' . $file->getClientOriginalName();

            // Simpan foto ke folder public/profile_images
            $file->move(public_path('profile_images'), $filename);

            $user->profile_image = $filename;
        }

        // 5. Simpan perubahan ke database (bebas dari garis merah VS Code)
        $user->save();

        // 6. Arahkan ke halaman login
        return redirect()->route('login')->with('success', 'Profil berhasil dibuat! Silakan login.');
    }
}