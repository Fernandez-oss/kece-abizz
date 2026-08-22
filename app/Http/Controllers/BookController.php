<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $title = "Sistem Perpustakaan Sekolah - Daftar buku";
        $books = [
            [
                'id' => 1,
                'isbn' => '978-0-123456-78-9',
                'title' => 'Pemrograman PHP',
                'author' => 'John Doe',
                'publisher' => 'Penerbit ABC',
            ],
            [
                'id' => 2,
                'isbn' => '978-0-987654-32-1',
                'title' => 'Pemrograman JavaScript',
                'author' => 'Jane Smith',
                'publisher' => 'Penerbit XYZ',
            ]
        ];

        return view('books.index', [
            'title' => $title,
            'books' => $books
        ]);
    }

    public function show(string $id)
    {
        $title = "Sistem Sekolah - Detail buku";
        
        return view('books.show', [
            'title' => $title,
        ]);
    }

    public function create()
    {
        $title = "Sistem Sekolah - Tambah buku";
        
        return view('books.create', [
            'title' => $title,
        ]);
    }


    public function edit(string $id)
    {
        $title = "Sistem Sekolah - Ubah buku";
        
        return view('books.edit', [
            'title' => $title,
        ]);
    }

    public function store()
    {
        return "Melakukan penambahan data buku";
    }

    public function update(string $id)
    {
        return "Melakukan perubahan data buku";
    }

    public function destroy(string $id)
    {
        return "Menghapus data buku";
    }
}