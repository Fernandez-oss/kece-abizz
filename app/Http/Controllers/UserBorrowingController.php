<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserBorrowingController extends Controller
{
    public function checkout(Request $request)
    {
        $request->validate([
            'days' => 'required|integer|min:1|max:14',
        ]);

        $carts = Cart::with('book')
            ->where('user_id', Auth::id())
            ->get();

        if ($carts->isEmpty()) {
            return back()->with('error', 'Keranjang masih kosong.');
        }

        foreach ($carts as $cart) {
            if (!$cart->book || $cart->book->stock <= 0) {
                return back()->with(
                    'error',
                    'Ada buku di keranjang yang sudah tidak tersedia.'
                );
            }
        }

        DB::transaction(function () use ($carts, $request) {

            foreach ($carts as $cart) {

                Borrowing::create([
                    'user_id' => Auth::id(),
                    'book_id' => $cart->book_id,
                    'borrowed_at' => now(),
                    'due_date' => now()->addDays((int) $request->days),
                    'returned_at' => null,
                    'status' => 'borrowed',
                ]);

                $cart->book->decrement('stock');
            }

            Cart::where('user_id', Auth::id())->delete();
        });

        return redirect()
            ->route('borrowings.user.index')
            ->with('success', 'Semua buku berhasil dipinjam.');
    }

    public function index()
    {
        $borrowings = Borrowing::with('book')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('users.borrowings', [
            'title' => 'Riwayat Peminjaman',
            'borrowings' => $borrowings,
        ]);
    }

    public function returnBook($id)
    {
        $borrowing = Borrowing::where('user_id', Auth::id())
            ->findOrFail($id);

        if ($borrowing->status !== 'borrowed') {
            return back()->with(
                'error',
                'Buku ini sudah diajukan untuk dikembalikan.'
            );
        }

        $borrowing->update([
            'status' => 'return_requested',
            'returned_at' => now(),
        ]);

        return back()->with(
            'success',
            'Pengembalian buku berhasil diajukan. Menunggu konfirmasi admin.'
        );
    }
}