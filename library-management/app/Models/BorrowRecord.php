<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BorrowRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'member_id',
        'borrow_date',
        'due_date',
        'return_date',
        'status',
        'fine_amount',
        'notes',
    ];

    protected $casts = [
        'borrow_date' => 'date',
        'due_date'    => 'date',
        'return_date' => 'date',
        'fine_amount' => 'decimal:2',
    ];

    // Fine rate: $1 per day overdue
    const FINE_PER_DAY = 1.00;

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function isOverdue(): bool
    {
        return $this->status !== 'returned' && Carbon::now()->isAfter($this->due_date);
    }

    public function calculateFine(): float
    {
        if (!$this->isOverdue()) {
            return 0.00;
        }

        $referenceDate = $this->return_date ?? Carbon::now();
        $overdueDays   = $this->due_date->diffInDays($referenceDate);

        return round($overdueDays * self::FINE_PER_DAY, 2);
    }

    public function getDaysOverdueAttribute(): int
    {
        if (!$this->isOverdue()) {
            return 0;
        }
        $referenceDate = $this->return_date ?? Carbon::now();
        return (int) $this->due_date->diffInDays($referenceDate);
    }

    /**
     * Mark record as returned, calculate fine, free up book copy.
     */
    public function markReturned(): void
    {
        $returnDate = Carbon::now()->toDateString();
        $fine       = $this->calculateFine();

        $this->update([
            'return_date' => $returnDate,
            'status'      => 'returned',
            'fine_amount' => $fine,
        ]);

        $this->book->incrementCopies();
    }

    // Scopes
    public function scopeBorrowed($query)
    {
        return $query->where('status', 'borrowed');
    }

    public function scopeOverdue($query)
    {
        return $query->where('status', 'overdue')
            ->orWhere(function ($q) {
                $q->where('status', 'borrowed')
                  ->where('due_date', '<', Carbon::now()->toDateString());
            });
    }

    public function scopeReturned($query)
    {
        return $query->where('status', 'returned');
    }
}
