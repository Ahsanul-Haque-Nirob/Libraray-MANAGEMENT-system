<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('api')->group(function () {
    // Dashboard
    Route::get('/dashboard/stats', [ApiController::class, 'getDashboardStats']);

    // Books
    Route::get('/books', [ApiController::class, 'getBooks']);
    Route::post('/books', [ApiController::class, 'createBook']);
    Route::put('/books/{id}', [ApiController::class, 'updateBook']);
    Route::delete('/books/{id}', [ApiController::class, 'deleteBook']);

    // Authors
    Route::get('/authors', [ApiController::class, 'getAuthors']);
    Route::post('/authors', [ApiController::class, 'createAuthor']);

    // Categories
    Route::get('/categories', [ApiController::class, 'getCategories']);
    Route::post('/categories', [ApiController::class, 'createCategory']);

    // Members
    Route::get('/members', [ApiController::class, 'getMembers']);
    Route::post('/members', [ApiController::class, 'createMember']);

    // Borrow Records
    Route::get('/borrows', [ApiController::class, 'getBorrows']);
    Route::post('/borrows', [ApiController::class, 'createBorrow']);
});
