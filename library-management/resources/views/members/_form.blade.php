<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label fw-semibold">Full Name <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $member->name ?? '') }}" required>
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
               value="{{ old('email', $member->email ?? '') }}" required>
        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Phone</label>
        <input type="text" name="phone" class="form-control"
               value="{{ old('phone', $member->phone ?? '') }}">
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
            <option value="active"    {{ old('status', $member->status ?? 'active') === 'active'    ? 'selected' : '' }}>Active</option>
            <option value="inactive"  {{ old('status', $member->status ?? '') === 'inactive'  ? 'selected' : '' }}>Inactive</option>
            <option value="suspended" {{ old('status', $member->status ?? '') === 'suspended' ? 'selected' : '' }}>Suspended</option>
        </select>
        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Membership Start <span class="text-danger">*</span></label>
        <input type="date" name="membership_start" class="form-control @error('membership_start') is-invalid @enderror"
               value="{{ old('membership_start', isset($member->membership_start) ? $member->membership_start->format('Y-m-d') : '') }}" required>
        @error('membership_start')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Membership End <span class="text-danger">*</span></label>
        <input type="date" name="membership_end" class="form-control @error('membership_end') is-invalid @enderror"
               value="{{ old('membership_end', isset($member->membership_end) ? $member->membership_end->format('Y-m-d') : '') }}" required>
        @error('membership_end')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-12">
        <label class="form-label fw-semibold">Address</label>
        <textarea name="address" rows="2" class="form-control">{{ old('address', $member->address ?? '') }}</textarea>
    </div>
</div>
