@extends('layouts.app')

@section('title', 'Edit Position')
@section('page-title', 'Edit Position')
@section('page-subtitle', 'Modify existing job position details')

@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-lg-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <div class="d-flex align-items-center justify-content-between">
                    <span class="fw-bold text-dark">
                        <i class="bi bi-pencil-square text-primary me-2"></i> Edit Position: {{ $position->position_name }}
                    </span>
                    <a href="{{ route('positions.index') }}" class="btn btn-sm btn-light border text-muted">
                        <i class="bi bi-arrow-left me-1"></i> Back to List
                    </a>
                </div>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('positions.update', $position) }}">
                    @csrf
                    @method('PUT')
                    @include('positions._form', ['position' => $position])
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
