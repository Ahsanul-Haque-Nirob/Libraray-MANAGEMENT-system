@extends('layouts.app')
@section('title', 'Borrow Detail — LibraryMS')
@section('breadcrumb', 'Borrow Records / Detail')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold text-primary mb-0"><i class="bi bi-arrow-left-right me-2"></i>Borrow Detail</h4>
    <div class="d-flex gap-2">
        @if($borrow->status !== 'returned')
        <form action="{{ route('borrows.return', $borrow) }}" method="POST"
              onsubmit="return confirm('Mark this book as returned?')">
            @csrf @method('PATCH')
            <button class="btn btn-success btn-sm">
                <i class="bi bi-check-circle me-1"></i> Mark Returned
            </button>
        </form>
        @endif
        <a href="{{ route('borrows.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header py-3"><i class="bi bi-book me-2 text-primary"></i>Book Information</div>
            <div class="card-body">
                <div class="mb-3">
                    <div class="text-muted small">Title</div>
                    <div class="fw-semibold">
                        <a href="{{ route('books.show', $borrow->book) }}" class="text-dark text-decoration-none">
                            {{ $borrow->book->title }}
                        </a>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="text-muted small">Author</div>
                    <div>{{ $borrow->book->author->name }}</div>
                </div>
                <div>
                    <div class="text-muted small">ISBN</div>
                    <code>{{ $borrow->book->isbn }}</code>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header py-3"><i class="bi bi-person me-2 text-primary"></i>Member Information</div>
            <div class="card-body">
                <div class="mb-3">
                    <div class="text-muted small">Name</div>
                    <div class="fw-semibold">
                        <a href="{{ route('members.show', $borrow->member) }}" class="text-dark text-decoration-none">
                            {{ $borrow->member->name }}
                        </a>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="text-muted small">Member Code</div>
                    <code>{{ $borrow->member->member_code }}</code>
                </div>
                <div>
                    <div class="text-muted small">Email</div>
                    <div>{{ $borrow->member->email }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header py-3"><i class="bi bi-calendar-check me-2 text-primary"></i>Borrow Details</div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <div class="text-muted small">Borrow Date</div>
                        <div class="fw-semibold">{{ $borrow->borrow_date->format('d M Y') }}</div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-muted small">Due Date</div>
                        <div class="fw-semibold {{ $borrow->isOverdue() ? 'text-danger' : '' }}">
                            {{ $borrow->due_date->format('d M Y') }}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-muted small">Return Date</div>
                        <div class="fw-semibold">
                            {{ $borrow->return_date ? $borrow->return_date->format('d M Y') : '—' }}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-muted small">Status</div>
                        <span class="badge badge-{{ $borrow->status }} rounded-pill px-2">
                            {{ ucfirst($borrow->status) }}
                        </span>
                    </div>
                    @if($borrow->isOverdue())
                    <div class="col-md-3">
                        <div class="text-muted small">Days Overdue</div>
                        <div class="fw-semibold text-danger">{{ $borrow->days_overdue }} days</div>
                    </div>
                    @endif
                    <div class="col-md-3">
                        <div class="text-muted small">Fine Amount</div>
                        <div class="fw-semibold {{ $borrow->fine_amount > 0 ? 'text-danger' : 'text-success' }}">
                            ${{ number_format($borrow->fine_amount, 2) }}
                        </div>
                    </div>
                    @if($borrow->notes)
                    <div class="col-12">
                        <div class="text-muted small">Notes</div>
                        <div>{{ $borrow->notes }}</div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
