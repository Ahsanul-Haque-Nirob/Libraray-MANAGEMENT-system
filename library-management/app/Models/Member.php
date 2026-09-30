<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'member_code',
        'name',
        'email',
        'phone',
        'address',
        'membership_start',
        'membership_end',
        'status',
    ];

    protected $casts = [
        'membership_start' => 'date',
        'membership_end'   => 'date',
    ];

    public function borrowRecords(): HasMany
    {
        return $this->hasMany(BorrowRecord::class);
    }

    public function activeBorrows(): HasMany
    {
        return $this->hasMany(BorrowRecord::class)->whereIn('status', ['borrowed', 'overdue']);
    }

    public function isActive(): bool
    {
        return $this->status === 'active' && $this->membership_end->isFuture();
    }

    public function getTotalFinesAttribute(): float
    {
        return $this->borrowRecords()->sum('fine_amount');
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Member $member) {
            if (empty($member->member_code)) {
                $member->member_code = 'LIB-' . strtoupper(uniqid());
            }
        });
    }
}
