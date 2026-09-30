@extends('layouts.app')

@section('title', 'Edit Book — LibraryMS')
@section('breadcrumb', 'Books / Edit')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold text-primary mb-0"><i class="bi bi-pencil-square me-2"></i>Edit Book</h4>
    <a href="{{ route('books.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Back
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('books.update', $book) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            @include('books._form')
            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-save me-1"></i> Update Book
                </button>
                <a href="{{ route('books.index') }}" class="btn btn-outline-secondary px-4">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
