@extends('layouts.app')
@section('title', 'Issue Book — LibraryMS')
@section('breadcrumb', 'Borrow Records / Issue Book')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold text-primary mb-0"><i class="bi bi-plus-circle me-2"></i>Issue Book</h4>
    <a href="{{ route('borrows.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Back
    </a>
</div>

<div class="card" style="max-width:700px">
    <div class="card-body">
        <form action="{{ route('borrows.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label fw-semibold">Book <span class="text-danger">*</span></label>
                    <select name="book_id" class="form-select @error('book_id') is-invalid @enderror" required>
                        <option value="">— Select an Available Book —</option>
                        @foreach($books as $book)
                        <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>
                            {{ $book->title }} — {{ $book->author->name }}
                            ({{ $book->available_copies }} available)
                        </option>
                        @endforeach
                    </select>
                    @error('book_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold">Member <span class="text-danger">*</span></label>
                    <select name="member_id" class="form-select @error('member_id') is-invalid @enderror" required>
                        <option value="">— Select a Member —</option>
                        @foreach($members as $member)
                        <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>
                            {{ $member->name }} — {{ $member->member_code }}
                        </option>
                        @endforeach
                    </select>
                    @error('member_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Borrow Date <span class="text-danger">*</span></label>
                    <input type="date" name="borrow_date"
                           class="form-control @error('borrow_date') is-invalid @enderror"
                           value="{{ old('borrow_date', now()->toDateString()) }}" required>
                    @error('borrow_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Due Date <span class="text-danger">*</span></label>
                    <input type="date" name="due_date"
                           class="form-control @error('due_date') is-invalid @enderror"
                           value="{{ old('due_date', now()->addDays(14)->toDateString()) }}" required>
                    @error('due_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold">Notes</label>
                    <textarea name="notes" rows="2" class="form-control"
                              placeholder="Optional notes…">{{ old('notes') }}</textarea>
                </div>
            </div>

            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-arrow-right-circle me-1"></i> Issue Book
                </button>
                <a href="{{ route('borrows.index') }}" class="btn btn-outline-secondary px-4">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
