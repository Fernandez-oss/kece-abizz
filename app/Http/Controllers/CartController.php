<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        // Mengambil data keranjang beserta relasi book dan author
        $carts = Cart::with(['book.author'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('users.cart', [
            'title' => 'Loan Application',
            'carts' => $carts, // Nama variabel disesuaikan menjadi $carts
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        $book = Book::findOrFail($request->book_id);

        if ($book->stock <= 0) {
            return back()->with('error', 'Buku sedang tidak tersedia.');
        }

        $alreadyExists = Cart::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->exists();

        if ($alreadyExists) {
            // Jika sudah ada di cart, langsung redirect ke halaman cart
            return redirect()->route('cart.index')->with('error', 'Buku sudah ada di keranjang.');
        }

        Cart::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
        ]);

        // Redirect langsung ke halaman keranjang (Loan Application)
        return redirect()->route('cart.index')->with('success', 'Buku berhasil ditambahkan ke keranjang.');
    }

    public function destroy($id)
    {
        $cart = Cart::where('user_id', Auth::id())
            ->findOrFail($id);

        $cart->delete();

        return back()->with('success', 'Buku dihapus dari keranjang.');
    }
}