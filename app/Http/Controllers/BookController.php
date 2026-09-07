<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;
use App\Models\Genre;
use App\Models\Category;
use App\Models\BookType;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();

        return view('books.index', compact('books'));
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);

        return view('books.show', compact('book'));
    }

    public function create()
    {
        $authors = Author::all();
        $genres = Genre::all();
        $categories = Category::all();
        $bookTypes = BookType::all();

        return view('books.create', compact(
            'authors',
            'genres',
            'categories',
            'bookTypes'
        ));
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);

        $authors = Author::all();
        $genres = Genre::all();
        $categories = Category::all();
        $bookTypes = BookType::all();

        return view('books.edit', compact(
            'book',
            'authors',
            'genres',
            'categories',
            'bookTypes'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'genre_id' => 'required|exists:genres,id',
            'category_id' => 'required|exists:categories,id',
            'book_type_id' => 'required|exists:book_types,id',
            'cover_image' => 'required|image|mimes:jpg,jpeg,png,webp,jfif|max:2048',
            'year' => 'required|integer',
            'stock' => 'required|integer|min:0',
            'description' => 'required|string',
        ]);

        $file = $request->file('cover_image');
        $filename = time() . '_' . $file->getClientOriginalName();

        $file->move(public_path('cover_images'), $filename);

        Book::create([
            'name' => $request->name,
            'author_id' => $request->author_id,
            'genre_id' => $request->genre_id,
            'category_id' => $request->category_id,
            'book_type_id' => $request->book_type_id,
            'cover_image' => $filename,
            'year' => $request->year,
            'stock' => $request->stock,
            'description' => $request->description,
        ]);

        return redirect()
            ->route('books.index')
            ->with('success', 'Buku berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'genre_id' => 'required|exists:genres,id',
            'category_id' => 'required|exists:categories,id',
            'book_type_id' => 'required|exists:book_types,id',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp,jfif|max:2048',
            'year' => 'required|integer',
            'stock' => 'required|integer|min:0',
            'description' => 'required|string',
        ]);

        $book->name = $request->name;
        $book->author_id = $request->author_id;
        $book->genre_id = $request->genre_id;
        $book->category_id = $request->category_id;
        $book->book_type_id = $request->book_type_id;
        $book->year = $request->year;
        $book->stock = $request->stock;
        $book->description = $request->description;

        if ($request->hasFile('cover_image')) {

            if ($book->cover_image) {
                $oldPath = public_path('cover_images/' . $book->cover_image);

                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $file = $request->file('cover_image');
            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('cover_images'), $filename);

            $book->cover_image = $filename;
        }

        $book->save();

        return redirect()
            ->route('books.show', $book->id)
            ->with('success', 'Data buku berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);

        // Hapus file cover dari folder public/cover_images
        if ($book->cover_image) {
            $path = public_path('cover_images/' . $book->cover_image);

            if (file_exists($path)) {
                unlink($path);
            }
        }

        // Hapus data buku
        $book->delete();

        return redirect()
            ->route('books.index')
            ->with('success', 'Buku berhasil dihapus.');
    }
}
