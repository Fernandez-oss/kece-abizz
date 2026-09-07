<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BorrowingController extends Controller
{
    // Menampilkan semua buku yang sedang dipinjam
    public function index()
    {
        $borrowings = Borrowing::with([
            'user',
            'book'
        ])
            ->latest()
            ->get();

        return view('borrowings.index', [
            'title' => 'Daftar Peminjaman',
            'borrowings' => $borrowings,
        ]);
    }

    // Menampilkan detail peminjaman
    public function show($id)
    {
        $borrowing = Borrowing::with([
            'user',
            'book'
        ])->findOrFail($id);

        return view('borrowings.show', [
            'title' => 'Detail Peminjaman',
            'borrowing' => $borrowing,
        ]);
    }

    // Halaman perpanjang peminjaman
    public function edit($id)
    {
        $borrowing = Borrowing::with([
            'user',
            'book'
        ])->findOrFail($id);

        return view('borrowings.edit', [
            'title' => 'Perpanjang Peminjaman',
            'borrowing' => $borrowing,
        ]);
    }

    // Menyimpan perubahan tanggal
    public function update(Request $request, $id)
    {
        $request->validate([
            'due_date' => 'required|date',
        ]);

        $borrowing = Borrowing::findOrFail($id);

        $borrowing->update([
            'due_date' => $request->due_date,
        ]);

        return redirect()
            ->route('borrowings.show', $borrowing->id)
            ->with('success', 'Waktu peminjaman berhasil diperpanjang.');
    }

    // Mengembalikan buku
    public function destroy($id)
    {
        DB::transaction(function () use ($id) {

            $borrowing = Borrowing::with('book')
                ->where('status', 'return_requested')
                ->findOrFail($id);

            $book = $borrowing->book;

            $book->increment('stock');

            $borrowing->delete();
        });

        return redirect()
            ->route('borrowings.index')
            ->with('success', 'Pengembalian buku berhasil dikonfirmasi.');
    }
}
