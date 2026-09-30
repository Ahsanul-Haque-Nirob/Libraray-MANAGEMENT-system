<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label fw-semibold">Category Name <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $category->name ?? '') }}" required>
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-12">
        <label class="form-label fw-semibold">Description</label>
        <textarea name="description" rows="3" class="form-control">{{ old('description', $category->description ?? '') }}</textarea>
    </div>
</div>
