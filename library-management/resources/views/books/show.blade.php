@extends('layouts.app')

@section('title', $book->title . ' — LibraryMS')
@section('breadcrumb', 'Books / Detail')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold text-primary mb-0"><i class="bi bi-book me-2"></i>Book Detail</h4>
    <div class="d-flex gap-2">
        <a href="{{ route('books.edit', $book) }}" class="btn btn-warning btn-sm">
            <i class="bi bi-pencil me-1"></i> Edit
        </a>
        <a href="{{ route('books.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
    </div>
</div>

<div class="row g-3">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="row g-3">
                    @if($book->cover_image)
                    <div class="col-auto">
                        <img src="{{ asset('storage/' . $book->cover_image) }}"
                             alt="Cover" class="rounded shadow-sm" style="height:150px;object-fit:cover">
                    </div>
                    @endif
                    <div class="col">
                        <h5 class="fw-bold mb-1">{{ $book->title }}</h5>
                        <p class="text-muted mb-2">by <strong>{{ $book->author->name }}</strong></p>
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <span class="badge bg-light text-dark border">{{ $book->category->name }}</span>
                            <span class="badge badge-{{ $book->status }} rounded-pill px-2">{{ ucfirst($book->status) }}</span>
                        </div>
                        @if($book->description)
                        <p class="text-muted" style="font-size:.9rem">{{ $book->description }}</p>
                        @endif
                    </div>
                </div>

                <hr>
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="text-muted small">ISBN</div>
                        <code>{{ $book->isbn }}</code>
                    </div>
                    <div class="col-md-4">
                        <div class="text-muted small">Publisher</div>
                        <div>{{ $book->publisher ?? '—' }}</div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-muted small">Published Year</div>
                        <div>{{ $book->published_year ?? '—' }}</div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-muted small">Total Copies</div>
                        <div class="fw-semibold">{{ $book->total_copies }}</div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-muted small">Available Copies</div>
                        <div class="fw-semibold {{ $book->available_copies > 0 ? 'text-success' : 'text-danger' }}">
                            {{ $book->available_copies }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-muted small">Added On</div>
                        <div>{{ $book->created_at->format('d M Y') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header py-3">
                <i class="bi bi-arrow-left-right me-2 text-primary"></i>Borrow History
            </div>
            <div class="card-body p-0">
                @forelse($borrows as $b)
                <div class="px-3 py-2 border-bottom">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="fw-semibold" style="font-size:.88rem">{{ $b->member->name }}</div>
                            <small class="text-muted">
                                {{ $b->borrow_date->format('d M Y') }} → {{ $b->due_date->format('d M Y') }}
                            </small>
                        </div>
                        <span class="badge badge-{{ $b->status }} rounded-pill px-2 mt-1">{{ ucfirst($b->status) }}</span>
                    </div>
                </div>
                @empty
                <div class="text-center text-muted py-4">No borrow records.</div>
                @endforelse
            </div>
            @if($borrows->hasPages())
            <div class="card-footer">{{ $borrows->links() }}</div>
            @endif
        </div>
    </div>
</div>
@endsection
