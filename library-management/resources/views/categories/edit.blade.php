@extends('layouts.app')
@section('title', 'Edit Category — LibraryMS')
@section('breadcrumb', 'Categories / Edit')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold text-primary mb-0"><i class="bi bi-pencil-square me-2"></i>Edit Category</h4>
    <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Back
    </a>
</div>
<div class="card" style="max-width:600px">
    <div class="card-body">
        <form action="{{ route('categories.update', $category) }}" method="POST">
            @csrf @method('PUT')
            @include('categories._form')
            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-save me-1"></i> Update
                </button>
                <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary px-4">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
