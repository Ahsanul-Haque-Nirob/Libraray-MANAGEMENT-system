@extends('layouts.app')
@section('title', 'Categories — LibraryMS')
@section('breadcrumb', 'Categories')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold text-primary mb-0"><i class="bi bi-tag me-2"></i>Categories</h4>
    <a href="{{ route('categories.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i> Add Category
    </a>
</div>

<div class="row g-3">
    @forelse($categories as $category)
    <div class="col-md-4 col-lg-3">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <h6 class="fw-bold mb-0">{{ $category->name }}</h6>
                    <span class="badge bg-primary rounded-pill">{{ $category->books_count }} books</span>
                </div>
                @if($category->description)
                <p class="text-muted mb-0" style="font-size:.85rem">{{ Str::limit($category->description, 80) }}</p>
                @endif
            </div>
            <div class="card-footer bg-white d-flex gap-2 py-2">
                <a href="{{ route('categories.show', $category) }}" class="btn btn-sm btn-outline-info flex-grow-1">
                    <i class="bi bi-eye me-1"></i>View
                </a>
                <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-outline-warning">
                    <i class="bi bi-pencil"></i>
                </a>
                <form action="{{ route('categories.destroy', $category) }}" method="POST"
                      onsubmit="return confirm('Delete this category?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card">
            <div class="card-body text-center py-5 text-muted">
                <i class="bi bi-tag fs-1 d-block mb-2"></i>No categories found.
            </div>
        </div>
    </div>
    @endforelse
</div>

@if($categories->hasPages())
<div class="d-flex justify-content-center mt-4">{{ $categories->links() }}</div>
@endif
@endsection
