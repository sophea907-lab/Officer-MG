<div class="mb-3">
    <label for="department_name" class="form-label fw-semibold">Department Name <span class="text-danger">*</span></label>
    <div class="input-group">
        <span class="input-group-text bg-light text-muted"><i class="bi bi-diagram-3"></i></span>
        <input type="text"
               name="department_name"
               id="department_name"
               class="form-control @error('department_name') is-invalid @enderror"
               value="{{ old('department_name', $department->department_name ?? '') }}"
               placeholder="e.g. Human Resources & Talent"
               required
               maxlength="255">
    </div>
    @error('department_name')
        <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror
</div>

<div class="mb-4">
    <label for="description" class="form-label fw-semibold">Description <span class="text-muted fw-normal">(Optional)</span></label>
    <textarea name="description"
              id="description"
              rows="4"
              class="form-control @error('description') is-invalid @enderror"
              placeholder="Describe the department's role, duties, and core operations...">{{ old('description', $department->description ?? '') }}</textarea>
    @error('description')
        <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror
    <div class="form-text">Briefly outline the responsibilities and scope of this department.</div>
</div>

<div class="d-flex align-items-center gap-2">
    <button type="submit" class="btn btn-primary px-4">
        <i class="bi bi-check2-circle me-1"></i> {{ isset($department) ? 'Update Department' : 'Save Department' }}
    </button>
    <a href="{{ route('departments.index') }}" class="btn btn-light border px-4">
        <i class="bi bi-arrow-left me-1"></i> Cancel
    </a>
</div>
