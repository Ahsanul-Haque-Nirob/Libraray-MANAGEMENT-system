@extends('layouts.app')
@section('title', 'Members — LibraryMS')
@section('breadcrumb', 'Members')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold text-primary mb-0"><i class="bi bi-people me-2"></i>Members</h4>
    <a href="{{ route('members.create') }}" class="btn btn-primary">
        <i class="bi bi-person-plus me-1"></i> Add Member
    </a>
</div>

{{-- Filters --}}
<div class="card mb-3">
    <div class="card-body py-2">
        <form method="GET" action="{{ route('members.index') }}" class="row g-2 align-items-center">
            <div class="col-md-6">
                <input type="text" name="search" class="form-control form-control-sm"
                       placeholder="Search by name, email or member code…" value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select form-select-sm">
                    <option value="">All Status</option>
                    <option value="active"    {{ request('status') === 'active'    ? 'selected' : '' }}>Active</option>
                    <option value="inactive"  {{ request('status') === 'inactive'  ? 'selected' : '' }}>Inactive</option>
                    <option value="suspended" {{ request('status') === 'suspended' ? 'selected' : '' }}>Suspended</option>
                </select>
            </div>
            <div class="col-md-3 d-flex gap-1">
                <button type="submit" class="btn btn-sm btn-primary w-100">Filter</button>
                <a href="{{ route('members.index') }}" class="btn btn-sm btn-outline-secondary">Clear</a>
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
                        <th>Name</th>
                        <th>Member Code</th>
                        <th>Email</th>
                        <th>Membership End</th>
                        <th>Active Borrows</th>
                        <th>Status</th>
                        <th class="text-end pe-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($members as $member)
                    <tr>
                        <td class="ps-3 text-muted">{{ $members->firstItem() + $loop->index }}</td>
                        <td>
                            <a href="{{ route('members.show', $member) }}"
                               class="fw-semibold text-dark text-decoration-none">
                                {{ $member->name }}
                            </a>
                        </td>
                        <td><code>{{ $member->member_code }}</code></td>
                        <td>{{ $member->email }}</td>
                        <td>
                            <span class="{{ $member->membership_end->isPast() ? 'text-danger' : 'text-success' }}">
                                {{ $member->membership_end->format('d M Y') }}
                            </span>
                        </td>
                        <td>
                            @if($member->active_borrows_count > 0)
                                <span class="badge bg-warning text-dark rounded-pill">{{ $member->active_borrows_count }}</span>
                            @else
                                <span class="text-muted">0</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge badge-{{ $member->status }} rounded-pill px-2">
                                {{ ucfirst($member->status) }}
                            </span>
                        </td>
                        <td class="text-end pe-3">
                            <div class="d-flex gap-1 justify-content-end">
                                <a href="{{ route('members.show', $member) }}" class="btn btn-sm btn-outline-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('members.edit', $member) }}" class="btn btn-sm btn-outline-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('members.destroy', $member) }}" method="POST"
                                      onsubmit="return confirm('Delete this member?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="bi bi-people fs-1 d-block mb-2"></i>No members found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($members->hasPages())
    <div class="card-footer bg-white d-flex justify-content-between align-items-center py-2 px-3">
        <small class="text-muted">Showing {{ $members->firstItem() }}–{{ $members->lastItem() }} of {{ $members->total() }}</small>
        {{ $members->links() }}
    </div>
    @endif
</div>
@endsection
