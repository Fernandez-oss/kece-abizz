<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
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