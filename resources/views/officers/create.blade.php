@extends('layouts.app')

@section('title', 'Add Officer')
@section('page-title', 'Create Officer')
@section('page-subtitle', 'Register a new officer into the database')

@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-xl-10">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <div class="d-flex align-items-center justify-content-between">
                    <span class="fw-bold text-dark">
                        <i class="bi bi-person-plus-fill text-primary me-2"></i> Officer Registration Form
                    </span>
                    <a href="{{ route('officers.index') }}" class="btn btn-sm btn-light border text-muted">
                        <i class="bi bi-arrow-left me-1"></i> Back to Officers List
                    </a>
                </div>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('officers.store') }}">
                    @csrf
                    @include('officers._form')
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
