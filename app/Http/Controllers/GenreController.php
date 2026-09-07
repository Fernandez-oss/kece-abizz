<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all();

        return view('genres.index', [
            'genres' => $genres,
        ]);
    }

    public function create()
    {
        $title = "Sistem Perpustakaan Sekolah - Tambah Genre";

        return view('genres.create', [
            'title' => $title,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Genre::create([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('genres.index')
            ->with('success', 'Genre berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $title = "Sistem Perpustakaan Sekolah - Detail Genre";

        $genre = Genre::findOrFail($id);

        return view('genres.show', [
            'title' => $title,
            'genre' => $genre,
        ]);
    }

    public function edit(string $id)
    {
        $title = "Sistem Perpustakaan Sekolah - Edit Genre";

        $genre = Genre::findOrFail($id);

        return view('genres.edit', [
            'title' => $title,
            'genre' => $genre,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $genre = Genre::findOrFail($id);

        $genre->update([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('genres.show', $genre->id)
            ->with('success', 'Genre berhasil diubah.');
    }

    public function destroy(string $id)
    {
        $genre = Genre::findOrFail($id);

        $genre->delete();

        return redirect()
            ->route('genres.index')
            ->with('success', 'Genre berhasil dihapus.');
    }
}