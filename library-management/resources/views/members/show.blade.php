@extends('layouts.app')
@section('title', $member->name . ' — LibraryMS')
@section('breadcrumb', 'Members / Detail')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold text-primary mb-0"><i class="bi bi-person me-2"></i>Member Detail</h4>
    <div class="d-flex gap-2">
        <a href="{{ route('members.edit', $member) }}" class="btn btn-warning btn-sm">
            <i class="bi bi-pencil me-1"></i> Edit
        </a>
        <a href="{{ route('members.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
    </div>
</div>

<div class="row g-3">
    <div class="col-lg-4">
        <div class="card text-center">
            <div class="card-body py-4">
                <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center
                            justify-content-center mb-3" style="width:80px;height:80px;font-size:2rem">
                    <i class="bi bi-person"></i>
                </div>
                <h5 class="fw-bold mb-1">{{ $member->name }}</h5>
                <p class="mb-1"><code>{{ $member->member_code }}</code></p>
                <span class="badge badge-{{ $member->status }} rounded-pill px-3 py-1">
                    {{ ucfirst($member->status) }}
                </span>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <div class="mb-3">
                    <div class="text-muted small">Email</div>
                    <div>{{ $member->email }}</div>
                </div>
                @if($member->phone)
                <div class="mb-3">
                    <div class="text-muted small">Phone</div>
                    <div>{{ $member->phone }}</div>
                </div>
                @endif
                @if($member->address)
                <div class="mb-3">
                    <div class="text-muted small">Address</div>
                    <div>{{ $member->address }}</div>
                </div>
                @endif
                <div class="mb-3">
                    <div class="text-muted small">Membership Period</div>
                    <div>{{ $member->membership_start->format('d M Y') }} →
                        <span class="{{ $member->membership_end->isPast() ? 'text-danger fw-semibold' : 'text-success' }}">
                            {{ $member->membership_end->format('d M Y') }}
                        </span>
                    </div>
                </div>
                <div>
                    <div class="text-muted small">Total Fines</div>
                    <div class="fw-semibold {{ $member->total_fines > 0 ? 'text-danger' : 'text-success' }}">
                        ${{ number_format($member->total_fines, 2) }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center py-3">
                <span><i class="bi bi-arrow-left-right me-2 text-primary"></i>Borrow History</span>
                <a href="{{ route('borrows.create') }}?member_id={{ $member->id }}"
                   class="btn btn-sm btn-primary">
                    <i class="bi bi-plus me-1"></i>Issue Book
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="ps-3">Book</th>
                                <th>Borrowed</th>
                                <th>Due</th>
                                <th>Returned</th>
                                <th>Fine</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($borrows as $b)
                            <tr>
                                <td class="ps-3">
                                    <a href="{{ route('books.show', $b->book) }}"
                                       class="text-dark text-decoration-none fw-semibold">
                                        {{ Str::limit($b->book->title, 25) }}
                                    </a>
                                </td>
                                <td>{{ $b->borrow_date->format('d M Y') }}</td>
                                <td>{{ $b->due_date->format('d M Y') }}</td>
                                <td>{{ $b->return_date ? $b->return_date->format('d M Y') : '—' }}</td>
                                <td>
                                    @if($b->fine_amount > 0)
                                        <span class="text-danger fw-semibold">${{ $b->fine_amount }}</span>
                                    @else
                                        <span class="text-muted">$0.00</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge badge-{{ $b->status }} rounded-pill px-2">
                                        {{ ucfirst($b->status) }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="6" class="text-center text-muted py-4">No borrow records.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($borrows->hasPages())
            <div class="card-footer">{{ $borrows->links() }}</div>
            @endif
        </div>
    </div>
</div>
@endsection
