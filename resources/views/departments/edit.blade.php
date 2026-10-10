@extends('layouts.app')

@section('title', 'Edit Department')
@section('page-title', 'Edit Department')
@section('page-subtitle', 'Modify existing department details')

@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-lg-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <div class="d-flex align-items-center justify-content-between">
                    <span class="fw-bold text-dark">
                        <i class="bi bi-pencil-square text-primary me-2"></i> Edit Department: {{ $department->department_name }}
                    </span>
                    <a href="{{ route('departments.index') }}" class="btn btn-sm btn-light border text-muted">
                        <i class="bi bi-arrow-left me-1"></i> Back to List
                    </a>
                </div>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('departments.update', $department) }}">
                    @csrf
                    @method('PUT')
                    @include('departments._form', ['department' => $department])
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
