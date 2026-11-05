<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserBorrowingController extends Controller
{
    // Memproses checkout
    public function store(Request $request)
    {
        return $this->checkout($request);
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'days' => 'required|integer|min:1|max:7',
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

        $pickupDate = now();
        $loanDays = (int) $request->days;

        DB::transaction(function () use ($carts, $pickupDate, $loanDays) {
            foreach ($carts as $cart) {
                Borrowing::create([
                    'user_id'     => Auth::id(),
                    'book_id'     => $cart->book_id,
                    'borrowed_at' => $pickupDate,
                    'due_date'    => $pickupDate->copy()->addDays($loanDays),
                    'returned_at' => null,
                    'status'      => 'borrowed',
                ]);

                $cart->book->decrement('stock');
            }

            Cart::where('user_id', Auth::id())->delete();
        });

        return redirect()
            ->route('borrowings.user.index')
            ->with(
                'success',
                "Semua buku berhasil dipinjam dengan durasi {$loanDays} hari."
            );
    }

    // Menampilkan riwayat peminjaman
    public function index(Request $request)
    {
        $query = Borrowing::with('book')
            ->where('user_id', Auth::id());

        // Pencarian berdasarkan judul buku
        if ($request->filled('search')) {
            $search = $request->search;

            $query->whereHas('book', function ($bookQuery) use ($search) {
                $bookQuery->where('title', 'like', "%{$search}%");
            });
        }

        $borrowings = $query->latest()->get();

        return view('users.history', [
            'title'      => 'Riwayat Peminjaman',
            'borrowings' => $borrowings,
        ]);
    }

    // Mengajukan pengembalian satu buku
    public function returnBook($id)
    {
        $borrowing = Borrowing::where('user_id', Auth::id())
            ->where('status', 'borrowed')
            ->findOrFail($id);

        $borrowing->update([
            'status'      => 'return_requested',
            'returned_at' => now(),
        ]);

        return back()->with(
            'success',
            'Pengembalian buku berhasil diajukan. Menunggu konfirmasi admin.'
        );
    }

    // Mengajukan pengembalian beberapa buku sekaligus
    public function returnSelected(Request $request)
    {
        $validated = $request->validate([
            'borrowing_ids'   => 'required|array|min:1',
            'borrowing_ids.*' => 'required|integer|distinct',
        ]);

        $ids = $validated['borrowing_ids'];

        DB::transaction(function () use ($ids) {
            // Pastikan semua buku milik user dan masih berstatus dipinjam
            $borrowings = Borrowing::where('user_id', Auth::id())
                ->where('status', 'borrowed')
                ->whereIn('id', $ids)
                ->lockForUpdate()
                ->get();

            // Tolak jika ada ID yang tidak valid atau bukan milik user
            if ($borrowings->count() !== count($ids)) {
                abort(403, 'Ada buku yang tidak valid atau tidak dapat dikembalikan.');
            }

            Borrowing::where('user_id', Auth::id())
                ->where('status', 'borrowed')
                ->whereIn('id', $ids)
                ->update([
                    'status'      => 'return_requested',
                    'returned_at' => now(),
                ]);
        });

        $count = count($ids);

        return redirect()
            ->route('borrowings.user.index')
            ->with(
                'success',
                "{$count} buku berhasil diajukan untuk dikembalikan. Menunggu konfirmasi admin."
            );
    }
}
