<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookType;

class BookTypeController extends Controller
{
    public function index()
    {
        $bookTypes = BookType::all();

        return view('book_types.index', [
            'bookTypes' => $bookTypes,
        ]);
    }

    public function create()
    {
        $title = "Sistem Perpustakaan Sekolah - Tambah Tipe Buku";

        return view('book_types.create', [
            'title' => $title,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        BookType::create([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('book_types.index')
            ->with('success', 'Tipe buku berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $title = "Sistem Perpustakaan Sekolah - Detail Tipe Buku";

        $bookType = BookType::findOrFail($id);

        return view('book_types.show', [
            'title' => $title,
            'bookType' => $bookType,
        ]);
    }

    public function edit(string $id)
    {
        $title = "Sistem Perpustakaan Sekolah - Edit Tipe Buku";

        $bookType = BookType::findOrFail($id);

        return view('book_types.edit', [
            'title' => $title,
            'bookType' => $bookType,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $bookType = BookType::findOrFail($id);

        $bookType->update([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('book_types.show', $bookType->id)
            ->with('success', 'Tipe buku berhasil diubah.');
    }

    public function destroy(string $id)
    {
        $bookType = BookType::findOrFail($id);

        $bookType->delete();

        return redirect()
            ->route('book_types.index')
            ->with('success', 'Tipe buku berhasil dihapus.');
    }
}