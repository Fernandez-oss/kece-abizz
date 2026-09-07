<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    public function index()
    {
        $title = "Sistem Perpustakaan Sekolah - Daftar Author";

        $authors = Author::all();

        return view('authors.index', [
            'title' => $title,
            'authors' => $authors
        ]);
    }

    public function create()
    {
        $title = "Sistem Perpustakaan Sekolah - Tambah Author";

        return view('authors.create', [
            'title' => $title
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Author::create([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('authors.index')
            ->with('success', 'Author berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $title = "Sistem Perpustakaan Sekolah - Detail Author";

        $author = Author::findOrFail($id);

        return view('authors.show', [
            'title' => $title,
            'author' => $author
        ]);
    }

    public function edit(string $id)
    {
        $title = "Sistem Perpustakaan Sekolah - Edit Author";

        $author = Author::findOrFail($id);

        return view('authors.edit', [
            'title' => $title,
            'author' => $author
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $author = Author::findOrFail($id);

        $author->update([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('authors.show', $author->id)
            ->with('success', 'Author berhasil diubah.');
    }

    public function destroy(string $id)
    {
        $author = Author::findOrFail($id);

        $author->delete();

        return redirect()
            ->route('authors.index')
            ->with('success', 'Author berhasil dihapus.');
    }
}