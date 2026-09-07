<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $title = "Sistem Perpustakaan Sekolah - Daftar Pengguna";

        // Ambil semua data user
        $users = User::all();

        return view('users.index', [
            'title' => $title,
            'users' => $users
        ]);
    }

    public function show(string $id)
    {
        $title = "Sistem Sekolah - Detail Pengguna";

        // Ambil user berdasarkan ID yang dipilih
        $user = User::findOrFail($id);

        return view('users.show', [
            'title' => $title,
            'user' => $user
        ]);
    }

    public function create()
    {
        $title = "Sistem Sekolah - Tambah Pengguna";

        return view('users.create', [
            'title' => $title,
        ]);
    }

    public function edit(string $id)
    {
        $title = "Sistem Sekolah - Ubah Pengguna";

        // Ambil user yang mau diedit
        $user = User::findOrFail($id);

        return view('users.edit', [
            'title' => $title,
            'user' => $user
        ]);
    }

    public function store(Request $request)
    {
        // Nanti isi dengan proses simpan user
        return "Melakukan penambahan data pengguna";
    }

    public function update(Request $request, string $id)
    {
        // Nanti isi dengan proses update user
        return "Melakukan perubahan data pengguna";
    }

    public function destroy(string $id)
    {
        // Nanti isi dengan proses hapus user
        return "Menghapus data pengguna";
    }
}