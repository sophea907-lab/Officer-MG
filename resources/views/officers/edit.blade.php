@extends('layouts.app')

@section('title', 'Edit Officer')
@section('page-title', 'Edit Officer')
@section('page-subtitle', 'Update officer information and assignments')

@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-xl-10">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <div class="d-flex align-items-center justify-content-between">
                    <span class="fw-bold text-dark">
                        <i class="bi bi-pencil-square text-primary me-2"></i> Edit Officer: {{ $officer->officer_name }}
                    </span>
                    <div class="d-flex gap-2">
                        <a href="{{ route('officers.show', $officer) }}" class="btn btn-sm btn-light border text-info">
                            <i class="bi bi-eye me-1"></i> View Details
                        </a>
                        <a href="{{ route('officers.index') }}" class="btn btn-sm btn-light border text-muted">
                            <i class="bi bi-arrow-left me-1"></i> Back to List
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('officers.update', $officer) }}">
                    @csrf
                    @method('PUT')
                    @include('officers._form', ['officer' => $officer])
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
