@extends('layouts.app')
@section('title', 'Authors — LibraryMS')
@section('breadcrumb', 'Authors')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold text-primary mb-0"><i class="bi bi-person-lines-fill me-2"></i>Authors</h4>
    <a href="{{ route('authors.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i> Add Author
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th class="ps-3">#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Nationality</th>
                        <th>Books</th>
                        <th class="text-end pe-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($authors as $author)
                    <tr>
                        <td class="ps-3 text-muted">{{ $authors->firstItem() + $loop->index }}</td>
                        <td>
                            <a href="{{ route('authors.show', $author) }}"
                               class="fw-semibold text-dark text-decoration-none">
                                {{ $author->name }}
                            </a>
                        </td>
                        <td>{{ $author->email ?? '—' }}</td>
                        <td>{{ $author->nationality ?? '—' }}</td>
                        <td>
                            <span class="badge bg-primary rounded-pill">{{ $author->books_count }}</span>
                        </td>
                        <td class="text-end pe-3">
                            <div class="d-flex gap-1 justify-content-end">
                                <a href="{{ route('authors.show', $author) }}" class="btn btn-sm btn-outline-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('authors.edit', $author) }}" class="btn btn-sm btn-outline-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('authors.destroy', $author) }}" method="POST"
                                      onsubmit="return confirm('Delete this author?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-person-lines-fill fs-1 d-block mb-2"></i>No authors found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($authors->hasPages())
    <div class="card-footer bg-white d-flex justify-content-between align-items-center py-2 px-3">
        <small class="text-muted">Showing {{ $authors->firstItem() }}–{{ $authors->lastItem() }} of {{ $authors->total() }}</small>
        {{ $authors->links() }}
    </div>
    @endif
</div>
@endsection
