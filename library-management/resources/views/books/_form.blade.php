<div class="row g-3">
    <div class="col-md-8">
        <label class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
               value="{{ old('title', $book->title ?? '') }}" required>
        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">ISBN <span class="text-danger">*</span></label>
        <input type="text" name="isbn" class="form-control @error('isbn') is-invalid @enderror"
               value="{{ old('isbn', $book->isbn ?? '') }}" required>
        @error('isbn')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Author <span class="text-danger">*</span></label>
        <select name="author_id" class="form-select @error('author_id') is-invalid @enderror" required>
            <option value="">— Select Author —</option>
            @foreach($authors as $author)
                <option value="{{ $author->id }}"
                    {{ old('author_id', $book->author_id ?? '') == $author->id ? 'selected' : '' }}>
                    {{ $author->name }}
                </option>
            @endforeach
        </select>
        @error('author_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Category <span class="text-danger">*</span></label>
        <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
            <option value="">— Select Category —</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}"
                    {{ old('category_id', $book->category_id ?? '') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Publisher</label>
        <input type="text" name="publisher" class="form-control"
               value="{{ old('publisher', $book->publisher ?? '') }}">
    </div>

    <div class="col-md-2">
        <label class="form-label fw-semibold">Published Year</label>
        <input type="number" name="published_year" class="form-control @error('published_year') is-invalid @enderror"
               value="{{ old('published_year', $book->published_year ?? '') }}" min="1000" max="{{ date('Y') }}">
        @error('published_year')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-2">
        <label class="form-label fw-semibold">Total Copies <span class="text-danger">*</span></label>
        <input type="number" name="total_copies" class="form-control @error('total_copies') is-invalid @enderror"
               value="{{ old('total_copies', $book->total_copies ?? 1) }}" min="1" required>
        @error('total_copies')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-2">
        <label class="form-label fw-semibold">Available Copies <span class="text-danger">*</span></label>
        <input type="number" name="available_copies" class="form-control @error('available_copies') is-invalid @enderror"
               value="{{ old('available_copies', $book->available_copies ?? 1) }}" min="0" required>
        @error('available_copies')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-2">
        <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
            <option value="available"   {{ old('status', $book->status ?? 'available') === 'available'   ? 'selected' : '' }}>Available</option>
            <option value="unavailable" {{ old('status', $book->status ?? '') === 'unavailable' ? 'selected' : '' }}>Unavailable</option>
        </select>
        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Description</label>
        <textarea name="description" rows="3" class="form-control">{{ old('description', $book->description ?? '') }}</textarea>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Cover Image</label>
        <input type="file" name="cover_image" class="form-control @error('cover_image') is-invalid @enderror"
               accept="image/*">
        @error('cover_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
        @if(!empty($book->cover_image))
            <div class="mt-2">
                <img src="{{ asset('storage/' . $book->cover_image) }}"
                     alt="Cover" class="rounded" style="height:80px;object-fit:cover">
            </div>
        @endif
    </div>
</div>
