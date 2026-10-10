@extends('layouts.app')

@section('title', 'Admin Dashboard')
@section('page-title', 'Administrative Dashboard')
@section('page-subtitle', 'Real-time overview of personnel, departments, and operations')

@section('content')
<!-- Quick Action Bar -->
<div class="row align-items-center mb-4 g-3">
    <div class="col-12 col-md-6">
        <h5 class="fw-bold mb-1 text-dark">System Metrics & Statistics</h5>
        <p class="text-muted small mb-0">Live snapshot calculated from the MySQL database</p>
    </div>
    <div class="col-12 col-md-6 text-md-end">
        <div class="btn-group shadow-sm">
            <a href="{{ route('officers.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-person-plus-fill me-1"></i> New Officer
            </a>
            <a href="{{ route('departments.create') }}" class="btn btn-light border btn-sm">
                <i class="bi bi-diagram-3 me-1"></i> New Dept
            </a>
            <a href="{{ route('positions.create') }}" class="btn btn-light border btn-sm">
                <i class="bi bi-briefcase me-1"></i> New Position
            </a>
        </div>
    </div>
</div>

<!-- Key Stat Cards (6 Statistics) -->
<div class="row g-3 mb-4">
    <!-- Total Officers -->
    <div class="col-6 col-lg-4 col-xl-2">
        <div class="card stat-card border-0 shadow-sm p-3 h-100">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="text-muted small fw-semibold">Total Officers</span>
                <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                    <i class="bi bi-people-fill"></i>
                </div>
            </div>
            <h3 class="fw-bold mb-1 text-dark">{{ number_format($totalOfficers) }}</h3>
            <span class="small text-muted">All personnel</span>
        </div>
    </div>

    <!-- Active Officers -->
    <div class="col-6 col-lg-4 col-xl-2">
        <div class="card stat-card border-0 shadow-sm p-3 h-100">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="text-muted small fw-semibold">Active</span>
                <div class="stat-icon bg-success bg-opacity-10 text-success">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
            </div>
            <h3 class="fw-bold mb-1 text-success">{{ number_format($activeOfficers) }}</h3>
            <span class="small text-muted">{{ $totalOfficers > 0 ? round(($activeOfficers / $totalOfficers) * 100) : 0 }}% on duty</span>
        </div>
    </div>

    <!-- Inactive Officers -->
    <div class="col-6 col-lg-4 col-xl-2">
        <div class="card stat-card border-0 shadow-sm p-3 h-100">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="text-muted small fw-semibold">Inactive</span>
                <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                    <i class="bi bi-pause-circle-fill"></i>
                </div>
            </div>
            <h3 class="fw-bold mb-1 text-warning">{{ number_format($inactiveOfficers) }}</h3>
            <span class="small text-muted">On leave / suspended</span>
        </div>
    </div>

    <!-- Resigned Officers -->
    <div class="col-6 col-lg-4 col-xl-2">
        <div class="card stat-card border-0 shadow-sm p-3 h-100">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="text-muted small fw-semibold">Resigned</span>
                <div class="stat-icon bg-danger bg-opacity-10 text-danger">
                    <i class="bi bi-x-circle-fill"></i>
                </div>
            </div>
            <h3 class="fw-bold mb-1 text-danger">{{ number_format($resignedOfficers) }}</h3>
            <span class="small text-muted">Offboarded</span>
        </div>
    </div>

    <!-- Total Departments -->
    <div class="col-6 col-lg-4 col-xl-2">
        <div class="card stat-card border-0 shadow-sm p-3 h-100">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="text-muted small fw-semibold">Departments</span>
                <div class="stat-icon bg-purple bg-opacity-10 text-purple" style="background-color: #ede9fe; color: #6d28d9;">
                    <i class="bi bi-diagram-3-fill"></i>
                </div>
            </div>
            <h3 class="fw-bold mb-1 text-dark">{{ number_format($totalDepartments) }}</h3>
            <span class="small text-muted">Org units</span>
        </div>
    </div>

    <!-- Total Positions -->
    <div class="col-6 col-lg-4 col-xl-2">
        <div class="card stat-card border-0 shadow-sm p-3 h-100">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="text-muted small fw-semibold">Positions</span>
                <div class="stat-icon bg-info bg-opacity-10 text-info">
                    <i class="bi bi-briefcase-fill"></i>
                </div>
            </div>
            <h3 class="fw-bold mb-1 text-dark">{{ number_format($totalPositions) }}</h3>
            <span class="small text-muted">Job titles</span>
        </div>
    </div>
</div>

<!-- Main Dashboard Grid -->
<div class="row g-4 mb-4">
    <!-- Recent Officers Table -->
    <div class="col-12 col-xl-8">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                <span class="fw-bold text-dark">
                    <i class="bi bi-clock-history text-primary me-2"></i> Recently Registered Officers
                </span>
                <a href="{{ route('officers.index') }}" class="btn btn-sm btn-link text-primary text-decoration-none p-0 fw-semibold">
                    View All Directory <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Officer Name</th>
                                <th>Department</th>
                                <th>Position</th>
                                <th class="text-center">Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentOfficers as $officer)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="rounded-circle bg-light border text-primary fw-bold d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; min-width: 32px; font-size: 0.8rem;">
                                                {{ strtoupper(substr($officer->officer_name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <a href="{{ route('officers.show', $officer) }}" class="fw-semibold text-dark text-decoration-none">
                                                    {{ $officer->officer_name }}
                                                </a>
                                                <div class="text-muted small">{{ $officer->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge badge-dept">{{ $officer->department->department_name ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-pos">{{ $officer->position->position_name ?? 'N/A' }}</span>
                                    </td>
                                    <td class="text-center">
                                        @if($officer->status === 'Active')
                                            <span class="badge badge-status badge-active">Active</span>
                                        @elseif($officer->status === 'Inactive')
                                            <span class="badge badge-status badge-inactive">Inactive</span>
                                        @else
                                            <span class="badge badge-status badge-resigned">Resigned</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('officers.show', $officer) }}" class="btn btn-sm btn-light border text-info" title="View Profile">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">
                                        No officer records found. <a href="{{ route('officers.create') }}">Add the first officer</a>.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Overview & Department Distribution -->
    <div class="col-12 col-xl-4">
        <!-- Status Overview Card -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white py-3">
                <span class="fw-bold text-dark">
                    <i class="bi bi-pie-chart-fill text-primary me-2"></i> Status Distribution
                </span>
            </div>
            <div class="card-body p-3">
                @php
                    $activePercent = $totalOfficers > 0 ? round(($activeOfficers / $totalOfficers) * 100) : 0;
                    $inactivePercent = $totalOfficers > 0 ? round(($inactiveOfficers / $totalOfficers) * 100) : 0;
                    $resignedPercent = $totalOfficers > 0 ? round(($resignedOfficers / $totalOfficers) * 100) : 0;
                @endphp
                <div class="progress mb-3" style="height: 10px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ $activePercent }}%" title="Active: {{ $activePercent }}%"></div>
                    <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $inactivePercent }}%" title="Inactive: {{ $inactivePercent }}%"></div>
                    <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $resignedPercent }}%" title="Resigned: {{ $resignedPercent }}%"></div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-success rounded-circle p-1"> </span>
                        <span class="small text-muted">Active Duty</span>
                    </div>
                    <span class="small fw-bold">{{ $activeOfficers }} ({{ $activePercent }}%)</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-warning rounded-circle p-1"> </span>
                        <span class="small text-muted">Inactive / Leave</span>
                    </div>
                    <span class="small fw-bold">{{ $inactiveOfficers }} ({{ $inactivePercent }}%)</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-danger rounded-circle p-1"> </span>
                        <span class="small text-muted">Resigned</span>
                    </div>
                    <span class="small fw-bold">{{ $resignedOfficers }} ({{ $resignedPercent }}%)</span>
                </div>
            </div>
        </div>

        <!-- Officers by Department Card -->
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                <span class="fw-bold text-dark">
                    <i class="bi bi-diagram-3-fill text-primary me-2"></i> Officers by Department
                </span>
                <a href="{{ route('departments.index') }}" class="small text-decoration-none text-muted">All</a>
            </div>
            <div class="card-body p-3">
                @forelse($departmentsSummary as $dept)
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="small fw-semibold text-dark text-truncate" style="max-width: 200px;">{{ $dept->department_name }}</span>
                            <span class="small text-muted fw-bold">{{ $dept->officers_count }}</span>
                        </div>
                        @php
                            $deptPercent = $totalOfficers > 0 ? round(($dept->officers_count / $totalOfficers) * 100) : 0;
                        @endphp
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $deptPercent }}%"></div>
                        </div>
                    </div>
                @empty
                    <div class="text-muted small text-center py-2">No departments yet.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
