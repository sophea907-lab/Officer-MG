@extends('layouts.app')

@section('title', 'Departments')
@section('page-title', 'Departments')
@section('page-subtitle', 'Manage organizational units and departments')

@section('content')
<div class="row align-items-center mb-4 g-3">
    <div class="col-12 col-md-6">
        <form method="GET" action="{{ route('departments.index') }}" class="d-flex gap-2">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                <input type="text"
                       name="search"
                       class="form-control border-start-0 ps-0"
                       placeholder="Search department name or description..."
                       value="{{ $search ?? '' }}">
                @if(!empty($search))
                    <a href="{{ route('departments.index') }}" class="btn btn-outline-secondary" title="Clear Search">
                        <i class="bi bi-x-lg"></i>
                    </a>
                @endif
            </div>
            <button type="submit" class="btn btn-primary px-3">Search</button>
        </form>
    </div>
    <div class="col-12 col-md-6 text-md-end">
        <a href="{{ route('departments.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Add Department
        </a>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
        <div class="fw-bold text-dark">
            <i class="bi bi-diagram-3-fill text-primary me-2"></i> Department List
            <span class="badge bg-secondary ms-2 fw-normal">{{ $departments->total() }} Total</span>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 70px;">#ID</th>
                        <th>Department Name</th>
                        <th>Description</th>
                        <th class="text-center" style="width: 150px;">Assigned Officers</th>
                        <th style="width: 150px;">Created Date</th>
                        <th class="text-end" style="width: 140px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($departments as $dept)
                        <tr>
                            <td class="text-muted fw-semibold">{{ $dept->id }}</td>
                            <td>
                                <div class="fw-semibold text-dark">{{ $dept->department_name }}</div>
                            </td>
                            <td>
                                <div class="text-muted small text-truncate" style="max-width: 320px;">
                                    {{ $dept->description ?: 'No description provided' }}
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="badge badge-dept px-2 py-1">
                                    <i class="bi bi-people-fill me-1"></i> {{ $dept->officers_count }} Officer{{ $dept->officers_count === 1 ? '' : 's' }}
                                </span>
                            </td>
                            <td class="text-muted small">
                                {{ $dept->created_at ? $dept->created_at->format('M d, Y') : 'N/A' }}
                            </td>
                            <td class="text-end">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('departments.edit', $dept) }}" class="btn btn-light border text-primary" title="Edit Department">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <button type="button"
                                            class="btn btn-light border text-danger"
                                            title="Delete Department"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteConfirmModal"
                                            data-action="{{ route('departments.destroy', $dept) }}"
                                            data-name="Department: {{ $dept->department_name }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                                    <h6 class="fw-semibold">No Departments Found</h6>
                                    <p class="small mb-3">
                                        @if(!empty($search))
                                            No departments match your search "{{ $search }}". Try clearing the filter.
                                        @else
                                            Start by adding the first organizational department.
                                        @endif
                                    </p>
                                    @if(!empty($search))
                                        <a href="{{ route('departments.index') }}" class="btn btn-sm btn-outline-primary">Reset Search</a>
                                    @else
                                        <a href="{{ route('departments.create') }}" class="btn btn-sm btn-primary">Add Department</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($departments->hasPages())
        <div class="card-footer bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <small class="text-muted">
                    Showing {{ $departments->firstItem() }} to {{ $departments->lastItem() }} of {{ $departments->total() }} records
                </small>
                <div>
                    {{ $departments->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
