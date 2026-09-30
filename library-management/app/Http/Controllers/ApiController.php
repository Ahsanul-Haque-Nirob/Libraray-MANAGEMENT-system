<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Models\Member;
use App\Models\BorrowRecord;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getDashboardStats()
    {
        return response()->json([
            'total_books' => Book::count(),
            'available_books' => Book::where('status', 'available')->count(),
            'total_authors' => Author::count(),
            'total_categories' => Category::count(),
            'total_members' => Member::count(),
            'active_members' => Member::where('status', 'active')->count(),
            'total_borrows' => BorrowRecord::count(),
            'active_borrows' => BorrowRecord::whereIn('status', ['borrowed', 'overdue'])->count(),
            'overdue_borrows' => BorrowRecord::where('status', 'overdue')->count(),
        ]);
    }

    public function getBooks()
    {
        return response()->json(Book::with(['author', 'category'])->get());
    }

    public function getAuthors()
    {
        return response()->json(Author::all());
    }

    public function getCategories()
    {
        return response()->json(Category::all());
    }

    public function getMembers()
    {
        return response()->json(Member::all());
    }

    public function getBorrows()
    {
        return response()->json(BorrowRecord::with(['book', 'member'])->get());
    }

    public function createBook(Request $request)
    {
        $book = Book::create($request->validated());
        return response()->json($book, 201);
    }

    public function createAuthor(Request $request)
    {
        $author = Author::create($request->validated());
        return response()->json($author, 201);
    }

    public function createCategory(Request $request)
    {
        $category = Category::create($request->validated());
        return response()->json($category, 201);
    }

    public function createMember(Request $request)
    {
        $member = Member::create($request->validated());
        return response()->json($member, 201);
    }

    public function createBorrow(Request $request)
    {
        $borrow = BorrowRecord::create($request->validated());
        return response()->json($borrow, 201);
    }

    public function updateBook($id, Request $request)
    {
        $book = Book::findOrFail($id);
        $book->update($request->validated());
        return response()->json($book);
    }

    public function deleteBook($id)
    {
        Book::findOrFail($id)->delete();
        return response()->json(['message' => 'Book deleted']);
    }
}
