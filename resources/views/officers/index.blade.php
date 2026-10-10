@extends('layouts.app')

@section('title', 'Officers')
@section('page-title', 'Officers Management')
@section('page-subtitle', 'Maintain and monitor active personnel records')

@section('content')
<!-- Filter & Search Toolbar -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-body p-3">
        <form method="GET" action="{{ route('officers.index') }}">
            <div class="row g-2 align-items-center">
                <!-- Search -->
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="input-group">
                        <span class="input-group-text bg-light text-muted border-end-0"><i class="bi bi-search"></i></span>
                        <input type="text"
                               name="search"
                               class="form-control border-start-0 ps-0"
                               placeholder="Search name, email, phone..."
                               value="{{ $search ?? '' }}">
                    </div>
                </div>

                <!-- Department Filter -->
                <div class="col-6 col-md-3 col-lg-3">
                    <select name="department_id" class="form-select">
                        <option value="">All Departments</option>
                        @foreach($departments as $dept)
                            <option value="{{ $dept->id }}" {{ ($departmentId ?? '') == $dept->id ? 'selected' : '' }}>
                                {{ $dept->department_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Position Filter -->
                <div class="col-6 col-md-3 col-lg-2">
                    <select name="position_id" class="form-select">
                        <option value="">All Positions</option>
                        @foreach($positions as $pos)
                            <option value="{{ $pos->id }}" {{ ($positionId ?? '') == $pos->id ? 'selected' : '' }}>
                                {{ $pos->position_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Status Filter -->
                <div class="col-6 col-md-2 col-lg-2">
                    <select name="status" class="form-select">
                        <option value="">All Statuses</option>
                        <option value="Active" {{ ($status ?? '') === 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="Inactive" {{ ($status ?? '') === 'Inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="Resigned" {{ ($status ?? '') === 'Resigned' ? 'selected' : '' }}>Resigned</option>
                    </select>
                </div>

                <!-- Action Buttons -->
                <div class="col-6 col-md-12 col-lg-2 d-flex gap-2 justify-content-lg-end">
                    <button type="submit" class="btn btn-primary flex-fill flex-lg-grow-0" title="Apply Filter">
                        <i class="bi bi-funnel-fill me-1"></i> Filter
                    </button>
                    @if(!empty($search) || !empty($departmentId) || !empty($positionId) || !empty($status))
                        <a href="{{ route('officers.index') }}" class="btn btn-outline-secondary" title="Reset Filters">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Header with Total & Add Action -->
<div class="d-flex justify-content-between align-items-center mb-3">
    <div class="text-muted small">
        Found <strong>{{ $officers->total() }}</strong> officer record{{ $officers->total() === 1 ? '' : 's' }}
    </div>
    <a href="{{ route('officers.create') }}" class="btn btn-primary">
        <i class="bi bi-person-plus-fill me-1"></i> Add New Officer
    </a>
</div>

<!-- Records Table -->
<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 60px;">#ID</th>
                        <th>Officer Name</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Department</th>
                        <th>Position</th>
                        <th class="text-center" style="width: 110px;">Status</th>
                        <th class="text-end" style="width: 140px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($officers as $officer)
                        <tr>
                            <td class="text-muted fw-semibold">{{ $officer->id }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rounded-circle bg-light border text-primary fw-bold d-flex align-items-center justify-content-center" style="width: 34px; height: 34px; min-width: 34px; font-size: 0.8rem;">
                                        {{ strtoupper(substr($officer->officer_name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <a href="{{ route('officers.show', $officer) }}" class="fw-semibold text-dark text-decoration-none hover-primary">
                                            {{ $officer->officer_name }}
                                        </a>
                                        <div class="text-muted small d-md-none">{{ $officer->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-light text-secondary border">
                                    {{ $officer->gender }}
                                </span>
                            </td>
                            <td>
                                <a href="mailto:{{ $officer->email }}" class="text-muted text-decoration-none small">
                                    <i class="bi bi-envelope text-secondary me-1"></i>{{ $officer->email }}
                                </a>
                            </td>
                            <td class="text-nowrap small text-muted">
                                <i class="bi bi-telephone text-secondary me-1"></i>{{ $officer->phone }}
                            </td>
                            <td>
                                <span class="badge badge-dept">
                                    {{ $officer->department->department_name ?? 'Unassigned' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge badge-pos">
                                    {{ $officer->position->position_name ?? 'Unassigned' }}
                                </span>
                            </td>
                            <td class="text-center">
                                @if($officer->status === 'Active')
                                    <span class="badge badge-status badge-active">
                                        <i class="bi bi-check-circle-fill"></i> Active
                                    </span>
                                @elseif($officer->status === 'Inactive')
                                    <span class="badge badge-status badge-inactive">
                                        <i class="bi bi-pause-circle-fill"></i> Inactive
                                    </span>
                                @else
                                    <span class="badge badge-status badge-resigned">
                                        <i class="bi bi-x-circle-fill"></i> Resigned
                                    </span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('officers.show', $officer) }}" class="btn btn-light border text-info" title="View Details">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('officers.edit', $officer) }}" class="btn btn-light border text-primary" title="Edit Officer">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <button type="button"
                                            class="btn btn-light border text-danger"
                                            title="Delete Officer"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteConfirmModal"
                                            data-action="{{ route('officers.destroy', $officer) }}"
                                            data-name="Officer: {{ $officer->officer_name }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="bi bi-person-x fs-1 d-block mb-2 text-secondary"></i>
                                    <h6 class="fw-semibold">No Officers Found</h6>
                                    <p class="small mb-3">No officer records match your selected filter criteria.</p>
                                    <a href="{{ route('officers.index') }}" class="btn btn-sm btn-outline-primary me-2">Clear All Filters</a>
                                    <a href="{{ route('officers.create') }}" class="btn btn-sm btn-primary">Add Officer</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($officers->hasPages())
        <div class="card-footer bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <small class="text-muted">
                    Showing {{ $officers->firstItem() }} to {{ $officers->lastItem() }} of {{ $officers->total() }} records
                </small>
                <div>
                    {{ $officers->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
