@extends('layouts.app')
@section('title', $category->name . ' — LibraryMS')
@section('breadcrumb', 'Categories / Detail')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold text-primary mb-0">
        <i class="bi bi-tag me-2"></i>{{ $category->name }}
    </h4>
    <div class="d-flex gap-2">
        <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning btn-sm">
            <i class="bi bi-pencil me-1"></i> Edit
        </a>
        <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
    </div>
</div>

@if($category->description)
<p class="text-muted mb-3">{{ $category->description }}</p>
@endif

<div class="card">
    <div class="card-header py-3">
        <i class="bi bi-journals me-2 text-primary"></i>Books in this Category
        <span class="badge bg-primary ms-1">{{ $books->total() }}</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th class="ps-3">Title</th>
                        <th>Author</th>
                        <th>Year</th>
                        <th>Available</th>
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
                        <td>{{ $book->author->name }}</td>
                        <td>{{ $book->published_year ?? '—' }}</td>
                        <td>{{ $book->available_copies }}/{{ $book->total_copies }}</td>
                        <td>
                            <span class="badge badge-{{ $book->status }} rounded-pill px-2">
                                {{ ucfirst($book->status) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center text-muted py-4">No books in this category.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($books->hasPages())
    <div class="card-footer">{{ $books->links() }}</div>
    @endif
</div>
@endsection
