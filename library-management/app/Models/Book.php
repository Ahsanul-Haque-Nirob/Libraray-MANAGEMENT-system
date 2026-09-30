<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'isbn',
        'author_id',
        'category_id',
        'description',
        'publisher',
        'published_year',
        'total_copies',
        'available_copies',
        'cover_image',
        'status',
    ];

    protected $casts = [
        'published_year' => 'integer',
        'total_copies'   => 'integer',
        'available_copies' => 'integer',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function borrowRecords(): HasMany
    {
        return $this->hasMany(BorrowRecord::class);
    }

    public function activeBorrows(): HasMany
    {
        return $this->hasMany(BorrowRecord::class)->whereIn('status', ['borrowed', 'overdue']);
    }

    public function isAvailable(): bool
    {
        return $this->available_copies > 0 && $this->status === 'available';
    }

    public function decrementCopies(): void
    {
        $this->decrement('available_copies');
        if ($this->available_copies <= 0) {
            $this->update(['status' => 'unavailable']);
        }
    }

    public function incrementCopies(): void
    {
        $this->increment('available_copies');
        if ($this->available_copies > 0) {
            $this->update(['status' => 'available']);
        }
    }
}
