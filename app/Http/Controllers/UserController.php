<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;

class UserController extends Controller
{
    public function index()
    {
        $title = "Sistem Perpustakaan Sekolah - Daftar Buku";

        $books = Book::with([
            'author',
            'genre',
            'category',
            'bookType'
        ])->get();

        return view('users.index', [
            'title' => $title,
            'books' => $books
        ]);
    }

    public function show(string $id)
    {
        $title = "Sistem Perpustakaan Sekolah - Detail Buku";

        $book = Book::with([
            'author',
            'genre',
            'category',
            'bookType'
        ])->findOrFail($id);

        return view('users.show', [
            'title' => $title,
            'book' => $book
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

        $user = User::findOrFail($id);

        return view('users.edit', [
            'title' => $title,
            'user' => $user
        ]);
    }

    public function store(Request $request)
    {
        return "Melakukan penambahan data pengguna";
    }

    public function update(Request $request, string $id)
    {
        return "Melakukan perubahan data pengguna";
    }

    public function destroy(string $id)
    {
        return "Menghapus data pengguna";
    }
}