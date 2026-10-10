<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard') - {{ config('app.name', 'Officer Management System') }}</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    @stack('styles')
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <aside id="sidebar-wrapper" class="d-flex flex-column">
            <a href="{{ route('dashboard') }}" class="sidebar-brand">
                <i class="bi bi-shield-lock-fill"></i>
                <div class="d-flex flex-column">
                    <span class="lh-sm">OfficerSys</span>
                    <small class="text-secondary fw-normal" style="font-size: 0.72rem;">Admin Portal</small>
                </div>
            </a>

            <div class="sidebar-heading">Navigation</div>
            <ul class="sidebar-nav flex-grow-1">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('departments.index') }}" class="nav-link {{ request()->routeIs('departments.*') ? 'active' : '' }}">
                        <i class="bi bi-diagram-3"></i>
                        <span>Departments</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('positions.index') }}" class="nav-link {{ request()->routeIs('positions.*') ? 'active' : '' }}">
                        <i class="bi bi-briefcase"></i>
                        <span>Positions</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('officers.index') }}" class="nav-link {{ request()->routeIs('officers.*') ? 'active' : '' }}">
                        <i class="bi bi-people"></i>
                        <span>Officers</span>
                    </a>
                </li>
            </ul>

            <div class="sidebar-footer">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2 overflow-hidden">
                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold" style="width: 34px; height: 34px; min-width: 34px; font-size: 0.85rem;">
                            {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                        </div>
                        <div class="text-truncate">
                            <div class="text-white small fw-semibold text-truncate">{{ Auth::user()->name ?? 'Admin User' }}</div>
                            <div class="text-secondary small text-truncate" style="font-size: 0.75rem;">Administrator</div>
                        </div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm text-secondary p-1 border-0 hover-light" title="Sign Out">
                            <i class="bi bi-box-arrow-right fs-5"></i>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Page Content Wrapper -->
        <div id="page-content-wrapper">
            <!-- Top Navbar -->
            <header class="top-navbar d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3">
                    <button class="btn btn-light d-lg-none border" id="sidebarToggle" type="button" aria-label="Toggle navigation">
                        <i class="bi bi-list fs-5"></i>
                    </button>
                    <div>
                        <h1 class="h5 mb-0 fw-bold text-dark">@yield('page-title', 'Overview')</h1>
                        <small class="text-muted">@yield('page-subtitle', 'Management & Records')</small>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-3">
                    <div class="d-none d-md-flex align-items-center text-muted small gap-1">
                        <i class="bi bi-calendar3"></i>
                        <span>{{ now()->format('l, d M Y') }}</span>
                    </div>

                    <div class="dropdown">
                        <button class="btn btn-light border dropdown-toggle d-flex align-items-center gap-2 py-1 px-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 28px; height: 28px; font-size: 0.75rem;">
                                {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                            </div>
                            <span class="d-none d-sm-inline small fw-medium">{{ Auth::user()->name ?? 'Admin' }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                            <li><h6 class="dropdown-header">Signed in as <strong>{{ Auth::user()->email ?? 'admin' }}</strong></h6></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('dashboard') }}">
                                    <i class="bi bi-speedometer2 text-muted"></i> Dashboard
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('officers.create') }}">
                                    <i class="bi bi-person-plus text-muted"></i> Add Officer
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger d-flex align-items-center gap-2">
                                        <i class="bi bi-box-arrow-right"></i> Sign Out
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="main-content">
                <!-- Notifications / Flash Alerts -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 mb-4 shadow-sm" role="alert">
                        <i class="bi bi-check-circle-fill fs-5"></i>
                        <div>{{ session('success') }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2 mb-4 shadow-sm" role="alert">
                        <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                        <div>{{ session('error') }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show mb-4 shadow-sm" role="alert">
                        <div class="d-flex align-items-center gap-2 fw-semibold mb-1">
                            <i class="bi bi-exclamation-octagon-fill"></i>
                            <span>Please fix the following validation errors:</span>
                        </div>
                        <ul class="mb-0 ps-3 small">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Universal Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header border-bottom-0 pb-0">
                    <h5 class="modal-title fw-bold text-danger" id="deleteModalLabel">
                        <i class="bi bi-exclamation-triangle-fill me-1"></i> Confirm Deletion
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-3">
                    <p class="mb-1 text-muted" id="deleteModalMessage">Are you sure you want to delete this record?</p>
                    <small class="text-danger">This action cannot be undone.</small>
                </div>
                <div class="modal-footer border-top-0 pt-0">
                    <button type="button" class="btn btn-light border px-3" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteModalForm" method="POST" action="" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger px-3">
                            <i class="bi bi-trash me-1"></i> Delete Record
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 Bundle JS (Includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Vanilla JavaScript for Interactive UI -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Mobile sidebar toggle
            const sidebarToggle = document.getElementById('sidebarToggle');
            const wrapper = document.getElementById('wrapper');
            if (sidebarToggle && wrapper) {
                sidebarToggle.addEventListener('click', function () {
                    wrapper.classList.toggle('toggled');
                });
            }

            // Universal delete confirmation modal trigger
            const deleteModal = document.getElementById('deleteConfirmModal');
            if (deleteModal) {
                deleteModal.addEventListener('show.bs.modal', function (event) {
                    const button = event.relatedTarget;
                    const actionUrl = button.getAttribute('data-action');
                    const itemName = button.getAttribute('data-name') || 'this record';

                    const form = document.getElementById('deleteModalForm');
                    const message = document.getElementById('deleteModalMessage');

                    if (form && actionUrl) {
                        form.setAttribute('action', actionUrl);
                    }
                    if (message) {
                        message.innerHTML = `Are you sure you want to permanently delete <strong>${itemName}</strong>?`;
                    }
                });
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
