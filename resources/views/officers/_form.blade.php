<div class="row g-3">
    <!-- Officer Full Name -->
    <div class="col-12 col-md-6">
        <label for="officer_name" class="form-label fw-semibold">Officer Full Name <span class="text-danger">*</span></label>
        <div class="input-group">
            <span class="input-group-text bg-light text-muted"><i class="bi bi-person"></i></span>
            <input type="text"
                   name="officer_name"
                   id="officer_name"
                   class="form-control @error('officer_name') is-invalid @enderror"
                   value="{{ old('officer_name', $officer->officer_name ?? '') }}"
                   placeholder="e.g. Chan Vandy"
                   required
                   maxlength="255">
        </div>
        @error('officer_name')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

    <!-- Email Address -->
    <div class="col-12 col-md-6">
        <label for="email" class="form-label fw-semibold">Email Address <span class="text-danger">*</span></label>
        <div class="input-group">
            <span class="input-group-text bg-light text-muted"><i class="bi bi-envelope"></i></span>
            <input type="email"
                   name="email"
                   id="email"
                   class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email', $officer->email ?? '') }}"
                   placeholder="e.g. chan.vandy@example.gov.kh"
                   required
                   maxlength="255">
        </div>
        @error('email')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

    <!-- Gender -->
    <div class="col-12 col-md-4">
        <label for="gender" class="form-label fw-semibold">Gender <span class="text-danger">*</span></label>
        <div class="input-group">
            <span class="input-group-text bg-light text-muted"><i class="bi bi-gender-ambiguous"></i></span>
            <select name="gender" id="gender" class="form-select @error('gender') is-invalid @enderror" required>
                <option value="" disabled {{ old('gender', $officer->gender ?? '') ? '' : 'selected' }}>Select Gender</option>
                <option value="Male" {{ old('gender', $officer->gender ?? '') === 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ old('gender', $officer->gender ?? '') === 'Female' ? 'selected' : '' }}>Female</option>
                <option value="Other" {{ old('gender', $officer->gender ?? '') === 'Other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>
        @error('gender')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

    <!-- Date of Birth -->
    <div class="col-12 col-md-4">
        <label for="dob" class="form-label fw-semibold">Date of Birth <span class="text-danger">*</span></label>
        <div class="input-group">
            <span class="input-group-text bg-light text-muted"><i class="bi bi-calendar-event"></i></span>
            <input type="date"
                   name="dob"
                   id="dob"
                   class="form-control @error('dob') is-invalid @enderror"
                   value="{{ old('dob', isset($officer->dob) ? $officer->dob->format('Y-m-d') : '') }}"
                   max="{{ date('Y-m-d') }}"
                   required>
        </div>
        @error('dob')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

    <!-- Phone Number -->
    <div class="col-12 col-md-4">
        <label for="phone" class="form-label fw-semibold">Phone Number <span class="text-danger">*</span></label>
        <div class="input-group">
            <span class="input-group-text bg-light text-muted"><i class="bi bi-telephone"></i></span>
            <input type="text"
                   name="phone"
                   id="phone"
                   class="form-control @error('phone') is-invalid @enderror"
                   value="{{ old('phone', $officer->phone ?? '') }}"
                   placeholder="e.g. +855 12 345 678"
                   required
                   maxlength="30">
        </div>
        @error('phone')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

    <!-- Department Dropdown -->
    <div class="col-12 col-md-6">
        <label for="department_id" class="form-label fw-semibold">Department <span class="text-danger">*</span></label>
        <div class="input-group">
            <span class="input-group-text bg-light text-muted"><i class="bi bi-diagram-3"></i></span>
            <select name="department_id" id="department_id" class="form-select @error('department_id') is-invalid @enderror" required>
                <option value="" disabled {{ old('department_id', $officer->department_id ?? '') ? '' : 'selected' }}>Select Department</option>
                @foreach($departments as $dept)
                    <option value="{{ $dept->id }}" {{ old('department_id', $officer->department_id ?? '') == $dept->id ? 'selected' : '' }}>
                        {{ $dept->department_name }}
                    </option>
                @endforeach
            </select>
        </div>
        @error('department_id')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

    <!-- Position Dropdown -->
    <div class="col-12 col-md-6">
        <label for="position_id" class="form-label fw-semibold">Position <span class="text-danger">*</span></label>
        <div class="input-group">
            <span class="input-group-text bg-light text-muted"><i class="bi bi-briefcase"></i></span>
            <select name="position_id" id="position_id" class="form-select @error('position_id') is-invalid @enderror" required>
                <option value="" disabled {{ old('position_id', $officer->position_id ?? '') ? '' : 'selected' }}>Select Position</option>
                @foreach($positions as $pos)
                    <option value="{{ $pos->id }}" {{ old('position_id', $officer->position_id ?? '') == $pos->id ? 'selected' : '' }}>
                        {{ $pos->position_name }}
                    </option>
                @endforeach
            </select>
        </div>
        @error('position_id')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

    <!-- Hire Date -->
    <div class="col-12 col-md-4">
        <label for="hire_date" class="form-label fw-semibold">Hire Date <span class="text-danger">*</span></label>
        <div class="input-group">
            <span class="input-group-text bg-light text-muted"><i class="bi bi-calendar-check"></i></span>
            <input type="date"
                   name="hire_date"
                   id="hire_date"
                   class="form-control @error('hire_date') is-invalid @enderror"
                   value="{{ old('hire_date', isset($officer->hire_date) ? $officer->hire_date->format('Y-m-d') : date('Y-m-d')) }}"
                   required>
        </div>
        @error('hire_date')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

    <!-- Salary -->
    <div class="col-12 col-md-4">
        <label for="salary" class="form-label fw-semibold">Monthly Salary ($) <span class="text-danger">*</span></label>
        <div class="input-group">
            <span class="input-group-text bg-light text-muted"><i class="bi bi-currency-dollar"></i></span>
            <input type="number"
                   step="0.01"
                   min="0"
                   name="salary"
                   id="salary"
                   class="form-control @error('salary') is-invalid @enderror"
                   value="{{ old('salary', $officer->salary ?? '') }}"
                   placeholder="e.g. 1500.00"
                   required>
        </div>
        @error('salary')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

    <!-- Status -->
    <div class="col-12 col-md-4">
        <label for="status" class="form-label fw-semibold">Employment Status <span class="text-danger">*</span></label>
        <div class="input-group">
            <span class="input-group-text bg-light text-muted"><i class="bi bi-activity"></i></span>
            <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                <option value="Active" {{ old('status', $officer->status ?? 'Active') === 'Active' ? 'selected' : '' }}>Active</option>
                <option value="Inactive" {{ old('status', $officer->status ?? '') === 'Inactive' ? 'selected' : '' }}>Inactive</option>
                <option value="Resigned" {{ old('status', $officer->status ?? '') === 'Resigned' ? 'selected' : '' }}>Resigned</option>
            </select>
        </div>
        @error('status')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

    <!-- Residential Address -->
    <div class="col-12">
        <label for="address" class="form-label fw-semibold">Residential Address <span class="text-danger">*</span></label>
        <textarea name="address"
                  id="address"
                  rows="3"
                  class="form-control @error('address') is-invalid @enderror"
                  placeholder="e.g. #142, Preah Norodom Blvd, Daun Penh, Phnom Penh, Cambodia"
                  required
                  maxlength="500">{{ old('address', $officer->address ?? '') }}</textarea>
        @error('address')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="d-flex align-items-center gap-2 mt-4 pt-2 border-top">
    <button type="submit" class="btn btn-primary px-4">
        <i class="bi bi-check2-circle me-1"></i> {{ isset($officer) ? 'Update Officer Record' : 'Save Officer Record' }}
    </button>
    <a href="{{ route('officers.index') }}" class="btn btn-light border px-4">
        <i class="bi bi-arrow-left me-1"></i> Cancel
    </a>
</div>
