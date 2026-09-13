<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Menampilkan Tampilan Homepage User
     */
    public function userIndex()
    {
        // Mengambil buku terbaru agar tampilannya sama persis seperti di foto kedua
        $latestBooks = Book::with(['author', 'category'])->latest()->take(5)->get();

        return view('users.index', [
            'title'         => 'Home',
            'newArrivals'   => $latestBooks,
            'mostBorrowed'  => $latestBooks,
            'favoriteBooks' => $latestBooks,
        ]);
    }

    /**
     * Menampilkan Halaman Pencarian Buku (Search Page)
     */
    public function search(Request $request)
    {
        // Menerima input search baik menggunakan parameter 'q' maupun 'query'
        $query = $request->input('q') ?? $request->input('query');

        $books = Book::with(['author', 'category', 'genres'])
            ->when($query, function ($q) use ($query) {
                return $q->where('name', 'LIKE', "%{$query}%")
                    ->orWhereHas('author', function ($authorQuery) use ($query) {
                        $authorQuery->where('name', 'LIKE', "%{$query}%");
                    })
                    ->orWhereHas('category', function ($categoryQuery) use ($query) {
                        $categoryQuery->where('name', 'LIKE', "%{$query}%");
                    });
            })
            ->paginate(12);

        return view('users.search', compact('books', 'query'));
    }

    /**
     * Menampilkan Daftar Buku untuk Admin (CRUD Index)
     */
    public function index()
    {
        $books = Book::with(['author', 'category'])->latest()->paginate(10);
        return view('books.index', compact('books'));
    }

    /**
     * Form Tambah Buku Baru (Admin)
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Menyimpan Buku Baru ke Database (Admin)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'author_id'    => 'nullable|exists:authors,id',
            'category_id'  => 'nullable|exists:categories,id',
            'description'  => 'nullable|string',
            'cover_image'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('cover_image')) {
            $imageName = time() . '.' . $request->cover_image->extension();
            $request->cover_image->move(public_path('cover_images'), $imageName);
            $validated['cover_image'] = $imageName;
        }

        Book::create($validated);

        return redirect()->route('books.index')->with('success', 'Book created successfully!');
    }

    /**
     * Menampilkan Detail Buku (User & Admin)
     */
    public function show($id)
    {
        $book = Book::with(['author', 'category', 'genres', 'publishers', 'bookTypes'])->findOrFail($id);
        return view('users.show', compact('book'));
    }

    /**
     * Form Edit Buku (Admin)
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('books.edit', compact('book'));
    }

    /**
     * Mengubah Data Buku di Database (Admin)
     */
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'author_id'    => 'nullable|exists:authors,id',
            'category_id'  => 'nullable|exists:categories,id',
            'description'  => 'nullable|string',
            'cover_image'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('cover_image')) {
            $imageName = time() . '.' . $request->cover_image->extension();
            $request->cover_image->move(public_path('cover_images'), $imageName);
            $validated['cover_image'] = $imageName;
        }

        $book->update($validated);

        return redirect()->route('books.index')->with('success', 'Book updated successfully!');
    }

    /**
     * Menghapus Buku dari Database (Admin)
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully!');
    }
}