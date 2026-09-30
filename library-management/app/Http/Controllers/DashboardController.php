<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BorrowRecord;
use App\Models\Member;
use App\Models\Author;
use App\Models\Category;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_books'      => Book::count(),
            'available_books'  => Book::where('status', 'available')->count(),
            'total_members'    => Member::count(),
            'active_members'   => Member::where('status', 'active')->count(),
            'total_borrows'    => BorrowRecord::count(),
            'active_borrows'   => BorrowRecord::whereIn('status', ['borrowed', 'overdue'])->count(),
            'overdue_borrows'  => BorrowRecord::where('status', 'overdue')
                                    ->orWhere(function ($q) {
                                        $q->where('status', 'borrowed')
                                          ->where('due_date', '<', Carbon::now()->toDateString());
                                    })->count(),
            'total_authors'    => Author::count(),
            'total_categories' => Category::count(),
            'total_fines'      => BorrowRecord::sum('fine_amount'),
        ];

        $recentBorrows = BorrowRecord::with(['book', 'member'])
            ->latest()
            ->take(8)
            ->get();

        $overdueBorrows = BorrowRecord::with(['book', 'member'])
            ->where(function ($q) {
                $q->where('status', 'overdue')
                  ->orWhere(function ($q2) {
                      $q2->where('status', 'borrowed')
                         ->where('due_date', '<', Carbon::now()->toDateString());
                  });
            })
            ->latest()
            ->take(5)
            ->get();

        $popularBooks = Book::withCount('borrowRecords')
            ->orderByDesc('borrow_records_count')
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'stats',
            'recentBorrows',
            'overdueBorrows',
            'popularBooks'
        ));
    }
}
