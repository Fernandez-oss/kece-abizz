<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller

{
    public function index()
    {
        $title = "Sistem Perpustakaan Sekolah - Publisher";

        $publishers = Publisher::latest()->get();

        return view('publishers.index', [
            'title' => $title,
            'publishers' => $publishers,
        ]);
    }

    public function show(string $id)
    {
        $publisher = Publisher::findOrFail($id);

        $title = "Sistem Perpustakaan Sekolah - Detail Publisher";

        return view('publishers.show', [
            'title' => $title,
            'publisher' => $publisher,
        ]);
    }

    public function create()
    {
        $title = "Sistem Perpustakaan Sekolah - Tambah Publisher";

        return view('publishers.create', [
            'title' => $title,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Publisher::create([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('publishers.index')
            ->with('success', 'Publisher berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $publisher = Publisher::findOrFail($id);

        $title = "Sistem Perpustakaan Sekolah - Edit Publisher";

        return view('publishers.edit', [
            'title' => $title,
            'publisher' => $publisher,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $publisher = Publisher::findOrFail($id);

        $publisher->update([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('publishers.index')
            ->with('success', 'Publisher berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $publisher = Publisher::findOrFail($id);

        $publisher->delete();

        return redirect()
            ->route('publishers.index')
            ->with('success', 'Publisher berhasil dihapus.');
    }
}
