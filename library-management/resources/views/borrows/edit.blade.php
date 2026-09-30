@extends('layouts.app')
@section('title', 'Edit Borrow Record — LibraryMS')
@section('breadcrumb', 'Borrow Records / Edit')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold text-primary mb-0"><i class="bi bi-pencil-square me-2"></i>Edit Borrow Record</h4>
    <a href="{{ route('borrows.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Back
    </a>
</div>

<div class="card" style="max-width:600px">
    <div class="card-body">
        {{-- Read-only info --}}
        <div class="alert alert-info d-flex gap-3 align-items-start">
            <i class="bi bi-info-circle-fill fs-5"></i>
            <div>
                <strong>Book:</strong> {{ $borrow->book->title }}<br>
                <strong>Member:</strong> {{ $borrow->member->name }}<br>
                <strong>Borrowed:</strong> {{ $borrow->borrow_date->format('d M Y') }}
            </div>
        </div>

        <form action="{{ route('borrows.update', $borrow) }}" method="POST">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label fw-semibold">New Due Date <span class="text-danger">*</span></label>
                    <input type="date" name="due_date"
                           class="form-control @error('due_date') is-invalid @enderror"
                           value="{{ old('due_date', $borrow->due_date->format('Y-m-d')) }}" required>
                    @error('due_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Notes</label>
                    <textarea name="notes" rows="3" class="form-control">{{ old('notes', $borrow->notes) }}</textarea>
                </div>
            </div>
            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-save me-1"></i> Update
                </button>
                <a href="{{ route('borrows.index') }}" class="btn btn-outline-secondary px-4">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
