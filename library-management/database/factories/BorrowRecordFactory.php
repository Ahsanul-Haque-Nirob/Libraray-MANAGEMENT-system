<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class BorrowRecordFactory extends Factory
{
    public function definition(): array
    {
        $borrowDate = fake()->dateTimeBetween('-3 months', '-1 week');
        $dueDate    = Carbon::instance($borrowDate)->addDays(14);
        $returned   = fake()->boolean(60);

        return [
            'book_id'     => Book::inRandomOrder()->first()?->id ?? Book::factory(),
            'member_id'   => Member::inRandomOrder()->first()?->id ?? Member::factory(),
            'borrow_date' => $borrowDate->format('Y-m-d'),
            'due_date'    => $dueDate->toDateString(),
            'return_date' => $returned ? Carbon::instance($borrowDate)->addDays(fake()->numberBetween(1, 20))->toDateString() : null,
            'status'      => $returned ? 'returned' : ($dueDate->isPast() ? 'overdue' : 'borrowed'),
            'fine_amount' => 0.00,
            'notes'       => fake()->optional()->sentence(),
        ];
    }

    public function borrowed(): static
    {
        return $this->state(function () {
            $borrow = now()->subDays(5);
            return [
                'borrow_date' => $borrow->toDateString(),
                'due_date'    => $borrow->addDays(14)->toDateString(),
                'return_date' => null,
                'status'      => 'borrowed',
                'fine_amount' => 0.00,
            ];
        });
    }

    public function overdue(): static
    {
        return $this->state(function () {
            $borrow = now()->subDays(30);
            return [
                'borrow_date' => $borrow->toDateString(),
                'due_date'    => $borrow->addDays(14)->toDateString(),
                'return_date' => null,
                'status'      => 'overdue',
                'fine_amount' => 16.00,
            ];
        });
    }
}
