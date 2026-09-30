<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\BorrowRecord;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BorrowRecordSeeder extends Seeder
{
    public function run(): void
    {
        $members = Member::where('status', 'active')->get();
        $books   = Book::where('status', 'available')->get();

        // Create some active borrows
        foreach ($members->take(8) as $member) {
            $book = $books->random();
            if ($book->available_copies > 0) {
                BorrowRecord::create([
                    'book_id'     => $book->id,
                    'member_id'   => $member->id,
                    'borrow_date' => now()->subDays(5)->toDateString(),
                    'due_date'    => now()->addDays(9)->toDateString(),
                    'status'      => 'borrowed',
                    'fine_amount' => 0.00,
                ]);
                $book->decrement('available_copies');
            }
        }

        // Create some overdue records
        foreach ($members->take(3) as $member) {
            $book = $books->random();
            if ($book->available_copies > 0) {
                BorrowRecord::create([
                    'book_id'     => $book->id,
                    'member_id'   => $member->id,
                    'borrow_date' => now()->subDays(30)->toDateString(),
                    'due_date'    => now()->subDays(16)->toDateString(),
                    'status'      => 'overdue',
                    'fine_amount' => 16.00,
                ]);
                $book->decrement('available_copies');
            }
        }

        // Create some returned records
        foreach ($members->take(10) as $member) {
            $book       = $books->random();
            $borrowDate = now()->subDays(rand(20, 60));
            $dueDate    = Carbon::parse($borrowDate)->addDays(14);
            $returnDate = Carbon::parse($borrowDate)->addDays(rand(1, 18));
            $fine       = $returnDate->isAfter($dueDate) ? $returnDate->diffInDays($dueDate) * 1.00 : 0.00;

            BorrowRecord::create([
                'book_id'     => $book->id,
                'member_id'   => $member->id,
                'borrow_date' => $borrowDate->toDateString(),
                'due_date'    => $dueDate->toDateString(),
                'return_date' => $returnDate->toDateString(),
                'status'      => 'returned',
                'fine_amount' => $fine,
            ]);
        }
    }
}
