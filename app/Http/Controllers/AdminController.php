<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $title = "Sistem Perpustakaan Sekolah - Daftar Pengguna";
        $users = User::all();

        return view('users.admin-index', compact('title', 'users'));
    }

    public function show(string $id)
    {
        $title = "Sistem Sekolah - Detail Admin";

        return view('users.admin-show', compact('title'));
    }

    public function create()
    {
        $title = "Sistem Sekolah - Tambah Admin";

        return view('users.admin-create', compact('title'));
    }

    public function edit(string $id)
    {
        $title = "Sistem Sekolah - Ubah Admin";

        return view('users.admin-edit', compact('title'));
    }

    public function store()
    {
        return "Melakukan penambahan data Admin";
    }

    public function update(string $id)
    {
        return "Melakukan perubahan data Admin";
    }

    public function destroy(string $id)
    {
        return "Menghapus data Admin";
    }

    public function dashboard()
    {
        $totalBooks = Book::count();
        $totalUsers = User::where('role', 'user')->count();

        $activeBorrowings = Borrowing::where('status', 'borrowed')->count();
        $returnRequests = Borrowing::where('status', 'return_requested')->count();

        $overdueBorrowings = Borrowing::with(['user', 'book'])
            ->where('status', 'borrowed')
            ->whereDate('due_date', '<', today())
            ->latest('due_date')
            ->get();

        return view('users.admin-dashboard', compact(
            'totalBooks',
            'totalUsers',
            'activeBorrowings',
            'returnRequests',
            'overdueBorrowings'
        ));
    }
}
