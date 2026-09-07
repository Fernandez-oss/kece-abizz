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
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('Register');
});

Route::name('users.')->prefix('users')->group(function () {

    Route::get('/', [UserController::class, 'index'])->name('index');


    Route::get('/{id}', [UserController::class, 'show'])->name('show')->whereNumber('id');

    Route::get('/create', [UserController::class, 'create'])->name('create');


    Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');

    Route::post('/store', [UserController::class, 'store'])->name('store');

    Route::put('/{id}', [UserController::class, 'update'])->name('update');

    Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
});

Route::name('books.')->prefix('books')->group(function () {

    Route::get('/', [BookController::class, 'index'])->name('index');

    Route::get('/create', [BookController::class, 'create'])->name('create');

    Route::get('/{id}', [BookController::class, 'show'])->name('show');

    Route::get('/{id}/edit', [BookController::class, 'edit'])->name('edit');

    Route::post('/store', [BookController::class, 'store'])->name('store');

    Route::put('/{id}', [BookController::class, 'update'])->name('update');

    Route::delete('/{id}', [BookController::class, 'destroy'])->name('destroy');
});

Route::name('categories.')->prefix('categories')->group(function () {

    Route::get('/', [CategoryController::class, 'index'])->name('index');

    Route::get('/create', [CategoryController::class, 'create'])->name('create');

    Route::get('/{id}', [CategoryController::class, 'show'])->name('show');

    Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('edit');

    Route::post('/store', [CategoryController::class, 'store'])->name('store');

    Route::put('/{id}', [CategoryController::class, 'update'])->name('update');

    Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('destroy');
});

Route::name('authors.')->prefix('authors')->group(function () {

    Route::get('/', [AuthorController::class, 'index'])->name('index');

    Route::get('/create', [AuthorController::class, 'create'])->name('create');

    Route::get('/{id}', [AuthorController::class, 'show'])->name('show');

    Route::get('/{id}/edit', [AuthorController::class, 'edit'])->name('edit');

    Route::post('/store', [AuthorController::class, 'store'])->name('store');

    Route::put('/{id}', [AuthorController::class, 'update'])->name('update');

    Route::delete('/{id}', [AuthorController::class, 'destroy'])->name('destroy');
});

Route::name('genres.')->prefix('genres')->group(function () {

    Route::get('/', [GenreController::class, 'index'])->name('index');

    Route::get('/create', [GenreController::class, 'create'])->name('create');

    Route::get('/{id}', [GenreController::class, 'show'])->name('show');

    Route::get('/{id}/edit', [GenreController::class, 'edit'])->name('edit');

    Route::post('/store', [GenreController::class, 'store'])->name('store');

    Route::put('/{id}', [GenreController::class, 'update'])->name('update');

    Route::delete('/{id}', [GenreController::class, 'destroy'])->name('destroy');
});

Route::name('book_types.')->prefix('book_types')->group(function () {

    Route::get('/', [BookTypeController::class, 'index'])->name('index');

    Route::get('/create', [BookTypeController::class, 'create'])->name('create');

    Route::get('/{id}', [BookTypeController::class, 'show'])->name('show');

    Route::get('/{id}/edit', [BookTypeController::class, 'edit'])->name('edit');

    Route::post('/store', [BookTypeController::class, 'store'])->name('store');

    Route::put('/{id}', [BookTypeController::class, 'update'])->name('update');

    Route::delete('/{id}', [BookTypeController::class, 'destroy'])->name('destroy');
});

Route::name('admins.')->prefix('admins')->group(function () {

    Route::get('/', [AdminController::class, 'index'])->name('index');

    Route::get('/create', [AdminController::class, 'create'])->name('create');

    Route::get('/{id}', [AdminController::class, 'show'])->name('show');

    Route::get('/{id}/edit', [AdminController::class, 'edit'])->name('edit');

    Route::post('/store', [AdminController::class, 'store'])->name('store');

    Route::put('/{id}', [AdminController::class, 'update'])->name('update');

    Route::delete('/{id}', [AdminController::class, 'destroy'])->name('destroy');
});

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/register', [RegisterController::class, 'store'])
    ->name('register.store');

Route::post('/login', [LoginController::class, 'login'])
    ->name('login.process');

Route::middleware('auth')->group(function () {
    Route::get('/name', [NameController::class, 'create'])->name('name');
    Route::post('/name', [NameController::class, 'store'])->name('name.store');
});

Route::get('/books/{id}/edit', [BookController::class, 'edit'])
    ->name('books.edit');

Route::put('/books/{id}', [BookController::class, 'update'])
    ->name('books.update');