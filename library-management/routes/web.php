<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowRecordController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Library Management System Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Books
Route::resource('books', BookController::class);

// Authors
Route::resource('authors', AuthorController::class);

// Categories
Route::resource('categories', CategoryController::class);

// Members
Route::resource('members', MemberController::class);

// Borrow Records
Route::resource('borrows', BorrowRecordController::class)->except(['update']);
Route::put('borrows/{borrow}', [BorrowRecordController::class, 'update'])->name('borrows.update');

// Return a book
Route::patch('borrows/{borrow}/return', [BorrowRecordController::class, 'returnBook'])
    ->name('borrows.return');
