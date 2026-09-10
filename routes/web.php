<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NameController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookTypeController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\UserBorrowingController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PublisherController;

use Illuminate\Support\Facades\Route;


// ==================================================
// HOME
// ==================================================

Route::get('/', function () {
    return view('welcome');
});


// ==================================================
// USERS
// ==================================================

Route::name('users.')->prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/{id}', [UserController::class, 'show'])->name('show')->whereNumber('id');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit')->whereNumber('id');
    Route::post('/store', [UserController::class, 'store'])->name('store');
    Route::put('/{id}', [UserController::class, 'update'])->name('update')->whereNumber('id');
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy')->whereNumber('id');
});


// ==================================================
// BOOKS
// ==================================================

Route::name('books.')->prefix('books')->group(function () {
    Route::get('/', [BookController::class, 'index'])->name('index');
    Route::get('/create', [BookController::class, 'create'])->name('create');
    Route::get('/{id}', [BookController::class, 'show'])->name('show')->whereNumber('id');
    Route::get('/{id}/edit', [BookController::class, 'edit'])->name('edit')->whereNumber('id');
    Route::post('/store', [BookController::class, 'store'])->name('store');
    Route::put('/{id}', [BookController::class, 'update'])->name('update')->whereNumber('id');
    Route::delete('/{id}', [BookController::class, 'destroy'])->name('destroy')->whereNumber('id');
});


// ==================================================
// CATEGORIES
// ==================================================

Route::name('categories.')->prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('/create', [CategoryController::class, 'create'])->name('create');
    Route::get('/{id}', [CategoryController::class, 'show'])->name('show')->whereNumber('id');
    Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('edit')->whereNumber('id');
    Route::post('/store', [CategoryController::class, 'store'])->name('store');
    Route::put('/{id}', [CategoryController::class, 'update'])->name('update')->whereNumber('id');
    Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('destroy')->whereNumber('id');
});


// ==================================================
// AUTHORS
// ==================================================

Route::name('authors.')->prefix('authors')->group(function () {
    Route::get('/', [AuthorController::class, 'index'])->name('index');
    Route::get('/create', [AuthorController::class, 'create'])->name('create');
    Route::get('/{id}', [AuthorController::class, 'show'])->name('show')->whereNumber('id');
    Route::get('/{id}/edit', [AuthorController::class, 'edit'])->name('edit')->whereNumber('id');
    Route::post('/store', [AuthorController::class, 'store'])->name('store');
    Route::put('/{id}', [AuthorController::class, 'update'])->name('update')->whereNumber('id');
    Route::delete('/{id}', [AuthorController::class, 'destroy'])->name('destroy')->whereNumber('id');
});


// ==================================================
// GENRES
// ==================================================

Route::name('genres.')->prefix('genres')->group(function () {
    Route::get('/', [GenreController::class, 'index'])->name('index');
    Route::get('/create', [GenreController::class, 'create'])->name('create');
    Route::get('/{id}', [GenreController::class, 'show'])->name('show')->whereNumber('id');
    Route::get('/{id}/edit', [GenreController::class, 'edit'])->name('edit')->whereNumber('id');
    Route::post('/store', [GenreController::class, 'store'])->name('store');
    Route::put('/{id}', [GenreController::class, 'update'])->name('update')->whereNumber('id');
    Route::delete('/{id}', [GenreController::class, 'destroy'])->name('destroy')->whereNumber('id');
});


// ==================================================
// BOOK TYPES
// ==================================================

Route::name('book_types.')->prefix('book_types')->group(function () {
    Route::get('/', [BookTypeController::class, 'index'])->name('index');
    Route::get('/create', [BookTypeController::class, 'create'])->name('create');
    Route::get('/{id}', [BookTypeController::class, 'show'])->name('show')->whereNumber('id');
    Route::get('/{id}/edit', [BookTypeController::class, 'edit'])->name('edit')->whereNumber('id');
    Route::post('/store', [BookTypeController::class, 'store'])->name('store');
    Route::put('/{id}', [BookTypeController::class, 'update'])->name('update')->whereNumber('id');
    Route::delete('/{id}', [BookTypeController::class, 'destroy'])->name('destroy')->whereNumber('id');
});


// ==================================================
// PUBLISHERS
// ==================================================

Route::name('publishers.')->prefix('publishers')->group(function () {
    Route::get('/', [PublisherController::class, 'index'])->name('index');
    Route::get('/create', [PublisherController::class, 'create'])->name('create');
    Route::get('/{id}', [PublisherController::class, 'show'])->name('show')->whereNumber('id');
    Route::get('/{id}/edit', [PublisherController::class, 'edit'])->name('edit')->whereNumber('id');
    Route::post('/store', [PublisherController::class, 'store'])->name('store');
    Route::put('/{id}', [PublisherController::class, 'update'])->name('update')->whereNumber('id');
    Route::delete('/{id}', [PublisherController::class, 'destroy'])->name('destroy')->whereNumber('id');
});


// ==================================================
// ADMINS
// ==================================================

Route::name('admins.')->prefix('admins')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/create', [AdminController::class, 'create'])->name('create');
    Route::get('/{id}', [AdminController::class, 'show'])->name('show')->whereNumber('id');
    Route::get('/{id}/edit', [AdminController::class, 'edit'])->name('edit')->whereNumber('id');
    Route::post('/store', [AdminController::class, 'store'])->name('store');
    Route::put('/{id}', [AdminController::class, 'update'])->name('update')->whereNumber('id');
    Route::delete('/{id}', [AdminController::class, 'destroy'])->name('destroy')->whereNumber('id');
});


// ==================================================
// REGISTER & LOGIN
// ==================================================

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');


// ==================================================
// USER AUTHENTICATED ROUTES
// ==================================================

Route::middleware('auth')->group(function () {

    Route::get('/name', [NameController::class, 'create'])->name('name');
    Route::post('/name', [NameController::class, 'store'])->name('name.store');

    // CART ROUTES
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy')->whereNumber('id');

    // BORROWING & HISTORY ROUTES (USER)
    Route::post('/borrowings/checkout', [UserBorrowingController::class, 'checkout'])->name('borrowings.checkout');
    Route::post('/borrowings', [UserBorrowingController::class, 'store'])->name('borrowings.store');
    Route::get('/my-borrowings', [UserBorrowingController::class, 'index'])->name('borrowings.user.index');
    Route::post('/borrowings/{id}/return', [UserBorrowingController::class, 'returnBook'])->name('borrowings.return')->whereNumber('id');

    // BORROWING ROUTES (ADMIN)
    Route::name('borrowings.')->prefix('borrowings')->group(function () {
        Route::get('/', [BorrowingController::class, 'index'])->name('index');
        Route::get('/{id}', [BorrowingController::class, 'show'])->name('show')->whereNumber('id');
        Route::get('/{id}/edit', [BorrowingController::class, 'edit'])->name('edit')->whereNumber('id');
        Route::put('/{id}', [BorrowingController::class, 'update'])->name('update');
        Route::delete('/{id}', [BorrowingController::class, 'destroy'])->name('destroy');
    });

});