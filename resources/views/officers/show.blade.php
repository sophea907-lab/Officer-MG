@extends('layouts.app')

@section('title', $officer->officer_name)
@section('page-title', 'Officer Profile')
@section('page-subtitle', 'Detailed record for ' . $officer->officer_name)

@section('content')
<div class="row g-4">
    <!-- Left Column: Summary Card -->
    <div class="col-12 col-lg-4">
        <div class="card shadow-sm border-0 text-center p-4">
            <div class="rounded-circle bg-primary bg-opacity-10 text-primary fw-bold d-flex align-items-center justify-content-center mx-auto mb-3 shadow-sm" style="width: 88px; height: 88px; font-size: 2.2rem;">
                {{ strtoupper(substr($officer->officer_name, 0, 1)) }}
            </div>
            <h4 class="fw-bold mb-1 text-dark">{{ $officer->officer_name }}</h4>
            <div class="text-muted small mb-2">{{ $officer->position->position_name ?? 'Unassigned Position' }}</div>
            <div class="mb-3">
                @if($officer->status === 'Active')
                    <span class="badge badge-status badge-active">
                        <i class="bi bi-check-circle-fill"></i> Active Status
                    </span>
                @elseif($officer->status === 'Inactive')
                    <span class="badge badge-status badge-inactive">
                        <i class="bi bi-pause-circle-fill"></i> Inactive Status
                    </span>
                @else
                    <span class="badge badge-status badge-resigned">
                        <i class="bi bi-x-circle-fill"></i> Resigned Status
                    </span>
                @endif
            </div>

            <hr class="my-3 text-muted">

            <div class="text-start">
                <div class="d-flex align-items-center gap-2 mb-2 text-muted small">
                    <i class="bi bi-envelope text-primary"></i>
                    <a href="mailto:{{ $officer->email }}" class="text-decoration-none text-dark">{{ $officer->email }}</a>
                </div>
                <div class="d-flex align-items-center gap-2 mb-2 text-muted small">
                    <i class="bi bi-telephone text-primary"></i>
                    <span>{{ $officer->phone }}</span>
                </div>
                <div class="d-flex align-items-center gap-2 mb-2 text-muted small">
                    <i class="bi bi-diagram-3 text-primary"></i>
                    <span>{{ $officer->department->department_name ?? 'Unassigned' }}</span>
                </div>
                <div class="d-flex align-items-center gap-2 text-muted small">
                    <i class="bi bi-calendar-check text-primary"></i>
                    <span>Hired: {{ $officer->hire_date ? $officer->hire_date->format('M d, Y') : 'N/A' }}</span>
                </div>
            </div>

            <div class="d-grid gap-2 mt-4 pt-2">
                <a href="{{ route('officers.edit', $officer) }}" class="btn btn-primary">
                    <i class="bi bi-pencil-square me-1"></i> Edit Profile
                </a>
                <button type="button"
                        class="btn btn-outline-danger"
                        data-bs-toggle="modal"
                        data-bs-target="#deleteConfirmModal"
                        data-action="{{ route('officers.destroy', $officer) }}"
                        data-name="Officer: {{ $officer->officer_name }}">
                    <i class="bi bi-trash me-1"></i> Delete Officer
                </button>
                <a href="{{ route('officers.index') }}" class="btn btn-light border text-muted">
                    <i class="bi bi-arrow-left me-1"></i> Back to Directory
                </a>
            </div>
        </div>
    </div>

    <!-- Right Column: Comprehensive Details -->
    <div class="col-12 col-lg-8">
        <!-- Employment & Personal Information Card -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white py-3">
                <span class="fw-bold text-dark">
                    <i class="bi bi-person-lines-fill text-primary me-2"></i> Personal & Contact Information
                </span>
            </div>
            <div class="card-body p-4">
                <div class="row g-3">
                    <div class="col-sm-6">
                        <label class="text-muted small fw-semibold d-block">Officer Identification</label>
                        <span class="fw-bold text-dark fs-6">#OFF-{{ str_pad($officer->id, 5, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <div class="col-sm-6">
                        <label class="text-muted small fw-semibold d-block">Full Legal Name</label>
                        <span class="fw-semibold text-dark">{{ $officer->officer_name }}</span>
                    </div>
                    <div class="col-sm-6">
                        <label class="text-muted small fw-semibold d-block">Gender</label>
                        <span>{{ $officer->gender }}</span>
                    </div>
                    <div class="col-sm-6">
                        <label class="text-muted small fw-semibold d-block">Date of Birth</label>
                        <span>{{ $officer->dob ? $officer->dob->format('F d, Y') : 'N/A' }} ({{ $officer->dob ? $officer->dob->age . ' years old' : '' }})</span>
                    </div>
                    <div class="col-sm-6">
                        <label class="text-muted small fw-semibold d-block">Email Address</label>
                        <span>{{ $officer->email }}</span>
                    </div>
                    <div class="col-sm-6">
                        <label class="text-muted small fw-semibold d-block">Contact Phone</label>
                        <span>{{ $officer->phone }}</span>
                    </div>
                    <div class="col-12">
                        <label class="text-muted small fw-semibold d-block">Residential Address</label>
                        <p class="mb-0 text-dark">{{ $officer->address }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Organizational & Financial Information Card -->
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <span class="fw-bold text-dark">
                    <i class="bi bi-briefcase-fill text-primary me-2"></i> Organizational & Compensation Details
                </span>
            </div>
            <div class="card-body p-4">
                <div class="row g-3">
                    <div class="col-sm-6">
                        <label class="text-muted small fw-semibold d-block">Assigned Department</label>
                        <span class="badge badge-dept fs-6 mb-1">{{ $officer->department->department_name ?? 'Unassigned' }}</span>
                        @if(!empty($officer->department->description))
                            <p class="text-muted small mb-0">{{ $officer->department->description }}</p>
                        @endif
                    </div>
                    <div class="col-sm-6">
                        <label class="text-muted small fw-semibold d-block">Designated Position</label>
                        <span class="badge badge-pos fs-6 mb-1">{{ $officer->position->position_name ?? 'Unassigned' }}</span>
                        @if(!empty($officer->position->description))
                            <p class="text-muted small mb-0">{{ $officer->position->description }}</p>
                        @endif
                    </div>
                    <div class="col-sm-6">
                        <label class="text-muted small fw-semibold d-block">Employment Hire Date</label>
                        <span class="text-dark fw-semibold">{{ $officer->hire_date ? $officer->hire_date->format('F d, Y') : 'N/A' }}</span>
                    </div>
                    <div class="col-sm-6">
                        <label class="text-muted small fw-semibold d-block">Base Monthly Salary</label>
                        <span class="text-success fw-bold fs-5">${{ number_format($officer->salary, 2) }}</span>
                    </div>
                    <div class="col-sm-6">
                        <label class="text-muted small fw-semibold d-block">Record Registered</label>
                        <span class="text-muted small">{{ $officer->created_at ? $officer->created_at->format('M d, Y h:i A') : 'N/A' }}</span>
                    </div>
                    <div class="col-sm-6">
                        <label class="text-muted small fw-semibold d-block">Last Updated</label>
                        <span class="text-muted small">{{ $officer->updated_at ? $officer->updated_at->format('M d, Y h:i A') : 'N/A' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
