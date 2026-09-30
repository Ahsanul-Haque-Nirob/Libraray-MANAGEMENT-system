@extends('layouts.app')
@section('title', 'Borrow Records — LibraryMS')
@section('breadcrumb', 'Borrow Records')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold text-primary mb-0"><i class="bi bi-arrow-left-right me-2"></i>Borrow Records</h4>
    <a href="{{ route('borrows.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i> Issue Book
    </a>
</div>

{{-- Filters --}}
<div class="card mb-3">
    <div class="card-body py-2">
        <form method="GET" action="{{ route('borrows.index') }}" class="row g-2 align-items-center">
            <div class="col-md-6">
                <input type="text" name="search" class="form-control form-control-sm"
                       placeholder="Search by book title or member name…" value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select form-select-sm">
                    <option value="">All Status</option>
                    <option value="borrowed" {{ request('status') === 'borrowed' ? 'selected' : '' }}>Borrowed</option>
                    <option value="returned" {{ request('status') === 'returned' ? 'selected' : '' }}>Returned</option>
                    <option value="overdue"  {{ request('status') === 'overdue'  ? 'selected' : '' }}>Overdue</option>
                </select>
            </div>
            <div class="col-md-3 d-flex gap-1">
                <button type="submit" class="btn btn-sm btn-primary w-100">Filter</button>
                <a href="{{ route('borrows.index') }}" class="btn btn-sm btn-outline-secondary">Clear</a>
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
                        <th>Book</th>
                        <th>Member</th>
                        <th>Borrowed</th>
                        <th>Due Date</th>
                        <th>Returned</th>
                        <th>Fine</th>
                        <th>Status</th>
                        <th class="text-end pe-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($borrows as $borrow)
                    <tr class="{{ $borrow->isOverdue() ? 'table-danger' : '' }}">
                        <td class="ps-3 text-muted">{{ $borrows->firstItem() + $loop->index }}</td>
                        <td>
                            <a href="{{ route('books.show', $borrow->book) }}"
                               class="fw-semibold text-dark text-decoration-none">
                                {{ Str::limit($borrow->book->title, 25) }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('members.show', $borrow->member) }}"
                               class="text-dark text-decoration-none">
                                {{ $borrow->member->name }}
                            </a>
                        </td>
                        <td>{{ $borrow->borrow_date->format('d M Y') }}</td>
                        <td>
                            <span class="{{ $borrow->isOverdue() ? 'text-danger fw-semibold' : '' }}">
                                {{ $borrow->due_date->format('d M Y') }}
                            </span>
                        </td>
                        <td>{{ $borrow->return_date ? $borrow->return_date->format('d M Y') : '—' }}</td>
                        <td>
                            @if($borrow->fine_amount > 0)
                                <span class="text-danger fw-semibold">${{ number_format($borrow->fine_amount, 2) }}</span>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge badge-{{ $borrow->status }} rounded-pill px-2">
                                {{ ucfirst($borrow->status) }}
                            </span>
                        </td>
                        <td class="text-end pe-3">
                            <div class="d-flex gap-1 justify-content-end">
                                <a href="{{ route('borrows.show', $borrow) }}" class="btn btn-sm btn-outline-info" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>
                                @if($borrow->status !== 'returned')
                                <form action="{{ route('borrows.return', $borrow) }}" method="POST"
                                      onsubmit="return confirm('Mark this book as returned?')">
                                    @csrf @method('PATCH')
                                    <button class="btn btn-sm btn-outline-success" title="Return Book">
                                        <i class="bi bi-check-circle"></i>
                                    </button>
                                </form>
                                <a href="{{ route('borrows.edit', $borrow) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                @endif
                                @if($borrow->status === 'returned')
                                <form action="{{ route('borrows.destroy', $borrow) }}" method="POST"
                                      onsubmit="return confirm('Delete this record?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-5 text-muted">
                            <i class="bi bi-arrow-left-right fs-1 d-block mb-2"></i>No borrow records found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($borrows->hasPages())
    <div class="card-footer bg-white d-flex justify-content-between align-items-center py-2 px-3">
        <small class="text-muted">Showing {{ $borrows->firstItem() }}–{{ $borrows->lastItem() }} of {{ $borrows->total() }}</small>
        {{ $borrows->links() }}
    </div>
    @endif
</div>
@endsection
