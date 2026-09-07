<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('categories.index', [
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        $title = "Sistem Perpustakaan Sekolah - Tambah Category";

        return view('categories.create', [
            'title' => $title,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $title = "Sistem Perpustakaan Sekolah - Detail Category";

        $category = Category::findOrFail($id);

        return view('categories.show', [
            'title' => $title,
            'category' => $category,
        ]);
    }

    public function edit(string $id)
    {
        $title = "Sistem Perpustakaan Sekolah - Edit Category";

        $category = Category::findOrFail($id);

        return view('categories.edit', [
            'title' => $title,
            'category' => $category,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id);

        $category->update([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('categories.show', $category->id)
            ->with('success', 'Category berhasil diubah.');
    }

    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category berhasil dihapus.');
    }
}