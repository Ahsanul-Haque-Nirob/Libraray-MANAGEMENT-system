<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label fw-semibold">Full Name <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $author->name ?? '') }}" required>
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Email</label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
               value="{{ old('email', $author->email ?? '') }}">
        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Nationality</label>
        <input type="text" name="nationality" class="form-control"
               value="{{ old('nationality', $author->nationality ?? '') }}">
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Birth Date</label>
        <input type="date" name="birth_date" class="form-control @error('birth_date') is-invalid @enderror"
               value="{{ old('birth_date', isset($author->birth_date) ? $author->birth_date->format('Y-m-d') : '') }}">
        @error('birth_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-12">
        <label class="form-label fw-semibold">Biography</label>
        <textarea name="bio" rows="4" class="form-control">{{ old('bio', $author->bio ?? '') }}</textarea>
    </div>
</div>
