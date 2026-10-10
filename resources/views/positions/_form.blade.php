<div class="mb-3">
    <label for="position_name" class="form-label fw-semibold">Position Title <span class="text-danger">*</span></label>
    <div class="input-group">
        <span class="input-group-text bg-light text-muted"><i class="bi bi-briefcase"></i></span>
        <input type="text"
               name="position_name"
               id="position_name"
               class="form-control @error('position_name') is-invalid @enderror"
               value="{{ old('position_name', $position->position_name ?? '') }}"
               placeholder="e.g. Senior Systems Analyst"
               required
               maxlength="255">
    </div>
    @error('position_name')
        <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror
</div>

<div class="mb-4">
    <label for="description" class="form-label fw-semibold">Description <span class="text-muted fw-normal">(Optional)</span></label>
    <textarea name="description"
              id="description"
              rows="4"
              class="form-control @error('description') is-invalid @enderror"
              placeholder="Outline the responsibilities, required qualifications, and scope of this position...">{{ old('description', $position->description ?? '') }}</textarea>
    @error('description')
        <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror
    <div class="form-text">Provide job description and key roles for this designation.</div>
</div>

<div class="d-flex align-items-center gap-2">
    <button type="submit" class="btn btn-primary px-4">
        <i class="bi bi-check2-circle me-1"></i> {{ isset($position) ? 'Update Position' : 'Save Position' }}
    </button>
    <a href="{{ route('positions.index') }}" class="btn btn-light border px-4">
        <i class="bi bi-arrow-left me-1"></i> Cancel
    </a>
</div>
