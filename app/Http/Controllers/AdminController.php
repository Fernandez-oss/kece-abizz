<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $title = "Sistem Perpustakaan Sekolah - Daftar Pengguna";

        $users = User::all();

        return view('admins.index', [
            'title' => $title,
            'users' => $users
        ]);
    }
    public function show(string $id)
    {
        $title = "Sistem Sekolah - Detail Admin";

        return view('admins.show', [
            'title' => $title,
        ]);
    }

    public function create()
    {
        $title = "Sistem Sekolah - Tambah Admin";

        return view('admins.create', [
            'title' => $title,
        ]);
    }


    public function edit(string $id)
    {
        $title = "Sistem Sekolah - Ubah Admin";

        return view('admins.edit', [
            'title' => $title,
        ]);
    }

    public function store()
    {
        return "Melakukan penambahan data Admin";
    }

    public function update(string $id)
    {
        return "Melakukan perubahan data Admin";
    }

    public function destroy(string $id)
    {
        return "Menghapus data Admin";
    }
}
