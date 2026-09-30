<?php

namespace App\Http\Controllers;

use App\Http\Requests\BorrowRecordRequest;
use App\Models\Book;
use App\Models\BorrowRecord;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BorrowRecordController extends Controller
{
    public function index(Request $request): View
    {
        $query = BorrowRecord::with(['book', 'member']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('book', fn ($q) => $q->where('title', 'like', "%{$search}%"))
                  ->orWhereHas('member', fn ($q) => $q->where('name', 'like', "%{$search}%"));
        }

        if ($request->filled('status')) {
            $status = $request->status;
            if ($status === 'overdue') {
                $query->where(function ($q) {
                    $q->where('status', 'overdue')
                      ->orWhere(function ($q2) {
                          $q2->where('status', 'borrowed')
                             ->where('due_date', '<', Carbon::now()->toDateString());
                      });
                });
            } else {
                $query->where('status', $status);
            }
        }

        $borrows = $query->latest()->paginate(12)->withQueryString();

        return view('borrows.index', compact('borrows'));
    }

    public function create(): View
    {
        $books   = Book::where('status', 'available')->orderBy('title')->get();
        $members = Member::where('status', 'active')->orderBy('name')->get();

        return view('borrows.create', compact('books', 'members'));
    }

    public function store(BorrowRecordRequest $request): RedirectResponse
    {
        $book   = Book::findOrFail($request->book_id);
        $member = Member::findOrFail($request->member_id);

        if (!$book->isAvailable()) {
            return back()->with('error', 'This book is currently not available for borrowing.')->withInput();
        }

        if (!$member->isActive()) {
            return back()->with('error', 'This member does not have an active membership.')->withInput();
        }

        // Prevent duplicate active borrows for same book+member
        $existing = BorrowRecord::where('book_id', $book->id)
            ->where('member_id', $member->id)
            ->whereIn('status', ['borrowed', 'overdue'])
            ->exists();

        if ($existing) {
            return back()->with('error', 'This member already has an active borrow for this book.')->withInput();
        }

        BorrowRecord::create([
            'book_id'     => $book->id,
            'member_id'   => $member->id,
            'borrow_date' => $request->borrow_date,
            'due_date'    => $request->due_date,
            'status'      => 'borrowed',
            'fine_amount' => 0.00,
            'notes'       => $request->notes,
        ]);

        $book->decrementCopies();

        return redirect()->route('borrows.index')
            ->with('success', "Book \"{$book->title}\" issued to {$member->name} successfully.");
    }

    public function show(BorrowRecord $borrow): View
    {
        $borrow->load(['book.author', 'member']);

        return view('borrows.show', compact('borrow'));
    }

    public function edit(BorrowRecord $borrow): View
    {
        if ($borrow->status === 'returned') {
            return redirect()->route('borrows.index')
                ->with('error', 'Cannot edit a returned borrow record.');
        }

        $books   = Book::orderBy('title')->get();
        $members = Member::orderBy('name')->get();

        return view('borrows.edit', compact('borrow', 'books', 'members'));
    }

    public function update(BorrowRecordRequest $request, BorrowRecord $borrow): RedirectResponse
    {
        $borrow->update($request->only(['due_date', 'notes']));

        return redirect()->route('borrows.index')
            ->with('success', 'Borrow record updated successfully.');
    }

    /**
     * Mark a borrow as returned.
     */
    public function returnBook(BorrowRecord $borrow): RedirectResponse
    {
        if ($borrow->status === 'returned') {
            return back()->with('error', 'This book has already been returned.');
        }

        $borrow->markReturned();

        $fine = $borrow->fresh()->fine_amount;
        $msg  = "Book returned successfully.";
        if ($fine > 0) {
            $msg .= " A fine of \${$fine} has been applied.";
        }

        return redirect()->route('borrows.index')->with('success', $msg);
    }

    public function destroy(BorrowRecord $borrow): RedirectResponse
    {
        if ($borrow->status !== 'returned') {
            return back()->with('error', 'Can only delete returned borrow records.');
        }

        $borrow->delete();

        return redirect()->route('borrows.index')
            ->with('success', 'Borrow record deleted.');
    }
}
