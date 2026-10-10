@extends('layouts.app')

@section('title', 'Positions')
@section('page-title', 'Positions')
@section('page-subtitle', 'Manage job titles, ranks, and roles')

@section('content')
<div class="row align-items-center mb-4 g-3">
    <div class="col-12 col-md-6">
        <form method="GET" action="{{ route('positions.index') }}" class="d-flex gap-2">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                <input type="text"
                       name="search"
                       class="form-control border-start-0 ps-0"
                       placeholder="Search position title or description..."
                       value="{{ $search ?? '' }}">
                @if(!empty($search))
                    <a href="{{ route('positions.index') }}" class="btn btn-outline-secondary" title="Clear Search">
                        <i class="bi bi-x-lg"></i>
                    </a>
                @endif
            </div>
            <button type="submit" class="btn btn-primary px-3">Search</button>
        </form>
    </div>
    <div class="col-12 col-md-6 text-md-end">
        <a href="{{ route('positions.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Add Position
        </a>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
        <div class="fw-bold text-dark">
            <i class="bi bi-briefcase-fill text-primary me-2"></i> Position List
            <span class="badge bg-secondary ms-2 fw-normal">{{ $positions->total() }} Total</span>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 70px;">#ID</th>
                        <th>Position Title</th>
                        <th>Description</th>
                        <th class="text-center" style="width: 150px;">Assigned Officers</th>
                        <th style="width: 150px;">Created Date</th>
                        <th class="text-end" style="width: 140px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($positions as $pos)
                        <tr>
                            <td class="text-muted fw-semibold">{{ $pos->id }}</td>
                            <td>
                                <div class="fw-semibold text-dark">{{ $pos->position_name }}</div>
                            </td>
                            <td>
                                <div class="text-muted small text-truncate" style="max-width: 320px;">
                                    {{ $pos->description ?: 'No description provided' }}
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="badge badge-pos px-2 py-1">
                                    <i class="bi bi-person-badge-fill me-1"></i> {{ $pos->officers_count }} Officer{{ $pos->officers_count === 1 ? '' : 's' }}
                                </span>
                            </td>
                            <td class="text-muted small">
                                {{ $pos->created_at ? $pos->created_at->format('M d, Y') : 'N/A' }}
                            </td>
                            <td class="text-end">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('positions.edit', $pos) }}" class="btn btn-light border text-primary" title="Edit Position">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <button type="button"
                                            class="btn btn-light border text-danger"
                                            title="Delete Position"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteConfirmModal"
                                            data-action="{{ route('positions.destroy', $pos) }}"
                                            data-name="Position: {{ $pos->position_name }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="bi bi-briefcase fs-1 d-block mb-2 text-secondary"></i>
                                    <h6 class="fw-semibold">No Positions Found</h6>
                                    <p class="small mb-3">
                                        @if(!empty($search))
                                            No positions match your search "{{ $search }}". Try clearing the filter.
                                        @else
                                            Start by defining the first job position or rank.
                                        @endif
                                    </p>
                                    @if(!empty($search))
                                        <a href="{{ route('positions.index') }}" class="btn btn-sm btn-outline-primary">Reset Search</a>
                                    @else
                                        <a href="{{ route('positions.create') }}" class="btn btn-sm btn-primary">Add Position</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($positions->hasPages())
        <div class="card-footer bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <small class="text-muted">
                    Showing {{ $positions->firstItem() }} to {{ $positions->lastItem() }} of {{ $positions->total() }} records
                </small>
                <div>
                    {{ $positions->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
