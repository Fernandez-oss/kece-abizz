<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;

class UserController extends Controller
{
    public function index()
    {
        $title = "Owl Post - Home";

        // Query relasi yang reusable
        $withRelations = ['author', 'publishers', 'genres', 'categories', 'bookTypes'];

        // 1. Most Borrowed (5 buku sesuai desain)
        $mostBorrowedTitles = [
            'Great Big Beautiful Life', 
            'Onyx Storm', 
            'Sunrise on the Reaping', 
            'The Women', 
            'The Let Them Theory'
        ];
        $mostBorrowed = Book::with($withRelations)
            ->whereIn('name', $mostBorrowedTitles)
            ->get();

        // 2. Reader's Favorites (5 buku)
        $favoriteTitles = [
            'The Housemaid', 
            'Fourth Wing', 
            'A Court of Thorns and Roses', 
            'The Seven Husbands of Evelyn Hugo', 
            'Atomic Habits'
        ];
        $favoriteBooks = Book::with($withRelations)
            ->whereIn('name', $favoriteTitles)
            ->get();

        // 3. New Arrivals (5 buku)
        $newArrivalTitles = [
            'The Metamorphosis', 
            'Crime and Punishment', 
            'White Nights', 
            'No Longer Human', 
            'A Little Life'
        ];
        $newArrivals = Book::with($withRelations)
            ->whereIn('name', $newArrivalTitles)
            ->get();

        return view('users.index', [
            'title' => $title,
            'mostBorrowed' => $mostBorrowed,
            'favoriteBooks' => $favoriteBooks,
            'newArrivals' => $newArrivals,
        ]);
    }

    public function show(string $id)
    {
        $title = "Owl Post - Detail Buku";

        $book = Book::with([
            'author',
            'publishers',
            'genres',
            'categories',
            'bookTypes'
        ])->findOrFail($id);

        // Ambil 5 buku acak untuk section "You might also like"
        $relatedBooks = Book::where('id', '!=', $id)->inRandomOrder()->take(5)->get();

        return view('users.show', [
            'title' => $title,
            'book' => $book,
            'relatedBooks' => $relatedBooks
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