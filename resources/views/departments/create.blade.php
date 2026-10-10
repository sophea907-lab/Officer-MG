@extends('layouts.app')

@section('title', 'Add Department')
@section('page-title', 'Create Department')
@section('page-subtitle', 'Add a new administrative department')

@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-lg-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <div class="d-flex align-items-center justify-content-between">
                    <span class="fw-bold text-dark">
                        <i class="bi bi-plus-circle-fill text-primary me-2"></i> New Department Information
                    </span>
                    <a href="{{ route('departments.index') }}" class="btn btn-sm btn-light border text-muted">
                        <i class="bi bi-arrow-left me-1"></i> Back to List
                    </a>
                </div>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('departments.store') }}">
                    @csrf
                    @include('departments._form')
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
