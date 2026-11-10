<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $q = trim($request->input('q', ''));

        $books = Book::with([
            'author',
            'categories',
            'genres',
        ])
        ->when($q !== '', function ($query) use ($q) {
            $query->where(function ($search) use ($q) {

                // Cari berdasarkan nama buku
                $search->where('name', 'LIKE', "%{$q}%")

                    // Cari berdasarkan nama author
                    ->orWhereHas('author', function ($author) use ($q) {
                        $author->where('name', 'LIKE', "%{$q}%");
                    })

                    // Cari berdasarkan genre
                    ->orWhereHas('genres', function ($genre) use ($q) {
                        $genre->where('name', 'LIKE', "%{$q}%");
                    })

                    // Cari berdasarkan kategori
                    ->orWhereHas('categories', function ($category) use ($q) {
                        $category->where('name', 'LIKE', "%{$q}%");
                    });
            });
        })
        ->latest()
        ->paginate(12)
        ->withQueryString();

        return view('users.search', [
            'title' => 'Search Books',
            'books' => $books,
        ]);
    }
}
