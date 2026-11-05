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

        $withRelations = [
            'author',
            'publishers',
            'genres',
            'categories',
            'bookTypes'
        ];

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

        return view('users.index', compact(
            'title',
            'mostBorrowed',
            'favoriteBooks',
            'newArrivals'
        ));
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

        $relatedBooks = Book::where('id', '!=', $id)
            ->inRandomOrder()
            ->take(5)
            ->get();

        return view('users.show', compact(
            'title',
            'book',
            'relatedBooks'
        ));
    }

    public function create()
    {
        $title = "Sistem Sekolah - Tambah Pengguna";

        return view('users.create', compact('title'));
    }

    public function edit(string $id)
    {
        $title = "Sistem Sekolah - Ubah Pengguna";
        $user = User::findOrFail($id);

        return view('users.edit', compact('title', 'user'));
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
