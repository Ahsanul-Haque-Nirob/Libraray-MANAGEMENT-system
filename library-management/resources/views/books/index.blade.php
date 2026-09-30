@extends('layouts.app')

@section('title', 'Books — LibraryMS')
@section('breadcrumb', 'Books')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold text-primary mb-0"><i class="bi bi-journals me-2"></i>Books</h4>
    <a href="{{ route('books.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i> Add Book
    </a>
</div>

{{-- Filters --}}
<div class="card mb-3">
    <div class="card-body py-2">
        <form method="GET" action="{{ route('books.index') }}" class="row g-2 align-items-center">
            <div class="col-md-5">
                <input type="text" name="search" class="form-control form-control-sm"
                       placeholder="Search by title, ISBN or author…" value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="category" class="form-select form-select-sm">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="status" class="form-select form-select-sm">
                    <option value="">All Status</option>
                    <option value="available"   {{ request('status') === 'available'   ? 'selected' : '' }}>Available</option>
                    <option value="unavailable" {{ request('status') === 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                </select>
            </div>
            <div class="col-md-2 d-flex gap-1">
                <button type="submit" class="btn btn-sm btn-primary w-100">Filter</button>
                <a href="{{ route('books.index') }}" class="btn btn-sm btn-outline-secondary">Clear</a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th class="ps-3">#</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>ISBN</th>
                        <th>Copies</th>
                        <th>Status</th>
                        <th class="text-end pe-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($books as $book)
                    <tr>
                        <td class="ps-3 text-muted">{{ $books->firstItem() + $loop->index }}</td>
                        <td>
                            <a href="{{ route('books.show', $book) }}"
                               class="fw-semibold text-dark text-decoration-none">
                                {{ Str::limit($book->title, 35) }}
                            </a>
                            @if($book->published_year)
                                <br><small class="text-muted">{{ $book->published_year }}</small>
                            @endif
                        </td>
                        <td>{{ $book->author->name }}</td>
                        <td>
                            <span class="badge bg-light text-dark border">{{ $book->category->name }}</span>
                        </td>
                        <td><code>{{ $book->isbn }}</code></td>
                        <td>
                            <span class="fw-semibold">{{ $book->available_copies }}</span>
                            <span class="text-muted">/ {{ $book->total_copies }}</span>
                        </td>
                        <td>
                            <span class="badge badge-{{ $book->status }} px-2 py-1 rounded-pill">
                                {{ ucfirst($book->status) }}
                            </span>
                        </td>
                        <td class="text-end pe-3">
                            <div class="d-flex gap-1 justify-content-end">
                                <a href="{{ route('books.show', $book) }}"
                                   class="btn btn-sm btn-outline-info" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('books.edit', $book) }}"
                                   class="btn btn-sm btn-outline-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('books.destroy', $book) }}" method="POST"
                                      onsubmit="return confirm('Delete this book?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="bi bi-journals fs-1 d-block mb-2"></i>
                            No books found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($books->hasPages())
    <div class="card-footer bg-white d-flex justify-content-between align-items-center py-2 px-3">
        <small class="text-muted">Showing {{ $books->firstItem() }}–{{ $books->lastItem() }} of {{ $books->total() }}</small>
        {{ $books->links() }}
    </div>
    @endif
</div>
@endsection
