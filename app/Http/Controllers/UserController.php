<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $title = "Sistem Perpustakaan Sekolah - Daftar Pengguna";

        $users = User::where('id', 1)->get();

        return view('users.index', [
            'title' => $title,
            'users' => $users
        ]);
    }

    public function show(string $id)
    {
        $title = "Sistem Sekolah - Detail Pengguna";

        return view('users.show', [
            'title' => $title,
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

        return view('users.edit', [
            'title' => $title,
        ]);
    }

    public function store()
    {
        return "Melakukan penambahan data pengguna";
    }

    public function update(string $id)
    {
        return "Melakukan perubahan data pengguna";
    }

    public function destroy(string $id)
    {
        return "Menghapus data pengguna";
    }
}
