<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserBorrowingController extends Controller
{
    // Alias untuk memproses request checkout dari form cart (Route: borrowings.store)
    public function store(Request $request)
    {
        return $this->checkout($request);
    }

    public function checkout(Request $request)
    {
        // Validasi input tanggal pickup dan durasi dari cart
        $request->validate([
            'pickup_date' => 'nullable|date',
            'days'        => 'nullable|integer|min:1|max:14',
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

        $pickupDate = $request->pickup_date ? Carbon::parse($request->pickup_date) : now();
        $loanDays   = $request->days ?? 7;

        DB::transaction(function () use ($carts, $pickupDate, $loanDays) {
            foreach ($carts as $cart) {
                Borrowing::create([
                    'user_id'     => Auth::id(),
                    'book_id'     => $cart->book_id,
                    'borrowed_at' => $pickupDate,
                    'due_date'    => $pickupDate->copy()->addDays((int) $loanDays),
                    'returned_at' => null,
                    'status'      => 'borrowed',
                ]);

                $cart->book->decrement('stock');
            }

            Cart::where('user_id', Auth::id())->delete();
        });

        // Redirect ke route borrowings.user.index
        return redirect()
            ->route('borrowings.user.index')
            ->with('success', 'Semua buku berhasil dipinjam.');
    }

    // Menampilkan halaman history (resources/views/users/history.blade.php)
    public function index()
    {
        $borrowings = Borrowing::with('book')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('users.history', [
            'title'      => 'Riwayat Peminjaman',
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
            'status'      => 'return_requested',
            'returned_at' => now(),
        ]);

        return back()->with(
            'success',
            'Pengembalian buku berhasil diajukan. Menunggu konfirmasi admin.'
        );
    }
}