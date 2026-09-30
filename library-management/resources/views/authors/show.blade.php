@extends('layouts.app')
@section('title', $author->name . ' — LibraryMS')
@section('breadcrumb', 'Authors / Detail')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold text-primary mb-0"><i class="bi bi-person me-2"></i>Author Detail</h4>
    <div class="d-flex gap-2">
        <a href="{{ route('authors.edit', $author) }}" class="btn btn-warning btn-sm">
            <i class="bi bi-pencil me-1"></i> Edit
        </a>
        <a href="{{ route('authors.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
    </div>
</div>

<div class="row g-3">
    <div class="col-lg-4">
        <div class="card text-center">
            <div class="card-body py-4">
                <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3"
                     style="width:80px;height:80px;font-size:2rem">
                    <i class="bi bi-person"></i>
                </div>
                <h5 class="fw-bold mb-1">{{ $author->name }}</h5>
                <p class="text-muted mb-2">{{ $author->nationality ?? 'Unknown' }}</p>
                @if($author->birth_date)
                    <small class="text-muted">Born: {{ $author->birth_date->format('d M Y') }}</small>
                @endif
                @if($author->email)
                <div class="mt-2">
                    <a href="mailto:{{ $author->email }}" class="text-decoration-none text-primary">
                        <i class="bi bi-envelope me-1"></i>{{ $author->email }}
                    </a>
                </div>
                @endif
            </div>
            <div class="card-footer bg-white py-2">
                <div class="fw-bold fs-4 text-primary">{{ $books->total() }}</div>
                <small class="text-muted">Books in Library</small>
            </div>
        </div>

        @if($author->bio)
        <div class="card mt-3">
            <div class="card-header py-3">Biography</div>
            <div class="card-body">
                <p class="text-muted mb-0" style="font-size:.9rem">{{ $author->bio }}</p>
            </div>
        </div>
        @endif
    </div>

    <div class="col-lg-8">
        <div class="card">
            <div class="card-header py-3">
                <i class="bi bi-journals me-2 text-primary"></i>Books by {{ $author->name }}
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="ps-3">Title</th>
                                <th>Category</th>
                                <th>Year</th>
                                <th>Copies</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($books as $book)
                            <tr>
                                <td class="ps-3">
                                    <a href="{{ route('books.show', $book) }}"
                                       class="text-dark fw-semibold text-decoration-none">
                                        {{ $book->title }}
                                    </a>
                                </td>
                                <td><span class="badge bg-light text-dark border">{{ $book->category->name }}</span></td>
                                <td>{{ $book->published_year ?? '—' }}</td>
                                <td>{{ $book->available_copies }}/{{ $book->total_copies }}</td>
                                <td>
                                    <span class="badge badge-{{ $book->status }} rounded-pill px-2">
                                        {{ ucfirst($book->status) }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="text-center text-muted py-4">No books found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($books->hasPages())
            <div class="card-footer">{{ $books->links() }}</div>
            @endif
        </div>
    </div>
</div>
@endsection
